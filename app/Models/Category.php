<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    public $timestamps=false;
    public function lien_ket_den_bang_product()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id')->orderBy('id','DESC');
    }
}
