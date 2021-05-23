<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthOrgStatistic extends Model
{
    use HasFactory;
    protected $table = 'health_org_statistics';
    public $timestamps = false;
    protected $fillable = [
        'business_id',
        'infected',
        'recovered',
        'deaths',
    ];
    public function saveStatistic($request, $user){
       return $this->where('business_id', $user)
                    ->update([
                        'infected' => $request->infected, 
                        'recovered' => $request->recovered, 
                        'deaths' => $request->deaths
                    ]);
    }
}
