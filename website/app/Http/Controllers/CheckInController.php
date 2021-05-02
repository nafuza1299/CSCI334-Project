<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\QRCode;

class CheckInController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $checkin_data = QRCode::where('user_id', $userid)
                            ->orderByDesc('check_in_time')
                            ->take(10)
                            ->get();
        
        return view('history', ['checkin_data' => $checkin_data]);
    }
}
