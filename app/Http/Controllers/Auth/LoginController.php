<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Username' => ['required'],
            'Password' => ['required'],
        ]);

        // Laravel expects 'password' key for auth attempt
        if (Auth::attempt(['Username' => $credentials['Username'], 'password' => $credentials['Password'], 'Status' => 'Active'])) {
            $request->session()->regenerate();
            
            // Log the login audit here (to be added fully later)
            // \App\Models\Audit::create([...]);

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'Username' => 'The provided credentials do not match our records or the account is inactive.',
        ])->onlyInput('Username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}