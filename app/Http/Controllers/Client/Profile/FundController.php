<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout;
use App\Models\FundProduct;
use Auth;
use Carbon\Carbon;

class FundController extends Controller
{
    public function index(){
        $user = Auth::user();
        $saldo = $this->saldo();
        $portofolios = FundCheckout::where('user_id', Auth::id())->get();
        return view('client.dashboard.portofolio.index', ['user' => $user, 'portofolios' => $portofolios, $saldo => 'saldo']);
    }

    public function invoice($invoice){
        $invoice = FundCheckout::where('invoice', $invoice)->first();
        $user = Auth::user();
        return view('client.dashboard.portofolio.invoice', ['user' => $user, 'invoice' => $invoice]);
    }

    public function pay($invoice){
        $invoice = FundCheckout::where('invoice', $invoice)->first();
        $user = Auth::user();
        return view('client.dashboard.portofolio.pay', ['user' => $user, 'invoice' => $invoice]);
    }

    public function pay_save(Request $request){
        $image_name = $this->upload_image('image/fund/payment', $request->file('pay_image'));
        $invoice = FundCheckout::where('invoice', $request->invoice)->first();
        $invoice->pay_by = $request->pay_by;
        $invoice->pay_at = Carbon::now();
        $invoice->pay_image = '/image/fund/payment/'.$image_name;
        $invoice->status_id = 2;
        $invoice->save();

        // minus stock
        $product = FundProduct::where('id', $invoice->product_id)->first();
        $old_stock = $product->stock;
        $product->stock = (int)$old_stock - (int)$invoice->qty;
        $product->save();
        return redirect('/profile/fund');
    }
}
