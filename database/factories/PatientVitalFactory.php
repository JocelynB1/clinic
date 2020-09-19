<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PatientVital;
use Faker\Generator as Faker;

$factory->define(PatientVital::class, function (Faker $faker) {
    return [
        'patient_id'=>$faker->randomElement(App\Patient::pluck('id')->toArray()),
        'vital_id'=>$faker->randomElement(App\Vital::pluck('id')->toArray())
    ];
});
