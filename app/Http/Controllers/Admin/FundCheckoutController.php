<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundCheckout;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FundCheckoutController extends Controller
{
  public function sendInvoice(Request $request){
    $portofolio = FundCheckout::find($request->portofolio_id);
    $portofolio->invoice_sent_at = Carbon::now();
    $portofolio->invoice_sent_by = 1;
    // todo kirim invoice via email
    if( $portofolio->save() ){
      return response()->json(['status' => 200, 'message' => 'success']);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request']);

    }
  }

  public function sendReturn(Request $request){
    $portofolio = FundCheckout::find($request->portofolio_id);
    // cek apakah aktual return sudah ada
    if( !$portofolio->product->actual_return ){
      return response()->json(['status' => 400, 'message' => 'product does not have actual return.']);
    }
    $portofolio->return_sent_at = Carbon::now();
    $portofolio->return_sent_by = 1;
    $portofolio->save();
    // menambahkan return ke user
    $return = ($portofolio->qty * $portofolio->product->price) * (100 + $portofolio->product->actual_return)/100;
    $transaction = new Transaction;
    $transaction->code = 'MKYTI'.$portofolio->user->id.Carbon::now()->timestamp;
    $transaction->user_id = $portofolio->user->id;
    $transaction->type = 'in';
    $transaction->bank_type = 'MAKARYA';
    $transaction->bank_acc = $portofolio->user->id;
    $transaction->nominal = $return;
    $transaction->status_id = 2;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();
    $transaction->comment = 'Bagi hasil funding '.$portofolio->product->name;
    $transaction->save();
    // todo mengirimkan notifikasi ke user
    return response()->json(['status' => 200, 'message' => 'Return berhasil dikirim.']);
  }
}
