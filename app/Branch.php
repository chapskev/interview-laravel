<?php

namespace shopApp;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'branch_id';

    public function headquarter()
    {
        return $this->belongsTo('shopApp\Headquarter', 'headquarter_id','headquarter_id');
    }
}
