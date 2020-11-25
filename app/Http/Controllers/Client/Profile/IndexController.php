<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Auth;

class IndexController extends Controller
{
    public function profile(){
        $user = Auth::user();
        $saldo = $this->saldo();
        $transactions=Transaction::where('user_id',$user->id)->orderBy('updated_at', 'DESC')->get();
        return view('client.dashboard.profile.index', ['user' => $user, 'saldo' => $saldo, 'transactions' => $transactions]);
    }

    public function update_save(Request $request){
        $user = User::find(Auth::id());
        $user->name = $request->name;
        if($request->birthday){
            $user->birthday = $request->birthday;
        }
        if($request->gender){
            $user->gender = $request->gender;
        }
        $user->phone = $request->phone;
        $user->ktp = $request->ktp;
        $user->save();
        return redirect('profile');
    }
}