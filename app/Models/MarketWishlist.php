<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketWishlist extends Model
{
    use HasFactory;
    protected $table = 'market_wishlists';
    public function product()
    {
        return $this->belongsTo('App\Models\MarketProduct', 'product_id');
    }
    public function user(){
        return $this->belongsToMany('App\Models\User', 'user_id');
    }
}
