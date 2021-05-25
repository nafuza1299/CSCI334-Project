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
    //save statistics
    public function saveStatistic($request, $user){
       return $this->where('business_id', $user)
                    ->update([
                        'infected' => $request->infected, 
                        'recovered' => $request->recovered, 
                        'deaths' => $request->deaths
                    ]);
    }
    //get individual org's statistics
    public function getOrgStatistic($business_id){
        return $this->where('business_id', $business_id)
                     ->get();
    }
    //get sum of all org's statistics
    public function getAllOrgStatistic(){
        return $this->select($this->raw('
               sum(infected) as infect_total, 
                sum(deaths) as death_total, 
                sum(recovered) as recovered_total'))
        ->get();
    }
}
