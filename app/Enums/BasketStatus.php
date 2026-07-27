<?php

namespace App\Enums;

enum BasketStatus: string
{
    case success = 'success';
    case failed = 'failed';
    case draft = 'draft';
}
