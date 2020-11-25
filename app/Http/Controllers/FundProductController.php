<?php

namespace App\Http\Controllers;

use App\Models\FundCheckout;
use App\Models\FundProduct;
use App\Models\FundProductCategory;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FundProductController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $fund_products = FundProduct::orderBy('id', 'desc')->paginate(18);
    return view('pages.funding.index', compact('fund_products', 'user'));
  }

  public function category($category){
    $user = $this->getUser();
    $category = FundProductCategory::where('name', $category)->first();
    $fund_products = FundProduct::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(18);
    return view('pages.funding.index', compact('category', 'fund_products', 'user'));
  }

  public function detail($category, $product){
    $user = $this->getUser();
    $category = FundProductCategory::where('name', $category)->first();
    $fund_product = FundProduct::where('category_id', $category->id)->where('id', $product)->first();
    if($fund_product){
      $fund_product->append('periode_length')->toArray();
    }else{
      return abort(404);
    }
    return view('pages.funding.detail', compact('fund_product', 'user'));
  }

  public function newPortofolio(Request $request){
    $user = $this->getUser();
    $product_id = $request->product_id;
    $qty = $request->qty;
    $product = FundProduct::where('id', $product_id)->first();
    // constrain produk
    if(!$product){
      return abort(404);
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
    $saldo_with_pending_withdraw = Transaction::where('user_id', $user->id)
      ->where('type', 'in')->whereNotNull('approved_at')->orWhere('type', 'out')->sum('nominal');
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
    // kirim notifikasi

    // kirim invoice
    return redirect('/portofolio');
  }
}
