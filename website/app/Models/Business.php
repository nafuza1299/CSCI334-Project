<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_number',
        'type',
        'verified',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
