<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Audit;
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

            // Log the login audit
            Audit::create([
                'UserID' => Auth::id(),
                'TableEdited' => 'Users',
                'PreviousChanges' => null,
                'SavedChanges' => json_encode(['event' => 'LOGIN', 'Username' => $credentials['Username']]),
                'Action' => 'LOGIN',
                'DateAdded' => now(),
            ]);

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'Username' => 'The provided credentials do not match our records or the account is inactive.',
        ])->onlyInput('Username');
    }

    public function logout(Request $request)
    {
        // Log the logout audit before destroying the session
        if (Auth::check()) {
            Audit::create([
                'UserID' => Auth::id(),
                'TableEdited' => 'Users',
                'PreviousChanges' => null,
                'SavedChanges' => json_encode(['event' => 'LOGOUT', 'Username' => Auth::user()->Username]),
                'Action' => 'LOGOUT',
                'DateAdded' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
