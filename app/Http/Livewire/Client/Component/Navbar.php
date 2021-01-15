<?php

namespace App\Http\Livewire\Client\Component;

use Livewire\Component;
use Auth;
use App\Models\Notification as NotificationDB;

class Navbar extends Component
{
  public function logout(){
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
  }
  
  public function render(){
    $navbar_user = Auth::user();
    $navbar_notification = NotificationDB::where('user_id', Auth::id())
      ->where('status', 'unread')->count();
    return view('livewire.client.component.navbar', compact('navbar_user', 'navbar_notification'));
  }
}
