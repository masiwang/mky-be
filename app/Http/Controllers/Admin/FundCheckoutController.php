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
    // kirim invoice via notifikasi
    $this->setNotification(
      $portofolio->user_id,
      'Invoice '.$portofolio->invoice,
      'Salam, '.$portofolio->user->name.'.<br/><br/>Terima kasih kami ucapkan kepada Anda, dengan ini anda
      secara resmi berpartisipasi dalam Project Funding '.$portofolio->product->name.' oleh '.$portofolio->product->vendor->name.'. Berikut adalah <em>invoice</em> pendanaan Anda,<br/><br/>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
      <tr><td style="border: 1px solid black;width: 30%;">Invoice No.</td><td style="border: 1px solid black;width: 70%;">'.$portofolio->invoice.'</td></tr>
      <tr><td style="border: 1px solid black">Produk pendanaan</td><td style="border: 1px solid black">'.$portofolio->product->name.'</td></tr>
      <tr><td style="border: 1px solid black">Jml. Pembiayaan</td><td>'.$portofolio->qty.' paket</td style="border: 1px solid black"></tr>
      <tr><td style="border: 1px solid black">Harga paket</td><td style="border: 1px solid black">Rp '.number_format($portofolio->product->price, 0, ',', '.').'/paket</td></tr>
      <tr><td style="border: 1px solid black">Total Pembiayaan</td><td style="border: 1px solid black">Rp '.number_format($portofolio->qty*$portofolio->product->price, 0, ',', '.').',-</td></tr>
      <tr><td style="border: 1px solid black">Estimasi ROI</td><td style="border: 1px solid black">'.$portofolio->product->estimated_return.'%</td></tr>
      <tr><td style="border: 1px solid black">Waktu Pembiayaan</td><td style="border: 1px solid black">'.$portofolio->created_at.'</td></tr>
      <tr><td style="border: 1px solid black">Est. Waktu Selesai</td><td style="border: 1px solid black">'.$portofolio->product->ended_at.'</td></tr>
      </table><br/><br/>
      Salam,<br/><br/>Tim Makarya'
    );

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
      return response()->json(['status' => 400, 'message' => 'product does not have actual return.'], 400);
    }
    $portofolio->return_sent_at = Carbon::now();
    $portofolio->return_sent_by = 1;
    $portofolio->save();
    // menambahkan return ke user
    $code = 'MKYTRFI'.$portofolio->user->id.Carbon::now()->timestamp;
    $return = ($portofolio->qty * $portofolio->product->price) * (100 + $portofolio->product->actual_return)/100;
    $transaction = new Transaction;
    $transaction->code = $code;
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
    
    $this->setNotification(
      $portofolio->user_id,
      'Pendanaan '.$portofolio->product->name,
      'Salam, '.$portofolio->user->name.'.<br/><br/>Terimakasih telah melakukan pendanaan (<em>funding</em>) pada produk '.$portofolio->product->name.' oleh '.$portofolio->product->vendor->name.'. Pendanaan tersebut telah selesai. Return telah dikirim ke Akun Anda dengan kode transaksi '.$code.'. Berikut ini adalah detail transaksi return pendanaan,<br/><br/>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
      <tr><td style="border: 1px solid black;width: 30%;">Kode Pendanaan</td><td style="border: 1px solid black;width: 70%;">'.$portofolio->invoice.'</td></tr>
      <tr><td style="border: 1px solid black">Produk pendanaan</td><td style="border: 1px solid black">'.$portofolio->product->name.'</td></tr>
      <tr><td style="border: 1px solid black">Total Pembiayaan</td><td style="border: 1px solid black">Rp '.number_format($portofolio->qty*$portofolio->product->price, 0, ',', '.').',-</td></tr>
      <tr><td style="border: 1px solid black">ROI</td><td style="border: 1px solid black">'.$portofolio->product->actual_return.'%</td></tr>
      <tr><td style="border: 1px solid black">Kode Transaksi</td><td style="border: 1px solid black">'.$code.'</td></tr>
      <tr><td style="border: 1px solid black">Nominal (ROI)</td><td style="border: 1px solid black">Rp '.number_format(((1+($portofolio->product->actual_return/100))*$portofolio->qty*$portofolio->product->price), 0, ',', '.').'</td></tr>
      </table>Nantikan produk-produk pendanaan selanjutnya ya.<br/><br/>
      Salam,<br/><br/>Tim Makarya'
    );

    return response()->json(['status' => 200, 'message' => 'Return berhasil dikirim.']);
  }
}
