<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralWallet;
use App\Models\User;
use App\Models\Activity;
use App\Models\WalletTransfer;
use App\Models\GeneralWalletTransaction;
use App\Models\FlutterwaveSubaccount;
use App\Models\WithdrawalToken;
use App\Models\WithdrawToken;
use App\Notifications\NewPay;
use App\Notifications\WithdrawTokenNotify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GeneralWalletController extends Controller
{
    public function index(){
        $gwallet = GeneralWallet::where('user_id', auth()->user()->id)->first();
        $gwtransactions = GeneralWalletTransaction::latest()->where('user_id', auth()->user()->id)->get();

        return view('pages.user.wallet.index', compact('gwallet', 'gwtransactions'));
    }

    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }

    public function self_topup(Request $request){
        $amount = $request->topup_amt;
        $user = User::where('id', auth()->user()->id)->first();
        $gwallet = GeneralWallet::where('user_id', auth()->user()->id)->first();
        if(!$gwallet){
            $general_wallet = new GeneralWallet;
            $general_wallet->balance = '0';
            $general_wallet->uid = 'GW'.rand(10000000, 99999999);
            $general_wallet->currency_id = '5';
            $general_wallet->user_id = $user->id;
            $general_wallet->save();

            $gwallet = GeneralWallet::where('user_id', auth()->user()->id)->first();
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

        $response = Http::withToken('FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X')->post('https://api.flutterwave.com/v3/payments', $payload);
        $data = json_decode($response);

        // dd($data);
        $link = $data->data->link;

        return redirect($link);
    }

    public function callback_self_topup(Request $request){
        $response = $request->all();
        $transaction = GeneralWalletTransaction::where('tx_ref', $response['tx_ref'])->first();
        $user = User::where('id', auth()->user()->id)->first();
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
            return redirect(route('user.gwallet.index'))->with('swal-error', 'Your transaction was not successful. Please try again');
        }
        return redirect(route('user.gwallet.index'))->with('success', 'Transaction successful. '.$gwallet->currency->symbol.$transaction->amount.' has been added into your wallet');

    }

    public function otpSystem(Request $request){
        $withdrawal_amt = $request->withdrawal_amt;
        $amount = $request->withdrawal_amt;
        $user = User::where('id', auth()->user()->id)->first();
        $gwallet = GeneralWallet::where('user_id', $user->id)->first();
        $subaccount = FlutterwaveSubaccount::where('user_id', $user->id)->first();
        // dd([$gwallet, $amount, $user, $subaccount]);

        // Check if General Wallet Exists
        if(!$gwallet){
            return redirect("/gwallet/index")->with('swal-error', 'You are trying to Withdraw from an Invalid wallet');
        }

        // Check if User has Added an Account
        if(!$subaccount){
            return redirect("/gwallet/index")->with('bank-error', 'You are yet to add your Bank Information');
        }

        // Check Wallet balance
        if($gwallet->balance < $amount){
            return redirect("/gwallet/index")->with('swal-error', 'You do not have sufficient balance in your Wallet to perform this transaction.');
        }

        if($amount < 100){
            return redirect("/gwallet/index")->with('swal-error', 'Amount is below minimum limit of $100');
        }

        $rand_token = rand(000000, 999990);
        $new_token = new WithdrawalToken();
        $new_token->token = $rand_token;
        $new_token->user_id = $user->id;
        $new_token->email = $user->email;
        $new_token->expires_at = Carbon::now()->addMinutes(5);
        $new_token->save();
        $details = [
            'message' => 'Your OTP code is ',
            'token' => $new_token->token
        ];
        $user->notify(new WithdrawTokenNotify($details));
        return view('pages.user.wallet.withdraw-otp', compact('withdrawal_amt'));
    }

    public function withdrawal(Request $request){
        $amount = $request->withdrawal_amt;
        $token = $request->withdrawal_token;
        $user = User::where('id', auth()->user()->id)->first();
        $gwallet = GeneralWallet::where('user_id', $user->id)->first();
        $subaccount = FlutterwaveSubaccount::where('user_id', $user->id)->first();
        // dd([$gwallet, $amount, $user, $subaccount]);

        $validToken = WithdrawalToken::where('user_id', $user->id)->latest()->first();
        error_log($validToken->token);
        $tokenTimeDiff = Carbon::parse($validToken->expires_at)->diffInMinutes(Carbon::now()->addMinutes(3), false);
        // $tokenTimeDiff = Carbon::now()->addMinutes(3)->diffInMinutes(Carbon::parse($validToken->expires_at, false));
        error_log($tokenTimeDiff);
        if(!$validToken->token){
            error_log("Something about that token bruhh");
            return redirect("/gwallet/index")->with('swal-error', 'Something went wrong try again!');
        }
        if(!$token){
            error_log("Invalid token, try again");
            return redirect("/gwallet/index")->with('swal-error', 'Invalid token');
        }
        if($validToken->token != $token){
            error_log("Incorrect token");
            return redirect("/gwallet/index")->with('swal-error', 'Incorrect token');
        }
        if($tokenTimeDiff > 0){
            error_log("Expired token bruhhh");
            return redirect("/gwallet/index")->with('swal-error', 'Your token is expired try again!');
        }


        // Check if General Wallet Exists
        if(!$gwallet){
            return redirect("/gwallet/index")->with('swal-error', 'You are trying to Withdraw from an Invalid wallet');
        }

        // Check if User has Added an Account
        if(!$subaccount){
            return redirect("/gwallet/index")->with('bank-error', 'You are yet to add your Bank Information');
        }

        // Check Wallet balance
        if($gwallet->balance < $amount){
            return redirect("/gwallet/index")->with('swal-error', 'You do not have sufficient balance in your Wallet to perform this transaction.');
        }

        if($amount < 100){
            return redirect("/gwallet/index")->with('swal-error', 'Amount is below minimum limit of $100');
        }

        $payload = [
            "account_bank"=> $subaccount->account_bank,
            "account_number"=> $subaccount->account_number,
            "amount"=> $amount,
            "full_name" => $user->first_name.' '.$user->last_name,
            "narration"=> "Vicomma Limited",
            "currency"=> 'NGN',
            "reference"=> "CAM_test_".rand(1000, 9999)."_PMCK",
            "debit_currency"=> 'NGN',
            "callback_url"=> route('wallet.pay.callback'),
        ];

        // dd($payload);
        $tx_ref = self::getRandomString(12);

        $response = Http::withToken('FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X')->post('https://api.flutterwave.com/v3/transfers', $payload);
        $data = json_decode($response);
        // dd($data);

        //New General Wallet Transaction
        $transaction = new GeneralWalletTransaction;
        $transaction->name = 'Wallet Withdrawal';
        $transaction->desc = 'Method: Payment Gateway';
        $transaction->tx_ref = $tx_ref;
        $transaction->amount = $amount;
        date_default_timezone_set($user->timezone);
        $transaction->time = date("h:ia");
        $transaction->date = date("d F Y");
        $transaction->type = 'withdrawal';
        $transaction->currency_id = $gwallet->currency_id;
        $transaction->status = 'pending';
        $transaction->user_id = $gwallet->user_id;
        $transaction->save();

        // dd($data);

        if ($data->status == 'success') {
            // dd($data->message);
            
            //deduct amount from wallet
            $gwallet->balance = $gwallet->balance - $amount;
            $gwallet->save();

            //Update General Wallet Transaction
            $transaction = GeneralWalletTransaction::where('tx_ref', $tx_ref)->first();
            $transaction->status = 'successful';
            $transaction->save();

            //New Wallet Transfer
            $transfers = new WalletTransfer;
            $transfers->wallet_id = $gwallet->id;
            $transfers->milestone_id = '0';
            $transfers->tx_id = $data->data->id;
            $transfers->acc_num = $data->data->account_number;
            $transfers->full_name = $data->data->full_name;
            $transfers->amount = $data->data->amount;
            $transfers->tx_created_at = $data->data->created_at;
            $transfers->currency = $data->data->currency;
            $transfers->status = $data->status;
            $transfers->tx_ref = $data->data->reference;
            $transfers->save();

            //create new Activity
            $activity = new Activity;
            $activity->type = 'gwallet_withdrawal';
            $activity->name = 'General Wallet Withdrawal';
            $activity->description = 'You requested a Withdrwal of <b> '.$gwallet->currency->symbol. $amount.'</b> from your General Wallet';
            $activity->user_id = $user->id;
            $activity->url = '/gwallet/index';
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'guser';
            $activity->save();
            

            // $details3 = [
            //     'urlChat' => route('user.jobs.show', $job->unique_id),
            //     'user' => $creative->last_name . " " . $creative->first_name,
            //     "vendor"=>$user->last_name . ' ' . $user->first_name,
            //     'job' => $job->name,
            //     "milestone"=>'Video Uploaded',
            // ];
            // $creative->notify(new Payment2($details3));
            return redirect("/gwallet/index")->with('success', 'Your Withdrawal of ' . $gwallet->currency->symbol. $amount . ' was Successful');
            // return redirect()->back()->with('success', 'Your Withdrawal of ' . $gwallet->currency->symbol. $amount . ' was Successful');
            
            

        }else{
            //Update General Wallet Transaction
            $transaction = GeneralWalletTransaction::where('tx_ref', $tx_ref)->first();
            $transaction->status = 'failed';
            $transaction->save();

            return redirect("/gwallet/index")->with('error', $data->message);
        }
    }
}   
