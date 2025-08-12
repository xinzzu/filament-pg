<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneDrug extends Model
{
    use HasFactory;

    protected $primaryKey = 'gene_drug_id';
    public $incrementing = true;
    protected $fillable = ['gene_id', 'drug_id', 'recommendation'];

    public function gene()
    {
        return $this->belongsTo(Gene::class, 'gene_id');
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
}
