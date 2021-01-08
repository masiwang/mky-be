<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FundProduct as ProductDB;
use App\Models\Vendor as VendorDB;

class Vendor extends Component
{
  use WithPagination;

  public $vendor;
  public $view = 'profile';
  public $product_page = 1;
  
  public function mount($id){
    $this->vendor = VendorDB::find($id);
  }
  public function render(){
    $products = ProductDB::where('vendor_id', $this->vendor->id)->limit($this->product_page * 8)->get();
    return view('livewire.admin.vendor', compact('products'))->layout('livewire.admin._layout');
  }
}
