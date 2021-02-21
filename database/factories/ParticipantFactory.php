<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participant;
use Faker\Generator as Faker;

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'nik' => $faker->unique()->numerify('################'),
        'name' => $faker->unique()->name,
    ];
});
