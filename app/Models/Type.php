<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Create a relation between type table and question table as one to many
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
