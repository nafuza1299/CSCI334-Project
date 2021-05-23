<?php

namespace App\Http\Controllers;

use App\Models\TestResult;

class TestResultController extends Controller
{
    public function index()
    {
        //get test result of user
        $testresult = new TestResult;
        $test_results_data = $testresult->getTestResult(auth()->id());

        return view('user.test-results', compact('test_results_data'));
    }
}

