<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'runner_id',
        'race_id',
        'begin',
        'finish',
        'runner_age'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function runner(): BelongsTo
    {
        return $this->belongsTo(Runner::class);
    }

    public function race() : BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
