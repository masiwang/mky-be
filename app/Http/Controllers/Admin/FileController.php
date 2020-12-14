<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;

class FileController extends Controller
{
  public function image(Request $request){
    $image = $request->file('image');
    $image_name = Str::random(32);
    $product_image = Image::make($image->getRealPath());
    $product_image->resize(500, 500, function($constraint){
      $constraint->aspectRatio();
    })->save('asset/fund/'.$image_name.'.jpg');
    return response()->json(['location' => '/assets/fund/'.$image_name.'.jpg']);
  }
}
