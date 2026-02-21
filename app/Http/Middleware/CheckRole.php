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

        // Owner/Admin has access to all routes, plus check if user role is in the allowed list
        if ($user->Role === 'Owner/Admin' || in_array($user->Role, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
