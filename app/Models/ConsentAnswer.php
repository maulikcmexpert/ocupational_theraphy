<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentAnswer extends Model
{
    use HasFactory;

    public function question()
    {
        $this->belongsTo(ConsentQuestion::class);
    }
    public function user()
    {
        $this->belongsTo(User::class, 'patient_id', 'id');
    }
}
