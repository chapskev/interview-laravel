<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'product_id';

    public function supplier()
    {
        return $this->belongsTo('shopApp\Supplier', 'supplier_id','supplier_id');
    }

    public function orderDetails()
    {
        return $this->hasMany('shopApp\OrderDetail','product_id', 'product_id');
    }
}
