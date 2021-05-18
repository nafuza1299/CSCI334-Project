<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Models\HealthOrgStatistic;

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
    public function store(Request $request)
    {
        $request->validate([
            'infected' => 'required|numeric|integer|min:0',
            'recovered' => 'required|numeric|integer|min:0',
            'deaths' => 'required|numeric|integer|min:0',
        ]);

        $user = Auth::guard('business')->user();

        $statistic = HealthOrgStatistic::where('business_id', $user->id)->first();
        $statistic->infected = $request->infected;
        $statistic->recovered = $request->recovered;
        $statistic->deaths = $request->deaths;
        $statistic->save();

        return redirect(route('business.healthorg.statistics'));
    }

}
