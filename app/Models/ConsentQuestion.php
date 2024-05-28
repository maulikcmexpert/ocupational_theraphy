<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentQuestion extends Model
{
    use HasFactory;

    public function answer()
    {
        return $this->hasOne(ConsentAnswer::class);
    }
}
