<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    $fund_products = FundProduct::orderBy('id', 'desc')->paginate(12);
    return view('pages.funding.index', compact('fund_products', 'user'));
  }

  public function category($category){
    $user = $this->getUser();
    $category = FundProductCategory::where('name', $category)->first();
    $fund_products = FundProduct::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(12);
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
    $transaction->bank_type = 'Saldo';
    $transaction->bank_acc = $user->id;
    $transaction->nominal = (-1)*$funding_price;
    $transaction->status_id = 2;
    $transaction->approved_by = 1;
    $transaction->approved_at = Carbon::now();
    $transaction->comment = 'Pendanaan '.$product->name;
    $transaction->save();
    // kurangi sisa stock saat ini
    $fund_product = FundProduct::find($product_id);
    $old_stock = $fund_product->current_stock;
    $new_stock = $old_stock - $qty;
    $fund_product->current_stock = $new_stock;
    $fund_product->save();
    // kirim notifikasi
    $this->setNotification(
      $user->id,
      'Pendanaan '.$fund_product->name,
      '<p>Hi '.$user->name.'👋</p>'.
      '<p>Terimakasih telah melakukan pendanaan pada produk '.$fund_product->name.'. Setelah pendanaan dimulai, Anda akan menerima invoice dan rincian pendanaan dari kami. Terimakasih 🙏.</p>'.
      '<p>Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in.</p>'.
      '<br/><p>Salam 💚,<br/><br/>Tim makarya</p>'
    );
    // kirim invoice
    return redirect('/portofolio');
  }
}