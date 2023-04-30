<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum LeaveRequestsType: string
{
    use Values;

    case Paid = 'paid';
    case Sick = 'sick';
}
