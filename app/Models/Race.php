<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * @return BelongsToMany
     */
    public function runners(): BelongsToMany
    {
        return $this->belongsToMany(Runner::class, 'race_runner');
    }

    /**
     * @return HasMany
     */
    public function classifications(): HasMany
    {
        return $this->hasMany(Classification::class);
    }

}
