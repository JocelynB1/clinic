<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        
        DB::table('users')->insert([
            
            [
                'name'=>'Nurse',
                'password'=>Hash::make('Nurse'),
                'email'=>'Nurse@cardioprotectionghana.com',
                'role'=>'Nurse'
                
            ],
            [
                'name'=>'Doctor',
                'password'=>Hash::make('Doctor'),
                'email'=>'Doctor@cardioprotectionghana.com',
                'role'=>'Doctor'
                
            ],
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
