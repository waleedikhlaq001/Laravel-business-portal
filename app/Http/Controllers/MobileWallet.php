<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Bid;
use App\Models\Budget;
use App\Models\Job;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use App\Models\FlutterwaveSubaccount;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\Chat;
use App\Models\Influencer;
use App\Models\Milestone;
use App\Models\VideoContent;
use App\Models\VendorType;
use App\Models\Wallet;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Token;
use App\Models\VerifToken;
use App\Models\InfluencerCategory;
use App\Models\InfluencerDetails;
use App\Models\InfluencerType;
use App\Models\VideoContentComment;
use App\Models\VideoContentView;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\AccountUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\GeneralWallet;
use App\Models\Activity;
use App\Models\WalletTransfer;
use App\Models\GeneralWalletTransaction;
use App\Http\Controllers\UserController;
use App\Notifications\GoogleRegistration;
use App\Notifications\FacebookRegistration;
use App\Notifications\PasswordReset;
use App\Notifications\PasswordReset2;
use App\Notifications\BidPlaced;
use App\Notifications\JobAwardNotification;
use App\Notifications\JobAwardNotification2;
use App\Notifications\UploadContent;
use App\Notifications\UploadContent2;
use App\Notifications\JobUpdate;
use App\Notifications\UserRegistration;
use App\Notifications\NewPay;
use App\Notifications\UserRegistration2;
class MobileWallet extends Controller
{
    //

    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }
    public function wallet(){
        $gwallet = GeneralWallet::where('user_id', auth('api')->user()->id)->first();
        $gwtransactions = GeneralWalletTransaction::latest()->where('user_id', auth('api')->user()->id)->get();
        $currency = Currency::where('id', $gwallet->currency_id)->first();

        return response()->json(compact("currency", 'gwallet', 'gwtransactions'));
    }

    public function initiate_topup(Request $request){
        $amount = $request->amount;
        $user = User::where('id', auth('api')->user()->id)->first();
        $gwallet = GeneralWallet::where('user_id', auth('api')->user()->id)->first();
        if(!$gwallet){
            $general_wallet = new GeneralWallet;
            $general_wallet->balance = '0';
            $general_wallet->uid = 'GW'.rand(10000000, 99999999);
            $general_wallet->currency_id = '5';
            $general_wallet->user_id = $user->id;
            $general_wallet->save();

            $gwallet = GeneralWallet::where('user_id', auth('api')->user()->id)->first();
        }
        $payment_method = "card,account,ussd,mpesa,qr,PayPal,credit,paga,mobilemoneytanzania,mobilemoneyzambia,mobilemoneyrwanda,mobilemoneytanzania,payattitude,barter";
        $tx_ref = self::getRandomString(12);

        $payload = [
            "tx_ref" => $tx_ref,
            "amount" => $amount,
            "currency" => 'USD',
            "payment_options" => $payment_method,
            "redirect_url" => route('gwallet.credit.callback'),
            "customer" => [
                "name" => $user->first_name.' '.$user->last_name,
                "email" => $user->email,
                "phone" => $user->phone_number,
            ],
            "customizations" => [
                "title" => $user->first_name.' '.$user->last_name.' Wallet Top-Up',
                "description" => $user->first_name.' '.$user->last_name.' Wallet Top-Up',
                "logo" => "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                "color" => "#2ecc71"
            ]
        ];

        $transaction = new GeneralWalletTransaction;
        $transaction->name = 'Wallet Top-Up';
        $transaction->desc = 'Method: Payment Gateway';
        $transaction->tx_ref = $tx_ref;
        $transaction->amount = $amount;
        date_default_timezone_set($user->timezone);
        $transaction->time = date("h:ia");
        $transaction->date = date("d F Y");
        $transaction->type = 'deposit';
        $transaction->currency_id = $gwallet->currency_id;
        $transaction->status = 'pending';
        $transaction->user_id = $gwallet->user_id;
        $transaction->save();

        // $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->post('https://api.flutterwave.com/v3/payments', $payload);
        // $data = json_decode($response);

        // // dd($data);
        // $link = $data->data->link;

        // return redirect($link);
        return response()->json([
            "message"=>"Top-up Initiated",
            "ref"=>$tx_ref,
            "amount"=>$amount
        ]);
    }

    public function callback_self_topup(Request $request){
        $response = $request->all();
        $transaction = GeneralWalletTransaction::where('tx_ref', $response['tx_ref'])->first();
        $user = User::where('id', auth('api')->user()->id)->first();
        $gwallet = GeneralWallet::where('user_id', $user->id)->first();

        // dd([$transaction, $response]);
        if($transaction->status == 'completed'){
            // dd('Transaction already completed');
            return redirect(route('user.gwallet.index'))->with('swal-error', 'Transaction already completed');
        }

        if($response['status'] == 'successful'){
            $transaction->status = 'successful';
            $transaction->save();

            //Update Wallet Balance
            $gwallet->balance = $gwallet->balance + $transaction->amount;
            $gwallet->save();

            //Create General Notification

            //create new Activity
            $activity = new Activity;
            $activity->type = 'gwallet_topup';
            $activity->name = 'Wallet Credited';
            $activity->description = 'You have credited you Vicomma Wallet with the sum of: <b>'.$transaction->amount.' </b>';
            $activity->user_id = $user->id;
            $activity->url = '/gwallet/index';
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'user';
            $activity->save();

            $details = [
                'url' => route('user.gwallet.index'),
                'user' => $user->last_name . ' ' . $user->first_name,
                'job' => $transaction->name,
                "currency"=>$gwallet->currency->symbol,
                "amount"=> "$transaction->amount"
            ];
            $user->notify(new NewPay($details));
        }
        else{
            $transaction->status = 'failed';
            $transaction->save();
            return response()->json(['message'=>'Your transaction was not successful. Please try again'], 400);
        }
        return response(['message'=>'Transaction successful. '.$gwallet->currency->symbol.$transaction->amount.' has been added into your wallet']);

    }
}
