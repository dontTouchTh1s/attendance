<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum EmployeeRole: string
{
    use Values;

    case ExpertAdministrativeAffairs = 'EAA';
    case ManagerAdministrativeAffairs = 'MAA';
    case Employee = 'employee';
    case Manager = 'manager';
    case BusinessAdmin = 'businessAdmin';
}
