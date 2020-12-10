<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\FundProductController;
use App\Models\FundProduct;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    protected function _totalFunding($vendor){
        $total_funding = 0;
        $fundings = $vendor->product;
        foreach ($fundings as $funding) {
            $total_funding = $total_funding + ($funding->price * $funding->total_stock);
        }
        return $total_funding;
    }

    protected function _resourceVendor($vendors){
        $response = [];
        foreach ($vendors as $vendor) {
            $data = [
                'id' => $vendor->id,
                'name' => $vendor->name,
                'owner' => $vendor->owner,
                'phone' => $vendor->phone,
                'funding' => $this->_totalFunding( $vendor ),
                'bank' => $vendor->bank_type.' '.$vendor->bank_acc
            ];
            array_push($response, $data);
        }
        return $response;
    }

    public function index(){
        $vendors = $this->_resourceVendor( Vendor::all() );
        return response()->json($vendors, 200);
    }

    protected function _resourceVendorDetail($vendor){
      $nominal = 0;
      $fundings = FundProduct::where('vendor_id', $vendor->id)->get();
      foreach ($fundings as $funding) {
        $nominal = $nominal + ($funding->price * $funding->total_stock);
      }

      $response = [
        'name' => $vendor->name,
        'owner' => $vendor->owner,
        'jalan' => $vendor->jalan,
        'kelurahan' => $vendor->kelurahan,
        'kecamatan' => $vendor->kecamatan,
        'kabupaten' => $vendor->kabupaten,
        'kodepos' => $vendor->kodepos,
        'ktp' => $vendor->ktp,
        'kk' => $vendor->kk,
        'npwp' => $vendor->npwp,
        'bank' => $vendor->bank_type.' '.$vendor->bank_acc,
        'phone' => $vendor->phone, 
        'nominal' => $nominal
      ];
      return $response;
    }

    public function detail($id){
      $fundProductController = new FundProductController;
      $vendor = $this->_resourceVendorDetail( Vendor::find($id) );
      $fund_products = $fundProductController->_resource( FundProduct::where('vendor_id', $id)->get() );
      return response()->json(compact('vendor', 'fund_products'), 200);
    }

    public function store(Request $request){
      if(
        Vendor::create($request->all())
      ){
        return response()->json(['status' => 'success'], 200);
      }else{
        return response()->json(['status' => 'bad request'], 200);
      }
    }
}
