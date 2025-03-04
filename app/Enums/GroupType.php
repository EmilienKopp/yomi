<?php

namespace App\Enums;

use Splitstack\EnumFriendly\Traits\ExtendedEnum;

enum GroupType: string
{
    use ExtendedEnum;
    case FAMILY = 'family';
    case FRIENDS = 'friends';
    case CLASSROOM = 'classroom';
    case WORK = 'work';
    case OTHER = 'other';
}
