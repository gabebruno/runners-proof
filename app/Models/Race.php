<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function runners()
    {
        return $this->belongsToMany(Runner::class, 'race_runner');
    }

    public function classifications()
    {
        return $this->hasMany(Classification::class);
    }

}
