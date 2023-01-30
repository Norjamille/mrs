<?php

namespace App\Http\Controllers\Midwife;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Pregnancy;
use App\Http\Controllers\Controller;

class PatientPregnanciesHistoryController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('Midwife/Patients/Pregnancies/History/Index', [
            'patient' => $patient->load('user')->append(['full_name', 'age']),
            'pregnancies'=>Pregnancy::query()
                            ->wherePatientId($patient->id)
                            ->paginate(10)
                            ->withQueryString(),
        ]);
    }
    
}
