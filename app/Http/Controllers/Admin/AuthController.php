<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;

class AuthController extends Controller
{
  public function loginSave(Request $request){
    /// cek email
    $email_is_not_admin = User::where('email', $request->email)->where('role', 'admin')->first();
    if(!$email_is_not_admin){
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    $credentials = $request->only('email', 'password');

    if($request->remember_me){
      $token = auth('api')->setTTL(43200)->attempt($credentials);
    }else{
      $token = auth('api')->attempt($credentials);
    }
    
    if(!$token){
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  public function logout(){
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['status' => 200, 'message' => 'success']);
  }

  public function refreshToken(){
    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
    $user = JWTAuth::setToken($refreshed)->toUser();
    return response()->json(['token' => $refreshed]);
  }

  protected function respondWithToken($token){
    return response()->json([
      'token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
  }
}
