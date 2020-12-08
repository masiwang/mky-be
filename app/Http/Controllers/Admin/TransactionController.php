<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;

class TransactionController extends Controller
{
  public function _resourceTransaction($transactions){
    $response = [];
    foreach ($transactions as $transaction) {
      $data = [
        'code' => $transaction->code,
        'time' => $transaction->created_at,
        'type' => substr($transaction->code, 6, 1),
        'bank' => $transaction->bank_type.' '.$transaction->bank_acc,
        'nominal' => $transaction->nominal,
        'status_id' => $transaction->status_id,
        'status' => $transaction->approved_at,
        'user_name' => $transaction->user->name
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
        'type' => substr($transaction->code, 6, 1),
        'bank' => $transaction->bank_type.' '.$transaction->bank_acc,
        'image' => $transaction->image,
        'nominal' => $transaction->nominal,
        'status' => $transaction->approved_at,
        'user_name' => $transaction->user->name
      ];
      array_push($response, $data);
    }
    return $response;
  }

  public function index(){
    $transactions = new Transaction;
    $all_transactions = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->orderBy('id', 'desc')->get() );
    $topup = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->where('type', 'in')->get() );
    $withdraw = $this->_resourceTransaction( $transactions->whereNotNull('approved_by')->where('type', 'out')->get());
    $pending_topup = $this->_resourceConfirmation( $transactions->whereNull('approved_by')->where('type', 'in')->get() );
    $pending_withdraw = $this->_resourceConfirmation( $transactions->whereNull('approved_by')->where('type', 'out')->get());
    return response()->json(compact('all_transactions', 'topup', 'withdraw', 'pending_topup', 'pending_withdraw'), 200);
  }

  public function confirm(Request $request){
    $user = $this->getUser();
    if(!(Hash::check($request->password, $user->password))){
      return response()->json(['status' => 401, 'message' => 'unauthenticated'], 400);
    }
    $transaction = Transaction::where('code', $request->code)->first();
    $transaction->status_id = 2;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();

    $this->setNotification(
      $transaction->user_id,
      'Transaksi sukses',
      'Transaksi Anda dengan kode '.$request->code.' telah berhasil.<br/><br/>Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in.<br/><br/>--------------------------------------<br/>Salam,<br/><br/>Tim makarya'
    );
    
    if( $transaction->save() ){
      return response()->json(['status' => 200, 'message' => 'success']);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request']);
    }
  }

  public function reject(Request $request){
    $transaction = Transaction::where('code', $request->code)->first();
    $transaction->status_id = 3;
    $transaction->comment = $request->description;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();

    $this->setNotification(
      $transaction->user_id,
      'Transaksi gagal',
      'Transaksi Anda dengan kode '.$request->code.' telah gagal.<br/>Hal tersebut dikarenakan <strong>'.$request->description.'</strong>.<br/><br/>Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WhatsApp +6282130004204 atau melalui Email support@makarya.in.<br/><br>--------------------------------------<br/>Salam,<br/><br/>Tim makarya'
    );

    if( $transaction->save() ){
      return response()->json(['status' => 200, 'message' => 'success']);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request']);
    }
  }
}
