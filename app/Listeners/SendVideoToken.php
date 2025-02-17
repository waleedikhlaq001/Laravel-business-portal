<?php

namespace App\Listeners;

use App\Events\FinalMileStonePaymentMade;
use App\Models\Job;
use App\Models\Token;
use App\Notifications\JobUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendVideoToken
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
     * @param  FinalMileStonePaymentMade  $event
     * @return void
     */
    public function handle(FinalMileStonePaymentMade $event)
    {
        $job = Job::find($event->jobId);
        $tk = Str::random(64);
        $token = new Token();
        $token->token = $tk;
        $token->email = $job->vendor->user->email;
        $token->save();

        $details = [
            'token' => $tk,
            'user' => $job->vendor->user->last_name . ' ' . $job->vendor->user->last_name,
            'message' => 'Creative has uploaded content for your job, procceed to watch'
        ];
        $job->user->notify(new JobUpdate($details));
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\FinalMileStonePaymentMade  $event
     * @param  \Throwable  $exception
     * @return void
     */

    public function failed(FinalMileStonePaymentMade $event, $exception)
    {
        Log::error("Failed to send video upload information to vendor for job", ["JobId" => $event->jobId, "error" => $exception->getMessage()]);
    }
}