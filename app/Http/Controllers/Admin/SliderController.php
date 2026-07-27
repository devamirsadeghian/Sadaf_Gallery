<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Requests\Slider\EditSliderRequest;
use App\Models\Slader;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $title = "لیست اسلایدر";
        $sliders = Slader::getAllSliders();
        return view('admin.slider.sliders', compact('title', 'sliders'));
    }


    public function create()
    {
        $title = "ایجاد اسلایدر";
        return view('admin.slider.create', compact('title'));
    }


    public function store(CreateSliderRequest $request)
    {
        Slader::createSlider($request);
        return redirect()->route('sliders.index')->with('success', __('messages.slider.created'));
    }


    public function show(Slader $slider)
    {
        $title = "نمایش اسلایدر";
        return view('admin.slider.show',compact('slider','title'));
    }


    public function edit(Slader $slider)
    {
        $title = "ویرایش اسلایدر";
        return view('admin.slider.edit',compact('slider','title'));
    }


    public function update(EditSliderRequest $request, Slader $slider)
    {
        Slader::updateSlider($request, $slider);
        return redirect()->route('sliders.index')->with('success', __('messages.slider.updated'));
    }


    public function destroy(Slader $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', __('messages.slider.deleted'));
    }
}
