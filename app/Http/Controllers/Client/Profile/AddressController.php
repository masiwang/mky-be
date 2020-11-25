<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AddressController extends Controller
{
    public function address(){
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.dashboard.profile.address', ['user'=> $user, $saldo => 'saldo']);
    }
}
