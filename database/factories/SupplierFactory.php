<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use shopApp\Supplier;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'supplier_id' => 1,
    ];
});
