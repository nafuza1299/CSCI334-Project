<?php

namespace App\Http\Controllers;

use App\Models\HealthOrgStatistic;
use App\Http\Requests\HealthStatisticRequest;

class HealthStatisticsController extends Controller
{
    // function used to show the health-statistic page
    public function index()
    {
        // check if there is a healthorgstatistic model for the user if not create one
        $statistic = HealthOrgStatistic::firstOrCreate(['business_id' => auth()->guard('business')->id()]);
        
        return view('organization.health.health-statistic', compact('statistic'));
    }

    // function used to store changes to the healthorgstatisticmodel
    public function store(HealthStatisticRequest $request)
    {
        //save statistics
        $healthstatistic = new HealthOrgStatistic;
        $healthstatistic->saveStatistic($request, auth()->guard('business')->id());
        
        return redirect(route('business.healthorg.statistics'));
    }

}
