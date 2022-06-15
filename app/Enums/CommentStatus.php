<?php

namespace App\Enums;

enum CommentStatus: String
{
    case Accepted = 'accepted';

    case Rejected = 'rejected';

    case Draft = 'draft';
}
