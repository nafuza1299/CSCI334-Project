<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\Alerts;

class AlertsController extends Controller
{

    public function index()
    {
        foreach(Auth::user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
       return view('alerts');
    }
    
    public function createAlert()
    {
        $user = Auth::user();
        //$user = User::findorFail(2);
        $message = "test 3resrew343423 message";
        $msg_type = "Covid 19 Update";
        $user->notify(new Alerts($message, $msg_type));
    }
}
