<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view('home.address',['user' => auth()->user() ]);
    }

    public function store(CreateAddressRequest $request, User $user)
    {
        $address = Address::createAddress($request);
        return redirect()->route('checkout')->with('success', __('messages.address.created'));
    }
}


