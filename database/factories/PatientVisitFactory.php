<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PatientVisit;
use Faker\Generator as Faker;

$factory->define(PatientVisit::class, function (Faker $faker) {
    return [
        'patient_id'=>$faker->randomElement(App\Patient::pluck('id')->toArray()),
        'visit_id'=>$faker->randomElement(App\Visit::pluck('id')->toArray())
    ];
});
