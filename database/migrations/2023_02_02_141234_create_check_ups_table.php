<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id');
            $table->dateTime('date_at');
            $table->string('weight');
            $table->string('height');
            $table->integer('age_of_gestation');
            $table->string('blood_pressure');
            $table->string('body_mass_index');
            $table->string('laboratory_test_done');
            $table->string('urinalysis');
            $table->string('complete_blood_count');
            $table->string('blood_typing');
            $table->string('advice_and_services');
            $table->dateTime('date_of_return');
            $table->string('name_of_service_worker');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('check_ups');
    }
};
