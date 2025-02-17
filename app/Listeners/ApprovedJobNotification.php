<?php

namespace App\Listeners;

use App\Events\ApprovedJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApprovedJobNotification
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
     * @param  \App\Events\ApprovedJob  $event
     * @return void
     */
    public function handle(ApprovedJob $event)
    {

        dd($event);

        $details = [
            'user' => $job->vendor->user->last_name . ' ' . $job->vendor->user->last_name,
            'message' => 'Your Job has been approved!'
        ];

        $job->user->notify(new JobUpdate($details));
    }
}
