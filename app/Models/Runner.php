<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Runner extends Model
{
    use HasFactory;

    public function races()
    {
        return $this->belongsToMany(Race::class, 'race_runner');
    }

    public function classifications()
    {
        return $this->hasMany(Classification::class);
    }
}

