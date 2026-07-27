<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyGroup\CreatePropertyGroupRequest;
use App\Http\Requests\PropertyGroup\EditPropertyGroupRequest;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyGroupController extends Controller
{
    public function index()
    {
        $title = "لیست گروه ویژگی ها";
        $propertyGroups = PropertyGroup::getAllPropertyGroups();
        return view('admin.propertyroups.propertygroups', compact('title', 'propertyGroups'));
    }


    public function create()
    {
        $title = "ایجاد گروه ویژگی ها";
        return view('admin.propertygroups.create', compact('title'));
    }


    public function store(CreatePropertyGroupRequest $request)
    {
        PropertyGroup::createPropertyGroup($request);
        return redirect()->route('property_groups.index')->with('success', __('messages.property_groups.created'));
    }


    public function show()
    {
        //
    }


    public function edit(PropertyGroup $propertyGroup)
    {
        $title = "ویرایش گروه ویژگی ها";
        return view('admin.propertygroups.edit',compact('title','propertyGroup'));
    }


    public function update(EditPropertyGroupRequest $request, PropertyGroup $propertyGroup)
    {
        PropertyGroup::updatePropertyGroup($request, $propertyGroup);
        return redirect()->route('property_groups.index')->with('success', __('messages.property_groups.updated'));
    }


    public function destroy(PropertyGroup $propertyGroup)
    {
        $propertyGroup->delete();
        return redirect()->route('property_groups.index')->with('success', __('messages.property_groups.deleted'));
    }
}
