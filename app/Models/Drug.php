<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $primaryKey = 'drug_id';
    public $incrementing = true;
    protected $fillable = ['name', 'description'];

    public function allergicPatients()
    {
        return $this->belongsToMany(Patient::class, 'patient_drug_allergies', 'drug_id', 'patient_id');
    }
}
