<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\EditRoleRequest;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $title ="نمایش نقش";
        $roles = Role::getAllRoles();
        return view('admin.role.roles', compact('roles','title'));
    }


    public function create()
    {
        $title = "ایجاد نقش";
        return view('admin.role.create',compact('title'));
    }


    public function store(CreateRoleRequest $request)
    {
        Role::createRole($request);
        return redirect()->route('roles.index')->with('success', __('messages.role.created'));
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Role $role)
    {
        $title = "ویرایش نقش";
        return view('admin.role.edit', compact('role', 'title'));
    }


    public function update(EditRoleRequest $request, Role $role)
    {
        Role::updateRole($request, $role);
        return redirect()->route('roles.index')->with('success', __('messages.role.updated'));
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', __('messages.role.deleted'));
    }
}

