<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    //mặc định
    //bảng liên kết là bảng users    ------- > để thay đổi : protected $table='Tên bảng liên kết';
    //khoá chính là id               ------- > để thay đổi : protected $primaryKey = 'tên khoá chính';
    //khoá chính là khoá tự tăng    ------- > để thay đổi :  public $incrementing = false;
    //bảng liên kết có 2 trường created_at,updated_at  (timestamps=true)  ------- > để thay đổi : public $timestamps =false;
    public $timestamps =false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lien_ket_den_bang_info()
    {
        return $this->hasOne('App\Models\info', 'users_id', 'id');
    }

    // public function lien_ket_den_bang_lop()
    // {
    //     return $this->belongsToMany('App\Models\Lop', 'Users_lop', 'user_id', 'lop_id');
    // }
}
