<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
use App\Models\User;
use Auth;
use Mail;
use App\Mail\ForgotPassword;
use Str;
use Hash;

class UserController extends Controller{
  protected function respondWithToken($token){
    return response()->json([
      'token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
  }

  public function doLogin(Request $req){
    $email_is_exist = User::where('email', $req->email)->first();
    if(!$email_is_exist){
      return response()->json(['error' => 'Email tidak ditemukan'], 401);
    }

    $credentials = $req->only('email', 'password');
    
    $token = auth('api')->setTTL(43200)->attempt($credentials);

    if(!$token){
      $error = 'Unauthorized';
      return response()->json(compact('error'), 401);
    }

    return $this->respondWithToken($token);
  }

  public function doRefresh(Request $req){
    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
    $user = JWTAuth::setToken($refreshed)->toUser();
    return $this->respondWithToken($refreshed);
  }

  public function getUser(){
    return Auth::user();
  }

  public function forgotPost(Request $req){
    $user = User::where('email', $req->email)->first();

    if(!$user){
      return response()->json(['status' => 'Email tidak terdaftar'], 404);
    }

    $user->remember_token = Str::random(64);
    $user->save();
    // kirim token reset password
    Mail::to($user)->send(new ForgotPassword($user));

    return response()->json(['status' => 'Sukses'], 200);
  }

  public function resetPassword(Request $req){
    $user = User::where('remember_token', $req->token)->first();

    if(!$user){
      return response()->json(['status' => 'Token tidak valid'], 400);
    }

    if(Str::length($req->new_password) < 6){
      return response()->json(['status' => 'Password tidak boleh kurang dari 6 karakter'], 400);
    }

    if(!($req->new_password == $req->new_password_confirm)){
      return response()->json(['status' => 'Konfirmasi password tidak sama'], 400);
    }

    $user->password = Hash::make($req->new_password);
    $user->save();

    return response()->json(['status' => 'Password berhasil diubah'], 200);
  }

  public function logout(){
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['status' => 'Logged out'], 200);
  }

  protected function _resourceProfile($user){
    $response = [
      'name' => $user->name,
      'saldo' => $user->saldo,
      'ktp' => $user->ktp,
      'bank_type' => $user->bank_type,
      'bank_acc' => $user->bank_acc,
      'email' => $user->email,
      'phone' => $user->phone,
      'jalan' => $user->jalan,
      'alamat' => $user->kelurahan.', '.$user->kecamatan.', '.$user->kabupaten.' '.$user->kodepos,
      'job' => $user->job
    ];
    return $response;
  }
  public function profile(){
    $user = $this->getUser();
    $user = $this->_resourceProfile($user);
    return response()->json(compact('user'), 200);
  }
}
