<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';

    public function product()
    {
        return $this->belongsToMany('App\Model\product', 'id_order', 'id_order');
    }
}
