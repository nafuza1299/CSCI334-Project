<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateTestResultEvent;
use App\Notifications\Alerts;
use App\Models\CheckIn;
use App\Models\User;

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
            $to = date('Y-m-d H:i:s', strtotime($user->test_date));
            $from = date('Y-m-d H:i:s', strtotime('-14 day', strtotime($to)));

            //gather all the infected user's check-in data
            $checkin_data_user = CheckIn::where('user_id', $user_id)
                                ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                                ->whereBetween('check_in_time', [$from, $to])
                                ->get()
                                ->toArray();
            //gather the lat/lon for every places they visited
            $getCoord = array_filter(array_map(function($data) { return array($data['latitude'], $data['longitude'] ); }, $checkin_data_user));
            //check closes location of user's
            $user_notified = array_unique([]);
            foreach($getCoord as $coordinates)
            {
                // query to get closest distance based on haversine
                $result = CheckIn::query()
                    ->leftJoin('business_addresses', 'check_in.business_address_id', '=', 'business_addresses.id')
                    ->whereRaw('(2 * asin(sqrt(power(sin((radians(latitude) - radians('.$coordinates[0].')) / 2),2 ) + cos(radians('.$coordinates[0].')) * cos(radians(latitude)) * power(sin((radians(longitude) - radians('.$coordinates[1].')) / 2), 2) ) )) * 6731 <= 5')
                    ->where('user_id', '!=', $user_id)
                    ->get();

                $getUserID = array_filter(array_map(function($data) { return array($data['user_id'], $data['address']); }, $result->toArray()));
                
                foreach($getUserID as $id){
                    array_push($user_notified, $id);
                }
            }   
            $msg_type = "Contact Tracing";
            foreach($user_notified as $data){
                $user = User::findOrFail($data[0]);
                $message = "You have been around who has COVID-19. Location of contact: ".$data[1];
                $user->notify(new Alerts($message, $msg_type));
            }
        }
    }
}
