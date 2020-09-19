<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("random_blood_sugar")->nullable();
            $table->string("fasting_blood_sugar")->nullable();
            $table->string("hba1c")->nullable();
            $table->string("total_cholesterol")->nullable();
            $table->string("hdl_cholesterol")->nullable();
            $table->string("ldl_cholesterol")->nullable();
            $table->string("renal_function")->nullable();
            $table->string("ecg")->nullable();
            $table->string("bun")->nullable();
            $table->string("creatinine")->nullable();
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
        Schema::dropIfExists('labs');
    }
}
