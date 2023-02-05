<?php

namespace App\Http\Controllers\Midwife;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Purok;
use App\Models\Patient;
use App\Services\PatientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Request;

class PatientController extends Controller
{
    public function index()
    {
        $search = Request::input('search');
        return Inertia::render('Midwife/Patients/Index', [
            'patients' => Patient::query()
                ->when($search!='',function($query)use($search){
                    $query->where('last_name','like',"%{$search}%")
                        ->orWhere('first_name','like',"%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($patient) => [
                    'id' => $patient->id,
                    'fullName' => $patient->full_name,
                    'contactNumber' => $patient->contact_number,
                    'email' => $patient->email,
                    'age' => $patient->age,
                    'status' => $patient->active ? 'Active' : 'Inactive',
                ]),
            'filters'=>Request::only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Midwife/Patients/Create', [
            'puroks' => Purok::select('id', 'name')->get(),
        ]);
    }

    public function store(PatientRequest $patientRequest)
    {
        $validated = $patientRequest->validated();
        $patientService = new PatientService;
        $patientService->addNewPatient($validated);

        return redirect()->route('midwife.patients')->with('toast', [
            'type' => 'success',
            'message' => 'New record has been added!',
        ]);
    }

    public function edit($id)
    {
        $patient = Patient::findOrfail($id);

        return Inertia::render('Midwife/Patients/Edit', [
            'patient' => $patient,
            'puroks' => Purok::select('id', 'name')->get(),
        ]);
    }

    public function update(PatientRequest $patientRequest, $id)
    {
        $validated = $patientRequest->validated();
        $patientService = new PatientService;
        $patientService->updatePatientData($validated, $id);

        return redirect()->route('midwife.patients')->with('toast', [
            'type' => 'success',
            'message' => 'Record has been updated!',
        ]);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        User::findOrFail($patient->user_id)->delete();
        $patient->delete();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Record has been deleted!',
        ]);
    }
}
