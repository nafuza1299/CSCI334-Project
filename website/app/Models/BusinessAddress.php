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

}
