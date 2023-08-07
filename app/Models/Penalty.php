<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Penalty extends Pivot
{
    protected $fillable = [
        ''
    ];

    public function attendanceLeave(): BelongsTo
    {
        return $this->belongsTo(AttendanceLeave::class);
    }
}
