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

    public function infectalert(){
        $userid = Auth::user()->id;
        $test_results_data = TestResult::where('infected', 1)
                            ->orderByDesc('updated_at')
                            ->first();
                            

        $user_id = $test_results_data->user_id;
        $to = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($test_results_data->test_date)));
        $from = date('Y-m-d H:i:s', strtotime('-14 day', strtotime($to)));

        $checkin_data_user = CheckIn::where('user_id', $user_id)
                 ->whereBetween('check_in_time', [$from, $to])
                ->get()
                ->toArray();

        $getOtherLat = array_filter(array_map(function($data) { return $data['latitude']; }, $checkin_data_user));
        $getOtherLon = array_filter(array_map(function($data) { return $data['longitude']; }, $checkin_data_user));

        // echo('Latitude'.$getOtherLat[0])."\r\n";
        // echo('Longitude'.$getOtherLon[0])."\r\n";
       
        // $results = CheckIn::get();
        $result = CheckIn::query()
        ->whereRaw('(6371 * acos( cos( radians('.$getOtherLat[0].') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$getOtherLon[0].') ) + sin( radians('.$getOtherLat[0].') ) * sin( radians( latitude ) ) ) ) < 5 ')
        ->where('user_id', '!=', $user_id)
        ->get();
        
        // echo($result);
        // $test2 = TestResultController::calculateDistanceBetweenTwoAddresses($results[0]->latitude, $results[0]->longitude, 	
        // 12.00000000, 	
        // 24.01000000);
        // echo($test2);exit;
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

