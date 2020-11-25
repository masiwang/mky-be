<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundCheckout extends Model
{
    use HasFactory;
    protected $table = 'fund_checkouts';

    public function product()
    {
      return $this->belongsTo('App\Models\FundProduct', 'product_id');
    }
    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
