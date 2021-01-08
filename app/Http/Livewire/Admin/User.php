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
  public $user;

  public $view = 'profile';

  public $portofolio_page_number = 1;
  public $transaction_page_number = 1;

  public $reject_cause;
  public $reject_error;

  public function mount($id){
    $this->user = UserDB::find($id);
  }

  public function morePortofolio(){
    $this->portofolio_page_number++;
  }

  public function moreTransaction(){
    $this->transaction_page_number++;
  }
  public function confirm(){
    $user = UserDB::find($this->user->id);
    $user->ktp_verified_at = Carbon::now();
    $user->ktp_verified_by = 1;
    $user->save();
    $send_mail = Mail::to($user)->send(new UserConfirmMail($user));
    $this->user = UserDB::find($this->user->id);
  }

  public function remove(){
    $user = UserDB::find($this->user->id);
    $user->delete();
    redirect('/v2/admin/user');
  }

  public function reject(){
    $user = UserDB::find($this->user->id);
    if($this->reject_cause == 1){
      $user->level = 0;
      $user->save();
    }else if($this->reject_cause == 2){
      $user->level = 1;
      $user->save();
      $send_mail = Mail::to($user)->send(new UserRejectMail($user));
    }else{
      $this->reject_error = true;
    }
  }

  public function render(){
    $portofolios = PortofolioDB::orderBy('id', 'desc')->limit($this->portofolio_page_number * 8)->where('user_id', $this->user->id)->get();
    $transactions = TransactionDB::orderBy('id', 'desc')->limit($this->portofolio_page_number * 10)->where('user_id', $this->user->id)->get();
    return view('livewire.admin.user', compact('portofolios', 'transactions'))->layout('livewire.admin._layout');
  }
}
