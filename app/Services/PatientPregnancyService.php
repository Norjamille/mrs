<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Pregnancy;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PatientPregnancyService
{
    public function addNewPregnancy($request)
    {
        DB::beginTransaction();
        $patient = Patient::findOrFail($request['patientId']);

        $babies_count = $request['noOfBabies'];

        $birth_id = Carbon::now()->format('Ydmhis');

        for ($i = 0; $i < $babies_count; $i++) {
            Pregnancy::create([
                'patient_id' => $patient->id,
                'first_check_up_at' => $request['firstCheckUpAt'],
                'months' => $request['months'],
                'status' => $request['status'],
                'birth_id' => $birth_id,
            ]);
        }

        $patient->update([
            'current_pregnant_with' => $birth_id,
        ]);

        DB::commit();

        return true;
    }
}
