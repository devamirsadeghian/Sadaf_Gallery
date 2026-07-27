<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function panel()
    {
        $title = "پنل ادمین";
        return view('admin.index',compact('title'));
    }
}


