<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\FundProduct as ProductDB;
use App\Models\Transaction as TransactionDB;
use App\Models\User as UserDB;
use App\Models\FundCheckout as PortofolioDB;
use Auth;
use Carbon\Carbon;

class FundProduct extends Component
{
  public $product_id, $product, $qty, $confirm_dialog;

  public function mount($id){
    $this->product_id = $id;
    $this->product = ProductDB::find($id);
  }
  
  public function fund(){
    $user = UserDB::find(Auth::id());
    $product = ProductDB::find($this->product_id);
    if(!$this->qty){
      session()->flash('error', 'Paket tidak valid');
      return $this->confirm_dialog = false;
    }
    // cek qty valid
    if(!($this->qty%1 == 0)){
      return session()->flash('error', 'Paket tidak valid');
      return $this->confirm_dialog = false;
    }
    // cek apakah dana mencukupi
    $saldo = $user->saldo;
    $pending_withdraw = TransactionDB::where('user_id', Auth::id())
      ->where('type', 'out')->where('status_id', 1)->sum('nominal');
    $saldo_with_pending_withdraw = $saldo + $pending_withdraw;

    if($product->price * $this->qty > $saldo_with_pending_withdraw){
       session()->flash('error', 'Saldo tidak cukup');
       return $this->confirm_dialog = false;
    }
    // cek apakah stok mencukupi
    if($this->qty > $product->current_stock){
       session()->flash('error', 'Stok tidak cukup');
       return $this->confirm_dialog = false;
    }
    // cek apakah sudah pernah mendanai
    $old_portofolio = PortofolioDB::where('user_id', Auth::id())
      ->where('product_id', $product->id)->first();
    
    if($old_portofolio){
      $old_qty = $old_portofolio->qty;
      $old_portofolio->update([
        'qty' => $old_qty + $this->qty
      ]);
    }else{
      $portofolio = PortofolioDB::create([
        'invoice' => 'MKYINVF'.Auth::id().Carbon::now()->timestamp,
        'product_id' => $product->id,
        'user_id' => Auth::id(),
        'qty' => $this->qty,
      ]);
    }
    // kurangi saldo user
    $transaction = TransactionDB::create([
      'code' => 'MKYTRFO'.Auth::id().Carbon::now()->timestamp,
      'user_id' => Auth::id(),
      'type' => 'out',
      'bank_type' => 'SALDO',
      'bank_acc' => Auth::id(),
      'nominal' => $this->qty * $product->price * -1,
      'status_id' => 2,
      'approved_by' => 1,
      'approved_at' => Carbon::now(),
      'comment' => 'Pendanaan '.$product->name
    ]);
    // kurangi qty product
    $old_stock = $product->current_stock;
    $product->update([
      'current_stock' => $old_stock - $this->qty
    ]);

    return redirect('/portofolio');
  }

  public function render(){
    return view('livewire.client.fund-product')->layout('livewire._layout', ['title' => $this->product->name]);
  }
}
