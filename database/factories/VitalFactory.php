<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vital;
use Faker\Generator as Faker;

$factory->define(Vital::class, function (Faker $faker) {
    return [
        'weight'=>$faker->randomDigit(),
        'height'=>$faker->randomDigit(),
        'abdominal_girth'=>$faker->randomDigit(),
        'bmi'=>$faker->randomDigit(),
        'bp'=>$faker->randomDigit(),
        'heart_rate'=>$faker->randomDigit(),
     
    ];
});
