<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FundProduct extends Model
{
  use HasFactory;

  protected $fillable = [
    'name', 'description', 'prospectus', 'price', 'estimated_return', 'actual_return', 'total_stock',
    'current_stock', 'image', 'started_at', 'ended_at', 'category_id', 'vendor_id'
  ];

  public function vendor(){
    return $this->belongsTo('App\Models\Vendor', 'vendor_id');
  }
  public function category(){
    return $this->belongsTo('App\Models\FundProductCategory', 'category_id');
  }
  public function checkout(){
    return $this->hasMany('App\Models\FundCheckout', 'product_id');
  }
  public function report(){
    return $this->hasMany('App\Models\FundProductReport', 'fund_product_id');
  }
  public function getPeriodeLengthAttribute(){
    /**
     * Sumber : https://laravel.com/docs/8.x/eloquent-serialization#appending-values-to-json
     */
    $periode_length = (new Carbon($this->started_at))->diffInDays(new Carbon($this->ended_at));
    return $this->attributes['periode_length'] = $periode_length;
  }
}
