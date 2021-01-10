<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as UserDB;
use Auth as AuthLib;
use App\Mail\EmailToken as EmailTokenMail;
use App\Mail\ForgotPassword as ForgotPasswordMail;
use Mail;
use Str;

class Auth extends Component
{
  public $email, $password;
  public $login_error;
  public $view = 'login';

  public function login(){
    $user = UserDB::where('email', $this->email)->first();
    if(!$user){
      session()->flash('error', 'Email tidak ditemukan.');
    }else{
      $login = AuthLib::attempt(['email' => $this->email, 'password' => $this->password]);
      if($login){
        return redirect('/');
      }else{
        session()->flash('error', 'Password salah.');
      }
    }
  }

  public function register(){
    $this->validate([
      'password' => 'min:6'
    ]);
    $user = UserDB::create([
      'email' => $this->email,
      'password' => Hash::make($this->password),
      'email_token' => rand(1000, 9999)
    ]);
    $email = Mail::send(new EmailTokenMail($user));
    $this->login();
  }

  public function forgot(){
    $user = UserDB::where('email', $this->email)->first();
    if($user){
      $user->remember_token = Str::random(32);
      $user->save();
      $email = Mail::send(new ForgotPasswordMail($user));
      session()->flash('success', 'Token lupa password telah dikirim ke email Anda.');
    }else{
      session()->flash('error', 'Email tidak ditemukan.');
    }
  }

  public function auth(){
    $view = $this->view;
    if($view == 'login'){
      $this->login();
    }else if($view == 'register'){
      $this->register();
    }else{
      $this->forgot();
    }
  }

  public function closeToast(){
    session()->put('error', null);
  }

  public function render(){
    return view('livewire.auth')->layout('livewire._layout');
  }
}
