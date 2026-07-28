<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogViewerController extends Controller
{
    public function log()
    {
        $title ='لیست لاگ ها';
//        return view('admin.logs.logs',compact('title'));

        $logFile = storage_path('logs/laravel-' . now()->format('Y-m-d') . '.log');

        $log = File::get($logFile);

        return view('admin.logs.logs', compact('title', 'log'));
    }
}
