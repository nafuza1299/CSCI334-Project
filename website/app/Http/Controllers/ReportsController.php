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
use App\Models\HealthOrgStatistic;
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

        //merge the first two arrays; positive_data and checkin_data
        $merge_data = ReportsController::custom_array_merge($positive_data->toArray(), $checkin_data->toArray());
        //get final report data with last check_in      
        $report_data =  ReportsController::custom_array_merge($merge_data, $last_checkin_data->toArray());

        //report data based on positive cases
        $positive_sorted = array(); 
        foreach ($report_data as $data) {
            $positive_sorted[] = $data['positive'];
        }

        array_multisort($positive_sorted, SORT_DESC, $report_data);
        return view('organization.report', compact('report_data'));
    }

    public function staff(){
        //get id
        $staff_id = Auth::user()->id;
        //get business ids
        $business_id = HealthStaff::where('user_id', $staff_id)
                                        ->select('business_id')
                                        ->first();
        //get statistics of business of staff
        $org_statistics = HealthOrgStatistic::where('business_id', $business_id)
                                            ->get();
        
        return view('user.healthstaff.report', compact('org_statistics'));

    }

    public function public(){
   
        //get statistics of business of staff
        $org_statistics = HealthOrgStatistic::select(HealthOrgStatistic::raw('
                                            sum(infected) as infect_total, 
                                            sum(deaths) as death_total, 
                                            sum(recovered) as recovered_total'))
                                            ->groupBy('business_id')
                                            ->get();
        return view('user.statistics', compact('org_statistics'));

    }

    public function healthorg(){ 
        //get patients which are positive
        $test_result_data= TestResult::where('infected', 1)
                        ->select('user_id')
                        ->distinct()
                        ->get()
                        ->toArray();

        //store positive id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));

        //get number of people which visited each address for all businesses
        $checkin_data = CheckIn::leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude','latitude', CheckIn::raw('count((user_id)) as visited'))
                        ->groupBy('business_address_id', 'address', 'latitude', 'longitude')
                        ->get();


        //get areas where infected users have visited
        $positive_data = CheckIn::leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude', 'latitude', CheckIn::raw('count(distinct(user_id)) as positive'))
                        ->groupBy('address', 'longitude', 'latitude')
                        ->get();
        //get the last check_in of user in location
        $last_checkin_data = CheckIn::leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                        ->select('address', 'longitude', 'latitude', CheckIn::raw('max((check_in_time)) as last_check'))
                        ->groupBy('address', 'longitude', 'latitude')
                        ->get();

      
        
        //merge the first two arrays; positive_data and checkin_data
        $merge_data = ReportsController::custom_array_merge($positive_data->toArray(), $checkin_data->toArray());

        //get final report data with last check_in      
        $report_data =  ReportsController::custom_array_merge($merge_data, $last_checkin_data->toArray());
        
        //report data based on positive cases
        $positive_sorted = array(); 
        foreach ($report_data as $data) {
            $positive_sorted[] = $data['positive'];
        }

        array_multisort($positive_sorted, SORT_DESC, $report_data);

        return view('organization.report', compact('report_data'));
    }

    //function to merge array by address
    public function custom_array_merge($array1, $array2) {
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
}
