<?php

namespace App\Enums;

enum PaymentStatus: String
{
    case Success = 'success';

    case Fail = 'fail';

    case Reject = 'reject';
}
