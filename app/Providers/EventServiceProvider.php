<?php

namespace App\Providers;
use App\Events\FinalMileStonePaymentMade;
use App\Events\VerifyOrderPayment;
use App\Listeners\SendVideoToken;
use App\Listeners\UpdateOrderPaymentStatus;
use App\Events\ApprovedJob;
use App\Listeners\ApprovedJobNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            'SocialiteProviders\\Instagram\\InstagramExtendSocialite@handle',
            'SocialiteProviders\\Twitter\\TwitterExtendSocialite@handle',
            'SocialiteProviders\\Facebook\\FacebookExtendSocialite@handle',
        ],
        FinalMileStonePaymentMade::class => [
            SendVideoToken::class
        ],
        VerifyOrderPayment::class => [
            UpdateOrderPaymentStatus::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            ApprovedJob::class,
            [ApprovedJobNotification::class, 'handle']
        );

        Event::listen(function (ApprovedJob $event) {
            dd($event);

            $details = [
                'user' => $job->vendor->user->last_name . ' ' . $job->vendor->user->last_name,
                'message' => 'Your Job has been approved!'
            ];

            $job->user->notify(new JobUpdate($details));
        });
    }
}
