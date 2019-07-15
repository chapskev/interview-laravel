<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use shopApp\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'order_id' => 1,
        'order_date' => $faker->date(),
        'headquarter_id' => 1,
    ];
});
