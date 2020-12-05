<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
  protected function _resourceNotifications($notifications){
    $response = [];
    foreach ($notifications as $notification) {
      $data = [
        'id' => $notification->id,
        'avatar' => substr($notification->title, 0, 1),
        'title' => $notification->title,
        'status' => $notification->status,
        'body' => substr($notification->body, 0, 100)
      ];
      array_push($response, $data);
    }
    return $response;
  }
  public function notification(){
    $user = $this->getUser();
    $notifications = Notification::where('user_id', $user->id)->get();
    $notifications = $this->_resourceNotifications($notifications);
    return response()->json(compact('notifications'), 200);
  }
}
