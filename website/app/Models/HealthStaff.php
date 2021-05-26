<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class HealthStaff extends Model
{
    use HasFactory;
    use CrudTrait;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'position',
        'business_id',
        'health_org_email',
    ];
    protected $table = 'health_staffs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    //gets all staff belonging to specific health org.
    public function getAllIDinOrg($getHealthOrgId){
        return $this->select("user_id")
                    ->where("business_id", $getHealthOrgId)
                    ->get()
                    ->toArray();
    }
    //get all existing health staff
    public function getAllStaff(){
        $StaffID = $this->select("user_id")->get()->toArray();
        $getStaffID = array_filter(array_map(function($data) { return $data['user_id']; }, $StaffID));
        return $getStaffID;
    }
    //get health staff's org's ID
    public function getHealthStaffID($staff_id){
        return $this->where('user_id', $staff_id)
                    ->select('business_id')
                    ->first();
    }
    //get health staff info
    public function getHealthStaffInfo($userid){
        return $this->where('user_id', $userid)
                    ->leftJoin('businesses', 'health_staffs.business_id', '=', 'businesses.id')
                    ->get();
    }
    //update health staff info
    public function updateHealthStaffInfo($user, $request){
        return $this->where('user_id', $user)
                    ->update(['position' => $request->position, 'health_org_email' => $request->health_org_email]);
    }
   
}
