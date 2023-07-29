<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_leave_year',
        'max_leave_month',
        'work_start_hour',
        'work_end_hour',
        'work_place_id'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function penaltyConditions(): HasMany
    {
        return $this->HasMany(PenaltyCondition::class);
    }

    public function workPlace(): BelongsTo
    {
        return $this->belongsTo(WorkPlace::class);
    }
}
