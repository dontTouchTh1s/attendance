<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objection extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'attendance_leave_id',
        'feedback',
        'reviewed'
    ];

    public function attendanceLeave(): BelongsTo
    {
        return $this->belongsTo(AttendanceLeave::class);
    }
}
