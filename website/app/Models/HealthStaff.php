<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class HealthStaff extends Model
{
    use HasFactory;
    use CrudTrait;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'position',
        'business',
        'health_org_email',
    ];
    protected $table = 'health_staffs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
