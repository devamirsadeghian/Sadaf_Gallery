<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function login_post(LoginRequest $request)
    {
        $request->validate([
            'mobile'=>'required',
            'password'=>'required',
        ]);

        if(Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', __('messages.auth.login'));
        }else{
            return redirect()->route('login')->with('error', __('messages.auth.failed'));
        }
    }


    public function register()
    {
        return view('auth.register');
    }


    public function register_post(RegisterRequest $request)
    {
        if( $request->password == $request->password_confirmation ){
            $mobileUser = User::where('mobile',$request->mobile)->first();

            if($mobileUser){
                return redirect()->route('login')->with('error', __('messages.auth.exist'));
            }else{
                $user = User::registerUser($request);
                Auth::login($user);
                return redirect()->route('login')->with('success', __('messages.auth.created'));
            }
        }else{
            return redirect()->back()->with('error', __('messages.auth.password'));
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', __('messages.auth.logout'));
    }
}
