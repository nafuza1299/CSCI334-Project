<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TestResult;

class TestResultController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $test_results_data = TestResult::where('user_id', $userid)
                            ->orderByDesc('test_date')
                            ->take(10)
                            ->get();
                    // return view('overview', compact());

        return view('user.test-results', compact('test_results_data'));
    }
}
