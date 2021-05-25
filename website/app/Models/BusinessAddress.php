<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BusinessAddress extends Authenticatable
{
    use HasFactory;
    protected $table = 'business_addresses';
    public $timestamps = false;
    protected $fillable = [
        'business_id',
        'address',
        'latitude',
        'longitude',
    ];
    //check business address ID exists
    public function checkBusinessAddressID($id){
        return $this->where('id', $id)
                    ->select('id')
                    ->first();
    }
    //get list of business's address
    public function getBusinessAddress($userid){
        return $this->where('business_id', $userid)
                    ->orderByDesc('address')
                    ->get();
    }
    //get business address ID
    public function getSelectedAddress($userid, $request){
        return $this->where('business_id', $userid)
                    ->where('id', $request->id)
                    ->get();
    }
    //update business address
    public function updateAddress($user, $request){
        return $this->where('business_id', $user)
                    ->where('id', $request->id)
                    ->update([
                    'address' => $request->address, 
                    'longitude' => $request->longitude, 
                    'latitude' => $request->latitude]);

    }
    //create business address
    public function createAddress($user, $request){
        return $this->create([
                    'business_id' => $user,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'address' => $request->address,
                ]);
    }
    //deletes business address
    public function deleteAddress($user, $request){
        return $this->where('business_id', $user)
                    ->where('id', $request->id)
                    ->delete();
    }
    //get number of people which visited each of the business's address
    public function getPeopleVisitedAddress($id = NULL){
        $people_visited = $this->leftJoin('check_in', 'business_addresses.id', '=', 'check_in.business_address_id' )
                    ->select('business_addresses.id', 'address', 'longitude','latitude', $this->raw('count(check_in.user_id) as visited'))
                    ->groupBy('business_addresses.id', 'address', 'longitude', 'latitude')
                    ->orderByDesc('visited');
        //if business id exists, get address belonging to that business only
        if($id != NULL){
            $people_visited->where('business_id', $id);
        }
        return $people_visited->get();       
    }
    //get number of people positive in each business address
    public function getPositiveVisitedAddress($getUserID = NULL, $id = NULL){
        //get all visited patients
        $people_visited = $this->leftJoin('check_in', 'business_addresses.id', '=', 'check_in.business_address_id' )
                ->select('business_addresses.id','address', 'longitude', 'latitude', $this->raw('0 as positive'))
                ->groupBy('business_addresses.id', 'address', 'longitude', 'latitude');
        
        //if business id exists, get address belonging to that business only
        if($id != NULL){
            $people_visited->where('business_id', $id);
        }
        //ids that are infected, and then exclude from total
        if($getUserID != NULL){
            $infected_visited = $this->leftJoin('check_in', 'business_addresses.id', '=', 'check_in.business_address_id' )
                    ->whereIn('check_in.user_id', $getUserID)
                    ->select('business_addresses.id','address', 'longitude', 'latitude', $this->raw('count(distinct(check_in.user_id)) as positive'))
                    ->groupBy('business_addresses.id', 'address', 'longitude', 'latitude')
                    ->orderbyDesc('positive');

            if($id != NULL){
                $infected_visited->where('business_id', $id);
            }
            $infected = $infected_visited->get()->toArray();
            //exclude infected patients from overall
            $IDinfected = array_filter(array_map(function($data) { return $data['id']; }, $infected));
            $notInfected = $people_visited->whereNotIn("business_addresses.id", $IDinfected)
                                        ->get()
                                        ->toArray();
            //merge negative and positive patients
            $people_visited = array_merge($infected, $notInfected);
        }
        return $people_visited;  
    }
     //get last check in date of each business's address
    public function getLastCheckInDate($id = NULL){
        $date = $this->leftJoin('check_in', 'business_addresses.id', '=', 'check_in.business_address_id' )
                ->select('business_addresses.id','address', 'longitude', 'latitude', $this->raw('max(check_in_time) as last_check'))
                ->groupBy('business_addresses.id', 'address', 'longitude', 'latitude')
                ->orderByDesc('last_check');
        if($id != NULL){
            $date->where('business_id', $id);
        }
        return $date->get(); 
    }
}
