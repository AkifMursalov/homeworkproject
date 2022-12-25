<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Create a relation between questions table and answer table as one to one
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    // Create a relation between questions table and option table as one to many
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // Create a relation between questions table and type table as one to one
    public function types()
    {
        return $this->hasOne(Type::class);
    }
}
