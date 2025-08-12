<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $full_name
 *
 * @property \Carbon\Carbon $date_of_birth
 * @property \Carbon\Carbon|null $diabetes_diagnosis_date
 */
class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'patient_id';
    public $incrementing = true;
    protected $fillable = [
        'medical_record_number',
        'full_name',
        'national_id',
        'date_of_birth',
        'birth_place',
        'gender',
        'address',
        'phone_number',
        'diabetes_diagnosis_date',
        'religion',
        'occupation',
        'education',
        'marital_status',
    ];

    protected $casts = [
        'diabetes_diagnosis_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->medical_record_number = static::generateMedicalRecordNumber();
        });
    }

    public static function generateMedicalRecordNumber()
    {
        $latestPatient = static::latest('medical_record_number')->first();
        return $latestPatient ? $latestPatient->medical_record_number + 1 : 100000;
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }

    public function drugAllergies()
    {
        return $this->belongsToMany(Drug::class, 'patient_drug_allergies', 'patient_id', 'drug_id');
    }

     public function patientResults()
    {
        return $this->hasMany(PatientResult::class, 'patient_id');
    }

}
