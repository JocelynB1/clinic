<?php

use Illuminate\Database\Seeder;

class LabPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\LabPatient::class, 200)->create();
        
    }
}
