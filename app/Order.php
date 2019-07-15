<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_id';

    public function headquarter()
    {
        return $this->hasOne('shopApp\Headquarter','headquarter_id', 'headquarter_id');
    }

    public function orderDetails()
    {
        return $this->hasMany('shopApp\OrderDetail','order_detail_id', 'order_detail_id');
    }
}
