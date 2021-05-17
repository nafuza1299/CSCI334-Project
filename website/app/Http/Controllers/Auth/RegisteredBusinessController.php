<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'phone_number' => 'required|numeric|digits_between:8,12',
            'type' => 'required|string|max:190',
            'password' => 'required|string|confirmed|min:8|max:190',
        ]);

        if($request->type == "Health"){
            $request->validate([
                'certificate' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg|max:5120',
            ]);
        }

        $business = Business::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'password' => Hash::make($request->password)
        ]);

        if($request->type == "Health"){        
            $business_name = $request->username;
            $imageName = $business_name.'_'.time().'.'.$request->certificate->extension();  
            $path = $request->certificate->storeAs('business/certs', $imageName);
            $business->certificate = $imageName;
            $business->save();
        }

        event(new Registered($business));

        // Auth::login($user);

        return redirect(route('business.login'));
    }
}
