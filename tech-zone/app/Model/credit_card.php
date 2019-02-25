<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class credit_card extends Model
{
    protected $table = 'category';

    public function payment_method()
    {
        return $this->hasOne('App\Model\payment_method', 'id_credit_card', 'id');
    }
}
