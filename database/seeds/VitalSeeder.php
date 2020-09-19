<?php

use Illuminate\Database\Seeder;

class VitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Vital::class, 200)->create();
        
    }
}
