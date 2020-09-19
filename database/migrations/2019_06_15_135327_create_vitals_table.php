<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("weight");
            $table->string("height");
            $table->string("abdominal_girth");
            $table->string("bmi");
            $table->string("systolic_bp");
            $table->string("diastolic_bp");
            $table->string("heart_rate");
            $table->string("bmi_level")->nullable();
            $table->string("bp_category")->nullable();
            $table->string("seen_by")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vitals');
    }
}
