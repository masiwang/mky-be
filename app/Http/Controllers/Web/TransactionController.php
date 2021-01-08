<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class TransactionController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    return view('pages.transaction.index', compact('user', 'transactions'));
  }
  
  public function topup(){
    $user = $this->getUser();
    return view('pages.transaction.topup', compact('user'));
  }

  public function topupSave(Request $request){

    $user = $this->getUser();
    if(!$user->ktp_verified_at){
      return back();
    }
    $request->validate([
      'bank_type' => 'required|string',
      'bank_acc' => 'required|numeric',
      'nominal' => 'required|numeric|min:1000|max:9999999999',
      'image' => 'required'
    ]);
    
    $code = 'MKYTRFI'.$user->id.Carbon::now()->timestamp;
      $bukti = Image::make($request->image->getRealPath());
      $bukti->resize(600, 600, function($constraint){
        $constraint->aspectRatio();
      })->save('assets/transaction/'.$code.'.jpg');
      $transaction = new Transaction();
      $transaction->user_id = $user->id;
      $transaction->code = $code;
      $transaction->type = 'in';
      $transaction->bank_type = $request->bank_type;
      $transaction->bank_acc = $request->bank_acc;
      $transaction->nominal = $request->nominal;
      $transaction->image = '/assets/transaction/'.$code.'.jpg';
      $transaction->status_id = 1;
      $transaction->comment = 'topup';
      if($transaction->save()){
        $this->setNotification(
          1,
          'Pending Topup',
          'Topup dilakukan oleh : '.$user->name.'<br/>Dari : '.$request->bank_type.' '.$request->bank_acc.'<br/>Sebanyak : Rp '.number_format($request->nominal, 2, ',', '.').'<br/>Pada : '.date('d F Y - H:m:s', Carbon::now()->timestamp).'<br/><br/>Masuk ke menu transaksi untuk melakukan verifikasi.'
        );
        return redirect('/transaction')->with('success', 'Sukses! Mohon tunggu konfirmasi topup.');
      }else{
        return back();
      }
  }
  
  public function withdraw(){
    $user = $this->getUser();
    return view('pages.transaction.withdraw', compact('user'));
  }

  public function withdrawSave(Request $request){
    $user = $this->getUser();
    if(!$user->ktp_verified_at){
      return back();
    }
    $saldo_real = $user->saldo;
    $pending_withdraw = Transaction::where([
      'user_id'=> $user->id,
      'type' => 'out'
      ])->whereNull('approved_at')->sum('nominal');
    $saldo_with_pending_withdraw = $saldo_real + $pending_withdraw;
    $bank_type = $request->bank_type ?? null;
    $bank_acc = $request->bank_acc ?? null;
    $nominal = $request->nominal ? ($request->nominal < $saldo_with_pending_withdraw ? $request->nominal : null) : null;

    if($bank_type && $bank_acc && $nominal){
      $transaction = new Transaction();
      $transaction->user_id = $user->id;
      $transaction->code = 'MKYTRFO'.$user->id.Carbon::now()->timestamp;
      $transaction->type = 'out';
      $transaction->bank_type = $bank_type;
      $transaction->bank_acc = $bank_acc;
      $transaction->nominal = (-1)*$nominal;
      $transaction->status_id = 1;
      $transaction->comment = 'withdraw';
      if($transaction->save()){
        $this->setNotification(
          1,
          'Pending Withdraw',
          'Permintaan withdraw dilakukan oleh : '.$user->name.'<br/>Ke : '.$request->bank_type.' '.$request->bank_acc.'<br/>Sebanyak : Rp '.number_format($request->nominal, 2, ',', '.').'<br/>Pada : '.date('d F Y - H:m:s', Carbon::now()->timestamp).'<br/><br/>Masuk ke menu transaksi untuk melakukan verifikasi.'
        );
        return redirect('/transaction')->with('success', 'Sukses! Mohon tunggu konfirmasi topup.');
      }else{
        return back();
      }
    }else{
      return back()->with([
        'bank_type' => (!$bank_type) ? 'Nama bank tidak valid' : '',
        'bank_acc' => (!$bank_acc) ? 'No. rekening tidak valid' : '',
        'nominal' => (!$nominal) ? 'Nominal tidak valid, atau saldo tidak cukup, atau anda memiliki penarikan dana yang tertunda' : '',
      ]);
    }
  }
}
