<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AttendanceLeave extends Pivot
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
}
