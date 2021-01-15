<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\FundCheckout as PortofolioDB;
use Auth;

class Portofolio extends Component
{
  public $filter;
  public $page = 1;
  public $status = 'all';

  public function more(){
    $this->page++;
  }

  public function render(){
    $portofolios = PortofolioDB::where('user_id', Auth::id());
    if(!($this->status == 'all')){
      if($this->status == 'ongoing'){
        $portofolios = $portofolios->whereNull('return_sent_at');
      }
      if($this->status == 'done'){
        $portofolios = $portofolios->whereNotNull('return_sent_at');
      }
    }
    $portofolios = $portofolios->limit($this->page * 8)->get();

    $portostats = PortofolioDB::where('user_id', Auth::id())->get();
    $total_modal = 0;
    $total_pendapatan = 0;
    foreach($portostats as $porto){
      $total_modal = $total_modal + $porto->qty * $porto->product->price;
      if($porto->product->actual_return){
        $total_pendapatan = $total_pendapatan + $porto->qty * $porto->product->price * $porto->product->actual_return/100;
      }
    }

    $total_portofolio = count($portostats);

    return view('livewire.client.portofolio', compact('portofolios', 'total_modal', 'total_portofolio', 'total_pendapatan'))->layout('livewire._layout', ['title' => 'Portofolio']);
  }
}
