<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // Create a relation between questions table and answer table as one to one
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
