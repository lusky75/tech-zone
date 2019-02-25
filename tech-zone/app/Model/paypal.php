<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paypal extends Model
{
    protected $table = 'paypal';

    public function payment_method()
    {
        return $this->hasOne('App\Model\payment_method', 'id_paypal', 'id');
    }
}
