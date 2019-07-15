<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_detail_id';

    public function product()
    {
        return $this->hasOne('shopApp\Product', 'product_id','product_id');
    }

    public function order()
    {
        return $this->belongsTo('shopApp\Order', 'order_id','order_id');
    }

    public function orderDetailDeliveries(){
        return $this->hasMany('shopApp\OrderDetailDelivery', 'order_detail_id','order_detail_id');
    }
}
