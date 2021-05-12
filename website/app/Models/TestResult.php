<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class TestResult extends Model
{
    use HasFactory;
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
}
