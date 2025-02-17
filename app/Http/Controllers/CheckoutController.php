<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Str;
use DB;
use App\Models\OrderDetail;
use App\Events\VerifyOrderPayment;
use App\Notifications\Order1;
use App\Notifications\Order2;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout.index');
    }

    public function placeOrder(Request $request, Order $order, OrderDetail $detail)
    {
        $geo = currencyConverter($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required',
            'products' => 'required'
        ]);
        $order->amount = $request->amount;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->shipping_name = $request->name;
        $order->shipping_address = $request->address;
        $order->shipping_address_2 = $request->address;
        $order->shipping = $request->shipping;
        $order->state = $request->state;
        $order->zip = $request->postal_code;
        $order->quantity = count(json_decode($request->products));
        $order->country = $request->country;
        $order->user_id = auth()->user()->id;
        $order->tax = null;
        $order->shipped = 0; //pending
        $order->tracking_number = Str::random(12);
        $order->save();

        foreach (json_decode($request->products) as $product) {
            $detail->price = $product->price;
            $detail->name = $product->name;
            $detail->qty = 1;
            // $detail->qty = $product->quantity;
            // $detail->sku = $product['sku'];
            $detail->order_id = $order->id;
            $detail->product_id = $product->id;
            $detail->user_id = auth()->user()->id;
            $detail->save();
        }

        //trigger an event to confirm the order
        // \event(new VerifyOrderPayment($order));



        $data = [
            "message" => "Order recorded successfully",
            "Payload" => $request->all(),
            "status" => "success"
        ];
        return response()->json($data);
    }

    public function checkout(Request $request, Order $order, OrderDetail $detail)
    {
        Stripe::setApiKey('sk_test_51HfwjlJFbzmLaIp8qsxEpwMk0DGISX5MuAmnzO0wqXUATs8H4NW84AFUGU7XC2D7GjVnFCaWWLSc2v4pVFWf2FaZ008ljpp1z0');
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required',
            'products' => 'required'
        ]);
        if ($request->payment_method == 'stripe') {
            $charge = Charge::create([
                'amount' => $request->amount * 100, // amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for ' . $request->email,
            ]);
            $order->payment_id = $charge->id;
        }
        $order->amount = $request->amount;
        $order->email = $request->email;
        $order->phone = $request->phone || "";
        $order->shipping_name = $request->name;
        $order->shipping_address = $request->address;
        $order->payment_method = $request->payment_method;
        $order->state = $request->state;
        $order->state = $request->state;
        $order->zip = $request->postal_code;
        $order->quantity = count(json_decode($request->products));
        $order->country = $request->country;
        $order->user_id = auth()->user()->id;
        $order->tax = null;
        $order->shipped = 0; //pending
        $order->tracking_number = Str::random(12);
        $order->save();
        $ship_fee = 0;
        foreach (json_decode($request->products) as $product) {
            $ship_fee += $product->shipping;
            $vendor =   DB::table("vendors")->where("id", DB::table("products")->where("id", $product->id)->first()->vendor_id ?? "")->first();
            $detail->price = $product->price;
            $detail->name = $product->name;
            $detail->qty = $product->qty;
            // $detail->qty = $product->quantity;
            // $detail->sku = $product['sku'];
            $detail->order_id = $order->id;
            $detail->product_id = $product->id;
            $detail->user_id = auth()->user()->id;
            $detail->save();
            if ($vendor) {
                $user = User::where("id", $vendor->user_id)->first();
                $details2 = [
                    'user' => $user->last_name . ' ' . $user->first_name,
                    'message' => "Thank you for making your order",
                    "product_id" => $product->id,
                    "shipping" => number_format($product->shipping, 2),
                    "sub" => number_format($request->amount - $product->shipping, 2),
                    "total" => number_format($request->amount, 2),
                    "name" => $user->last_name . ' ' . $user->first_name,
                    "address" => $request->address,
                    "product" => $product

                ];
                // User::where("id", $user->id)->first()->notify(new Order2($details2));
                // User::where("id",$user->id)->first()->notify(new Order1($details2));
            }
        }

        //trigger an event to confirm the order
        // \event(new VerifyOrderPayment($order));


        $details2 = [
            'user' => auth()->user()->last_name . ' ' . auth()->user()->first_name,
            'message' => "Thank you for making your order",
            "order_id" => $order->id,
            "products" => json_decode($request->products),
            "shipping" => number_format($ship_fee, 2),
            "sub" => number_format($request->amount - $ship_fee, 2),
            "total" => number_format($request->amount, 2),
            "name" => auth()->user()->last_name . ' ' . auth()->user()->first_name,
            "address" => $request->address

        ];
        User::where("id", auth()->user()->id)->first()->notify(new Order1($details2));
        $data = [
            "message" => "Order Placed successfully",
            "id" => $order->id,
            "Payload" => $request->all(),
            "status" => "success"
        ];
        return response()->json($data);
    }

    public function sendOrderReciept()
    {
        //TODO:send an email for order reciept
    }
}
