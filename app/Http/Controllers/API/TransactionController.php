<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout as Portofolio;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = User::where('email', $request->email)->first();
      $transactions = Transaction::where('user_id', $user->id)->get();
      return response()->json(compact('request'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $portofolio = Portofolio::find($request->portofolio_id);
      $time = new Carbon($request->time);
      $transaction = new Transaction;
      $transaction->user_id = $request->user_id;
      $transaction->status_id = 2;
      $transaction->approved_by = 1;
      if($request->type == 'topup'){
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->code = 'MKYTRFI'.$request->user_id.$time->timestamp;
        $transaction->type = 'in';
        $transaction->nominal = $request->nominal;
        $transaction->comment = 'Topup';
        $transaction->approved_at = $time;
      $transaction->created_at = $time;
      }else if($request->type == 'withdraw'){
        $transaction->bank_type = $request->bank_type;
        $transaction->bank_acc = $request->bank_acc;
        $transaction->code = 'MKYTRFO'.$request->user_id.$time->timestamp;
        $transaction->type = 'out';
        $transaction->nominal = (-1)*$request->nominal;
        $transaction->comment = 'Withdraw';
        $transaction->approved_at = $time;
        $transaction->created_at = $time;
      }else if($request->type == 'funding'){
        $portofolio_created = new Carbon($portofolio->created_at);
        $transaction->bank_type = 'MAKARYA';
        $transaction->bank_acc = $request->user_id;
        $transaction->code = 'MKYTRFO'.$request->user_id.$portofolio_created->timestamp;
        $transaction->type = 'out';
        $transaction->nominal = (-1)*$portofolio->qty*$portofolio->product->price;
        $transaction->comment = 'Funding '.$portofolio->product->name;
        $transaction->approved_at = $portofolio_created;
        $transaction->created_at = $portofolio_created;
      }else if($request->type == 'return'){
        $portofolio_ended = new Carbon($portofolio->product->ended_at);
        $transaction->bank_type = 'MAKARYA';
        $transaction->bank_acc = $request->user_id;
        $transaction->code = 'MKYTRFI'.$request->user_id.$portofolio_ended->timestamp;
        $transaction->type = 'in';
        $transaction->nominal = $portofolio->qty*$portofolio->product->price*(1+($portofolio->product->actual_return/100));
        $transaction->comment = 'Bagi hasil funding '.$portofolio->product->name;
        $transaction->approved_at = $portofolio_ended;
        $transaction->created_at = $portofolio_ended;
      }
      if($transaction->save()){
        return response()->json(['status' => 'success'], 200);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
