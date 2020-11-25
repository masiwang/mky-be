<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notification_get(Request $request){
        $notifications = new Notification;

        if($request->status){
            $notifications = $notifications->where('status', $request->status)->get();
            return response()->json(compact('notifications'), 200);
        }
    }
}
