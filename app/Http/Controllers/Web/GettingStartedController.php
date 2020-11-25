<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Kodepos;
use Auth;
use Carbon\Carbon;
use Str;

class GettingStartedController extends Controller
{
  public function index(){
    $user = $this->getUser();
    if( $user->level == 5 ){
      return redirect('/');
    }
    
    switch ($user->level) {
      case 0: $view = 'email'; break;
      case 1: $view = 'profile'; break;
      case 2: $view = 'address'; break;
      case 3: $view = 'document'; break;
      case 4: $view = 'agreement'; break;
    }
    return view('pages.getting_started.'.$view, compact('user'));
  }

  public function save(Request $request){

    $user = User::find(Auth::id());

    if($user->level == 0){
      $cek_token = ($user->email_token == $request->email_token);
      if(!$cek_token){
        return back()->with(['error' => 'Token tidak tepat']);
      }

      $user->email_verified_at = Carbon::now();
      $user->level = 1;
      $user->save();
    }

    if($user->level == 1){
      $name = (Str::length($request->name) > 3) ? $request->name : null;
      $birthday = $request->birthday ?? null;
      $phone = $request->phone ?? null;
      $gender = $request->gender ?? null;
      $job = (Str::length($request->job) > 2) ? $request->job : null;
      
      if( $name && $birthday && $gender && $phone && $job ){
        $user->name = $name;
        $user->birthday = $birthday;
        $user->gender = $gender;
        $user->phone = $phone;
        $user->job = $job;
        $user->level = 2;
        $user->save();
      }else{
        return back()->with([
          'name' => (!$name) ? 'Nama tidak tepat' : '',
          'birthday' => (!$birthday) ? 'Tanggal lahir tidak tepat' : '',
          'gender' => (!$gender) ? 'Jenis kelamin tidak tepat': '',
          'phone' => (!$phone) ? 'No. HP tidak tepat': '',
          'job' => (!$job) ? 'Pekerjaan tidak tepat': ''
        ])->withInput();
      }
    }

    if($user->level == 2){
      $jalan = $request->jalan ?? null;
      $provinsi = $request->provinsi ?? null;
      $kabupaten = $request->kabupaten ?? null;
      $kecamatan = $request->kecamatan ?? null;
      $kelurahan = $request->kelurahan ?? null;
      $kodepos = $request->kodepos ?? null;

      if($jalan && $provinsi && $kabupaten && $kecamatan && $kelurahan && $kodepos){
        $user->jalan = $jalan;
        $user->provinsi = $provinsi;
        $user->kabupaten = $kabupaten;
        $user->kecamatan = $kecamatan;
        $user->kelurahan = $kelurahan;
        $user->kodepos = $kodepos;
        $user->level = 3;
        $user->save();
      }else{
        return back()->with(['error' => 'Alamat tidak tepat']);
      }
    }

    if($user->level == 3){
      $ktp = $request->ktp ? ((Str::length($request->ktp) == 16) ? $request->ktp : null) : null;
      $image = $request->image ?? null;
      if($ktp && $image){
        $image_name = $this->setImage($image);
        $user->ktp = $ktp;
        $user->ktp_image = $image_name;
        $user->level = 4;
        $user->save();
      }else{
        return back()->with([
          'ktp' => (!$ktp) ? 'ID KTP tidak tepat' : '',
          'image' => (!$image) ? 'Foto KTP wajib diisi' : ''
        ]);
      }
    }

    if($user->level == 4){
      $agree = $request->agree ?? null;
      $image = $request->image ?? null;
      if($agree && $image){
        $image_name = $this->setImage($image);
        $user->ttd = $image_name;
        $user->level = 5;
        $user->save();
        $this->setNotification(
          $user->id,
          'Pendaftaran Berhasil',
          '<p>Selamat, registrasi Anda telah berhasil.</p>
          <p>Setelah ini, silahkan menunggu maksimal 1 hari kerja untuk verifikasi identitas Anda. Apabila dalam 1 hari kerja akun Anda belum diverifikasi, harap hubungi kami melalui nomor WhatsApp Official kami berikut ini +62 821-3000-4204</p>
          <p>Salam hangat,</p><br/><br/>
          <strong>Tim Makarya</strong>'
        );
      }else{
        return back()->with([
          'agree' => (!$agree) ? 'Anda tidak dapat menyelesaikan pendaftaran karena tidak setuju dengan syarat dan ketentuan Makarya' : '',
          'ttd' => (!$image) ? 'Foto tanda tangan wajib diisi' : ''
        ]);
      }
    }

    return redirect('/getting-started');
  }
}
