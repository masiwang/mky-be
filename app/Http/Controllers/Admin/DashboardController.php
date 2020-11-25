<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundProduct;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function _stats($object){
        $this_month = new Carbon('1-'.date('n').'-'.date('Y'));
        $total = $object->count();
        $new = $object->where('created_at', '>=', $this_month)->count();
        return compact('new', 'total');
    }

    public function index(){
        $notifications = Notification::where('status', 'unread')->orderBy('id', 'desc')->get();

        $fund = $this->_stats(new FundProduct);
        $user = $this->_stats(new User);
        $vendor = $this->_stats(new Vendor);
        $stats = compact('fund', 'user', 'vendor');

        return response()->json(compact('notifications', 'stats'), 200);


    }
}
