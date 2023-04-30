<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum LeaveRequestStatus: string
{
    use Values;

    case Pending = 'pending';
    case Accepted = 'accepted';
    case Declined = 'declined';
    case PendingForAdmin = 'pendingForAdmin';
}
