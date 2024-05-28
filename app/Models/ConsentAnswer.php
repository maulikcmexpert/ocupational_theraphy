<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentAnswer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(ConsentQuestion::class);
    }
    public function user()
    {
        return   $this->belongsTo(User::class, 'patient_id', 'id');
    }
}
