<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Session;
use Str;
use Mail;

class AuthController extends Controller
{
  public function login(){
    $user = $this->getUser();
    return $user ? redirect('/') : view('pages.login');
  }

  public function login_save(Request $request){
    $credential = $request->only('email', 'password');
    
    if( Auth::attempt($credential) ){
      $user = Auth::user();
      $user_level = $user->level;
      // jika level = 5 maka redirect ke /, jika tidak maka redirect ke getting-started
      return ($user_level == 5) ? redirect('/') : redirect('/getting-started');
    }
    // jika credential salah, maka kembali dengan error
    return back()->with('error', 'Email atau password salah.')->withInput();
  }

    public function register(){
        return view('auth/register');
    }

    public function register_do(Request $request){
        // TODO: validate
        $email_is_exist = User::where('email', $request->email)->first();
        if($email_is_exist){
            return back()->with(['email' => 'Email telah terdaftar']);
        }
        if(!($request->password == $request->password_confirm)){
            return back()->with(['password' => 'Periksa kembali password Anda.']);
        }
        // write data
        $email_token = rand (1000,9999);
        $user = new User;
        $user->email = $request->email;
        $user->email_token = $email_token;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(100);
        $user->created_at = Carbon::now();
        $user->getting_started_level = 0;
        $user->save();
        // TODO: kirim verifikasi email
        Mail::send('template.email.verification', ['token' => $user->email_token], function ($m) use ($request) {
            $m->from('no-reply@makarya.in', 'Makarya - PT. Inspira Karya Teknologi Nusantara');
            $m->to($request->email)->subject('Email verification @makarya.in');
        });

        // Login
        $credential = $request->only('email', 'password');

        if( Auth::attempt($credential) ){
            return redirect('/getting-started');
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
