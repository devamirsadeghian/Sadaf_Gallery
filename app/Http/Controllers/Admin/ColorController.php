<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\EditColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ColorController extends Controller
{
    public function index()
    {
        $title = "لیست رنگ ها";
        $colors = Color::getAllColors();
        return view('admin.color.colors', compact('title', 'colors'));
    }


    public function create()
    {
        $title = "ایجاد رنگ";
        return view('admin.color.create', compact('title'));
    }


    public function store(CreateColorRequest $request)
    {
        Color::createColor($request);
        return redirect()->route('colors.index')->with('success', __('messages.color.created'));
    }


    public function show()
    {
        //
    }


    public function edit(Color $color)
    {
        $title = "ویرایش رنگ";
        return view('admin.color.edit',compact('title','color'));
    }


    public function update(EditColorRequest $request, Color $color)
    {
        Color::updateColor($request, $color);
        return redirect()->route('colors.index')->with('success', __('messages.color.updated'));
    }


    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('colors.index')->with('success', __('messages.color.deleted'));
    }
}
