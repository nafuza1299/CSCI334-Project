<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\TestResult;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->id();
        $last_checkin_data = CheckIn::where('user_id', $userid)
                            ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                            ->orderByDesc('check_in_time')
                            ->take(1)
                            ->first();

        $test_result = TestResult::where('user_id', $userid)
                            ->leftJoin('business_addresses', 'testresults.business_address_id', '=', 'business_addresses.id')
                            ->orderByDesc('testresults.created_at')
                            ->take(1)
                            ->first();
        return view('user.overview', compact('last_checkin_data', 'test_result'));
        
    }

    public function business()
    {
            // return view('overview', compact());
        return view('organization.overview');
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
