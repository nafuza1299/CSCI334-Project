<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;
    protected $table = 'check_in';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'business_address_id',
    ];
    //get user's last ten check in
    public function getCheckIn($userid)
    {
       return $this->where('user_id', $userid)
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->orderByDesc('check_in_time')
                    ->take(10)
                    ->get();
    }
    //get the last check in data for users
    public function getLastCheckIn($userid){
       return $this->where('user_id', $userid)
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->orderByDesc('check_in_time')
                    ->take(1)
                    ->first();
   }
   //get areas where infected users have visited
   public function getInfectedAreas($userid){
      return $this->whereIn('user_id', $userid)
                  ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('address', 'longitude', 'latitude', $this->raw('count(distinct(user_id)) as total'))
                  ->groupBy('address', 'longitude', 'latitude')
                  ->orderByDesc('total')
                  ->get();
   }
   //create check in
   public function createCheckIn($id, $request){
      return $this->create([
         'user_id' => $id,
         'business_address_id' => $request->business_address_id,
     ]);
   }
   //get number of people which visited each of the business's address
   public function getPeopleVisitedAddress($getAddress = NULL){
      $people_visited = $this->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('business_address_id', 'address', 'longitude','latitude', $this->raw('count((user_id)) as visited'))
                  ->groupBy('business_address_id', 'address', 'longitude', 'latitude');

      if(isset($getAddress)){
         $people_visited->whereIn('business_address_id', $getAddress);
      }
      return $people_visited->get();       
   }
   //get number of people positive in each business address
   public function getPositiveVisitedAddress($getUserID, $getAddress = NULL){
      $infected_visited = $this->whereIn('user_id', $getUserID)
                  ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('business_address_id','address', 'longitude', 'latitude', $this->raw('count(distinct(user_id)) as positive'))
                  ->groupBy('business_address_id', 'address', 'longitude', 'latitude');
      if(isset($getAddress)){
         $infected_visited->whereIn('business_address_id', $getAddress);
      }
      return $infected_visited->get();  
   }
   //get last check in date of each business's address
   public function getLastCheckInDate($getAddress = NULL){
      $date = $this->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('business_address_id','address', 'longitude', 'latitude', $this->raw('max((check_in_time)) as last_check'))
                  ->groupBy('business_address_id', 'address', 'longitude', 'latitude');
      if(isset($getAddress)){
         $date->whereIn('business_address_id', $getAddress);
      }
      return $date->get(); 
   }
}
