<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'user_id', 'type', 'bank_type', 'bank_acc', 'nominal', 'status_id', 'approved_at', 'approved_by', 'comment', 'image'];
    
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function status(){
      return $this->belongsTo('App\Models\TransactionStatus', 'status_id');
    }

}
