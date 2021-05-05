<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredBusinessController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.business.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:190',
            'username' => 'required|string|max:190|unique:businesses',
            'email' => 'required|string|email|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'type' => 'string|max:190',
            'password' => 'required|string|confirmed|min:8|max:190',
        ]);

        $business = Business::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($business));

        // Auth::login($user);

        return redirect(route('business.login'));
    }
}
