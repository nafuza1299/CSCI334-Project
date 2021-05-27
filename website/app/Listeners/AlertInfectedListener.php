<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateTestResultEvent;
use App\Notifications\Alerts;

class AlertInfectedListener
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
        // dd('from UpdateInfectStatusEvent ', $event->user);
        $user = $event->user;
        $user_id = $event->user->user_id;
        if($user->infected){
            //get Test date and date two weeks prior test date
           if(gettype($user->test_date) == "string"){
                $to = date('Y-m-d H:i:s', strtotime($user->test_date));
           }
           else{
            $to = date('Y-m-d H:i:s', strtotime(date_format($user->test_date, "Y-m-d H:i:s")));
           }
            $from = date('Y-m-d H:i:s', strtotime('-14 day', strtotime($to)));

            //gather all the infected user's check-in data
            $checkin_data_user = app("CheckIn")->getAddressBetweenTime($user_id, $from, $to);
            
            //gather the lat/lon for every places they visited
            $getCoord = array_filter(array_map(function($data) { return array($data['latitude'], $data['longitude'] ); }, $checkin_data_user));
            
            //check closes location of user's
            $user_notified = array_unique([]);
            foreach($getCoord as $coordinates)
            {
                // query to get closest distance based on haversine
                $result = app("CheckIn")->IDbyHaversine($user_id, $coordinates[0], $coordinates[1]);

                $getUserID = array_filter(array_map(function($data) { return array($data['user_id'], $data['address']); }, $result->toArray()));
                
                foreach($getUserID as $id){
                    array_push($user_notified, $id);
                }
            }   
            $msg_type = "Contact Tracing";
            foreach($user_notified as $data){
                $user = app("User")->findOrFail($data[0]);
                $message = "You have been around who has COVID-19. Location of contact: ".$data[1];
                $user->notify(new Alerts($message, $msg_type));
            }
        }
    }
}
