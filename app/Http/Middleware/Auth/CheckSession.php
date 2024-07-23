<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $lastActivity = session('last_activity', 0);
            error_log('Last Activity: ' . $lastActivity);
            //600 seconds = 10 minutes
            //900 seconds = 15 minutes
            if (isset($lastActivity) && (time() - $lastActivity > 10)) {
                return redirect()->route('extendSession')->with('error', 'You have been logged out due to inactivity.');
            } elseif (isset($lastActivity) && (time() - $lastActivity > 15)) {
                Auth::logout();
                return redirect()->route('extendSession')->with('error', 'You have been logged out due to inactivity.');
            }
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}
