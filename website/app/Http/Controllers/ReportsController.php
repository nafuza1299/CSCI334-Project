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
        $businessAddress = new BusinessAddress;
        $address_data = $businessAddress->getBusinessAddress(auth()->guard('business')->id())->toArray();
        $getAddress = array_filter(array_map(function($data) { return $data['id']; }, $address_data));
        $report_data = $this->getReportData($getAddress);

        return view('organization.report', compact('report_data'));
    }

    public function healthorg(){ 
        $report_data = $this->getReportData();
        return view('organization.report', compact('report_data'));
    }

    public function staff(){

        //get health staff's org ID
        $healthstaff = new HealthStaff;
        $business_id = $healthstaff->getHealthStaffID(auth()->id());

        //get statistics of business of staff
        $statistics = new HealthOrgStatistic;
        $org_statistics = $statistics->getOrgStatistic($business_id->business_id);
                                            
        return view('user.healthstaff.report', compact('org_statistics'));

    }
    public function public(){
   
        //get statistics of business of staff
        $statistics = new HealthOrgStatistic;
        $org_statistics = $statistics->getAllOrgStatistic();

        return view('user.statistics', compact('org_statistics'));

    }

    public function getReportData($getAddress = NULL){
        //get patients which are positive
        $testresult = new TestResult;
        $test_result_data = $testresult->getInfected();

        //store positive id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));

        $checkin = new CheckIn;
        //get number of people which visited each address
        $checkin_data = $checkin->getPeopleVisitedAddress($getAddress);
   
        //get areas where infected users have visited
        $positive_data = $checkin->getPositiveVisitedAddress($getUserID, $getAddress);
      
        //get the last check_in of user in location
        $last_checkin_data = $checkin->getLastCheckInDate($getAddress);
    
        //merge the first two arrays; positive_data and checkin_data
        $merge_data = $this->custom_array_merge($positive_data->toArray(), $checkin_data->toArray());
        //get final report data with last check_in      
        $report_data =  $this->custom_array_merge($merge_data, $last_checkin_data->toArray());

        //report data based on positive cases
        $positive_sorted = array(); 
        foreach ($report_data as $data) {
            $positive_sorted[] = $data['positive'];
        }

        array_multisort($positive_sorted, SORT_DESC, $report_data);
        return $report_data;
    }

    //function to merge array by address
    public function custom_array_merge($array1, $array2) {
        $result = Array();
        foreach ($array1 as $key_1 => &$value_1) {
            foreach ($array2 as $key_1 => $value_2) {
                //merge by business_address_id
                if($value_1['business_address_id'] ==  $value_2['business_address_id']) {
                    $result[] = array_merge($value_1,$value_2);
                }
            }
        }
        return $result;
    }
}
