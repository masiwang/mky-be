<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Carbon\Carbon;

class VendorController extends Controller
{
    public function stats(){
        $this_month = new Carbon('1-'.date('n').'-'.date('Y'));
        $total = Vendor::count();
        $new = Vendor::where('created_at', '>=', $this_month)->count();
        $vendor = compact('new', 'total');
        return response()->json(compact('vendor'), 200);
    }
}
