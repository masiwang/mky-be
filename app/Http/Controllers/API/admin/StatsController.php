<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\admin\FundController;
use App\Http\Controllers\API\admin\UserController;
use App\Http\Controllers\API\admin\VendorController;

class StatsController extends Controller
{
    public function stats(){
        $fund = FundController::stats();
        return response()->json(compact('fund'), 200);
    }
}
