<?php

namespace App\Http\Controllers;

use App\Models\FlutterwaveSubaccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Currency;
use App\Models\Country;
use App\Models\StripeAccount;
use App\Notifications\PaymentMethodNotification;

class PaymentController extends Controller
{
    private $gateway = "Flutterwave";

    protected function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    protected function getGateway()
    {
        return $this->gateway;
    }

    public function indexAction(Request $request)
    {
        // dd(Auth::user()->id);
        // // dd($request);
        $isStripeVerified = false;
        if ($request->stripe == "verified") {
            //check if stripe account has been added for user_id
            //if so, display the modal you stripe account has been verified
            //else we are have trouble verifying your account.
            $isStripeVerified = (int) $this->checkStripeAccount();

            // return (int) $isStripeVerified;
        }

        //1. display available payment method based on country code.
        //2. display option to filter payment option based on current location.
        $user = User::where('id', Auth::user()->id)->first();
        $currency = Currency::where('id', $user->currency_id)->first();
        $country = Country::where('id', $user->country_id)->first();
        $response = Http::withToken("FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X")->get('https://api.flutterwave.com/v3/banks/NG');
        $data = json_decode($response);
        $banks = $data->data??[];
        usort($banks, function($a, $b) {
            return strcmp($a->name, $b->name);
        });
        // dd($banks);

        if (!is_null($user->country_id)) {
            $countryName = $country->name;
            $country_error = false;
        } else {
            $countryName = "";
            $country_error = true;
        }


        return view('pages.paymentmethod.index', compact('banks', 'countryName', 'country_error', 'isStripeVerified'));
    }

    private function checkStripeAccount()
    {
        $account = StripeAccount::where('user_id', Auth::user()->id)->first();
        // dd($account);
        if (!is_null($account)) {
            return true;
        }
        return false;
    }

    public function getPaymentmethods($code = null)
    {
        //get available payment method based on country code supplied.
        $code = (is_null($code)) ? "NGN" : $code;
        switch ($code) {
            case 'India':
                $data = ["RazorPay"];
                break;
            case 'United States':
                $data = ["Stripe"];
                break;
            default:
                $data = ["Flutterwave", "Paystack"];
                break;
        }
        return json_encode($data);
    }


    public function getPaymentDetails()
    {
        $subaccount = FlutterwaveSubaccount::where('user_id', Auth::user()->id)->get();
        // dd($subaccount);
        // if (is_null($subaccount)) {
        //     $subaccount = new FlutterwaveSubaccount;
        //     $subaccount->user_id = Auth::user()->id;
        //     $subaccount->save();
        // }

        if (is_null($subaccount)) {
            $data = [];
        } else {
            $data = [];
            foreach ($subaccount as $key => $value) {
                array_push($data, [
                    'id' => $value->id,
                    'type' => "PERSONAL",
                    'bank_name' => $value->bank_name,
                    'name' => $value->full_name,
                    'account' => $value->account_number,
                    'status' => 'Approved',
                    'isactive' => false,
                ]);
            }
        }


        return response()->json([
            'status' => 'success',
            'data' => $data,
            'ui' => Auth::user()->id
        ], 200);
    }

    public function resolveAccount(Request $request)
    {
        $payload = [
            "account_number" => $request->account_number,
            "account_bank" => $request->account_bank,
        ];

        $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->post('https://api.flutterwave.com/v3/accounts/resolve', $payload);
        return json_decode($response);
    }

    public function getPaymentLink(Request $request)
    {
        // dd($request->all());

        $subaccount = FlutterwaveSubaccount::where('user_id', $request->influencer_id)->first();

        $payment_method = "card,account,ussd,mpesa,qr,PayPal,credit,paga,mobilemoneytanzania,mobilemoneyzambia,mobilemoneyrwanda,mobilemoneytanzania,payattitude,barter";
        $payload = [
            "tx_ref" => "VICOMMA_" . uniqid() . '_' . time(),
            "amount" => $request->amount,
            "currency" => $request->currency,
            "payment_options" => $payment_method,
            "redirect_url" => "https://webhook.site/b0425eb6-f76a-4daf-ab1d-4cf4fd4f2eda",
            "subaccounts" => [
                [
                    "id" => $subaccount->subaccount_id,
                ]
            ],
            "meta" => [
                "vendor_id" => $request->vendor_id,
                "vendor_name" => $request->vendor_name,
            ],
            "customer" => [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            ],
            "customizations" => [
                "title" => "Payment for Job #" . $request->job_id,
                "description" => "Payment for Job #" . $request->job_id,
                "logo" => "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                "color" => "#2ecc71"
            ]
        ];

        // dd($payload);

        $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->post('https://api.flutterwave.com/v3/payments', $payload);
        $data = json_decode($response);

        // dd($data);
        $link = $data->data->link;

        return redirect($link);
    }

    public function escrowPaymentLink()
    {
    }

    public function deleteSubaccount(Request $request)
    {
        //delete from flutterwave
        $subaccount = FlutterwaveSubaccount::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        $flutterwave_id = $subaccount->flutterwave_id;
        $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->delete("https://api.flutterwave.com/v3/subaccounts/$flutterwave_id");
        $data = json_decode($response);
        //delete from database
        $subaccount = FlutterwaveSubaccount::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        $subaccount->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Subaccount deleted successfully'
        ], 200);
    }

    public function releaseEscrowPayment(Request $request)
    {
        $id = $request->id;
        // release escrow payment
        // https://api.ravepay.co/v2/gpx/transactions/escrow/settle

        $response = Http::post('https://api.ravepay.co/v2/gpx/transactions/escrow/settle', [
            'id' => $id,
            'secret_key' => env('FLUTTERWAVE_BEARER_TOKEN'),
        ]);
    }

    public function refundEscrowPayment(Request $request)
    {
        $id = $request->id;
        $comment = $request->comment;
        // release escrow payment
        // https://api.ravepay.co/v2/gpx/transactions/escrow/settle

        $response = Http::post('https://api.ravepay.co/v2/gpx/transactions/escrow/refund', [
            'id' => $id,
            'comment' => $comment,
            'secret_key' => env('FLUTTERWAVE_BEARER_TOKEN'),
        ]);
    }

    public function partialEscrowPayment(Request $request)
    {
        $id = $request->id;
        $comment = $request->comment;
        $amount = $request->amount;
        // release escrow payment
        // https://api.ravepay.co/v2/gpx/transactions/escrow/settle

        $response = Http::post('https://api.ravepay.co/v2/gpx/transactions/escrow/partial', [
            'id' => $id,
            'comment' => $comment,
            'amount' => $amount,
            'secret_key' => env('FLUTTERWAVE_BEARER_TOKEN'),
        ]);
    }

    public function paymentMethodAddedToAccount()
    {
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);

        $details = [
            'user' => $user->last_name . ' ' . $user->first_name,
        ];

        $user->notify(new PaymentMethodNotification($details));
    }
}
