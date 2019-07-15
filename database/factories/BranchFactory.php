<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use shopApp\Branch;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'branch_id' => 1,
    ];
});
