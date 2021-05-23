<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\TestResult;

class SearchInfectLocationController extends Controller
{
    public function index()
    {
        //get users which are infected
        $testresult = new TestResult;
        $test_result_data = $testresult->getInfected();
      
        //store id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));
        
        //get areas where infected users have visited
        $checkin = new CheckIn;
        $result = $checkin->getInfectedAreas($getUserID);
                    
        return view('location', compact('result'));
    }
}
