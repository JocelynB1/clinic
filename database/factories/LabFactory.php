<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lab;
use Faker\Generator as Faker;

$factory->define(Lab::class, function (Faker $faker) {
    return [
        'blood_sugar'=>$faker->randomDigit(),
        'cholesterol'=>$faker->randomDigit(),
        'bun_and_creatinine'=>$faker->randomDigit()
    ];
});
