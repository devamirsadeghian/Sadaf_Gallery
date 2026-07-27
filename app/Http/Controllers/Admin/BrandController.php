<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\EditBrandRequest;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $title = "لیست برند";
        $brands = Brand::getAllBrends();
        return view('admin.brand.brands', compact('title', 'brands'));
    }


    public function create()
    {
        $title = "ایجاد برند";
        return view('admin.brand.create', compact('title'));
    }


    public function store(CreateBrandRequest $request)
    {
        Brand::createBrand($request);
        return redirect()->route('brands.index')->with('success', __('messages.brand.created'));
    }


    public function show(Brand $brand)
    {
        $title = "نمایش برند";
        return view('admin.slider.show',compact('brand','title'));
    }


    public function edit(Brand $brand)
    {
        $title = "ویرایش برند";
        return view('admin.brand.edit',compact('title','brand'));
    }


    public function update(EditBrandRequest $request, Brand $brand)
    {
        Brand::updateBrand($request,$brand);
        return redirect()->route('brands.index')->with('success', __('messages.brand.updated'));
    }


    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', __('messages.brand.deleted'));
    }
}
