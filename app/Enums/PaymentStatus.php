<?php

namespace App\Enums;

enum PaymentStatus: String
{
    case Success = 'success';

    case Failed = 'failed';

    case Draft = 'draft';
}
