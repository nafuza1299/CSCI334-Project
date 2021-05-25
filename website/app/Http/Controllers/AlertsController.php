<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlertsRequest;
use App\Notifications\Alerts;

class AlertsController extends Controller
{

    public function index()
    {
        //get all alerts for users
        foreach(auth()->user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
       return view('user.alerts');
    }

    public function business()
    {
        //get all users for businesses
        foreach(auth()->guard('business')->user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }

       return view('organization.alerts');
    }

    public function createAlert(AlertsRequest $request)
    {  
        $msg_type = "Health Org. Update";
        
        //check the type of user
        if($request->type == "Public"){
            $this->createAlertPublic($msg_type, $request->message);
        }
        elseif($request->type == "Business"){
            $this->createAlertBusiness($msg_type, $request->message);
        }
        elseif($request->type == "Staff"){
            $this->createAlertStaff($msg_type, $request->message);
        }
        return redirect(route('business.alerts'));
    }

    public function createAlertBusiness($msg_type, $message)
    {
        // get business ID that is not a health org
        $getBusinessID = app("Business")->getBusinessNotHealth();
  
        //alert all Businesses
        foreach($getBusinessID as $data){
            $user = app("Business")->findOrFail($data["id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
    public function createAlertPublic($msg_type, $message)
    {
        //get staff to exclude from user
        $getStaffID = app("HealthStaff")->getAllStaff();

        //get user ids from public which are not health staff
        $getPublicID = app("User")->getPublicIDnotStaff($getStaffID);

        //alert all public
        foreach($getPublicID as $data){
            $user = app("User")->findOrFail($data["id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
    public function createAlertStaff($msg_type, $message)
    {
        //get staff IDs that belongs to the health organization
        $getHealthOrgId = auth()->guard('business')->id();
        $getStaffID = app("HealthStaff")->getAllIDinOrg($getHealthOrgId);
        
        //alert all health staff
        foreach($getStaffID as $data){
            $user = app("User")->findOrFail($data["user_id"]);
            $user->notify(new Alerts($message, $msg_type));
        }
    }
}
