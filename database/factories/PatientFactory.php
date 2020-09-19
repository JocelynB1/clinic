<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name'=>$faker->name(),
        'mobile_phone_number'=>$faker->phoneNumber(),
        'alternative_phone_number'=>$faker->phoneNumber(),
        'area_of_residence'=>$faker->address(),
        'birth_date'=>$faker->date(),
        'gender'=>$faker->randomElement(["Male","Female"]),
        
    ];
});

