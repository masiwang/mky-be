<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Transaction;
use App\Models\FundCheckout as Portofolio;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'jalan', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos', 
        'gender', 'birthday', 'image', 'job', 'phone', 'email_verified_at', 'remember_token',
        'ktp', 'ktp_image', 'ktp_verified_at', 'ktp_verified_by', 'bank_type', 'bank_acc',
        'npwp', 'npwp_image', 'npwp_verified_at', 'npwp_verified_by',
        'email',
        'password',
        'email_token', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'security_answer',
        'ktp',
        'ktp_image'
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

  public function getSaldoAttribute()
  {
    $transaksi_masuk = Transaction::where([
      'user_id' => $this->id,
      'status_id' => 2,
      'type' => 'in'
      ])->whereNotNull('approved_at')->sum('nominal');
    $transaksi_keluar = Transaction::where([
      'user_id' => $this->id,
      'status_id' => 2,
      'type' => 'out'
      ])->whereNotNull('approved_at')->sum('nominal');

    return $this->attributes['saldo'] = $transaksi_masuk+$transaksi_keluar;
  }

  public function getAssetAttribute(){
    $portofolio_berjalan = Portofolio::where([
      'user_id' => $this->id,
    ])->whereNull('return_sent_at')->get();
    
    $asset = 0;
    foreach ($portofolio_berjalan as $portofolio) {
      $p = Portofolio::find($portofolio->id);
      $asset = $asset + $p->qty*$p->product->price;
    }
    return $this->attributes['asset'] = $asset;
  }

  public function getNotificationAttribute(){
    return $this->attributes['notification'] = Notification::where('user_id', $this->id)->where('status', 'unread')->count();
  }
  public $appends = ['saldo', 'notification', 'asset'];

}
