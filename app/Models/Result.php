<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Result extends Model
{
    use HasFactory;

    protected $table = 'races';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function runnersClassification(): BelongsToMany
    {
        return $this->belongsToMany(Runner::class, 'race_runner','race_id')
            ->withPivot('runner_age', 'total_time')
            ->orderBy('total_time');
    }
}
