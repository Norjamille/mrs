<?php

namespace App\Http\Controllers\Midwife;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientPregnancyRequest;
use App\Models\Patient;
use App\Models\Pregnancy;
use App\Services\PatientPregnancyService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientPregnanciesHistoryController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);

        return Inertia::render('Midwife/Patients/Pregnancies/History/Index', [
            'patient' => $patient->load('user')->append(['full_name', 'age']),
            'pregnancies' => Pregnancy::query()
                            ->wherePatientId($patient->id)
                            ->latest()
                            ->paginate(10)
                            ->withQueryString()
                            ->through(fn ($pregnancy) => [
                                'id' => $pregnancy->id,
                                'baby_full_name' => $pregnancy->first_name.' '.$pregnancy->last_name,
                                'first_check_up_at' => $pregnancy->first_check_up_at,
                                'months_on_check_up' => $pregnancy->month,
                                'current_months_of_pregnancy' => $pregnancy->current_pregnancy_month > 1 ? $pregnancy->current_pregnancy_month.' months' : $pregnancy->current_pregnancy_month.' month',
                                'status' => Pregnancy::STATUSES[$pregnancy->status],
                                'birth_id' => $pregnancy->birth_id,
                            ]),
        ]);
    }

    public function create(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        if ($patient->current_pregnant_with) {
            return redirect()->back();
        }

        return Inertia::render('Midwife/Patients/Pregnancies/History/Create', [
            'patient' => $patient->load('user')->append(['full_name', 'age']),
            'refererUrl' => $request->refererUrl,
            'statuses' => Pregnancy::STATUSES,
        ]);
    }

    public function store(PatientPregnancyRequest $patientPregnancyRequest)
    {
        $validated = $patientPregnancyRequest->validated();
        $pregnancyService = new PatientPregnancyService;
        $pregnancyService->addNewPregnancy($validated);

        return redirect($patientPregnancyRequest->refererUrl);
    }
}
