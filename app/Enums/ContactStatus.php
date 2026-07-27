<?php

namespace App\Enums;


enum ContactStatus: string
{
    case unread = 'unread';          // خوانده نشده
    case read = 'read';               // خوانده شده
    case answered = 'answered';    // پاسخ داده شده
}
