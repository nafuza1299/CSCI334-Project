<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Alert;

class AlertsController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $alert_data = Alert::where('user_id', $userid)
                            ->orderByDesc('created_at')
                            ->take(10)
                            ->get();
        

        return view('alerts', compact('alert_data'));
    }
}
