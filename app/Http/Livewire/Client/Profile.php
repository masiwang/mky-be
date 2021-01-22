<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Image;
use App\Models\User as UserDB;
use Str;

class Profile extends Component
{
  use WithFileUploads;
  public $user, $user_image, $user_image_url, $user_name, $user_phone, $user_email, $user_job, $user_bank_type, $user_bank_acc, $user_jalan, $user_kodepos, $user_kelurahan, $user_kecamatan, $user_kabupaten, $user_provinsi;
  
  public function uploadImage(){
    $random = Str::random(32);
    $image = Image::make($this->user_image)->fit(400)->orientate()->save('userdata/profile/'.$random.'.jpg');
    $this->user_image_url = '/userdata/profile/'.$random.'.jpg';
  }
  public function update(){
    $user = UserDB::find(Auth::id());
    if($this->user_image){
      $this->uploadImage();
      $user->image = $this->user_image_url;
    }
    $user->name = $this->user_name;
    $user->phone = $this->user_phone;
    $user->email = $this->user_email;
    $user->job = $this->user_job;
    $user->bank_type = $this->user_bank_type;
    $user->bank_acc = $this->user_bank_acc;
    $user->jalan = $this->user_jalan;
    $user->kodepos = $this->user_kodepos;
    $user->kelurahan = $this->user_kelurahan;
    $user->kecamatan = $this->user_kecamatan;
    $user->kabupaten = $this->user_kabupaten;
    $user->provinsi = $this->user_provinsi;
    $user->save();
    $this->user->image = $this->user_image_url;
  }

  public function mount(){
    $user = UserDB::find(Auth::id());
    $this->user = $user;
    $this->user_name = $user->name;
    $this->user_phone = $user->phone;
    $this->user_email = $user->email;
    $this->user_job = $user->job;
    $this->user_bank_type = $user->bank_type;
    $this->user_bank_acc = $user->bank_acc;
    $this->user_jalan = $user->jalan;
    $this->user_kodepos = $user->kodepos;
    $this->user_kelurahan = Str::title($user->kelurahan);
    $this->user_kecamatan = Str::title($user->kecamatan);
    $this->user_kabupaten = Str::title($user->kabupaten);
    $this->user_provinsi = Str::title($user->provinsi);
  }

  public function render(){
    

    return view('livewire.client.profile')->layout('livewire._layout', ['title' => 'Profil']);
  }
}
