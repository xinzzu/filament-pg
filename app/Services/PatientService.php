<?php

namespace App\Services;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PatientService
{
    /**
     * Gathers and formats all necessary data for the patient record view.
     *
     * @param Patient $patient
     * @return array
     */
    public function getPatientData(Patient $patient): array
    {
        // Eager load all required relationships for efficiency
        $patient->load([
            'medicalRecords' => function ($query) {
                $query->with('doctor.specialization')->orderBy('created_at', 'desc');
            },
            'drugAllergies',
            'patientResults.gene'
        ]);

        $latestRecord = $patient->medicalRecords->first();

        return [
            'info' => $this->getPatientInfo($patient),
            'latest_record' => $this->formatLatestRecord($latestRecord),
            'medical_history' => $this->formatMedicalHistory($patient->medicalRecords),
            'diagnoses' => $this->getDiagnoses($latestRecord),
            'genetic_results' => $this->formatGeneticResults($patient->patientResults),
            'allergies' => $this->formatAllergies($patient->drugAllergies),
            'diabetes_diagnosis_date' => $patient->diabetes_diagnosis_date,
        ];
    }

    /**
     * Formats the patient's personal information.
     */
    private function getPatientInfo(Patient $patient): array
    {
        $nameParts = explode(' ', $patient->full_name);
        $initials = (isset($nameParts[0]) ? Str::upper(substr($nameParts[0], 0, 1)) : '') .
                    (isset($nameParts[1]) ? Str::upper(substr($nameParts[1], 0, 1)) : '');

        return [
            'id' => $patient->patient_id,
            'name' => $patient->full_name,
            'initials' => $initials,
            'medical_record_number' => 'MR-' . $patient->medical_record_number,
            'dob' => Carbon::parse($patient->date_of_birth)->format('F j, Y'),
            'age' => Carbon::parse($patient->date_of_birth)->age,
            'gender' => ucfirst($patient->gender),
            'phone' => $patient->phone_number,
            'national_id' => $patient->national_id,
            'birth_place' => $patient->birth_place,
            'religion' => $patient->religion,
            'occupation' => $patient->occupation,
            'education' => $patient->education,
            'marital_status' => $patient->marital_status,
            'address' => $patient->address,
        ];
    }

    /**
     * Formats the latest medical record for quick stats.
     */
    private function formatLatestRecord($latestRecord): ?array
    {
        if (!$latestRecord) return null;

        $bmi = $latestRecord->bmi;
        $bmiStatus = 'N/A';
        if ($bmi) {
            if ($bmi < 18.5) $bmiStatus = 'Underweight';
            elseif ($bmi < 24.9) $bmiStatus = 'Normal';
            elseif ($bmi < 29.9) $bmiStatus = 'Overweight';
            else $bmiStatus = 'Obese';
        }

        return [
            'height' => $latestRecord->height,
            'weight' => $latestRecord->weight,
            'bmi' => $bmi,
            'bmi_status' => $bmiStatus,
            'diabetes_status' => $latestRecord->diabetes_mellitus_diagnosis ?? 'N/A',
            'standard_blood_sugar' => $latestRecord->standard_blood_sugar,
            'fasting_blood_sugar' => $latestRecord->fasting_blood_sugar,
            'hba1c' => $latestRecord->hba1c_results,
            'irs1_variant' => $latestRecord->irs1_rs1801278,
        ];
    }

    /**
     * Formats all historical medical records.
     */
    private function formatMedicalHistory($records): array
    {
        return $records->map(function ($record) {
            return [
                'title' => 'Medical Visit', // You can customize this
                'doctor_name' => $record->doctor->full_name ?? 'N/A',
                'doctor_specialization' => $record->doctor->specialization->name ?? 'General',
                'date' => Carbon::parse($record->created_at)->format('M j, Y'),
                'prescription' => $record->prescription,
                'notes' => $record->notes,
            ];
        })->all();
    }

    /**
     * Formats diagnoses from the latest record.
     */
    private function getDiagnoses($latestRecord): array
    {
        if (!$latestRecord) return ['primary' => null, 'other' => []];

        return [
            'primary' => [
                'name' => 'Diabetes Mellitus Type 2',
                'description' => 'Confirmed diagnosis',
                'code' => 'ICD-10: E11',
            ],
            'other' => json_decode($latestRecord->other_disease, true) ?? [], // Assuming other_disease is a JSON field
        ];
    }

    /**
     * Formats genetic test results.
     */
    private function formatGeneticResults($results): array
    {
        return $results->map(function ($result) {
            return [
                'gene_name' => $result->gene->name ?? 'N/A',
                'status' => $result->status, // e.g., 'Analyzed', 'Normal Metabolizer'
                'variant' => $result->variant_details, // Assuming you add this column
                'description' => $result->description, // Assuming you add this column
            ];
        })->all();
    }

    /**
     * Formats drug allergies.
     */
    private function formatAllergies($allergies): array
    {
        return $allergies->map(function ($allergy) {
            return [
                'name' => $allergy->name,
                'reaction' => $allergy->pivot->reaction_description ?? 'Severity not specified', // Assuming you add a pivot table column for reaction
            ];
        })->all();
    }
}
