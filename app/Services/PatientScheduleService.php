<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PatientScheduleService
{
    // $table->foreignId('user_id');
    // $table->foreignId('patient_id');
    // $table->string('description')->nullable();
    // $table->dateTime('date_at');
    // $table->string('expected_service_worker_name')->nullable();
    // $table->string('status')->default('pending'); //pending, done , cancelled
    // $table->boolean('retake_from')->nullable(); // date
    public function addNewSchedule($request)
    {
        DB::beginTransaction();
            Schedule::create([
                'user_id'=>auth()->user()->id,
                'patient_id'=>$request['patientId'],
                'description'=>$request['description'],
                'date_at'=>$request['date'],
            ]);
        DB::commit();
    }
}