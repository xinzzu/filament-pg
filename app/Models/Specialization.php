<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $primaryKey = 'specialization_id';
    public $incrementing = true;
    protected $fillable = ['name', 'description'];
}
