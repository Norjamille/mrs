<?php

namespace App\Http\Controllers\Midwife;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;

class PatientsPregnancyController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('Midwife/Patients/Pregnancy/Index',[
            'patient'=>$patient->load('user')->append(['full_name','age']),
           
        ]); 
    }
}
