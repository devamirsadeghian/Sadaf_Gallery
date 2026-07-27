<?php

namespace App\Enums;

enum CommentStatus: string
{
    case draft = 'draft';
    case accept = 'accept';
    case reject = 'reject';
}
