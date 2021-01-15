<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\FundProduct as ProductDB;
use Carbon\Carbon;
use Auth;

class Home extends Component
{
  public $page = 1;

  public $search, $filter;
  public $order_by = 'ended_at';
  public $order_to = 'desc';
  public $category = 'all';
  public $status = 'all';

  public function mount(){
    if(Auth::check()){
      $user = Auth::user();
      if($user->level < 5){
        return redirect('/mulai');
      }
    }
  }

  public function more(){
    $this->page++;
  }
  public function render(){
    $products = ProductDB::limit($this->page * 8);
    // category
    if(!($this->category == 'all')){
      $products = $products->where('category_id', $this->category);
    }
    // status
    if($this->status == 'new'){
      $products = $products->where('current_stock', '>', '0');
    }
    if($this->status == 'ongoing'){
      $products = $products->where('ended_at', '>', Carbon::now())->where('current_stock', 0);
    }
    if($this->status == 'done'){
      $products = $products->where('ended_at', '<', Carbon::now());
    }
    if($this->search){
      $products = $products->where('name', 'like', '%'.$this->search.'%');
    }
    $products = $products->orderBy($this->order_by, $this->order_to)->get();
    return view('livewire.client.home', compact('products'))->layout('livewire._layout', ['title' => 'Pendanaan']);
  }
}
