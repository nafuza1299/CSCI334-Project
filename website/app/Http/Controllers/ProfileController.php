<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BusinessAddress;


class ProfileController extends Controller
{
    public function index()
    {
       
        // return view('overview', compact());
        return view('user.public.profile');
        
    }
    public function business()
    {
        $userid = Auth::guard('business')->user()->id;
        $address= BusinessAddress::where('business_id', $userid)
                            ->orderByDesc('address')
                            ->get();
                    // return view('overview', compact());

        return view('organization.business.profile', compact('address'));
        
    }
    public function editAccountInfo(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'date_of_birth' => 'nullable|date',
        ]);
        
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
        $request->validate([
            'email' => 'required|email|max:190',
            'name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'address' => 'nullable|string|max:190',
        ]);
        
        $user = Auth::guard('business')->user();
        $user->email = $request->email;
        $user->name = $request->name;
        // $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->type = $request->type;
        $user->save();
        return redirect(route('business.profile'));
    }

    public function editAddressInfoBusiness(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:0,99.99',
            'longitude' => 'required|numeric|between:0,99.99',
            'address' => 'required|string|max:255',
        ]);
        
        $user = Auth::guard('business')->user()->id;
        BusinessAddress::where('business_id', $user)
        ->where('id', $request->id)
        ->update(['address' => $request->address, 'longitude' => $request->longitude, 'latitude' => $request->latitude]);

        return redirect(route('business.profile'));
    }

    public function storeAddressInfoBusiness(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:0,99.99',
            'longitude' => 'required|numeric|between:0,99.99',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::guard('business')->user()->id;

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
        
        BusinessAddress::where('business_id', $user)
        ->where('id', $request->id)
        ->delete();

        return redirect(route('business.profile'));
    }
}
