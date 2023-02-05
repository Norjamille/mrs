<?php

namespace App\Http\Controllers\Midwife;

use SNMP;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Schedule;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        return Inertia::render('Midwife/Schedules/Index',[
            'schedules'=>Schedule::query()
                        ->with('patient')
                        ->paginate(10)
                       ->withQueryString()
                       ->through(fn($schedule)=>[
                            'date'=>$schedule->date_at,
                            'patient_full_name'=>$schedule->patient->full_name,
                            'status'=>$schedule->status,
                            'description'=>$schedule->description,
                            'date'=> Carbon::parse($schedule->date_at)->format('M d Y h:m A'),
                       ])
        ]);
    }
}
