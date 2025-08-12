<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientResult extends Model
{
    use HasFactory;

    protected $primaryKey = 'patient_result_id';
    public $incrementing = true;
    protected $fillable = ['patient_id', 'gene_id', 'status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function gene()
    {
        return $this->belongsTo(Gene::class, 'gene_id');
    }


}
