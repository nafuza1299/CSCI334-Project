<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TestResult;
use App\Models\CheckIn;

class TestResultController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $test_results_data = TestResult::where('user_id', $userid)
                            ->orderByDesc('test_date')
                            ->take(10)
                            ->get();
                    // return view('overview', compact());
        return view('user.test-results', compact('test_results_data'));
    }



    // public function calculateDistanceBetweenTwoAddresses($lat1, $lng1, $lat2, $lng2){
    //     $lat1 = deg2rad($lat1);
    //     $lng1 = deg2rad($lng1);
    
    //     $lat2 = deg2rad($lat2);
    //     $lng2 = deg2rad($lng2);
    
    //     $delta_lat = $lat2 - $lat1;
    //     $delta_lng = $lng2 - $lng1;
    
    //     $hav_lat = (sin($delta_lat / 2))**2;
    //     $hav_lng = (sin($delta_lng / 2))**2;
    
    //     $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));
    
    //     $distance = 6371*$distance;
    //     // If you want calculate the distance in miles instead of kilometers, replace 6371 with 3959.
    
    //     return $distance;
    // }


}

