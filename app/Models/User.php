<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'security_answer'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function portofolio(){
        return $this->hasMany('App\Models\FundCheckout', 'user_id');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction', 'user_id');
    }
    public function saldo(){
      return $this->hasMany('App\Models\Transaction', 'user_id')->select(DB::raw('sum(transactions.amount) as amount'));
  }

  public function getSaldoAttribute()
  {
    $transaksi = Transaction::where('user_id', $this->id)->whereNotNull('approved_at')->where('status_id', 2);
    $transaksi_masuk = $transaksi->where('type', 'in')->sum('nominal');
    $transaksi_keluar = $transaksi->where('type', 'out')->sum('nominal');
      return $this->attributes['saldo'] = $transaksi_masuk+$transaksi_keluar;
  }
  public function getNotificationAttribute(){
    return $this->attributes['notification'] = Notification::where('user_id', $this->id)->where('status', 'unread')->count();
  }
  public $appends = ['saldo', 'notification'];

}
