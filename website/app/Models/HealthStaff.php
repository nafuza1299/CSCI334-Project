<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'position',
        'business',
        'health_org_email',
    ];
    protected $table = 'health_staffs';
}
