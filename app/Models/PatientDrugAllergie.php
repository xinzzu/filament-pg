<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDrugAllergie extends Model
{
    use HasFactory;

    protected $table = 'patient_drug_allergies';
    protected $fillable = ['patient_id', 'drug_id'];
}
