<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use shopApp\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_id' => 1,
        'supplier_id' => 1,
    ];
});
