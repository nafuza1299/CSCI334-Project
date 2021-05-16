<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateTestResultEvent;
use App\Notifications\Alerts;
use App\Models\User;

class AlertTestResultListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateTestResultEvent $event)
    {
        $user = $event->user;
        $user_id = $event->user->user_id;
        $user = User::findOrFail($user_id);
        $msg_type = "Test Result";
        $message = "Your test results have arrived. You can view it in the Test Results page";
        $user->notify(new Alerts($message, $msg_type));
    }
}
