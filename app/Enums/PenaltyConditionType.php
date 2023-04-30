<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum PenaltyConditionType: string
{
    use Values;

    case Delay = 'delay';
    case CuttingOut = 'cuttingOut';
    case LeaveAttendance = 'LeaveAttendance';
}
