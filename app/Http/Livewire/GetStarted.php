<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use App\Models\User as UserDB;
use App\Models\Kodepos as KodeposDB;
use App\Mail\EmailToken;
use Image;
use Mail;
use Str;
use Carbon\Carbon;

class GetStarted extends Component
{
  use WithFileUploads;
  public function mount(){
    $user = Auth::user();
    if($user->level == 5){
      return redirect('/');
    }
  }
  // step 1
  public $level;
  public function resendToken(){
    $token = rand(1000, 9999);
    $user = UserDB::find(Auth::id());
    $user->update([
      'email_token' => $token,
    ]);
    $email_token = Mail::send(new EmailToken($user));
    session()->flash('success', 'Token konfirmasi berhasil dikirim kembali. Silahkan periksa email anda dalam ~1-5 menit.');
  }

  public $email_token;
  public function emailConfirm(){
    $user = UserDB::find(Auth::id());
    if($user->email_token == $this->email_token){
      $user->update([
        'level' => 1
      ]);
      session()->flash('success', 'Token berhasil dikonfirmasi');
      $this->level = 1;
    }else{
      session()->flash('error', 'Maaf token tidak tepat');
    }
  }
  // step 2
  public $name, $gender, $birthday_date, $birthday_month, $birthday_year, $phone, $job;
  public function personalInfo(){
    $this->validate([
      'name' => 'required|min:3',
      'gender' => 'required',
      'birthday_date' => 'required',
      'birthday_month' => 'required',
      'birthday_year' => 'required',
      'phone' => 'required',
      'job' => 'required'
    ]);
    
    $user = UserDB::find(Auth::id());
    $user->update([
      'name' => $this->name,
      'gender' => $this->gender,
      'birthday' => Carbon::createFromDate($this->birthday_year, $this->birthday_month, $this->birthday_date),
      'phone' => $this->phone,
      'job' => $this->job,
      'level' => 2
    ]);
    $this->level = 2;
  }
  // step 3
  public $kodepos = '';
  public $jalan, $kelurahan, $kecamatan, $kabupaten, $provinsi, $kelurahanList;
  public function userAddress(){
    $this->validate([
      'jalan' => 'required',
      'kodepos' => 'required',
      'kelurahan' => 'required',
      'kecamatan' => 'required',
      'kabupaten' => 'required',
      'provinsi' => 'required',
    ]);

    $user = UserDB::find(Auth::id());
    $user->update([
      'jalan' => $this->jalan,
      'kodepos' => $this->kodepos,
      'kelurahan' => $this->kelurahan,
      'kecamatan' => $this->kecamatan,
      'kabupaten' => $this->kabupaten,
      'provinsi' => $this->provinsi,
      'level' => 3
    ]);
    $this->level = 3;
  }
  // step 4
  public $ktp_image, $ktp_image_url, $ktp, $npwp_image, $npwp_image_url, $npwp, $bank_type, $bank_acc;
  
  public function uploadKTP(){
    $random = Str::random(32);
    $path = Image::make($this->ktp_image)->save('userdata/idcard/'.$random.'.jpg');
    $this->ktp_image_url = '/userdata/idcard/'.$random.'.jpg';
  }

  public function uploadNPWP(){
    $random = Str::random(32);
    $path = Image::make($this->npwp_image)->save('userdata/npwp/'.$random.'.jpg');
    $this->npwp_image_url = '/userdata/npwp/'.$random.'.jpg';
  }
  public function userDocument(){
    $this->validate([
      'ktp_image' => 'required|image|max:2048',
      'ktp' => 'required|numeric',
      'npwp_image' => 'nullable|image|max:2048',
      'bank_type' => 'required|string',
      'bank_acc' => 'required|numeric'
    ]);

    if(!$this->ktp_image){
      return session()->flash('error', 'Wajib menyertakan KTP');
    }

    $this->uploadKTP();
    if($this->npwp_image){
      $this->uploadNPWP();
    }

    $user = UserDB::find(Auth::id());
    $user->update([
      'ktp_image' => $this->ktp_image_url,
      'ktp'=> $this->ktp,
      'npwp_image' => $this->npwp_image_url,
      'npwp' => $this->npwp,
      'bank_type' => $this->bank_type,
      'bank_acc' => $this->bank_acc,
      'level' => 4
    ]);

    $this->level = 4;
  }

  // step 5
  public $agree;
  public function agreement(){
    if(!$this->agree){
      return session()->flash('error', 'Setujui agreement untuk melanjutkan.');
    }

    $user = UserDB::find(Auth::id());
    $user->update([
      'level' => 5
    ]);

    return redirect('/pendanaan');
  }

  public function render()
  {
    $user = UserDB::find(Auth::id());
    $this->level = $user->level;
    if(Str::length($this->kodepos) > 4){
      $kodepos = KodeposDB::where('kodepos', $this->kodepos)->first();
      $this->kelurahanList = KodeposDB::where('kodepos', $this->kodepos)->get();
      $this->kecamatan = $kodepos->kecamatan;
      $this->kabupaten = $kodepos->kabupaten;
      $this->provinsi = $kodepos->provinsi;
    }
    // Storage::disk('public')->delete('ktp/mVMFDa2tveHTJMzJh69muIpvrXjmJSaeL260M53t.png');
    return view('livewire.get-started')->layout('livewire._layout', ['title' => 'Mulai']);
  }
}
