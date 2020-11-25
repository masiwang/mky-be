<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FundCheckoutCollection;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\FundCheckout;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;

class FundCheckoutController extends Controller
{
    public function portofolio(Request $request){
        $portofolios = FundCheckout::where('user_id', Auth::id());
        if($request->container){
            $portofolios = $portofolios->whereNotNull('pay_at')
                ->limit(2);
        }else{
            $portofolios = $portofolios->skip($request->page * 10)->take(10);
        }
        $portofolios = $portofolios->get();
        $portofolios = new FundCheckoutCollection($portofolios);
        return response()->json(compact('portofolios'), 200);
    }

    public function new_portofolio(Request $request){
        // mencari product
        $product = Fund::find($request->product_id);
        // cek saldo
        $saldo = Transaction::where(['user_id' => Auth::id(), 'status_id' => 2])->sum('nominal');
        if($product->price * $request->qty > $saldo){
            return response()->json(['status' => 'Bad request', 'message' => 'Saldo tidak mencukupi']);
        }
        $portofolio = new FundCheckout;
        $portofolio->user_id = Auth::id();
        $portofolio->invoice = 'MKYF'.Carbon::now()->timestamp;
        $portofolio->product_id = $request->product_id;
        $portofolio->qty = $request->qty;
        $portofolio->pay_at = Carbon::now();
        $portofolio->save();
        
        // mengurangi saldo user
        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'out';
        $transaction->bank_type = 'SALDO';
        $transaction->bank_acc = 'MAKARYA';
        $transaction->nominal = (-1) * (int)$product->price * $request->qty;
        $transaction->status_id = 2;
        $transaction->approved_by = 1;
        $transaction->approved_at = Carbon::now();
        $transaction->save();
        // mengurangi stock product
        $product->stock = $product->stock - $request->qty;
        $product->save();
        return $this->respondWithToken(['status' => 'success'], 200);
    }
}
