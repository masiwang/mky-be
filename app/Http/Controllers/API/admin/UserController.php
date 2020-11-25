<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Models\FundCheckout;
use App\Models\FundProduct;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    protected function _countTotalFunding($user){
        $portofolios = $user->portofolio;
        $total_funding = 0;
        foreach ($portofolios as $portofolio) {
            $funding_qty = $portofolio->qty;
            $product_price = $portofolio->product->price;
            $total_funding = $total_funding + ($funding_qty * $product_price);
        }
        return $total_funding;
    }
    protected function _countTotalWithdraw($user){
        $total_withdraw = 0;
        $transactions = $user->transaction->where('comment', 'withdraw');
        foreach ($transactions as $transaction) {
            $withdraw = $transaction->nominal;
            $total_withdraw = $total_withdraw + (-1*$withdraw);
        }
        return $total_withdraw;
    }
    protected function _resourceMainTable($users){
        $response = [];
        foreach ($users as $user) {
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'portofolio' => $user->portofolio->count(),
                'total_funding' => $this->_countTotalFunding($user),
                'total_withdraw' => $this->_countTotalWithdraw($user)
            ];
            array_push($response, $data);
        }
        return $response;
    }
    protected function _resourceConfirmationTable($users){
        $response = [];
        foreach($users as $user){
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'join_at' => $user->created_at,
                'ktp' => $user->ktp_image
            ];
            array_push($response, $data);
        }
        return $response;
    }

    public function count(){
        $count = User::count();
        return response()->json($count, 200);
    }

    public function user(){
        $users = User::all();
        $response = $this->_resourceMainTable($users);
        return response()->json($response, 200);
    }

    public function last_month(){
        $users = User::where('created_at', '>=', Carbon::now()->subMonths(1))->get();
        $response = $this->_resourceMainTable($users);
        return response()->json($response, 200);
    }

    public function ktp_unconfirmed(){
        $users = User::whereNotNull('ktp_image')->whereNull('ktp_verified_at')->get();
        $response = $this->_resourceConfirmationTable($users);
        return response()->json($response, 200);
    }

    public function stats(){
        $this_month = new Carbon('1-'.date('n').'-'.date('Y'));
        $total = User::count();
        $new = User::where('created_at', '>=', $this_month)->count();
        $user = compact('new', 'total');
        return response()->json(compact('user'), 200);
    }

}
