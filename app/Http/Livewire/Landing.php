<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FundProduct as ProductDB;

class Landing extends Component
{
  public function render(){
    $product_count = ProductDB::count();
    return view('livewire.landing', compact('product_count'))->layout('livewire._layout', ['title' => 'Home']);
  }
}
