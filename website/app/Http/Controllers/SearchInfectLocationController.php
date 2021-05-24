<?php

namespace App\Http\Controllers;

class SearchInfectLocationController extends Controller
{
    public function index()
    {
        //get users which are infected
        $test_result_data = app("TestResult")->getInfected();
      
        //store id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));
        
        //get areas where infected users have visited
        $result = app("CheckIn")->getPositiveVisitedAddress($getUserID);

        return view('location', compact('result'));
    }
}
