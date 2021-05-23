<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Models\HealthOrgStatistic;
use App\Http\Requests\HealthStatisticRequest;
class HealthStatisticsController extends Controller
{
    // function used to show the health-statistic page
    public function index()
    {
        // return view('overview', compact());
        $user = Auth::guard('business')->user();

        // check if there is a healthorgstatistic model for the user if not create one
        $statistic = HealthOrgStatistic::firstOrCreate(['business_id' => $user->id]);
        
        return view('organization.health.health-statistic', compact('statistic'));
    }

    // function used to store changes to the healthorgstatisticmodel
    public function store(HealthStatisticRequest $request)
    {
        $user = Auth::guard('business')->id(); 
        $healthstatistic = new HealthOrgStatistic;
        $healthstatistic->saveStatistic($request, $user);
        
        return redirect(route('business.healthorg.statistics'));
    }

}
