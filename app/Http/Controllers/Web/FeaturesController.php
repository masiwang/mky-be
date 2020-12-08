<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
  public function index(){
    $user = $this->getUser();
    return view('pages.features', compact('user'));
  }
}
