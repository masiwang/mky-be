<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
  public function index(){
    $user = $this->getUser();
    return view('pages.about-us', compact('user'));
  }
}
