<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User as UserDB;
use App\Models\Transaction as TransactionDB;
use App\Models\FundCheckout as PortofolioDB;
use Carbon\Carbon;

class Transactions extends Component
{
  public $select_by = 'all';
  public $filter = 'confirmed';
  public $order_by = 'created_at';
  public $order_to = 'desc';
  public $page = 1;
  public $query;
  public $detail_dialog, $detail_image, $detail_code;
  public $new_dialog, $new_user, $new_type, $new_nominal, $new_portofolio;
  public $delete_dialog, $delete_code;

  public function more(){
    $this->page++;
  }

  public function openDetail($id){
    $transaction = TransactionDB::find($id);
    $this->detail_image = $transaction->image;
    $this->detail_code = $transaction->code;
    $this->detail_dialog = true;
  }

  public function save(){
    $user = UserDB::where('name', $this->new_user)->first();
    if($this->new_type == 1){
      $code = 'MKYTRFI'.$user->id.Carbon::now()->timestamp;
      $type = 'in';
      $nominal = $this->new_nominal;
      $comment = 'Topup';
    }else if($this->new_type == 2){
      $portofolio = PortofolioDB::find($this->new_portofolio);
      $code = 'MKYTRFO'.$user->id.Carbon::now()->timestamp;
      $type = 'out';
      $nominal = -1*$portofolio->qty*$portofolio->product->price;
      $comment = 'Funding '.$portofolio->product->name;
    }else if($this->new_type == 3){
      $portofolio = PortofolioDB::find($this->new_portofolio);
      $code = 'MKYTRFI'.$user->id.Carbon::now()->timestamp;
      $type = 'in';
      $nominal = $portofolio->qty * $portofolio->product->price * (1 + ($portofolio->product->actual_return/100));
      $comment = 'Imbal hasil '.$portofolio->product->name;
    }else{
      $code = 'MKYTRFO'.$user->id.Carbon::now()->timestamp;
      $type = 'out';
      $nominal = -1*$this->new_nominal;
      $comment = 'Withdraw';
    }

    $transaction = TransactionDB::create([
      'code' => $code,
      'user_id' => $user->id,
      'type' => $type,
      'bank_type' => ($this->new_type == 1 or $this->new_type == 4) ? $user->bank_type : 'Saldo Makarya',
      'bank_acc' => ($this->new_type == 1 or $this->new_type == 4) ? $user->bank_acc : $user->id,
      'nominal' => $nominal,
      'status_id' => 2,
      'approved_at' => Carbon::now(),
      'approved_by' => 1,
      'comment' => $comment
    ]);

    $this->new_dialog = false;
  }

  public function delete(){
    $transaction = TransactionDB::where('code', $this->delete_code);
    $transaction->delete();
    $this->delete_dialog = false;
  }

  public function confirm(){
    $transaction = TransactionDB::where('code', $this->detail_code);
    $transaction->approved_at = Carbon::now();
    $transaction->approved_by = 1;
    $transaction->save();
    $this->detail_dialog = false;
  }

  public function render(){
    $transactions = TransactionDB::orderBy($this->order_by, $this->order_to);
    if($this->filter == 'confirmed'){
      $transactions = $transactions->whereNotNull('approved_at');
    }else if($this->filter == 'new'){
      $transactions = $transactions->whereNull('approved_at');
    }
    if(!($this->select_by == 'all')){
      $transactions = $transactions->where('type', $this->select_by);
    }
    if($this->query){
      $query = $this->query;
      $transactions = $transactions->whereHas('user', function ($q) use ($query){
        $q->where('name', 'like', '%'.$query.'%');
      })->orWhere('code', 'like', '%'.$query.'%');
    }
    $transactions = $transactions->limit($this->page * 7)->get();

    $users = new UserDB;
    if($this->new_user){
      $users = $users->where('name', 'like', '%'.$this->new_user.'%');
    }
    $users = $users->limit(10)->get();
    return view('livewire.admin.transactions', compact('transactions', 'users'))->layout('livewire.admin._layout');
  }
}
