<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\Notification as NotificationResources;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function index(){
        return view('client.notification.index', ['user' => Auth::user()]);
    }

    public function _get(){
        $notification = Notification::where('received_by', Auth::id())->get();
        $notification = new NotificationCollection($notification);
        return response()->json($notification, 200);
    }

    public function _detail($id){
        $notification = Notification::where(['id' => $id, 'received_by' => Auth::id()])->first();
        if(!$notification){
            return response()->json(['status', 'error'], 400);
        }
        // jika notifikasi di akses, artinya notifikasi telah dibuka. update is_open = true
        $notification->is_open = 1;
        $notification->save();
        $notification_res = new NotificationResources($notification);
        return response()->json($notification_res, 200);
    }
}
