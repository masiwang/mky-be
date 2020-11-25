<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\v1\TransactionController;
use App\Http\Resources\User as UserResources;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Auth;
use Hash;
use JWTAuth;
use Mail;
use Str;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){
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

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'logged_out']);
    }

    public function register(Request $request){
        // validasi email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        // jika password tidak sama dengan password_confirm
        if(!($request->password == $request->password_confirm)){
            // maka di kembalikan dengan status Bad request
            return response()->json(['status' => 'Bad request', 'message' => 'Konfirmasi password tidak sama.'], 400);
        }
        // jika email telah terdaftar
        if(User::where('email', $request->email)->first()){
            // maka kembalikan dengan status Bad request
            return response()->json(['status' => 'Bad request', 'message' => 'Email telah terdaftar.'], 400);
        }
        // inisiasi user baru
        $token = rand(1000, 9999);
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_token = $token;
        $user->remember_token = Str::random(32);
        $user->getting_started_level = 0;
        // jika berhasil menambahkan user baru
        if($user->save()){
            // kirim token ke email
            Mail::send('templates.email_verification', ['token' => $token], function ($m) use ($request) {
                $m->from('no-reply@makarya.in', 'Makarya - PT. Inspira Karya Teknologi Nusantara');
                $m->to($request->email)->subject('Email verification @makarya.in');
            });
            // mencoba login dengan email dan password
            $credentials = $request->only('email', 'password');
            try{
                if( !$token = JWTAuth::attempt($credentials) ){
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            }catch(JWTException $e){
                return response()->json(['could_not_create_token create token.'], 500);
            }
            // jika berhasil, kembalikan token
            return response()->json(compact('token'), 200);
        }else{
            // jika tidak berhasil, kembalikan status Bad request
            return response()->json(['status' => 'Bad request'], 400);
        }
    }

    public function user(Request $request){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if( !$user ){
                return response()->json(['error' => 'user_not_found'], 404);
            }
        }catch(TokenExpiredException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        }catch(JWTException $e){
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // $user = new UserResources($user);
        return response()->json(compact('user'), 200);
    }

    public function user_edit(Request $request){
        $user = User::find(Auth::id());
        if($request->name){
            $request->validate(['name' => 'min:6']);
            $user->name = $request->name;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($request->jalan){
            $request->validate([
                'jalan' => 'required|min:6',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kodepos' => 'required',
            ]);
            $user->jalan = $request->jalan;
            $user->provinsi = $request->provinsi;
            $user->kabupaten = $request->kabupaten;
            $user->kecamatan = $request->kecamatan;
            $user->kelurahan = $request->kelurahan;
            $user->kodepos = $request->kodepos;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($request->phone){
            $request->validate(['phone' => 'required|min:9']);
            $user->phone = $request->phone;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($request->job){
            $request->validate(['job' => 'required|min:3']);
            $user->job = $request->job;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($request->password){
            $request->validate([
                'password_old' => 'required',
                'password' => 'required|min:8'
            ]);
            if(!($request->password == $request->password_confirm)){
                return response()->json(['status' => 'Bad request', 'message' => 'Konfirmasi password tidak tepat.'], 400);
            }
            if(!(Hash::check($request->password_old, $user->password))){
                return response()->json(['status' => 'Bad request', 'message' => 'Password lama tidak dikenali.'], 400);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->respondWithToken(['status' => 'success'], 200);
        }
    }

    public function get_started(Request $request){
        $user = Auth::user();
        if($user->getting_started_level == 0){
            if($request->email_token == $user->email_token){
                $user->email_verified_at = Carbon::now();
                $user->getting_started_level = 1;
                $user->save();
                return $this->respondWithToken(Auth::user(), 200);
            }else{
                return response()->json(['status' => 'Bad request', 'message' => 'Token tidak dikenali.'], 400);
            }
        }
        if($user->getting_started_level == 1){
            $request->validate([
                'name' => 'required|min:4',
                'birthday' => 'required',
                'gender' => 'required',
                'phone' => 'required'
            ]);
            $user->name = $request->name;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->job = $request->job;
            $user->getting_started_level = 2;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($user->getting_started_level == 2){
            $request->validate([
                'jalan' => 'required|min:6',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kodepos' => 'required',
            ]);
            $user->jalan = $request->jalan;
            $user->provinsi = $request->provinsi;
            $user->kabupaten = $request->kabupaten;
            $user->kecamatan = $request->kecamatan;
            $user->kelurahan = $request->kelurahan;
            $user->kodepos = $request->kodepos;
            $user->getting_started_level = 3;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($user->getting_started_level == 3){
            $request->validate([
                'ktp' => 'required',
                'ktp_image' => 'required'
            ]);
            $user->ktp = $request->ktp;
            $user->ktp_image = $request->ktp_image;
            $user->getting_started_level = 4;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
        if($user->getting_started_level == 4){
            $request->validate([
                'ttd' => 'required'
            ]);
            $user->ttd = $request->ttd;
            $user->getting_started_level = 5;
            $user->save();
            return $this->respondWithToken(Auth::user(), 200);
        }
    }

    public function refresh(){
        $refreshed = JWTAuth::refresh(JWTAuth::getToken());
        $user = JWTAuth::setToken($refreshed)->toUser();
        return response()->json(['token' => $refreshed]);
    }

    protected function tokenizer($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
