<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\View\View;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

   public function show(Patient $patient): View
    {
        $patientData = $this->patientService->getPatientData($patient);

        return view('patients.show', compact('patientData'));
    }
}
