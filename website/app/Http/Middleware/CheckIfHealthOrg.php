<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfHealthOrg
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle()
    {
        if(Auth::guard('business')->user()->type == 'Health'){
            return $next($request);
        }
        return redirect()->route('business');
    }
}
