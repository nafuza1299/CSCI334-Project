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
                  ->select('check_in.business_address_id', 'address', 'longitude','latitude', $this->raw('count(user_id) as visited'))
                  ->groupBy('check_in.business_address_id', 'address', 'longitude', 'latitude')
                  ->orderByDesc('visited');
      if($getAddress != NULL){
         $people_visited->whereIn('business_address_id', $getAddress);
      }
      return $people_visited->get();       
   }
   //get number of people positive in each business address
   public function getPositiveVisitedAddress($getUserID = NULL, $getAddress = NULL){
      //if positive paitients is null, return 0 for count
      $infected_visited = $this->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('check_in.business_address_id','address', 'longitude', 'latitude', $this->raw('0 as positive'))
                  ->groupBy('check_in.business_address_id', 'address', 'longitude', 'latitude')
                  ->orderByDesc('positive');

      if($getAddress != NULL){
         $infected_visited->whereIn('business_address_id', $getAddress);
      }
      //if positive patient exists return count
      elseif($getUserID != NULL){
         $infected_visited->whereIn('user_id', $getUserID)
                  ->select('check_in.business_address_id','address', 'longitude', 'latitude', $this->raw('count(distinct(user_id)) as positive'))
                  ->orderByDesc('positive');
      }

      return $infected_visited->get();  
   }
   //get last check in date of each business's address
   public function getLastCheckInDate($getAddress = NULL){
      $date = $this->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->select('business_address_id','address', 'longitude', 'latitude', $this->raw('max(check_in_time) as last_check'))
                  ->groupBy('business_address_id', 'address', 'longitude', 'latitude')
                  ->orderByDesc('last_check');

   if($getAddress != NULL){
         $date->whereIn('business_address_id', $getAddress);
      }
      return $date->get(); 
   }
   //get address between time period
   public function getAddressBetweenTime($user_id, $from, $to){
      return $this->where('user_id', $user_id)
                  ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->whereBetween('check_in_time', [$from, $to])
                  ->get()
                  ->toArray();
   }
   public function IDbyHaversine($user_id, $latitude, $longitude){
      return $this->query()
                  ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                  ->whereRaw('(2 * asin(sqrt(power(sin((radians(latitude) - radians('.$latitude.')) / 2),2 ) + cos(radians('.$latitude.')) * cos(radians(latitude)) * power(sin((radians(longitude) - radians('.$longitude.')) / 2), 2) ) )) * 6731 <= 5')
                  ->where('user_id', '!=', $user_id)
                  ->get();
   }
}
