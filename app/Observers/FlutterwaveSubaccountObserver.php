<?php

namespace App\Observers;

use App\Models\FlutterwaveSubaccount;

class FlutterwaveSubaccountObserver
{
    /**
     * Handle the FlutterwaveSubaccount "created" event.
     *
     * @param  \App\Models\FlutterwaveSubaccount  $flutterwaveSubaccount
     * @return void
     */
    public function created(FlutterwaveSubaccount $flutterwaveSubaccount)
    {
        //email user of the addition of a subaccount

    }

    /**
     * Handle the FlutterwaveSubaccount "updated" event.
     *
     * @param  \App\Models\FlutterwaveSubaccount  $flutterwaveSubaccount
     * @return void
     */
    public function updated(FlutterwaveSubaccount $flutterwaveSubaccount)
    {
        //email user of the update of a subaccount
    }

    /**
     * Handle the FlutterwaveSubaccount "deleted" event.
     *
     * @param  \App\Models\FlutterwaveSubaccount  $flutterwaveSubaccount
     * @return void
     */
    public function deleted(FlutterwaveSubaccount $flutterwaveSubaccount)
    {
        //email user of the deletion of a subaccount
    }

    /**
     * Handle the FlutterwaveSubaccount "restored" event.
     *
     * @param  \App\Models\FlutterwaveSubaccount  $flutterwaveSubaccount
     * @return void
     */
    public function restored(FlutterwaveSubaccount $flutterwaveSubaccount)
    {
        //email user of the restoration of a subaccount
    }

    /**
     * Handle the FlutterwaveSubaccount "force deleted" event.
     *
     * @param  \App\Models\FlutterwaveSubaccount  $flutterwaveSubaccount
     * @return void
     */
    public function forceDeleted(FlutterwaveSubaccount $flutterwaveSubaccount)
    {
        //email user of the forced deletion of a subaccount
    }
}
