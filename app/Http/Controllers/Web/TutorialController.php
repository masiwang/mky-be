<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
  public function index(){
    $user = $this->getUser();
    return view('pages.tutorial', compact('user'));
  }
}
