<?php

namespace App\Enums;

enum BasketDetailsStatus: string
{
    case received = 'received';
    case rejected = 'rejected';
    case processing = 'processing';
}
