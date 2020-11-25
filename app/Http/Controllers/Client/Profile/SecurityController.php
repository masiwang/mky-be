<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SecurityController extends Controller
{
    public function security(){
        $user = Auth::user();
        return view('client.dashboard.profile.security', ['user' => $user]);
    }
}
