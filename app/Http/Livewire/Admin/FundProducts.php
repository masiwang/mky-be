<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\FundProduct as ProductDB;
use App\Models\Vendor as VendorDB;
use Carbon\Carbon;
use Str;
use Image;

class FundProducts extends Component
{
  use WithFileUploads;

  public $view = 'list';
  // list variable
  public $page_number = 1;
  public $sort_by = 'ended_at';
  public $sort_to = 'desc';
  public $query = '';
  // add variable
  public $product_image;
  public $product;
  public $vendors;

  public function more(){
    $this->page_number++;
  }

  public function sortBy($param){
    $this->sort_by = $param;
  }
  public function sortTo($param){
    $this->sort_to = $param;
  }

  public function uploadImage(){
    $random = Str::random(32);
    $image = Image::make($this->product_image)->fit(500)->save('assets/fund/'.$random.'.jpg');
    $this->product['image'] = '/assets/fund/'.$random.'.jpg';
  }

  public function save(){
    $this->uploadImage();
    $product = ProductDB::create($this->product);
    return redirect('/markas/fund/'.$product->id);
  }

  public function render(){
    $products = ProductDB::limit($this->page_number*8)->orderBy($this->sort_by, $this->sort_to)
      ->where('name', 'like', '%'.$this->query.'%')->get();
    $this->vendors = VendorDB::get();
    return view('livewire.admin.fund-products', compact('products'))->layout('livewire.admin._layout');
  }
}
