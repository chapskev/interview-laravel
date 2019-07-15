<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'delivery_id';

    public function orderDetailDeliveries()
    {
        return $this->hasMany('shopApp\OrderDetail', 'delivery_id', 'delivery_id');
    }
}
