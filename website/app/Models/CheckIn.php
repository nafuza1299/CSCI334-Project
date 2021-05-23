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
      ->select('address', 'longitude', 'latitude', CheckIn::raw('count(distinct(user_id)) as total'))
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
   
}
