<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';

    public function review()
    {
        return $this->hasMany('App\Model\review', 'id_product', 'id');

    }

    public function order()
    {
        return $this->belongsToMany('App\Model\order', 'order', 'id_product', 'id_product');
    }
}
