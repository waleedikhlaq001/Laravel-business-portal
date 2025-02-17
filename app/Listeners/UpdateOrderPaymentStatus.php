<?php

namespace App\Listeners;

use App\Events\VerifyOrderPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\OrderDetail;

class UpdateOrderPaymentStatus
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
     * @param  \App\Events\VerifyOrderPayment  $event
     * @return void
     */
    public function handle(VerifyOrderPayment $event)
    {
        $order = Order::find($event->orderId);
        $payment_status = "pending"; // or 0 for shipped.

        $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->get('https://api.flutterwave.com/v3/transactions/' . $order->reference);

        $response = json_decode($response->body());

        if ($response->data->status == 'successful') {
            $order->payment_status = $payment_status;
            $order->save();
        }
    }
}
