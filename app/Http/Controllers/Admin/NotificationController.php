<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Str;

class NotificationController extends Controller
{
    protected function _createAvatarChar($username){
      $avatar = '';
      foreach ($username as $name) {
        $avatar = $avatar.substr($name, 0, 1);
      }
      return $avatar;
    }
    protected function _resourceNotificationList($notifications){
      $response = [];
      foreach ($notifications as $notification) {
        $username = $notification->user->name;
        $data = [
          'id' => $notification->id,
          'avatar' => $this->_createAvatarChar(explode(' ', $username)),
          'username' => $username,
          'title' => $notification->title,
          'body' => substr($notification->body, 0, 500).(Str::length($notification->body) > 50 ? '...' : '')
        ];
        array_push($response, $data);
      }
      return $response;
    }
    public function index(){
      $notifications = $this->_resourceNotificationList( Notification::orderBy('id', 'desc')->get() );
      return response()->json(compact('notifications'), 200);
    }
    protected function _resourceNotificationDetail($notification){
      $response = [
        'id' => $notification->id,
        'time' => $notification->created_at,
        'title' => $notification->title,
        'body' => $notification->body,
        'user_id' => $notification->user_id,
        'username' => $notification->user->name
      ];
      return $response;
    }
    public function detail($id){
      $notification = $this->_resourceNotificationDetail( Notification::find($id) );
      return response()->json($notification, 200);
    }
}
