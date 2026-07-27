<?php

namespace App\Enums;

enum OrderStatus: string
{
    case success = 'success';
    case failed = 'failed';
    case draft = 'draft';
}
