<?php

namespace App\Http\Controllers;

class CheckInController extends Controller
{
    public function index()
    {
        //retrieves check-in data of user
        $checkin_data = app("CheckIn")->getCheckIn(auth()->id());
   
        return view('user.history', compact('checkin_data'));
    }
}
