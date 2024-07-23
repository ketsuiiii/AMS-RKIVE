<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!auth()->check()) {
            return response()->view('auth.register'); // Replace 'auth.login' with the view you want to show
        }

        if ($user && in_array($user->role_code, $roles)) {
            return $next($request);
        }
        return redirect()->route('block')->with('message', 'Unauthorized access.');
    }
}
