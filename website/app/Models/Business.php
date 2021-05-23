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
    use CrudTrait; 

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_number',
        'type',
        'verified',
        'password',
        'suspended',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function addresses()
    {
        return $this->hasMany(BusinessAddress::class);
    }
    //get businesses which are not health orgs
    public function getBusinessNotHealth(){
        return $this->select("id")
        ->where('type', '!=', 'Health')
        ->get();
    }
}
