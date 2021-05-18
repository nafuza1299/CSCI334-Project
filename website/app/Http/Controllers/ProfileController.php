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
        if (HealthStaff::where('user_id', Auth::user()->id)->count() != 0){
            $userid = Auth::user()->id;
            $health_staff = HealthStaff::where('user_id', $userid)
                            ->leftJoin('businesses', 'health_staffs.business_id', '=', 'businesses.id')
                            ->get();
        }
        return view('user.public.profile', compact('health_staff'));
        
    }
    public function business()
    {
        //get business id from logged in business
        $business_id = Auth::guard('business')->user()->id;
        //returns business information
        $address= BusinessAddress::where('business_id', $business_id)
                            ->orderByDesc('address')
                            ->get();

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
        if (HealthStaff::where('user_id', Auth::user()->id)->count() != 0){
            $request->validate([

                'health_org_email' => 'required|email|max:190',
                'position' => 'required|string|max:190',
            ]);
            $user = Auth::user()->id;
            HealthStaff::where('user_id', $user)
                ->update(['position' => $request->position, 'health_org_email' => $request->health_org_email]);
        }
        //save user data
        $user = Auth::user();
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();
        return redirect(route('profile'));
    }
    public function editAccountInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|email|max:190',
            'name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'address' => 'nullable|string|max:190',
        ]);
        //saves business info
        $user = Auth::guard('business')->user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->type = $request->type;
        $user->save();
        return redirect(route('business.profile'));
    }

    public function editAddressInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'latitude' => 'required|numeric|between:0,99.99',
            'longitude' => 'required|numeric|between:0,99.99',
            'address' => 'required|string|max:255',
        ]);
        //edit business addresses to business address table
        $user = Auth::guard('business')->user()->id;
        BusinessAddress::where('business_id', $user)
        ->where('id', $request->id)
        ->update(['address' => $request->address, 'longitude' => $request->longitude, 'latitude' => $request->latitude]);

        return redirect(route('business.profile'));
    }

    public function storeAddressInfoBusiness(Request $request)
    {
        //validate input
        $request->validate([
            'latitude' => 'required|numeric|between:0,99.99',
            'longitude' => 'required|numeric|between:0,99.99',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::guard('business')->user()->id;

        //save new business addresses to business address table
        $insert_address= BusinessAddress::create([
            'business_id' => $user,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
        ]);
        return redirect(route('business.profile'));
    }

    public function deleteAddressInfoBusiness(Request $request)
    {
        $user = Auth::guard('business')->user()->id;
        
        //delete business address in business address table
        BusinessAddress::where('business_id', $user)
        ->where('id', $request->id)
        ->delete();

        return redirect(route('business.profile'));
    }
}
