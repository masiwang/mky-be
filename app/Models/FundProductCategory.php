<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundProductCategory extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasMany('App\Models\FundProduct', 'category_id');
    }
}
