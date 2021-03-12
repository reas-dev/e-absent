<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TimeStatus;
use Faker\Generator as Faker;

$factory->define(TimeStatus::class, function (Faker $faker) {
    return [
        'attend' => '08:00:00',
        'late' => '14:00:00',
    ];
});
