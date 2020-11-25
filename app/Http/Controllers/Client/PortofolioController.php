<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortofolioCollection;
use App\Http\Resources\Portofolio as PortofolioResources;
use Illuminate\Http\Request;
use App\Models\FundCheckout;
use App\Models\FundProduct;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Mail;
use Str;

class PortofolioController extends Controller
{
    public function index(){
        $saldo = $this->saldo();
        return view('client.portofolio.index', ['user' => Auth::user(), 'saldo' => $saldo]);
    }

    public function detail(){
        return view('client.portofolio.detail', ['user' => Auth::user()]);
    }

    public function pay(){
        return view('client.portofolio.pay', ['user' => Auth::user()]);
    }

    public function pay_save(Request $request){
        $image_name = 'payment-'.Str::random(32).'.jpg';
        $request->file('pay_image')->move('image/fund/', $image_name);
        $invoice = FundCheckout::where('invoice', $request->invoice)->first();
        $invoice->pay_by = $request->pay_by;
        $invoice->pay_at = Carbon::now();
        $invoice->pay_image = '/image/fund/'.$image_name;
        $invoice->status_id = 2;
        $invoice->save();

        // minus stock
        $product = FundProduct::where('id', $invoice->product_id)->first();
        $old_stock = $product->stock;
        $product->stock = (int)$old_stock - (int)$invoice->qty;
        $product->save();
        return redirect('portofolio');
    }

    public function _get(Request $request){
        $per_page = 6;
        $checkout = FundCheckout::where('user_id', Auth::id())
            ->skip((int)$request->page*$per_page)->take($per_page)->get();
        $checkout_res = new PortofolioCollection($checkout);
        return response()->json($checkout_res, 200);
    }

    public function _post(Request $request){
        $product = FundProduct::where('slug', $request->product)->first();
        $saldo = $this->getSaldo();
        $invoice = 'MKYF'.Carbon::now()->timestamp;
        $portofolio = new FundCheckout;
        $portofolio->invoice = $invoice;
        $portofolio->user_id = Auth::id();
        $portofolio->product_id = $product->id;
        $portofolio->qty = $request->qty;
        $portofolio->save();
        // kurangi saldo user
        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'out';
        $transaction->bank_type = 'MAKARYA';
        $transaction->nominal = (-1)*($product->price*$request->qty);
        $transaction->comment = 'Funding '.$product->name;
        $transaction->status_id = 2;
        $transaction->approved_by = 1;
        $transaction->approved_at = Carbon::now();
        $transaction->save();
        // kurangi stock barang
        $product->stock = (int)$product->stock - (int)$request->qty;
        $product->save();
        // kirim invoice ke email
        // $user = Auth::user();
        // $product = FundProduct::where('slug', $request->product)->first();
        // $portofolio = FundCheckout::where('invoice', $invoice)->first();
        // Mail::send('template.email.invoice', ['user' => $user, 'product' => $product, 'portofolio' => $portofolio], function ($m) use ($user, $portofolio, $product) {
        //     $m->from('no-reply@makarya.in', 'Invoice from Makarya');
        //     $m->to($user->email)->subject('Invoice #'.$portofolio->invoice.' - Rp.'.((int)$portofolio->qty * (int)$product->price));
        // });
        return response()->json(['status' => 'success', 'invoice' => $invoice]);
    }

    public function _detail($invoice){
        $portofolio = FundCheckout::where('invoice', $invoice)->first();
        $portofolio = new PortofolioResources($portofolio);
        return response()->json($portofolio, 200);
    }


}
