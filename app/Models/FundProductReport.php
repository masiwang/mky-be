<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundProductReport extends Model
{
    use HasFactory;
    public function product()
    { 
        return $this->belongsTo('App\Models\FundProduct', 'fund_product_id');
    }
}
