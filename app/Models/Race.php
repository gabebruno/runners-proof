<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Race extends Model
{
    use HasFactory;

    public function runners()
    {
        return $this->belongsToMany(Runner::class, 'race_runner');
    }

    public function classifications()
    {
        return $this->hasMany(Classification::class);
    }

}
