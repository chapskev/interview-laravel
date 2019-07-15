<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class OrderDetailDelivery extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_detail_id';

    public function delivery()
    {
        return $this->belongsTo('shopApp\Delivery', 'delivery_id','delivery_id');
    }

    public function order()
    {
        return $this->belongsTo('shopApp\Order', 'order_id','order_id');
    }

    public function orderDetail()
    {
        return $this->belongsTo('shopApp\OrderDetail', 'order_detail_id','order_detail_id');
    }

}
