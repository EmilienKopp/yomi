<?php

namespace App\Enums;

use Splitstack\EnumFriendly\Traits\ExtendedEnum;

enum IELTS: string
{
    use ExtendedEnum;
    case ONE = '1';
    case TWO = '2';
    case THREE = '3';
    case FOUR = '4';
    case FIVE = '5';
    case SIX = '6';
    case SEVEN = '7';
    case EIGHT = '8';
    case NINE = '9';
}
