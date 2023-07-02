<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum AttendanceLeaveType: string
{
    use Values;

    case Attendance = 'attendance';
    case Leave = 'leave';
}
