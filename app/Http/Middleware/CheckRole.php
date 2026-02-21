<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if user role is in the allowed roles array
        if (in_array($user->Role, $roles)) {
            return $next($request);
        }

        // Specific inheritance for Owner/Admin
        if ($user->Role === 'Owner/Admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}