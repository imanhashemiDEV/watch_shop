<?php

namespace App\Enums;

enum OrderStatus: String
{
    case Received = 'received';

    case Cancelled = 'cancelled';

    case Failed = 'failed';

    case Processing = 'processing';
}
