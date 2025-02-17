<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageSent;
use App\Models\User;
use App\Models\Influencer;
use App\Models\Notification;
use App\Models\GeneralNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getUserNotifications(Request $request)
    {
        $notifications = [];
        $user = User::find($request->user);
        $notis = Notification::where('receiver', $request->user)->orderBy('created_at', 'asc')->get();
        $unread = Notification::where('receiver', $request->user)->where('status', 0)->get();
        $general = GeneralNotification::where('receivers', $user->role)->orderBy('created_at', 'asc')->get();
        foreach($notis as $not){
            $not['senderObject'] = User::find($not->sender);
            $not['about'] = 'individual';
            $date = date('dS M, Y, h:i', strtotime($not->created_at));
            $not['date'] = $date;
            array_push($notifications, $not);
        }

        foreach($general as $gen){
            $gen['about'] = 'general';
            $gen['senderObject'] = '';
            $date = date('dS M, Y, h:i',  strtotime($gen->created_at));
            $gen['date'] = $date;
            array_push($notifications, $gen);
        }

        $count = count($unread);



        return ['notifications'=>array_reverse($notifications), 'count'=>$count];
        
        
    }
    
    public function markUserNotifications(Request $request)
    {
        $user = User::find($request->user);
        

        $notis = Notification::where('receiver', $request->user)->get();
        foreach($notis as $not){
            $not['status'] = 1;
            $not->save();
        }


        return $notis;
        
        
    }

    

}
