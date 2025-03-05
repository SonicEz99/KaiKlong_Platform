<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/home'); // Redirect if not logged in
        }

        // Get the authenticated user
        $user = Auth::user();

        // If the user is not an admin and is trying to access /admin, redirect them
        if ($request->is('admin*') && $user->role != 'admin') {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }

        if (Auth::check() && $request->is('/')) {
            return redirect('/home'); // Redirect authenticated users from '/' to '/home'
        }

        return $next($request);
    }
}
