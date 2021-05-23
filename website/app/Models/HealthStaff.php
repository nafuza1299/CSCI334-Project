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
        'business',
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
}
