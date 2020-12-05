<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout;
use Auth;

class FundCheckoutController extends Controller
{
  public function new(Request $req){
    $user = $this->getUser();
    $product_id = $request->product_id;
    $qty = $request->qty;
    $product = FundProduct::where('id', $product_id)->first();
    // constrain produk
    if(!$product){
      return abort(404);
    }
    //constrain stock = 0
    if($product->current_stock < 1){
      return back()->with('error', 'Produc stockout.');
    }
    // constrain verifikasi akun
    if(!$user->ktp_verified_at){
      return back()->with(['error' => 'Akun Anda belum diverifikasi oleh pihak Makarya.']);
    }
    // satu user satu kali funding di produk yang sama
    $funding_is_exist = FundCheckout::where('product_id', $product_id)->where('user_id', $user->id)->first();
    if($funding_is_exist){
      return back()->with(['error' => 'Anda telah melakukan pendanaan pada produk ini.']);
    }
    //qty harus lebih dari 1
    if($qty < 1){
      return back()->with(['error' => 'Jumlah paket tidak valid']);
    }
    // qty saldo plus pending withdraw
    $saldo = Transaction::where('user_id', $user->id)->whereNotNull('approved_at')->sum('nominal');
    $pending_withdraw = Transaction::where('user_id', $user->id)->where('type', 'out')->whereNull('approved_at')->sum('nominal');
    $saldo_with_pending_withdraw = (int)$saldo + (int)$pending_withdraw;
    $funding_price = $qty * $product->price;
    if($funding_price > $saldo_with_pending_withdraw){
      return back()->with(['error' => 'Saldo tidak mencukupi, atau anda memiliki penarikan dana yang tertunda.']);
    }
    // menambah portofolio
    $portofolio = new FundCheckout();
    $portofolio->invoice = 'MKYINVF'.$user->id.Carbon::now()->timestamp;
    $portofolio->product_id = $product_id;
    $portofolio->user_id = $user->id;
    $portofolio->qty = $qty;
    $portofolio->save();
    // mengurangi saldo
    $transaction = new Transaction();
    $transaction->code = 'MKYTRFO'.$user->id.Carbon::now()->timestamp;
    $transaction->user_id = $user->id;
    $transaction->type = 'out';
    $transaction->bank_type = 'MKY';
    $transaction->bank_acc = $user->id;
    $transaction->nominal = (-1)*$funding_price;
    $transaction->status_id = 2;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();
    $transaction->comment = 'Pendanaan '.$product->name;
    $transaction->save();
  }

  protected function _resourcePortofolio($portofolios){
    $response = [];
    foreach ($portofolios as $portofolio) {
      $return_is_sent = ($portofolio->return_sent_at) ? 1 : 0;
      $data = [
        'id' => $portofolio->id,
        'product_image' => $portofolio->product->image,
        'estimated_return' => $portofolio->product->estimated_return,
        'product_name' => $portofolio->product->name,
        'vendor_name' => $portofolio->product->vendor->name,
        'ended_at' => $portofolio->product->ended_at,
        'is_done' => $return_is_sent,
        'nominal' => $portofolio->qty * $portofolio->product->price
      ];
      array_push($response, $data);
    }
    return $response;
  }

  public function portofolio(){
    $user = $this->getUser();

    $portofolios = FundCheckout::where('user_id', $user->id)->get();
    $portofolios = $this->_resourcePortofolio($portofolios);

    return response()->json(compact('portofolios'), 200);
  }
}