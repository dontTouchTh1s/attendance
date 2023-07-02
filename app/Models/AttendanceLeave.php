<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttendanceLeave extends Pivot
{
    protected $fillable = [
        'date',
        'type'
    ];
}
