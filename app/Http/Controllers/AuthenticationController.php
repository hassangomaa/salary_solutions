<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function loginBlade()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to dashboard
            return view('admin-login');
        } else {
            // Authentication failed, redirect back with errors
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect(route('loginBlade'));
    }



}
