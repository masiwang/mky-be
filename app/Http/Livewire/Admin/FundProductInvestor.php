<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FundProduct as ProductDB;
use App\Models\FundCheckout as PortofolioDB;
use App\Models\User as UserDB;
use Str;

class FundProductInvestor extends Component
{
  use WithPagination;

  public $product;
  public $new_investor_name, $new_investor_qty;

  public function mount($id){
    $this->product = ProductDB::find($id);
  }

  public function render(){
    $investors = PortofolioDB::where('product_id', $this->product->id)->paginate(10);
    $users = new UserDB;
    if($this->new_investor_name){
      $users = $users->where('name', 'like', '%'.$this->new_investor_name.'%');
    }
    $users = $users->limit(10)->get();
    return view('livewire.admin.fund-product-investor', compact('investors', 'users'))->layout('livewire.admin._layout');
  }
}
