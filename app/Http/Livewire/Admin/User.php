<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\FundCheckout as PortofolioDB;
use App\Models\Transaction as TransactionDB;
use App\Models\User as UserDB;
use Carbon\Carbon;
use Mail;
use App\Mail\UserReject as UserRejectMail;
use App\Mail\UserConfirm as UserConfirmMail;

class User extends Component{
  public $user, $user_id;

  public $view = 'profile';

  public $portofolio_page_number = 1;
  public $transaction_page_number = 1;

  public $reject_cause;
  public $reject_error;

  public function mount($id){
    $this->user_id = $id;
    $this->user = UserDB::find($id);
  }

  public function morePortofolio(){
    $this->portofolio_page_number++;
  }

  public function moreTransaction(){
    $this->transaction_page_number++;
  }
  public function confirm(){
    $user = UserDB::find($this->user_id);
    $user->ktp_verified_at = Carbon::now();
    $user->ktp_verified_by = 1;
    $user->save();
    $send_mail = Mail::to($user)->send(new UserConfirmMail($user));
    redirect('/markas/user/'.$this->user_id);
  }

  public function remove(){
    $user = UserDB::find($this->user_id);
    $user->delete();
    redirect('/markas/user');
  }

  public function reject(){
    $user = UserDB::find($this->user_id);
    if($this->reject_cause == 1){
      $user->level = 0;
      $user->save();
      session()->flash('success', 'User berhasil di tolak karena email tidak valid.');
    }else if($this->reject_cause == 2){
      $user->level = 1;
      $user->save();
      $send_mail = Mail::to($user)->send(new UserRejectMail($user));
      session()->flash('success', 'User berhasil di tolak karena informasi tidak valid.');
    }else{
      session()->flash('error', 'Alasan penolakan user tidak valid.');
    }
  }

  public function render(){
    $portofolios = PortofolioDB::orderBy('id', 'desc')->limit($this->portofolio_page_number * 8)->where('user_id', $this->user_id)->get();
    $transactions = TransactionDB::orderBy('id', 'desc')->limit($this->portofolio_page_number * 10)->where('user_id', $this->user_id)->get();

    $total_topup = TransactionDB::where('user_id', $this->user_id)->whereNotNull('approved_at')->where('type', 'in')->where('comment', 'topup')->sum('nominal');
    $total_withdraw = TransactionDB::where('user_id', $this->user_id)->whereNotNull('approved_at')->where('type', 'out')->where('comment', 'withdraw')->sum('nominal');
    $total_funding = TransactionDB::where('user_id', $this->user_id)->whereNotNull('approved_at')->where('type', 'out')->where('bank_acc', $this->user_id)->sum('nominal');

    $portofolio = PortofolioDB::where('user_id', $this->user_id)->get();
    $total_return = 0;
    foreach($portofolio as $porto){
      if($porto->product->actual_return > 0){
        $total_return = $total_return + $porto->qty * $porto->product->price * $porto->product->actual_return/100;
      }
    }
    return view('livewire.admin.user', compact('portofolios', 'transactions', 'total_topup', 'total_withdraw', 'total_funding', 'total_return'))->layout('livewire.admin._layout');
  }
}
