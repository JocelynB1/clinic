<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     //   $this->call(UsersTableSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(VisitSeeder::class);
        $this->call(LabSeeder::class);
        $this->call(VitalSeeder::class);
        $this->call(PatientVisitSeeder::class);
        $this->call(LabPatientSeeder::class);
        $this->call(PatientVitalSeeder::class);

    }
}
