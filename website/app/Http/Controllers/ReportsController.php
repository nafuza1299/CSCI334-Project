<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessAddress;
use App\Models\HealthStaff;
use App\Models\CheckIn;

use App\Notifications\Alerts;

class ReportsController extends Controller
{

    public function index()
    {
        foreach(Auth::user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
       return view('user.alerts');
    }

    public function business()
    {
        //get list of all business addresss   
        $business_id = Auth::guard('business')->user()->id;
        $address_data = BusinessAddress::where('business_id', $business_id)
                                        ->select('address', 'latitude', 'longitude')
                                        ->get()
                                        ->toArray();

        $getAddress = array_filter(array_map(function($data) { return $data['address']; }, $address_data));
        $getLatitude = array_filter(array_map(function($data) { return $data['latitude']; }, $address_data));
        $getLongitude = array_filter(array_map(function($data) { return $data['longitude']; }, $address_data));
        
        $checkin_data = CheckIn::whereIn('address', $getAddress)
                        ->get();

        dd($checkin_data);
        // return view('overview', compact());

       return view('organization.business.report');
    }

   
}
