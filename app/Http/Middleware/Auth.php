<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
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
        
        if (!auth()->user()) {
            return redirect('/login');
        } elseif (auth()->user() && empty(auth()->user()->email_verified_at)) {
            return redirect()->route('auth.register')->with(['verified' => 'You must complete your profile.']);
        }
        return $next($request);
    }
}
