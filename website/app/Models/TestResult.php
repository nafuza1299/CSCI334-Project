<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Events\UpdateInfectStatusEvent;
use App\Events\UpdateTestResultEvent;
use Illuminate\Notifications\Notifiable;

class TestResult extends Model
{
    use HasFactory, Notifiable;
    use CrudTrait;
    protected $table = 'testresults';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'test_date',
        'business_address_id',
        'infected',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function BusinessAddress()
    {
        return $this->belongsTo(BusinessAddress::class);
    }
    //get last test result of user
    public function getLastResult($userid){
        return $this->where('user_id', $userid)
                    ->leftJoin('business_addresses', 'testresults.business_address_id', '=', 'business_addresses.id')
                    ->orderByDesc('testresults.created_at')
                    ->take(1)
                    ->first();
    }

    protected $dispatchesEvents = [
        'updated' => UpdateInfectStatusEvent::class, 
        'created' => UpdateInfectStatusEvent::class, 
        'updated' => UpdateTestResultEvent::class,
        'created' => UpdateTestResultEvent::class,
    ];
}
