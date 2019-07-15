<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'supplier_id';

    public function products()
    {
        return $this->hasMany('shopApp\Product','supplier_id','supplier_id');
    }

    public function deliveries()
    {
        return $this->hasMany('shopApp\Delivery','supplier_id', 'supplier_id');
    }
}
