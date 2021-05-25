<?php

namespace App\Http\Controllers;



class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->id();

        //get the last check in data for user
        $last_checkin_data = app("CheckIn")->getLastCheckIn($userid);

        //get last test result for user
        $test_result = app("TestResult")->getLastResult($userid);

        return view('user.overview', compact('last_checkin_data', 'test_result'));
        
    }

    public function business()
    {
        return view('organization.overview');
    }
}
