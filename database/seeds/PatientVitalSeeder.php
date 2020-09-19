<?php

use Illuminate\Database\Seeder;

class PatientVitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\PatientVital::class, 200)->create();
        
    }
}
