<?php

namespace App\Enums;

enum OrderStatus: String
{
    case Recieved = 'recieved';

    case Cancelled = 'cancelled';

    case Failed = 'failed';

    case Draft = 'draft';
}
