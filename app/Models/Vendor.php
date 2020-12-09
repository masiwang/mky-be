<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
