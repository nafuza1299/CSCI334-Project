<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;

class CheckInController extends Controller
{
    public function index()
    {
        //retrieves check-in data of user
        $checkin= new CheckIn();
        $checkin_data = $checkin->getCheckIn(auth()->id());
   
        return view('user.history', compact('checkin_data'));
    }
}
