<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum PenaltyType: string
{
    use Values;

    case Paid = 'paid';
    case NoPaid = 'noPaid';
}
