<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $transactions = Transaction::where('user_id', $user->id)->get();
    return view('pages.profile.index', compact('transactions', 'user'));
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
    $image = $request->image ?? null;

    if($name && $birthday && $gender && $phone && $ktp){
      $image_name = $this->setImage($image);
      $user->image = $image_name;
    }
    $user->save();
    return redirect('profile');
}
}
