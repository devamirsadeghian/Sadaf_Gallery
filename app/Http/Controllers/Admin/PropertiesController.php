<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\CreatePropertyRequest;
use App\Http\Requests\Property\EditPropertyRequest;
use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function index()
    {
        $title = "لیست ویژگی ها";
        $properties = Property::getAllProperties();
        return view('admin.property.properties', compact('title', 'properties'));
    }


    public function create()
    {
        $title = "ایجاد گروه ویژگی ها";
        $propertyGroups = PropertyGroup::query()->pluck('title','id');
        return view('admin.property.create', compact('title','propertyGroups'));
    }


    public function store(CreatePropertyRequest $request)
    {
        Property::createProperty($request);
        return redirect()->route('properties.index')->with('success', __('messages.property.created'));
    }


    public function show()
    {
        //
    }


    public function edit(Property $property)
    {
        $title = "ویرایش گروه ویژگی ها";
        $propertyGroups = PropertyGroup::query()->pluck('title','id');
        return view('admin.property.edit',compact('title','propertyGroups','property'));
    }


    public function update(EditPropertyRequest $request, Property $property)
    {
        Property::updateProperty($request, $property);
        return redirect()->route('properties.index')->with('success', __('messages.property.updated'));
    }


    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', __('messages.property.deleted'));
    }
}
