<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PatientService
{
    public function addNewPatient($request)
    {
        DB::beginTransaction();

        $user = User::create([
            'name' => $request['firstName'].' '.$request['lastName'],
            'email' => $request['email'],
            'password' => bcrypt('password'),
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'first_name' => $request['firstName'],
            'middle_name' => $request['middleName'] ?? '',
            'last_name' => $request['lastName'],
            'extension_name' => $request['extensionName'] ?? '',
            'address' => $request['address'],
            'purok_id'=>$request['purokId'],
            'email' => $request['email'],
            'contact_number' => $request['contactNumber'],
            'date_of_birth' => $request['dateOfBirth'],
        ]);

        DB::commit();

        return true;
    }

    public function updatePatientData($request, $id)
    {
        DB::beginTransaction();
        $patient = Patient::findOrFail($id);
        $user = User::findOrfail($patient->user_id);

        $user->update([
            'name' => $request['firstName'].' '.$request['lastName'],
            'email' => $request['email'],
        ]);

        $patient->update([
            'first_name' => $request['firstName'],
            'middle_name' => $request['middleName'] ?? '',
            'last_name' => $request['lastName'],
            'extension_name' => $request['extensionName'] ?? '',
            'address' => $request['address'],
            'email' => $request['email'],
            'contact_number' => $request['contactNumber'],
            'date_of_birth' => $request['dateOfBirth'],
        ]);

        DB::commit();

        return true;
    }
}
