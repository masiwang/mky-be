<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  public function getProvinsi(){
    $addresses = Address::select('provinsi as data')->groupBy('provinsi')->get();
    return response()->json($addresses, 200);
  }

  public function getKabupaten($provinsi){
    $addresses = Address::where('provinsi', $provinsi)
      ->select('kabupaten as data')->groupBy('kabupaten')->get();
    return response()->json($addresses, 200);
  }

  public function getKecamatan($provinsi, $kabupaten){
    $addresses = Address::where('provinsi', $provinsi)
      ->where('kabupaten', $kabupaten)
      ->select('kecamatan as data')->groupBy('kecamatan')->get();
    return response()->json($addresses, 200);
  }

  public function getKelurahan($provinsi, $kabupaten, $kecamatan){
    $addresses = Address::where('provinsi', $provinsi)
      ->where('kabupaten', $kabupaten)
      ->where('kecamatan', $kecamatan)
      ->select('kelurahan as data')->groupBy('kelurahan')->get();
    return response()->json($addresses, 200);
  }

  public function getKodepos($provinsi, $kabupaten, $kecamatan, $kelurahan){
    $addresses = Address::where('provinsi', $provinsi)
      ->where('kabupaten', $kabupaten)
      ->where('kecamatan', $kecamatan)
      ->where('kelurahan', $kelurahan)
      ->select('kodepos as data')->first();
    return response()->json($addresses, 200);
  }
}
