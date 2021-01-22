<?php

namespace App\Http\Livewire\Client\Component;

use Livewire\Component;
use Auth;
use App\Models\Notification as NotificationDB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Navbar extends Component
{
  public function logout(){
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
  }

  public function darkmode(){
    $darkmode = Session::has('dark-mode');

    if($darkmode){
      $darkmode_active = Session::get('dark-mode');
      if($darkmode_active){
        Session::put(['dark-mode' => false]);
      }else{
        Session::put(['dark-mode' => true]);
      }
    }else{
      Session::put(['dark-mode' => true]);
    }
    
    $this->dispatchBrowserEvent('reload');
  }
  
  public function render(){
    $navbar_user = Auth::user();
    $navbar_notification = NotificationDB::where('user_id', Auth::id())
      ->where('status', 'unread')->count();
    return view('livewire.client.component.navbar', compact('navbar_user', 'navbar_notification'));
  }
}
