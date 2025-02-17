<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Chat;
use App\Models\Bid;
use App\Models\Job;
use App\Models\Vendor;
use App\Events\NewMessageSent;
use App\Events\NewNotification;
use App\Models\User;
use App\Models\Influencer;
use App\Models\Notification;
use App\Models\Milestone;
use Illuminate\Support\Facades\Auth;
use JamesMills\LaravelTimezone\Facades\Timezone;

class ChatController extends Controller
{
    public function getIndividualChatsVendor(Request $request)
    {

        $unread_chats = Chat::where('bid_id', $request->bid)->where('status', 0)->get();

        foreach($unread_chats as $unread){
            $unread->status = 1;
            $unread->save();
        }


        $bid = Bid::find($request->bid);
        $influencer = User::find($bid->influencer_id);
        $job = Job::find($bid->job_id);
        $vend = Vendor::find($job->vendor_id);
        $vendor = User::find($vend->user_id);
        $chats = Chat::where('bid_id', $request->bid)->get();

        $milestone = Milestone::where('job_id', $job->id)->where(['completed' => '1', 'paid'=> '0'])->first();

        $currency = $job->currency->symbol;

        if($milestone){

            $milestone['currency'] = $currency;
        }

        foreach($chats as $chat){
            $datetime = $chat['created_at'];
            // $time = Timezone::convertToLocal($datetime, 'D, h:m', true);
            $time = date('D, h:m', strtotime($datetime));
            $chat['time'] = $time;
        }



        return ['chats'=>$chats, 'job'=>$job, 'vendor'=>$vendor,  'influencer'=>$influencer, 'bid'=>$bid, 'milestone'=>$milestone];
    }

    public function getIndividualChatsInfluencer(Request $request)
    {
        $bid = Bid::find($request->bid);
        $influencer = Vendor::find($bid->influencer_id);
        $job = Job::find($bid->job_id);
        $vendor = User::find($job->vendor_id);
        $chats = Chat::where('bid_id', $request->bid)->get();
        return ['chats'=>$chats, 'job'=>$job,'influencer'=> $influencer, 'bid'=>$bid];
    }


    public function getChats(Request $request)
    {
        $uid = User::find($request->user)->id;
        $all_chats = [];
        $latest = [];
        $chats = Chat::orderBy('created_at', 'desc')->where('sender', $uid)->orWhere('receiver', $uid)->where('job_status', 1)->get()->groupBy(function($val){
            return $val->bid_id;
        });


        foreach($chats as $key=>$chat){
            $latest_chat = ['bid'=>$key, 'chat'=>$chat[0]];
            array_push($latest, $latest_chat);

        }


        // $count = count($latest_chat);

        foreach($latest as $data){

            if($data['chat']['sender'] == $request->user){
                $datetime = $data['chat']['created_at'];
                $time = date('D, h:m', strtotime($datetime));

                // $time = Timezone::convertToLocal($datetime, 'D, h:m', true);

                $bid = Bid::find($data['bid']);
                $job_name = $bid->job->name;
                $sent_chats = ['chat'=>$data['chat'],  'job_name'=>$job_name, 'time'=>$time, 'sender'=>'user', 'receiver'=>User::find($data['chat']['receiver']), 'bid'=>Bid::find($data['chat']['bid_id']), 'job'=>Job::find($data['chat']['job_id'])];
                array_push($all_chats, $sent_chats);

            }else{
                $datetime = $data['chat']['created_at'];
                $time = date('D, h:m', strtotime($datetime));
                // $time = Timezone::convertToLocal($datetime, 'D, h:m', true);


                $bid = Bid::find($data['bid']);
                $job_name = $bid->job->name;

                $received_chats = ['chat'=>$data['chat'], 'job_name'=>$job_name, 'time'=>$time, 'sender'=> User::find($data['chat']['sender']), 'receiver'=>'user', 'bid'=>Bid::find($data['chat']['bid_id']), 'job'=>Job::find($data['chat']['job_id'])];
                array_push($all_chats, $received_chats);

            }
        }

        return $all_chats;
    }




    public function chatStore(Request $request)
    {

        $chat = new Chat;
        $chat->bid_id = $request->bid;

        $user =  User::find($request->user);

        $bid= Bid::find($request->bid);
        $job_vendor = Job::find($bid->job_id)->vendor_id;
        $vendor_id = Vendor::find($job_vendor)->user_id;
        $vendor = User::find($vendor_id);

        $chat->sender = $user->id;

        if($user->role == 'vendor'){
            $chat->receiver = $request->inf;
        }else{
            $chat->receiver = $vendor->id;
        }
        $chat->job_id = $request->job;
        $chat->job_status = '1';
        $chat->message = $request->message;
        $chat->save();

        // $time = date('D, h:m', strtotime($chat->created_at));
        // $chat['time'] = $time;

        //create new notification

        $noti = new Notification;
        $noti->sender = $user->id;
        $noti->receiver = $chat->receiver;
        $noti->type = 'chat';
        $noti->type_id = $chat->id;
        $noti->message = $request->message;
        $noti->save();

        //broadcast event here;
        broadcast(new NewMessageSent($user, $chat))->toOthers();
        broadcast(new NewNotification($user, $noti))->toOthers();

        return $chat;
    }


}


class SavedChat
{
    public $id;
}
