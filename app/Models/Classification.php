<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    public function runner()
    {
        return $this->belongsTo(Runner::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
