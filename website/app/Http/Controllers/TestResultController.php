<?php

namespace App\Http\Controllers;

use App\Models\TestResult;

class TestResultController extends Controller
{
    public function index()
    {
        //get test result of user
        $test_results_data = app("TestResult")->getTestResult(auth()->id());

        return view('user.test-results', compact('test_results_data'));
    }
}

