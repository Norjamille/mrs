<?php

namespace App\Http\Controllers\Midwife;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PatientScheduleController extends Controller
{
    public function index($id)
    {
        return Inertia::render('Midwife/Patients/Schedules/Index');
    }
}
