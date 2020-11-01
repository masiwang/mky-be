<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function provinsi(){
        $provinsi = Address::groupBy('provinsi')->select('provinsi')->get();
        return response()->json(compact('provinsi'), 200);
    }

    public function kabupaten(Request $request){
        $kabupaten = Address::where('provinsi', $request->provinsi)->groupBy('kabupaten')->select('kabupaten')->get();
        return response()->json(compact('kabupaten'), 200);
    }

    public function kecamatan(Request $request){
        $kecamatan = Address::where(['provinsi'=> $request->provinsi, 'kabupaten' => $request->kabupaten])->groupBy('kecamatan')->select('kecamatan')->get();
        return response()->json(compact('kecamatan'), 200);
    }

    public function kelurahan(Request $request){
        $kelurahan = Address::where(['provinsi'=> $request->provinsi, 'kabupaten' => $request->kabupaten, 'kecamatan' => $request->kecamatan])->groupBy('kelurahan')->select('kelurahan')->get();
        return response()->json(compact('kelurahan'), 200);
    }

    public function kodepos(Request $request){
        $kodepos = Address::where(['provinsi'=> $request->provinsi, 'kabupaten' => $request->kabupaten, 'kecamatan' => $request->kecamatan, 'kelurahan' => $request->kelurahan])->first();
        return response()->json(compact('kodepos'), 200);
    }
}
