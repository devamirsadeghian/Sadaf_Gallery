<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserByAdminRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\EditUserByAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $title = "لیست کاربران";
        $users = User::getAllUsers();
        return view('admin.user.users',compact('users','title'));
    }


    public function create()
    {
        $title = "ایجاد کاربر";
        return view('admin.user.create',compact('title'));
    }


    public function store(CreateUserByAdminRequest $request)
    {
        User::createUserByAdmin($request);
        return redirect()->route('users.index')->with('success', __('messages.user.created'));
    }


    public function show(User $user)
    {
        $title = "نمایش کاربر";
        return view('admin.user.show',compact('user','title'));
    }


    public function edit(User $user)
    {
        $title = "ویرایش کاربر";
        return view('admin.user.edit',compact('title','user'));
    }


    public function update(EditUserByAdminRequest $request, User $user)
    {
        User::updateUserByAdmin($request,$user);
        return redirect()->route('users.index')->with('success', __('messages.user.updated'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', __('messages.user.deleted'));
    }


    public function createUserRoles(string $id)
    {
        $title = "اعمال نقش کاربر";
        $roles = Role::getAllRoles();
        $user = User::getUser($id);
        return view('admin.user.user_roles',compact('title','roles','user'));
    }


    public function storeUserRoles(request $request, string $id)
    {
        $user = User::getUser($id);
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', __('messages.user.created_role'));
    }
}
