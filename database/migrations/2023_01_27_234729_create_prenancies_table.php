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
        Schema::create('prenancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->dateTime('first_check_up_at')->nullable();
            $table->bigInteger('months');
            $table->string('status');
            $table->string('baby_first_name')->nullable();
            $table->string('baby_middle_name')->nullable();
            $table->string('baby_last_name')->nullable();
            $table->string('baby_birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_procedure')->nullable(); // noral / cesarean 
            $table->string('birth_id')->nullable(); // identifying of duplicates (Tween etc)
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
        Schema::dropIfExists('prenancies');
    }
};
