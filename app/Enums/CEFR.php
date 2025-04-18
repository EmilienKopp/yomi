<?php

namespace App\Enums;

use Splitstack\EnumFriendly\Traits\ExtendedEnum;

enum CEFR: string
{
    use ExtendedEnum;
    case A1 = 'A1';
    case A2 = 'A2';
    case B1 = 'B1';
    case B2 = 'B2';
    case C1 = 'C1';
    case C2 = 'C2';
}
