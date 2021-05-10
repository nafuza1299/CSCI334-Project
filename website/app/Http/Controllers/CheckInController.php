<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CheckIn;

class CheckInController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $checkin_data = CheckIn::where('user_id', $userid)
                            ->orderByDesc('check_in_time')
                            ->take(10)
                            ->get();
                    // return view('overview', compact());

        return view('user.history', compact('checkin_data'));
    }
}
