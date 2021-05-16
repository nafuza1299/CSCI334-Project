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
        'location',
        'infected',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'updated' => UpdateInfectStatusEvent::class, 
        'created' => UpdateInfectStatusEvent::class, 
        'updated' => UpdateTestResultEvent::class,
        'created' => UpdateTestResultEvent::class,
     
    ];
}
