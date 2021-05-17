<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfGeneral
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
        // Checks if the business type is 'general' redirects to home if not
        if(Auth::guard('business')->user()->type == 'Business'){
            return $next($request);
        }
        return redirect()->route('business');
    }
}
