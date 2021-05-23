<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\HealthStaff;
use App\Notifications\Alerts;

class AlertsController extends Controller
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
        foreach(Auth::guard('business')->user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }

       return view('organization.alerts');
    }

    public function createAlert(Request $request)
    {  
        $request->validate([
            'message' => 'required|string|max:190',
        ]);
        $msg_type = "Health Org. Update";

        if($request->type == "Public"){
            AlertsController::createAlertPublic($msg_type, $request->message);
        }
        elseif($request->type == "Business"){
            AlertsController::createAlertBusiness($msg_type, $request->message);
        }
        elseif($request->type == "Staff"){
            AlertsController::createAlertStaff($msg_type, $request->message);
        }
        return redirect(route('business.alerts'));
    }

    public function createAlertBusiness($msg_type, $message)
    {
        // get business ID that is not a health org
        $business = new Business;
        $getBusinessID = $business->getBusinessNotHealth();
  
        //alert all Businesses
        foreach($getBusinessID as $data){
            $user = Business::findOrFail($data["id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
    public function createAlertPublic($msg_type, $message)
    {
        //get staff to exclude from user
        $healthstaff = new HealthStaff();
        $getStaffID = $healthstaff->getAllStaff();

        //get user ids from public which are not health staff
        $public = new User();
        $getPublicID = $public->getPublicIDnotStaff($getStaffID);
    
        //alert all public
        foreach($getPublicID as $data){
            $user = User::findOrFail($data["id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
    public function createAlertStaff($msg_type, $message)
    {
        //get staff IDs that belongs to the health organization
        $getHealthOrgId = Auth::guard('business')->id();
        $healthstaff = new HealthStaff();
        $getStaffID = $healthstaff->getAllIDinOrg($getHealthOrgId);

        //alert all health staff
        foreach($getStaffID as $data){
            $user = User::findOrFail($data["user_id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
}
