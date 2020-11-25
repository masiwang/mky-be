<?php

namespace App\Http\Controllers\Invest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InvestInvoice;

class InvoiceController extends Controller
{
    public function invoice(){
        $invoices = InvestInvoice::where('user_id', Auth::id())->paginate(10);
        return view('/invest/invoice', ['invoices' => $invoices]);
    }

    public function invoice_pay($invoice_id){
        $invoice = InvestInvoice::find($invoice_id);
        return view('/invest/invoice_pay', ['invoice' => $invoice]);
    }

    public function invoice_pay_save(Request $request){
        // TODO: validate

        // kurangi stock produk
        $product_id = InvestInvoice::find($request->id)->checkout()->product_id;
        $product = InvestProduct::find($product_id);
        $product_old_stock = $product->first()->stock;
        $product->stock = (int)$product_old_stock - (int)$request->qty;
        $product->updated_at = Carbon::now();
        $product->save();
        // update invoice
        $invoice = InvestInvoice::find($request->id);
        $invoice->status = 'paid';
        $invoice->payment_method = $request->payment_method;
        $invoice->paid_by = $request->paid_by;
        $invoice->paid_at = Carbon::now();
        $invoice->updated_at = Carbon::now();
        $invoice->save();
        return redirect('invest/checkout')->with('success', 'Pembayaran berhasil dilakukan');
    }

    public function invoice_pay_confirm(){
        $this->admin_only();
        $invoices = InvestInvoice::paginate(10);
        return view('/admin/invest/payment', ['invoices' => $invoices]);
    }

    public function invoice_pay_confirm_save(Request $request){
        $this->admin_only();
        // perbarui data invoice
        $invoice = InvestInvoice::find($request->id);
        $invoice->status = 'payment_confirmed';
        $invoice->confirmed_by = Auth::id();
        $invoice->confirmed_at = Carbon::now();
        $invoice->updated_at = Carbon::now();
        // menambahkan saldo wallet user
        $product_id = $invoice->checkout()->product_id;
        $product = InvestProduct::find($product_id)->first();
        $transaction_amount = (int)$product->price * (int)$invoice->checkout()->qty;
        // menambahkan uang hasil pembayaran ke wallet
        $transaction = new Transaction;
        $transaction->id = 'TR1'.Carbon::now()->timestamp;
        $transaction->type = 'out';
        $transaction->user_id = $invoice->user_id;
        $transaction->amount = $transaction_amount;
        $transaction->created_at = Carbon::now();
        $transaction->save();
        // TODO: kirim notifikasi ke user
    }
}
