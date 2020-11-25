<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketProduct extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\MarketProductCategory', 'category_id', 'id');
    }
    public function wishlist()
    {
        return $this->hasMany('App\Models\MarketWishlist', 'product_id');
    }

    public function user()
    {
        return $this->hasManyThrough('App\Models\MarketWishlist', 'App\Models\User', 'product_id', 'user_id');
    }
}
