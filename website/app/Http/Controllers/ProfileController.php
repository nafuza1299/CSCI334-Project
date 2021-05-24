<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BusinessAddress;
use App\Models\HealthStaff;

class ProfileController extends Controller
{
    public function index()
    {
        //placeholder value for health staff variable
        $health_staff = '';
        //get additonal data if user is healthstaff
        if (app("HealthStaff")->where('user_id', auth()->id())->count() != 0){
            $health_staff = app("HealthStaff")->getHealthStaffInfo( auth()->id());
        }
        return view('user.public.profile', compact('health_staff'));
        
    }
    public function business()
    {
        //returns business information
        $address= app("BusinessAddress")->getBusinessAddress(auth()->guard('business')->id());

        return view('organization.business.profile', compact('address'));    
    }
    public function editAccountInfo(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|email|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'date_of_birth' => 'nullable|date',
        ]);

        //save additional data if healthstaff
        if (app("HealthStaff")->where('user_id', auth()->id())->count() != 0){
            $request->validate([
                'health_org_email' => 'required|email|max:190',
                'position' => 'required|string|max:190',
            ]);
            app("HealthStaff")->updateHealthStaffInfo(auth()->id(), $request);
        }
        //save user data
        app("User")->updateUserInfo(auth()->id(), $request);
        return redirect(route('profile'));
    }
    public function editAccountInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|email|max:190',
            'name' => 'required|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
        ]);

        //saves business info
        app("Business")->updateBusinessInfo(auth()->guard('business')->id(), $request);
        return redirect(route('business.profile'));
    }

    public function editAddressInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string|max:255',
        ]);

        //edit business addresses to business address table
        app('BusinessAddress')->updateAddress(auth()->guard('business')->id(), $request);
        return redirect(route('business.profile'));
    }

    public function storeAddressInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string|max:255',
        ]);

        //save new business addresses to business address table
        app("BusinessAddress")->createAddress(auth()->guard('business')->id(), $request);
        return redirect(route('business.profile'));
    }

    public function deleteAddressInfoBusiness(Request $request)
    {
        //delete business address in business address table
        app("BusinessAddress")->deleteAddress(auth()->guard('business')->id(), $request);
        return redirect(route('business.profile'));
    }
}
