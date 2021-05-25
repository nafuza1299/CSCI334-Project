<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthStaff;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.public.login');
    }

    public function create_healthstaff()
    {
        return view('auth.healthstaff.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // check if account is disabled. Logs out if disabled
        if (Auth::user()->suspended == 1){
            $this->destroy($request);
            return redirect('/login');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function store_healthstaff(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // check if user is not healthstaff or is suspended. logs out if it matches a criteria
        if (HealthStaff::where('user_id', Auth::user()->id)->count() == 0 || Auth::user()->suspended == 1    ){
            $this->destroy($request);
        }
        else{
            return redirect('/staff');
        }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
