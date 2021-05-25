<?php

namespace App\Http\Controllers;

use App\Http\Requests\HealthStatisticRequest;

class HealthStatisticsController extends Controller
{
    // function used to show the health-statistic page
    public function index()
    {
        // check if there is a healthorgstatistic model for the user if not create one
        $statistic = app("HealthOrgStatistic")->firstOrCreate(['business_id' => auth()->guard('business')->id()]);
        
        return view('organization.health.health-statistic', compact('statistic'));
    }

    // function used to store changes to the healthorgstatisticmodel
    public function store(HealthStatisticRequest $request)
    {
        //save statistics
        app("HealthOrgStatistic")->saveStatistic($request, auth()->guard('business')->id());
        
        return redirect(route('business.healthorg.statistics'));
    }

}
