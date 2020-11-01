<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdaterController extends Controller
{
    public function check_update(){
        return response()->json(['is_available' => true, 'version' => 'v0.1', 'link' => 'http://google.com'], 200);
    }
}
