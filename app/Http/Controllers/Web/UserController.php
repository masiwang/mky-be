<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $transactions = Transaction::where('user_id', $user->id)->get();
    return view('pages.profile.index', compact('transactions', 'user'));
  }
}
