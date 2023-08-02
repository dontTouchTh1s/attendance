<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum UserRoles: string
{
    use Values;

    case EAA = 'expertAdministrativeAffairs';
    case MAA = 'managerAdministrativeAffairs';
    case Employee = 'employee';
    case User = 'user';
    case Manager = 'manager';
}
