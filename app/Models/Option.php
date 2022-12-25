<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    // Create a relation between questions table and option table as one to many
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
