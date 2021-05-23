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
        //retrieves check-in data of user
        $userid = Auth::user()->id;
        $checkin= new CheckIn();
        $checkin_data = $checkin->getCheckIn($userid);
   
        return view('user.history', compact('checkin_data'));
    }
}
