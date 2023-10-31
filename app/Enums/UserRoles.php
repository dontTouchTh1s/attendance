<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum UserRoles: string
{
    use Values;

    case ExpertAdministrativeAffairs = 'EAA';
    case ManagerAdministrativeAffairs = 'MAA';
    case Employee = 'employee';
    case User = 'user';
    case Manager = 'manager';
    case BusinessAdmin = 'businessAdmin';
    case SuperAdmin = 'superAdmin';
}
