<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum RequestType: string
{
    use Values;

    case Leave = 'leave';
    case OverTime = 'overtime';
    case OptionalLeave = 'optionalLeave';
}
