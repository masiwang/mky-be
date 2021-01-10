<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Kodepos as KodeposDB;
use App\Models\Vendor as VendorDB;
use Str;
use Image;

class Vendors extends Component
{
  use WithFileUploads;
  public $page = 1;
  public $search;
  public $order_by = 'name';
  public $order_to = 'asc';

  public $view = 'index';
  // create vendor
  public $new_vendor = ['kodepos' => null];
  public $new_vendor_image;

  public function uploadImage(){
    $random = Str::random(32);
    $image = Image::make($this->new_vendor_image)->fit(500)->save('assets/vendor/'.$random.'.jpg');
    $this->new_vendor['image'] = '/assets/vendor/'.$random.'.jpg';
  }

  public function create(){
    $this->uploadImage();
    $vendor = VendorDB::create($this->new_vendor);
    return redirect('/markas/fund/'.$vendor->id);
  }

  public function more(){
    $this->page++;
  }

  public function render(){
    $vendors = new VendorDB;
    if($this->search){
      $vendors = $vendors->where('name', 'like', '%'.$this->search.'%')->orWhere('owner', 'like', '%'.$this->search.'%');
    }
    $vendors = $vendors->orderBy($this->order_by, $this->order_to)->limit($this->page * 8)->get();
    if(Str::length($this->new_vendor['kodepos']) > 2){
      $kodepos = KodeposDB::where('kodepos', $this->new_vendor['kodepos']);
      $alamats = $kodepos->get();
      $alamat = $kodepos->first();
      if($alamat){
        $this->new_vendor['kecamatan'] = $alamat->kecamatan;
        $this->new_vendor['kabupaten'] = $alamat->kabupaten;
        $this->new_vendor['provinsi'] = $alamat->provinsi;
      }
    }else{
      $alamats = [];
      $alamat = '';
    }
    return view('livewire.admin.vendors', compact('vendors', 'alamats', 'alamat'))->layout('livewire.admin._layout');
  }
}
