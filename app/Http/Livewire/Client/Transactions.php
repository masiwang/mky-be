<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User as UserDB;
use App\Models\Transaction as TransactionDB;
use Auth;
use Carbon\Carbon;
use Image;
use Str;

class Transactions extends Component
{
  use WithFileUploads;
  public $filter;
  public $type = 'all';
  public $order_by = 'id';
  public $order_to = 'desc';

  public $page = 1;

  public function more(){
    $this->page++;
  }

  public $dialog, $bank_type, $bank_acc, $nominal, $image, $image_url;
  public $dialog_type = 'topup';

  public function openTopup(){
    $this->dialog_type = 'topup';
    $this->dialog = true;
  }

  public function openWithdraw(){
    $this->dialog_type = 'withdraw';
    $this->dialog = true;
  }

  public function uploadImage(){
    $random = Str::random(32);
    $image = Image::make($this->image)->resize(400, 400, function($constraint){
      $constraint->aspectRatio();
    })->save('userdata/transaction/'.$random.'.jpg');
    return  '/userdata/transaction/'.$random.'.jpg';
  }

  public function submit(){
    if($this->dialog_type == 'topup'){
      $this->validate([
        'bank_type' => 'required',
        'bank_acc' => 'required',
        'nominal' => 'required',
        'image' => 'required'
      ]);

      if($this->nominal > 9999999999 or $this->nominal < 0){
        return session()->flash('error', 'Nominal tidak valid.');
      }

      $url = $this->uploadImage();

      $transaction = TransactionDB::create([
        'user_id' => Auth::id(),
        'code' => 'MKYTRFI'.Auth::id().Carbon::now()->timestamp,
        'type' => 'in',
        'bank_type' => $this->bank_type,
        'bank_acc' => $this->bank_acc,
        'nominal' => $this->nominal,
        'image' => $url,
        'status_id' => 1,
        'comment' => 'Topup'
      ]);

      $this->dialog = false;
      $this->nominal = 0;
    }else{
      $this->validate([
        'bank_type' => 'required',
        'bank_acc' => 'required',
        'nominal' => 'required',
      ]);

      $user = UserDB::find(Auth::id());
      $saldo = $user->saldo;
      $pending_withdraw = TransactionDB::where('user_id', Auth::id())
        ->where('type', 'out')->where('status_id', 1)->sum('nominal');
      $saldo_with_pending_withdraw = $saldo + $pending_withdraw;

      if($this->nominal > $saldo_with_pending_withdraw){
        return session()->flash('error', 'Saldo tidak mencukupi atau terdapat penarikan dana yang pending.');
      }

      if($this->nominal < 0){
        return session()->flash('error', 'Saldo salah');
      }

      $transaction = TransactionDB::create([
        'user_id' => Auth::id(),
        'code' => 'MKYTRFO'.Auth::id().Carbon::now()->timestamp,
        'type' => 'out',
        'bank_type' => $this->bank_type,
        'bank_acc' => $this->bank_acc,
        'nominal' => $this->nominal * -1,
        'status_id' => 1,
        'comment' => 'Withdraw'
      ]);

      $this->dialog = false;
      $this->nominal = 0;
    }
  }

  public function mount(){
    $this->bank_type = Auth::user()->bank_type;
    $this->bank_acc = Auth::user()->bank_acc;
  }

  public function render(){
    $transactions = TransactionDB::where('user_id', Auth::id());
    if(!($this->type == 'all')){
      $transactions = $transactions->where('type', $this->type);
    }
    $transactions = $transactions->orderBy($this->order_by, $this->order_to)
      ->limit($this->page * 10)->get();
    
    return view('livewire.client.transactions', compact('transactions'))->layout('livewire._layout', ['title' => 'Transaksi']);
  }
}
