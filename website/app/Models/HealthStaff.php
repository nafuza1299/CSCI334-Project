<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'position',
        'health_org_email',
        'verified',
    ];
    protected $table = 'health_staffs';
}
