<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Business extends Authenticatable
{
    use HasFactory, Notifiable;

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
