<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'drug_allergies',
        'prescription',
        'notes',
        'height',
        'weight',
        'standard_blood_sugar',
        'fasting_blood_sugar',
        'diabetes_mellitus_diagnosis',
        'other_disease',
        'hba1c_results',
        'irs1_rs1801278',
        'bmi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($medicalRecord) {

            if ($medicalRecord->height && $medicalRecord->weight) {
                $medicalRecord->bmi = static::calculateBMI($medicalRecord->height, $medicalRecord->weight);
            }
        });
    }

    public static function calculateBMI($height, $weight)
    {
        if ($height > 0) {
            return round($weight / (($height / 100) ** 2), 2);
        }
        return null;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function drugs()
    {
        return $this->belongsToMany(Drug::class, 'medical_record_drugs', 'medical_record_id', 'drug_id');
    }

}
