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
    $credentials = $request->only('email', 'password');
    try{
      if( !$token = JWTAuth::attempt($credentials) ){
        return response()->json(['error' => 'invalid_credentials'], 400);
      }
    }catch(JWTException $e){
      return response()->json(['could_not_create_token create token.'], 500);
    }
    return response()->json(compact('token'), 200);
  }
}
