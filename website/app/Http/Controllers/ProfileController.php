<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index()
    {
       
            // return view('overview', compact());
        return view('profile');

        
    }
    public function editAccountInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'date_of_birth' => 'nullable|date',
        ]);
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();
        return redirect(route('profile'));
    }
}
