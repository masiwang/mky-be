<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
  public function index(){
    $user = Auth::user();
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
    $user->save();
    return redirect('profile');
  }
  public function update_foto(Request $request){
    $user = User::find(Auth::id());
    // upload image
    $request->validate([
      'image' => 'required|max:5120'
    ]);
    $user_image = Image::make($request->file('image')->getRealPath());
    $user_image->resize(300, 300, function($constraint){
      $constraint->aspectRatio();
    })->save('assets/user/'.$user->id.'.jpg');

    $image_name = '/assets/user/'.$user->id.'.jpg';
    $user->image = $image_name;
    $user->save();
    return redirect('profile');
  }
}
