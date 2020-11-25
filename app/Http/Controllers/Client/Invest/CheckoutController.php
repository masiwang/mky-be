<?php

namespace App\Http\Controllers\Invest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\InvestCheckout;
use App\Models\InvestInvoice;

class CheckoutController extends Controller
{
    public function index(){
        $this->client_only();
        $checkouts = InvestCheckout::where('user_id', Auth::id())->paginate(10);
        $saldo = $this->saldo();
        return view('/invest/index', ['user' => Auth::user(),'checkouts', $checkouts, $saldo => 'saldo']);
    }

    public function new_save(Request $request){
        // TODO: validasi
        
        // cek ketersediaan produk
        $product = InvestProduct::find($request->product_id);
        if( (int)$product->stock < (int)$request->qty ){
            return back()->with('error', 'Periksa kembali stock produk ini');
        }
        // create invoice
        $invoice_id = 'INV1'.Carbon::now()->timestamp;

        $invoice = new InvestInvoice;
        $invoice->id = $invoice_id;
        $invoice->user_id = Auth::id();
        $invoice->status = 'unpaid';
        $invoice->created_at = Carbon::now();
        $invoice->save();
        // checkout
        $checkout = new InvestCheckout;
        $checkout->id = 'MKY1'.Carbon::now()->timestamp;
        $checkout->product_id = $request->product_id;
        $checkout->user_id = Auth::id();
        $checkout->invoice_id = $invoice_id;
        $checkout->qty = $request->qty;
        $checkout->created_at = Carbon::now();
        $checkout->save();
        // redirect
        return redirect('/invest/checkout');
    }
}
