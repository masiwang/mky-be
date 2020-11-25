<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $saldo = $this->saldo();
        if(Auth::user()){
            if($user->getting_started_level < 5){
                return redirect('/getting-started');
            }
            return view('client.index', compact('user','saldo'));
        }else{
            return view('client.landing', compact('user','saldo'));
        }
    }
}
