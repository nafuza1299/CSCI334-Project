<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use CrudTrait; 
    use HasRoles; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'date_of_birth',
        'suspended',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function testresult()
    {
        return $this->hasMany(TestResult::class);
    }
    //get user ids from public which are not health staff
    public function getPublicIDnotStaff($getStaffID){
         return $this->select("id")
                    ->whereNotIn('id', $getStaffID)
                    ->get();
    }
    //update user entry
    public function updateUserInfo($user, $request){
        return $this->where('id', $user)
                    ->update([
                        'email' => $request->email, 
                        'first_name' => $request->first_name, 
                        'last_name'=> $request->last_name,
                        'address' => $request->address,
                        'phone_number' => $request->phone_number,
                        'date_of_birth' => $request->date_of_birth,
                    ]);
    }
}
