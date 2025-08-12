<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\PatientResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MedicalRecordController extends Controller
{
    use \App\ApiResponse;

    /**
     * Get the authenticated patient's latest medical record.
     */
    public function show()
    {
        $user = Auth::user();

        // Check if user has a linked patient record
        $patientId = $user->patient_id;
        if (!$patientId) {
            return $this->errorResponse('Patient not found', 404, 404);
        }

        // Get the latest medical record for the patient
        $medicalRecord = MedicalRecord::where('patient_id', $patientId)
            ->latest('created_at')
            ->with(['patient', 'patient.drugAllergies', 'drugs'])
            ->first();

        if (!$medicalRecord) {
            return $this->errorResponse('No medical record found', 404, 404);
        }

        // Get patient results (Gene & Status)
        $patientResults = PatientResult::where('patient_id', $patientId)
            ->with('gene')
            ->get()
            ->map(fn($result) => "{$result->gene->name}: {$result->status}")
            ->toArray();

        // Get drug allergies
        $drugAllergies = $medicalRecord->patient->drugAllergies->pluck('name')->toArray();

        // Format patient data
        $patient = $medicalRecord->patient;
        // You can also simplify this line if 'date_of_birth' is cast in the model
        $formattedDateOfBirth = Carbon::parse($patient->date_of_birth)->format('d M Y');
        $patientData = "{$patient->birth_place}, {$formattedDateOfBirth}";

        // Drugs consumed from latest medical record
        $consumedDrugs = $medicalRecord->drugs->pluck('name')->toArray();

        return $this->successResponse('Medical record retrieved successfully', [
            'patient_name' => $patient->full_name,
            'patient_data' => $patientData,
            'drug_allergies' => $drugAllergies,
            'prescription' => $medicalRecord->prescription,
            'height' => $medicalRecord->height,
            'weight' => $medicalRecord->weight,
            'bmi' => $medicalRecord->bmi,
            'irs1_rs1801278' => $medicalRecord->irs1_rs1801278,
            'drugs_consumed' => $consumedDrugs,
            'diabetes_diagnosed_since' => $patient->diabetes_diagnosis_date
                ? Carbon::parse($patient->diabetes_diagnosis_date)->format('d M Y')
                : '-',
            'patient_pg_link' => url('/patients/' . $patient->patient_id),

        ]);
    }

}
