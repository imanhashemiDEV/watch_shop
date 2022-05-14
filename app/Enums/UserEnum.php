<?php

namespace App\Enums;

enum UserStatus: String
{
    case Active = 'active';

    case InActive = 'inactive';

    case Banned = 'banned';
}
