<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCheckout extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo('App\Models\MarketProduct', 'product_id', 'id');
    }

    public function status(){
        return $this->belongsTo('App\Models\MarketCheckoutStatus', 'status_id', 'id');
    }
}
