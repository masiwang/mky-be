<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;

class FileController extends Controller
{
    public function upload(Request $request){
        $image_name = Str::random(32).'.jpg';
        $request->image->move('assets/', $image_name);
        return response()->json(['location' => 'https://dev.makarya.in/assets/'.$image_name]);
    }
}
