<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckoutCollection;
use App\Http\Resources\Checkout as CheckoutResources;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Str;
use App\Models\MarketCheckout;
use App\Models\MarketProduct;

class CheckoutController extends Controller
{
    public function index(){
        return view('client.checkout.index', ['user' => Auth::user()]);
    }
    public function detail(){
        return view('client.checkout.detail', ['user' => Auth::user()]);
    }
    public function pay(){
        return view('client.checkout.pay', ['user' => Auth::user()]);
    }

    public function pay_save(Request $request){
        
        $image_name = 'payment-'.Str::random(32).'.jpg';
        $request->file('pay_image')->move('image/market/', $image_name);
        $invoice = MarketCheckout::where('invoice', $request->invoice)->first();
        $invoice->pay_by = $request->pay_by;
        $invoice->pay_at = Carbon::now();
        $invoice->pay_image = '/image/market/'.$image_name;
        $invoice->status_id = 2;
        $invoice->save();

        // minus stock
        $product = MarketProduct::where('id', $invoice->product_id)->first();
        $old_stock = $product->stock;
        $product->stock = (int)$old_stock - (int)$invoice->qty;
        $product->save();
        return redirect('checkout');
    }

    public function _get(Request $request){
        $per_page = 6;
        $checkout = MarketCheckout::where('user_id', Auth::id())
            ->skip((int)$request->page*$per_page)->take($per_page)->get();
        $checkout = new CheckoutCollection($checkout);
        return response()->json($checkout, 200);
    }

    public function _detail($invoice){
        $checkout = MarketCheckout::where('invoice', $invoice)->first();
        $checkout = new CheckoutResources($checkout);
        return response()->json($checkout, 200);
    }
}
