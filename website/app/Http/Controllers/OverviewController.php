<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\TestResult;

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
        $checkin = new CheckIn;
        $last_checkin_data = $checkin->getLastCheckIn($userid);

        //get last test result for user
        $testresult = new TestResult;
        $test_result = $testresult->getLastResult($userid);

        return view('user.overview', compact('last_checkin_data', 'test_result'));
        
    }

    public function business()
    {
        return view('organization.overview');
    }
}
