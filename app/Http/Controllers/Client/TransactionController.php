<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Str;

class TransactionController extends Controller
{
    public function index(){
        $user = Auth::user();
        $saldo = $this->saldo();
        $transactions=Transaction::where('user_id',$user->id)->orderBy('updated_at', 'DESC')->get();
        // return dd($transactions);
        return view('client.transaction.index', compact('user','transactions','saldo'));
    }

    public function topup(){
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.transaction.topup', compact('user', 'saldo'));
    }

    public function withdraw(){
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.transaction.withdraw', compact('user','saldo'));
    }

    public function withdraw_save(Request $request){
        $saldo = $this->saldo();
        if($request->nominal > $saldo){
            return back()->with(['error' => 'saldo tidak mencukupi']) ;
        } 
        $user = Auth::user();
        $withdraw=new Transaction;
        $withdraw->user_id=$user->id;
        $withdraw->bank_type = $request->bank_type;
        $withdraw->bank_acc = $request->bank_acc;
        $withdraw->nominal = $request->nominal*(-1);
        $withdraw->status_id=1;
        $withdraw->type="out";
        $withdraw->save();
        return redirect('/transaction');
    }

    public function topup_save(Request $request){
        if(!$request->image){
            return back()->with('error', 'Harap masukkan bukti pembayaran.');
        }
        $image_name = Str::random(32).'.jpg';
        $request->image->move('image/transaction/', $image_name);
        $user = Auth::user();
        $transaction=new Transaction;
        $transaction->user_id= $user->id;
        $transaction->type='in';
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->nominal = $request->nominal;
        $transaction->image = '/image/transaction/'.$image_name;
        $transaction->status_id=1;
        $transaction->save();
        return redirect('/transaction');
    }

    public function _index(){
        $transactions = Transaction::where('user_id', Auth::id())->get();
        $transactions_res = new TransactionCollection($transactions);
        return response()->json($transactions_res, 200);
    }

    public function _topup(Request $request){
        if(!$request->image){
            return back()->with('error', 'Harap masukkan bukti pembayaran.');
        }
        $image_name = Str::random(32).'.jpg';
        $request->image->move('image/transaction/', $image_name);

        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'in';
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->nominal = $request->nominal;
        $transaction->image = '/image/transaction/'.$image_name;
        $transaction->status_id = 1;
        $transaction->created_at = Carbon::now();
        $transaction->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function _withdraw(Request $request){
        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->type = 'out';
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->nominal = (-1)*(int)$request->nominal;
        $transaction->created_at = Carbon::now();
        $transaction->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function _saldo(){
        $saldo = Transaction::where(['user_id' => Auth::id(), 'status_id' => 2])->sum('nominal');
        return $saldo;
    }
}