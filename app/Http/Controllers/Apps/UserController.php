<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
use App\Models\User;
use Auth;

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

  
}
