<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'headquarter_id';


    public function branches()
    {
        return $this->hasMany('shopApp\Branch','branch_id', 'branch_id');
    }

}
