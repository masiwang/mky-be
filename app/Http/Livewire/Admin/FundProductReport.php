<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\FundProduct as ProductDB;

class FundProductReport extends Component
{
  public $product;

  public function mount($id){
    $this->product = ProductDB::find($id);
  }
    public function render(){
        return view('livewire.admin.fund-product-report')->layout('livewire.admin._layout');
    }
}
