<?php

namespace App\Enums;

use Splitstack\EnumFriendly\Traits\ExtendedEnum;

enum JLPT: string
{
    use ExtendedEnum;

    case N1 = 'N1';
    case N2 = 'N2';
    case N3 = 'N3';
    case N4 = 'N4';
    case N5 = 'N5';
}
