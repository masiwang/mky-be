<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as UserDB;
use Hash;

class Reset extends Component
{
  public $token, $user, $password, $password_confirm;
  
  public function mount($token){
    $this->token = $token;
    $user = UserDB::where('remember_token', $this->token)->first();
    if(!$user){
      return abort(404);
    }
  }

  public function update(){
    $user = UserDB::where('remember_token', $this->token)->first();
    $user->update([
      'password' => Hash::make($this->password),
      'remember_token' => null
    ]);
    return redirect('/login');
  }

  public function render(){
    return view('livewire.reset')->layout('livewire._layout', ['title' => 'Reset Password']);
  }
}
