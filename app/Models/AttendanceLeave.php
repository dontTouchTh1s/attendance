<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttendanceLeave extends Model
{
    protected $table = 'attendance_leaves';
    protected $fillable = [
        'date',
        'type',
        'employee_id'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function objections(): HasMany
    {
        return $this->hasMany(Objection::class);
    }

    public function penalty(): HasOne
    {
        return $this->hasOne(Penalty::class);
    }
}
