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

    public function getCheckIn($userid)
    {
       return $this->where('user_id', $userid)
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->orderByDesc('check_in_time')
                    ->take(10)
                    ->get();
    }
    public function getLastCheckIn($userid){
       return $this->where('user_id', $userid)
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->orderByDesc('check_in_time')
                    ->take(1)
                    ->first();
    }
}
