<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use shopApp\Headquarter;

$factory->define(Headquarter::class, function (Faker $faker) {
    return [
        'headquarter_id' => 1,
        'branch_id' => 1,
    ];
});
