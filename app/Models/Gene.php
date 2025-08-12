<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gene extends Model
{
    use HasFactory;

    protected $primaryKey = 'gene_id';
    public $incrementing = true;
    protected $fillable = ['name', 'status'];
}
