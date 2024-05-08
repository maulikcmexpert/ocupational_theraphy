<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist_notes extends Model
{
    protected $fillable = [
        'doctor_id',
        'session_id',
        'patient_id',
        'note'
    ];

    use HasFactory;
}
