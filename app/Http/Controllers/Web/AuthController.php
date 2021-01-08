<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Session;
use Str;
use Mail;
use App\Mail\ForgotPassword;
use App\Mail\EmailToken;

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
        return view('pages.register');
    }

    public function registerSave(Request $request){
        // TODO: validate
        $email = $request->email ? $request->email : false;
        $password = Str::length($request->password) > 7 ? $request->password : false;
        
        $email_exist = User::where('email', $email)->first();
        $password_match = $password == $request->password_confirm;

        if($email && $password && !$email_exist){
          $email_token = rand(1000, 9999);
          $user = new User;
          $user->email = $email;
          $user->email_token = $email_token;
          $user->password = Hash::make($password);
          $user->remember_token = Str::random(100);
          $user->level = 0;
          $user->save();
          // kirim email verifikasi
          
          // auth
          $credential = $request->only('email', 'password');
          if(Auth::attempt($credential)){
            $user = User::find(Auth::id());
            Mail::to($user)->send(new EmailToken($user));
            return redirect('/getting-started');
          }
        }else{
          return back()->with([
            'email' => (!$email) ? 'Email tidak valid' : null,
            'password' => (!$password) ? 'Password tidak boleh kurang dari 8 karakter' : null,
            'email_exist' => ($email_exist) ? 'Email telah terdaftar sebelumnya' : null,
            'password_match' => (!$password_match) ? 'Konfirmasi password tidak cocok' : null
          ]);
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function forgotViewEmail(){
      return view('pages.forgot.step1');
    }

    public function forgotSaveEmail(Request $req){
      $user = User::where('email', $req->email)->first();
      if(!$user){
        return back()->with('error', 'Akun tidak ditemukan.');
      }
      $user->remember_token = Str::random(64);
      $user->save();
      Mail::to($user)->send(new ForgotPassword($user));
      return redirect('/forgot/reset');
    }

    public function forgotViewPassword(){
      return view('pages.forgot.step2');
    }

    public function forgotSavePassword(Request $request){
      if(!$request->token || Str::length($request->token) < 64){
        return back()->with('error', 'Token tidak valid.');
      }

      if(!$request->new_password || Str::length($request->new_password) < 6){
        return back()->with('error', 'Password harus lebih dari 6 karakter');
      }

      if(!($request->new_password == $request->new_password_confirm)){
        return back()->with('error', 'Konfirmasi password tidak tepat');
      }

      $user = User::where('remember_token', $request->token)->first();
      $user->password = Hash::make($request->new_password);
      
      if($user->save()){
        return redirect('/login')->with('reset_password_success', 'Password Anda berhasil diubah.');
      }else{
        return back()->with('error', 'Maaf terdapat kesalahan. Ulangi sekali lagi.');
      }
    }

    public function resendToken(){
      $user = User::find(Auth::id());
      Mail::to($user)->send(new EmailToken($user));
      return back()->with('email', 'Token telah dikirim ulang, periksa email anda untuk konfirmasi token.');
    }
}
