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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('patient_id');
            $table->string('description')->nullable();
            $table->dateTime('date_at');
            $table->string('expected_service_worker_name')->nullable();
            $table->string('status')->default('pending'); //pending, done , cancelled
            $table->boolean('retake_from')->nullable(); // date
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
        Schema::dropIfExists('schedules');
    }
};
