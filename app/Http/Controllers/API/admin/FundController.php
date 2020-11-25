<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminFundProductFrontPageCollection as FundProductFrontPage;
use Illuminate\Http\Request;
use App\Models\FundProduct;
use Carbon\Carbon;

class FundController extends Controller
{
    public function stats(){
        $this_month = new Carbon('1-'.date('n').'-'.date('Y'));
        $total = FundProduct::count();
        $new = FundProduct::where('created_at', '>=', $this_month)->count();
        $fund = compact('new', 'total');
        return response()->json(compact('fund'), 200);
    }
}
