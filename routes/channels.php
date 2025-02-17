<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function ($user) {
    if(Auth::check()){
        return ['id'=>$user->id, 'name'=>$user->name];
    }
});

Broadcast::channel('new-notification', function ($user) {
    if(Auth::check()){
        return ['id'=>$user->id, 'name'=>$user->name];
    }
});

Broadcast::channel('new-bid', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('new-dispute-msg', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('bid-accepted', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('wallet-updated', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});
Broadcast::channel('first-milestone', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('wallet-updated2', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('new-content', function ($user) {
    if(Auth::check()){
        return ["id"=>$user->id];
    }
});

Broadcast::channel('new-general-notification', function ($user) {
    if(Auth::check()){
        return ['id'=>$user->id, 'name'=>$user->name];
    }
});