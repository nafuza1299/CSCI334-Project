<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\TestResult;

class SearchInfectLocationController extends Controller
{
    public function index()
    {
        //get users which are infected
        $test_result_data= TestResult::where('infected', 1)
        ->select('user_id')
        ->distinct()
        ->get()
        ->toArray();

        //store id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));
        
        //get areas where infected users have visited
        $result = CheckIn::whereIn('user_id', $getUserID)
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->select('address', 'longitude', 'latitude', CheckIn::raw('count(distinct(user_id)) as total'))
                    ->groupBy('address', 'longitude', 'latitude')
                    ->orderByDesc('total')
                    ->get();
                    
        return view('location', compact('result'));
    }
}
