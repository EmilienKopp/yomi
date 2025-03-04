<?php

namespace App\Enums;

use Splitstack\EnumFriendly\Traits\ExtendedEnum;

enum OrganizationType: string
{
    use ExtendedEnum;
    case SCHOOL = 'school';
    case COMPANY = 'company';
    case NON_PROFIT = 'non_profit';
    case ASSOCIATION = 'association';
    case OTHER = 'other';
}
