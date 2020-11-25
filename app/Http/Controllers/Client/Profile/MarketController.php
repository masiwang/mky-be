<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarketCheckout;
use App\Models\MarketProduct;
use Auth;
use Str;
use Carbon\Carbon;

class MarketController extends Controller
{
    public function index(){
        $user = Auth::user();
        $saldo = $this->saldo();
        $carts = MarketCheckout::where('user_id', Auth::id())->get();
        return view('client.dashboard.cart.index', ['user' => $user, 'carts' => $carts, $saldo => 'saldo']);
    }

    public function invoice($invoice){
        $invoice = MarketCheckout::where('invoice', $invoice)->first();
        $user = Auth::user();
        return view('client.dashboard.cart.invoice', ['user' => $user, 'invoice' => $invoice]);
    }

    public function pay($invoice){
        $invoice = MarketCheckout::where('invoice', $invoice)->first();
        $user = Auth::user();
        return view('client.dashboard.cart.pay', ['user' => $user, 'invoice' => $invoice]);
    }

    public function pay_save(Request $request){
        $invoice = MarketCheckout::where('invoice', $request->invoice)->first();
        $invoice->pay_by = $request->pay_by;
        $invoice->pay_at = Carbon::now();
        $image = $request->file('image');
        $image_name = 'payment-'.Str::random(32).'.jpg';
        $image->move('image/market/', $image_name);
        $invoice->pay_image = '/image/market/'.$image_name;
        $invoice->status_id = 2;
        $invoice->save();

        // minus stock
        $product = MarketProduct::where('id', $invoice->product_id)->first();
        $old_stock = $product->stock;
        $product->stock = (int)$old_stock - (int)$invoice->qty;
        $product->save();
        return redirect('/profile/market');
    }
}
