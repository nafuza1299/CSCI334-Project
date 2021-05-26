<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business;
use App\Models\HealthStaff;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\Alerts;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.public.register');
    }

    public function create_healthstaff()
    {
        $result = Business::select('name', 'id')->where('type', 'Health')->where('verified', '1')->get();
        return view('auth.healthstaff.register', compact('result'));
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
            'name' => 'required|string|max:190|unique:users',
            'email' => 'required|string|email|max:190',
            'password' => 'required|string|confirmed|min:8|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('login'));
    }

    public function store_user_healthstaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:190|unique:users',
            'email' => 'required|string|email|max:190',
            'password' => 'required|string|confirmed|min:8|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'position' => 'required|string|max:190',
            'business_id' => 'required',
            'health_org_email' => 'required|email|max:190',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        $health_staff = HealthStaff::create([
            'user_id' => $user->id,
            'position' => $request->position,
            'business_id' => $request->business_id,
            'health_org_email' => $request->health_org_email,
        ]);
        $user->assignRole('healthstaff');

        // create notification
        $message = "Please wait until the admin verifies your account before accessing the dashboard";
        $msg_type = "System";
        $user->notify(new Alerts($message, $msg_type));
        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('healthstaff.login'));
    }
}
