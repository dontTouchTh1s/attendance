<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupPolicy extends Model
{
    use HasFactory;

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function penaltyConditions(): HasMany
    {
        return $this->HasMany(PenaltyConditions::class);
    }
    public function workPlace(): BelongsTo
    {
        return $this->belongsTo(WorkPlace::class);
    }
}
