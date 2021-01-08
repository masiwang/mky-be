<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
use App\Models\Vendor as VendorDB;
use App\Models\Kodepos as KodeposDB;
use App\Models\Bank as BankDB;

class VendorNew extends Component
{
  use WithFileUploads;

  public $profileDialog, $ktpDialog, $kkDialog, $npwpDialog = false;
  public $kelurahans = [];
  public $banks;

  public $profileImage, $ktpImage, $kkImage, $npwpImage;

  public $profileURL, $name, $owner, $ktpURL, $ktp, $kkURL, $kk, $npwpURL, $npwp, $email, $phone, $bank_type, $bank_acc, $jalan, $kodepos, $kelurahan, $kecamatan, $kabupaten, $provinsi;

  public function openDialog($dialog){
    switch ($dialog) {
      case 'ktp':
        $this->ktpDialog = true;
        break;
      case 'kk':
        $this->kkDialog = true;
        break;
      case 'npwp':
        $this->npwpDialog = true;
        break;
      case 'profile':
        $this->profileDialog = true;
        break;
    }
  }

  public function closeDialog($dialog){
    switch ($dialog) {
      case 'ktp':
        $this->ktpDialog = false;
        break;
      case 'kk':
        $this->kkDialog = false;
        break;
      case 'npwp':
        $this->npwpDialog = false;
        break;
      case 'profile':
        $this->profileDialog = false;
        break;
    }
  }

  public function saveKTP(){
    $random = Str::random(32);
    $image = Image::make($this->ktpImage)->encode('jpg');
    $image->resize(700, 700, function($constraint){
      $constraint->aspectRatio();
    })->save('assets/vendor/'.$random.'_ktp.jpg');
    $this->ktpURL = '/assets/vendor/'.$random.'_ktp.jpg';
    return $this->ktpDialog = false;
  }

  public function saveKK(){
    $random = Str::random(32);
    $image = Image::make($this->kkImage)->encode('jpg');
    $image->resize(700, 700, function($constraint){
      $constraint->aspectRatio();
    })->save('assets/vendor/'.$random.'_kk.jpg');
    $this->kkURL = '/assets/vendor/'.$random.'_kk.jpg';
    return $this->kkDialog = false;
  }

  public function saveNPWP(){
    $random = Str::random(32);
    $image = Image::make($this->npwpImage)->encode('jpg');
    $image->resize(700, 700, function($constraint){
      $constraint->aspectRatio();
    })->save('assets/vendor/'.$random.'_npwp.jpg');
    $this->npwpURL = '/assets/vendor/'.$random.'_npwp.jpg';
    return $this->npwpDialog = false;
  }

  public function saveProfile(){
    $random = Str::random(32);
    $image = Image::make($this->profileImage)->encode('jpg');
    $image->resize(400, 400, function($constraint){
      $constraint->aspectRatio();
    })->save('assets/vendor/'.$random.'_profile.jpg');
    $this->profileURL = '/assets/vendor/'.$random.'_profile.jpg';
    return $this->profileDialog = false;
  }

  public function save(){
    $new_vendor = VendorDB::create([
      'image' => $this->profileURL,
      'name' => $this->name,
      'owner' => $this->owner,
      'ktp' => $this->ktp,
      'ktp_image' => $this->ktpURL,
      'kk' => $this->kk,
      'kk_image' => $this->kkURL,
      'npwp' => $this->npwp,
      'npwp_image' => $this->npwpURL,
      'email' => $this->email,
      'phone' => $this->phone,
      'bank_type' => $this->bank_type,
      'bank_acc' => $this->bank_acc,
      'jalan' => $this->jalan,
      'kodepos' => $this->kodepos,
      'provinsi' => $this->provinsi,
      'kabupaten' => $this->kabupaten,
      'kecamatan' => $this->kecamatan,
      'kelurahan' => $this->kelurahan
    ]);
    return redirect('/vendor/'.$new_vendor->id);
  }

  public function render(){
    if(!empty($this->kodepos)) {
      $alamat = KodeposDB::where('kodepos', $this->kodepos);
      $this->kelurahans = $alamat->get();
      $this->kecamatan = $alamat->first()->kecamatan;
      $this->kabupaten = $alamat->first()->kabupaten;
      $this->provinsi = $alamat->first()->provinsi;
    }
    $this->banks = BankDB::get();
    return view('livewire.admin.vendor-new')->layout('livewire.admin._layout');
  }
}
