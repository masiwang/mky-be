<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FundProduct as ProductDB;
use DB;

class Vendor extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasMany('App\Models\FundProduct', 'vendor_id');
    }

    protected $fillable = [
      'name',
      'owner',
      'ktp',
      'phone',
      'kk',
      'npwp',
      'bank_type',
      'bank_acc',
      'jalan',
      'provinsi',
      'kabupaten',
      'kecamatan',
      'kelurahan',
      'kodepos'
    ];

    public function getInvestasiAttribute(){
      $product = ProductDB::select(DB::raw('sum(total_stock * price) as investasi'))->where('vendor_id', $this->id)->first();
      return $this->attributes['investasi'] = $product->investasi;
    }
}
