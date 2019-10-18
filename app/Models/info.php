<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    protected $table='info';
    public function lien_ket_den_bang_users()
    {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
}
