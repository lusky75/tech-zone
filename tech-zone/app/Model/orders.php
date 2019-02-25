<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';

    public function product()
    {
        return $this->belongsToMany('App\Model\product', 'id_order', 'id_order');
    }
}
