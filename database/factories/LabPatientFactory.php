<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\LabPatient;
use Faker\Generator as Faker;

$factory->define(LabPatient::class, function (Faker $faker) {
    return [
        'patient_id'=>$faker->randomElement(App\Patient::pluck('id')->toArray()),
        'lab_id'=>$faker->randomElement(App\Lab::pluck('id')->toArray())
    ];
});
