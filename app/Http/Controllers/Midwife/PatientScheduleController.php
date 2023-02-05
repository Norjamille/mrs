<?php

namespace App\Http\Controllers\Midwife;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientScheduleRequest;
use App\Services\PatientScheduleService;
use Carbon\Carbon;

class PatientScheduleController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('Midwife/Patients/Schedules/Index',[
            'patient'=>$patient,
            'schedules'=>Schedule::query()
                        ->paginate(10)
                        ->withQueryString()
                        ->through(fn($schedule)=>[
                            'id'=>$schedule->id,
                            'description'=>$schedule->description,
                            'date_at'=>Carbon::parse($schedule->date_at)->format('M d Y h:m A'),
                            'status'=>$schedule->status,
                        ]),
        ]);
    }

    public function store(StorePatientScheduleRequest $request)
    {
        $validated =  $request->validated();
        $patientScheduleService = new PatientScheduleService;
        $patientScheduleService->addNewSchedule($validated);
        
        return redirect()->back()->with('toast',[
            'type'=>'success',
            'message'=>'Schedule has been set',
        ]);
    }
}
