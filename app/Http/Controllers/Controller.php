<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $perpage = 10;

    public function respondWithToken($data, $status){
        return response()->json([
            'token' => auth()->setTTL(60*24*7)->refresh(),
            'data' => $data
        ], $status);
    }
}
