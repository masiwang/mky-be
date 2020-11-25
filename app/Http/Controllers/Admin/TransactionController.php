<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  public function _resourceTransaction($transactions){
    $response = [];
    foreach ($transactions as $transaction) {
      $data = [
        'code' => $transaction->code,
        'time' => $transaction->created_at,
        'type' => substr($transaction->code, 4, 1),
        'bank' => $transaction->bank_type.' '.$transaction->bank_acc,
        'nominal' => $transaction->nominal,
        'status' => $transaction->approved_at
      ];
      array_push($response, $data);
    }
    return $response;
  }

  protected function _resourceConfirmation($transactions){
    $response = [];
    foreach ($transactions as $transaction) {
      $data = [
        'code' => $transaction->code,
        'time' => $transaction->created_at,
        'type' => substr($transaction->code, 4, 1),
        'bank' => $transaction->bank_type.' '.$transaction->bank_acc,
        'image' => $transaction->image,
        'nominal' => $transaction->nominal,
        'status' => $transaction->approved_at
      ];
      array_push($response, $data);
    }
    return $response;
  }

  public function index(){
    $transactions = new Transaction;
    $all_transactions = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->get() );
    $topup = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->where('type', 'in')->get() );
    $withdraw = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->where('type', 'out')->get());
    $pending_topup = $this->_resourceConfirmation( $transactions->whereNull('approved_by')->where('type', 'in')->get() );
    $pending_withdraw = $this->_resourceConfirmation( $transactions->whereNull('approved_by')->where('type', 'out')->get());
    return response()->json(compact('all_transactions', 'topup', 'withdraw', 'pending_topup', 'pending_withdraw'), 200);
  }

  public function confirm(Request $request){
    $transaction = Transaction::where('code', $request->code)->first();
    $transaction->status_id = 2;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();
    
    if( $transaction->save() ){
      return response()->json(['status' => 200, 'message' => 'success']);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request']);
    }
  }
}
