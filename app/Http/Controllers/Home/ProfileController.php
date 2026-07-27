<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('home.profile',['user' => auth()->user() ]);
    }

    public function update(EditUserRequest $request, string $id)
    {
        $user = User::getUser(auth()->id());
        User::updateUser($request,$user);

        return redirect()->route('home')->with('success', __('messages.account.completed'));
    }
}

