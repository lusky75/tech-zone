<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';

    public function order()
    {
        return $this->hasMany('App\Model\order', 'id_user', 'id');
    }

    public function review()
    {
        return $this->hasMany('App\Model\review', 'id_user', 'id');
    }

    public function payment_method()
    {
        return $this->hasMany('App\Model\payment_method', 'id_user', 'id');
    }
}
