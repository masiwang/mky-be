<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Hash;

class TransactionController extends Controller
{
    public function saldo(){
        $saldo = Transaction::where(['user_id' => Auth::id(), 'status_id' => 2])->sum('nominal');
        return $this->respondWithToken($saldo, 200);
    }

    public function transaction(Request $request){
        $transactions = new Transaction;
        $transactions = $transactions->where('user_id', Auth::id())->orderBy('id', 'desc');
        if($request->container){
            if($request->container == 'profile_page'){
                $transactions = $transactions
                    ->limit(2)
                    ->get();
            }else{

            }
        }else{
            $transactions = $transactions->skip($request->page * $this->perpage)
                ->take($this->perpage)
                ->get();
        }
        return $this->respondWithToken($transactions, 200);
    }

    public function topup(Request $request){
        $request->validate([
            'bank_type' => 'required',
            'bank_acc' => 'required',
            'nominal' => 'required|integer',
            'image' => 'required'
        ]);
        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'in';
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->nominal = $request->nominal;
        $transaction->image = $request->image;
        $transaction->status_id = 1;
        $transaction->save();
        
        $transaction = Transaction::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        return $this->respondWithToken($transaction, 200);
    }

    public function withdraw(Request $request){
        $request->validate([
            'bank_type' => 'required',
            'bank_acc' => 'required',
            'nominal' => 'required|integer',
            'password' => 'required'
        ]);
        $user = User::find(Auth::id());
        // jika password benar
        if(!(Hash::check($request->password, $user->password))){
            return response()->json(['status' => 'Bad request', 'message' => 'Password salah'], 400);
        }
        // jika jumlah permintaan lebih besar dari saldo
        $saldo = Transaction::where('user_id', Auth::id())->sum('nominal');
        if($request->nominal > $saldo){
            return response()->json(['status' => 'Bad request', 'message' => 'Saldo tidak mencukupi']);
        }
        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'out';
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->nominal = (int)$request->nominal * (-1);
        $transaction->status_id = 1;
        $transaction->save();
        
        $transaction = Transaction::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        return $this->respondWithToken($transaction, 200);
    }
}
