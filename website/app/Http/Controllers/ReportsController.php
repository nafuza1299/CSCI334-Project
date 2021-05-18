<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessAddress;
use App\Models\HealthStaff;
use App\Models\CheckIn;
use App\Models\TestResult;

use App\Notifications\Alerts;

class ReportsController extends Controller
{
    public function business()
    {
        //get list of all business addresss   
        $business_id = Auth::guard('business')->user()->id;
        $address_data = BusinessAddress::where('business_id', $business_id)
                        ->get()
                        ->toArray();

        $getAddress = array_filter(array_map(function($data) { return $data['id']; }, $address_data));

        //get patients which are positive
        $test_result_data= TestResult::where('infected', 1)
                        ->select('user_id')
                        ->distinct()
                        ->get()
                        ->toArray();

        //store positive id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));

        //get number of people which visited each address
        $checkin_data = CheckIn::whereIn('business_address_id', $getAddress)
                        ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude','latitude', CheckIn::raw('count((user_id)) as visited'))
                        ->groupBy('business_address_id', 'address', 'latitude', 'longitude')
                        ->get();


        //get areas where infected users have visited
        $positive_data = CheckIn::whereIn('user_id', $getUserID)
                        ->whereIn('business_address_id', $getAddress)
                        ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude', 'latitude', CheckIn::raw('count(distinct(user_id)) as positive'))
                        ->groupBy('address', 'longitude', 'latitude')
                        ->get();

        //get the last check_in of user in location
        $last_checkin_data = CheckIn::whereIn('business_address_id', $getAddress)
                        ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude', 'latitude', CheckIn::raw('max((check_in_time)) as last_check'))
                        ->groupBy('address', 'longitude', 'latitude')
                        ->get();


        //function to merge by address
        function custom_array_merge($array1, $array2) {
            $result = Array();
            foreach ($array1 as $key_1 => &$value_1) {
                foreach ($array2 as $key_1 => $value_2) {
                    if($value_1['address'] ==  $value_2['address']) {
                        $result[] = array_merge($value_1,$value_2);
                    }
                }
            }
            return $result;
        }
        //merge the first two arrays; positive_data and checkin_data
        $merge_data =  custom_array_merge($positive_data->toArray(), $checkin_data->toArray());
        //get final report data with last check_in      
        $report_data =  custom_array_merge($merge_data, $last_checkin_data->toArray());
        return view('organization.business.report', compact('report_data'));
    }

   
}
