<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("has_history_of_high_bp?");
            $table->string("has_history_of_diabetes?");
            $table->string("has_heart_disease?");
            $table->string("has_history_of_stroke?");
            $table->string("smokes?");
            $table->string("takes_BB?")->nullable();
            $table->string("takes_CCB?")->nullable();
            $table->string("takes_Diuretic?")->nullable();
            $table->string("takes_ARB?")->nullable();
            $table->string("takes_ACE_I?")->nullable();
            $table->string("takes_ASA?")->nullable();
            $table->string("takes_insulin/OHA?")->nullable();
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
        Schema::dropIfExists('visits');
    }
}
