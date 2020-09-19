<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'has_history_of_high_bp?'=>$faker->randomElement(["Yes","No"]),
        'has_history_of_diabetes?'=>$faker->randomElement(["Yes","No"]),
        'has_heart_disease?'=>$faker->randomElement(["Yes","No"]),
        'has_history_of_stroke?'=>$faker->randomElement(["Yes","No"]),
        'smokes?'=>$faker->randomElement(["Yes","No"]),
        'takes_BB?'=>$faker->randomElement(["Yes","No"]),
        'takes_CCB?'=>$faker->randomElement(["Yes","No"]),
        'takes_Diuretic?'=>$faker->randomElement(["Yes","No"]),
        'takes_ARB?'=>$faker->randomElement(["Yes","No"]),
        'takes_ACE_I?'=>$faker->randomElement(["Yes","No"]),
        'takes_ASA?'=>$faker->randomElement(["Yes","No"]),
        'takes_insulin/OHA?'=>$faker->randomElement(["Yes","No"]),

    ];
});
