<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CheckIn;
use App\Models\BusinessAddress;

class CheckInController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;

        //get checkin data of user, with reference to business address
        $checkin_data = CheckIn::where('user_id', $userid)
                            ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                            ->orderByDesc('check_in_time')
                            ->take(10)
                            ->get();
     
        return view('user.history', compact('checkin_data'));
    }
}
