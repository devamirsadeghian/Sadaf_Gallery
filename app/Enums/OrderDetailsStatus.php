<?php

namespace App\Enums;

enum OrderDetailsStatus: string
{
    case received = 'received';
    case rejected = 'rejected';
    case processing = 'processing';
}
