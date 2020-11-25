<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;

class FileController extends Controller
{
  public function image(Request $request){
    $image_name = Str::random(32).'.jpg';
    $request->image->move('assets/', $image_name);
    return response()->json(['location' => 'https://127.0.0.1:8000/assets/'.$image_name]);
  }
}
