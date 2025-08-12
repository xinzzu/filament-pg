<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{
    use \App\ApiResponse;

    /**
     * Get the authenticated user's patient data.
     */
    public function show()
    {
        $user = Auth::user();

        // Fetch the patient
        $patient = Patient::where('patient_id', $user->patient_id)->first();

        if (!$patient) {
            return $this->errorResponse('Patient record not found', 404, 404);
        }

        // Get the latest medical record
        $latestMedicalRecord = $patient->medicalRecords()->latest('created_at')->first();

        // Append height, weight, and BMI to the patient data
        $patientData = $patient->toArray();
        $patientData['height'] = $latestMedicalRecord?->height;
        $patientData['weight'] = $latestMedicalRecord?->weight;
        $patientData['bmi'] = $latestMedicalRecord?->bmi;

        // Return the patient without medical records
        unset($patientData['medical_records']);

        return $this->successResponse('Patient data retrieved successfully', $patientData);
    }



    /**
     * Update the authenticated user's patient data.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $patient = Patient::where('patient_id', $user->patient_id)->first();

        if (!$patient) {
            return $this->errorResponse('Patient record not found', 404, 404);
        }

        // Validate input
        $validated = $request->validate([
            'full_name' => 'string|max:255',
            'phone_number' => 'string|max:15',
            'address' => 'string|max:255',
            'religion' => 'string|max:50',
            'occupation' => 'string|max:100',
            'education' => 'string|max:100',
            'marital_status' => 'string|max:50',
        ]);

        // Update patient data
        $patient->update($validated);

        return $this->successResponse('Patient data updated successfully', $patient);
    }
}
