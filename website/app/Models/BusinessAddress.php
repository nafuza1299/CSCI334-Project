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
}
