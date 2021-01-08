<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Vendor as VendorDB;

class Vendors extends Component
{
  public $page = 1;
  public $search;
  public $order_by = 'name';
  public $order_to = 'asc';

  public function more(){
    $this->page++;
  }

  public function render(){
    $vendors = new VendorDB;
    if($this->search){
      $vendors = $vendors->where('name', 'like', '%'.$this->search.'%')->orWhere('owner', 'like', '%'.$this->search.'%');
    }
    $vendors = $vendors->orderBy($this->order_by, $this->order_to)->limit($this->page * 8)->get();
    return view('livewire.admin.vendors', compact('vendors'))->layout('livewire.admin._layout');
  }
}
