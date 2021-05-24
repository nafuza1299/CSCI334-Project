<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function business()
    {
        $report_data = $this->getReportData(auth()->guard('business')->id());
        return view('organization.report', compact('report_data'));
    }

    public function healthorg(){ 
        $report_data = $this->getReportData();
        return view('organization.report', compact('report_data'));
    }

    public function staff(){

        //get health staff's org ID
        $business_id = app("HealthStaff")->getHealthStaffID(auth()->id());

        //get statistics of business of staff
        $org_statistics = app("HealthOrgStatistic")->getOrgStatistic($business_id->business_id);
                                            
        return view('user.healthstaff.report', compact('org_statistics'));

    }
    public function public(){
   
        //get statistics of business of staff
        $org_statistics = app("HealthOrgStatistic")->getAllOrgStatistic();

        return view('user.statistics', compact('org_statistics'));

    }

    public function getReportData($id = NULL){
        //get patients which are positive
        $test_result_data = app("TestResult")->getInfected();

        //store positive id as an array after mapping
        $getUserID = array_filter(array_map(function($data) { return $data['user_id']; }, $test_result_data));

        //get number of people which visited each address
        $checkin_data = app("BusinessAddress")->getPeopleVisitedAddress($id);
        
        //get areas where infected users have visited
        $positive_data = app("BusinessAddress")->getPositiveVisitedAddress($getUserID, $id);
        //get the last check_in of user in location
        $last_checkin_data = app("BusinessAddress")->getLastCheckInDate($id);
    
        //merge the first two arrays; positive_data and checkin_data
        $merge_data = $this->custom_array_merge($positive_data, $checkin_data->toArray());

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
                if($value_1['id'] ==  $value_2['id']) {
                    $result[] = array_merge($value_1,$value_2);
                }
            }
        }
        return $result;
    }
}
