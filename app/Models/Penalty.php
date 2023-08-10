<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    protected $fillable = [
        'duration',
        'type',
        'attendance_leave_id'
    ];

    public function attendanceLeave(): BelongsTo
    {
        return $this->belongsTo(AttendanceLeave::class);
    }
}
