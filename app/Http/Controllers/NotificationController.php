<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    $notification_detail = '';
    return view('pages.notification.index', compact('notifications', 'notification_detail', 'user'));
  }

  public function detail($id){
    $user = $this->getUser();
    $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    $notification_detail = Notification::where('user_id', $user->id)->where('id', $id)->first();
    $notification_detail->status = 'read';
    $notification_detail->save();
    return view('pages.notification.index', compact('notifications', 'notification_detail', 'user'));
  }
}
