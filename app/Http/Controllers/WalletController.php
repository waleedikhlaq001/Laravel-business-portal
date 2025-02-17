<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\FlutterwaveSubaccount;
use App\Models\Job;
use App\Models\Milestone;
use App\Models\User;
use App\Models\Wallet;
use App\Models\GeneralWallet;
use App\Models\WalletTransaction;
use App\Models\GeneralWalletTransaction;
use App\Models\WalletTransfer;
use App\Notifications\JobUpdate;
use App\Notifications\Payment;
use App\Notifications\Payment2;
use App\Notifications\NewPay;
use App\Notifications\NewPay2;
use App\Notifications\PaymentFinal;
use App\Notifications\PaymentFinal2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Shetabit\TokenBuilder\Facade\TokenBuilder;
use App\Models\Notification;
use App\Models\GeneralNotification;
use App\Events\NewNotification;
use App\Events\NewGeneralNotification;
use App\Events\WalletUpdated;
use App\Events\WalletUpdated2;
use App\Events\Milestone1;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\PayPalEscrowService;

class WalletController extends Controller
{
    protected $payPalEscrowService;

    public function __construct(PayPalEscrowService $payPalEscrowService)
    {
        $this->payPalEscrowService = $payPalEscrowService;
    }

    function getRandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
    public function get_currency_id($req)
    {

        $details = json_decode(file_get_contents("http://ipinfo.io"), true);
        // echo $details->country;
        $ip = $details['ip'];
        $ip = $req->getClientIp();

        $geo = file_get_contents("https://api.timanetglobaltech.com/?ip=" . $ip . "&time=" . date('H:i:s'));
        // print_r($geo);
        $geo_data = json_decode($geo, true);
        $country = DB::table("countries")->where("name", $geo_data['country'])->first();
        if ($country) {
            $currency = DB::table("currencies")->where("code", $geo_data["currency_code"])->first();
            if ($currency) {
                return $currency->code;
            } else {
                return $geo_data["exchange_rate"];
            }
        } else {
            return "USD";
        }
    }

    public function get_currency_rate($req)
    {

        $details = json_decode(file_get_contents("http://ipinfo.io"), true);
        // echo $details->country;
        $ip = $details['ip'];
        $ip = $req->getClientIp();

        $geo = file_get_contents("https://api.timanetglobaltech.com/?ip=" . $ip . "&time=" . date('H:i:s'));
        // print_r($geo);
        $geo_data = json_decode($geo, true);
        $country = DB::table("countries")->where("name", $geo_data['country'])->first();
        if ($country) {
            $currency = DB::table("currencies")->where("code", $geo_data["currency_code"])->first();
            if ($currency) {
                return $geo_data["exchange_rate"];
            } else {
                return "1";
            }
        } else {
            return "1";
        }
    }
    //function to create wallet
    public function create($job_uid)
    {
        $job = Job::where('unique_id', $job_uid)->first();
        $bid = Bid::where(['job_id' => $job->id, 'influencer_id' => $job->influencer_id])->first();
        $video = $job->video;

        $wallet = new Wallet;
        $wallet->job_id = $job->id;
        $wallet->currency_id = "97";
        $wallet->budget = $bid->amount;
        $wallet->balance = '0';
        $wallet->twenty_five = '0';
        $wallet->fifty = '0';
        $wallet->seventy_five = '0';
        $wallet->hundred = '0';
        $wallet->uid = rand(10000000, 99999999);
        $wallet->save();

        $milestone1 = new Milestone;
        $milestone1->job_id = $job->id;
        $milestone1->name = 'Video Uploaded';
        $milestone1->amt_due = $bid->amount * 0.25;
        $milestone1->completed = ($video ? '1' : '0');
        $milestone1->paid = '0';
        $milestone1->uid = rand(10000000, 99999999);
        $milestone1->wallet_id = $wallet->id;
        $milestone1->save();

        $milestone2 = new Milestone;
        $milestone2->job_id = $job->id;
        $milestone2->name = 'Video Watched';
        $milestone2->amt_due = $bid->amount * 0.75;
        $milestone2->completed = '0';
        $milestone2->paid = '0';
        $milestone2->uid = rand(10000000, 99999999);
        $milestone2->wallet_id = $wallet->id;
        $milestone2->save();

        return redirect()->back()->with('success', 'Wallet created successfully');
    }


    //Function to create transaction for wallet
    public function createTransaction($payload, $percent)
    {
        $data = [];
        $data['job_id'] =  $payload['meta']['job_id'];
        $data['vendor_id'] =  $payload['meta']['vendor_id'];
        $data['wallet_uid'] =  $payload['meta']['wallet_uid'];
        $data['status'] =  'pending';
        $data['amount'] = $payload['amount'];
        $data['currency'] = $payload['currency'];
        $data['ref'] = $payload['tx_ref'];
        $data['percent'] = $percent;

        return WalletTransaction::create($data);
    }

    public function createTransaction2($payload, $percent)
    {
        $data = [];
        $data['job_id'] =  $payload['meta']['job_id'];
        $data['vendor_id'] =  $payload['meta']['vendor_id'];
        $data['wallet_uid'] =  $payload['meta']['wallet_uid'];
        $data['status'] =  'pending';
        $data['amount'] = $payload['amount'];
        $data['currency'] = $payload['currency'];
        $data['ref'] = $payload['reference'];
        $data['percent'] = $percent;

        return WalletTransaction::create($data);
    }

    //function to initialize flutterwave payment gateway
    public function credit(Request $request)
    {

        $perc = $request->percT;
        $wallet = $request->uid;
        $type = $request->type;
        $user = auth()->user();


        if ($perc == '25' || $perc == '50' || $perc == '75' || $perc == '100') {
            $percent = $perc;
            $wallet = Wallet::where('uid', $wallet)->first();
            $job = $wallet->job;
            $budget = $wallet->budget;
            $balance = $wallet->balance;
            $perc = $perc / 100;
            $amount = $budget * $perc;
            $flutCharge = $amount * 0.014; //remove in Live mode and set flutterwave to charge customer
            $vicCharge = $budget * 0.07;

            if ($wallet->vicomma_fee == null) {
                $totalCharge = $amount + $flutCharge + $vicCharge;
            } else {
                $totalCharge = $amount + $flutCharge;
            }
            if ($request->gwallet != '1' && $type == "paypal") {
                $payeeEmail = $request->input('payee_email');
                if (!$this->payPalEscrowService->verifyEmail($payeeEmail)) {
                    return redirect()->route('original.route')
                        ->with('error', 'PayPal email verification failed');
                }

                $order = $this->payPalEscrowService->createOrder(100); // Amount to be held in escrow

                foreach ($order['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        $redirectUrl = $link['href'];
                        break;
                    }
                }

                Session::put('paypal_order_id', $order['id']);

                if (isset($redirectUrl)) {
                    return redirect($redirectUrl);
                }
            }

            if ($request->gwallet != '1' && $type == "flutterwave") {
                //Check Wallet Balance
                if ($balance >= $budget) {
                    return redirect()->back()->with('swal-error', 'You have already topped up this wallet balance');
                }

                // dd($amount);
                function get_amount($charge, $currency, $rate)
                {
                    if ($currency == "USD") {
                        return $charge;
                    } else {
                        return (int)$charge * $rate;
                    }
                }

                $subaccount = FlutterwaveSubaccount::where('user_id', $job->influencer_id)->first();
                // if (!$subaccount){
                //     return redirect()->back()->with('swal-error', 'Creative is yet to add a payment method');
                // }
                $vendor = User::where('id', $job->vendor->user_id)->first();

                $payment_method = "card,account,ussd,mpesa,qr,PayPal,credit,paga,mobilemoneytanzania,mobilemoneyzambia,mobilemoneyrwanda,mobilemoneytanzania,payattitude,barter";

                $payload = [
                    "tx_ref" => "VICOMMA_" . uniqid() . '_' . time(),
                    "amount" => get_amount($totalCharge, $this->get_currency_id($request), $this->get_currency_rate($request)),
                    "currency" => $this->get_currency_id($request),
                    "payment_options" => $payment_method,
                    "redirect_url" => route('wallet.credit.callback'),
                    // "subaccounts" => [
                    //     [
                    //         "id" => $subaccount->subaccount_id,
                    //     ]
                    // ],
                    "meta" => [
                        "vendor_id" => $job->vendor_id,
                        "job_id" => $job->id,
                        "creative_id" => $job->influencer_id,
                        "wallet_uid" => $wallet->uid,
                    ],
                    "customer" => [
                        "name" => $vendor->first_name . ' ' . $vendor->last_name,
                        "email" => $vendor->email,
                        "phone" => $vendor->phone_number,
                    ],
                    "customizations" => [
                        "title" => $percent . "% Payment for Job #" . $job->id,
                        "description" => $percent . "% Credit into Wallet #" . $wallet->uid,
                        "logo" => "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                        "color" => "#2ecc71"
                    ]
                ];

                // dd($payload);FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X
                $this->createTransaction($payload, $percent);
                $response = Http::withToken("FLWSECK_TEST-7e3d31a3211e6320cdab3742566c2a0b-X")->post('https://api.flutterwave.com/v3/payments', $payload);
                $data = json_decode($response);

                // dd($data);
                $link = $data->data->link;

                return redirect($link);
            }
            if ($request->gwallet != '1' && $type == "paystack") {
                //Check Wallet Balance
                if ($balance >= $budget) {
                    return redirect()->back()->with('swal-error', 'You have already topped up this wallet balance');
                }

                // dd($amount);

                $subaccount = FlutterwaveSubaccount::where('user_id', $job->influencer_id)->first();
                // if (!$subaccount){
                //     return redirect()->back()->with('swal-error', 'Creative is yet to add a payment method');
                // }
                $vendor = User::where('id', $job->vendor->user_id)->first();

                $payment_method = "card,account,ussd,mpesa,qr,PayPal,credit,paga,mobilemoneytanzania,mobilemoneyzambia,mobilemoneyrwanda,mobilemoneytanzania,payattitude,barter";
                function get_amount($charge, $currency, $rate)
                {
                    if ($currency == "USD") {
                        return $charge;
                    } else {
                        return $charge * $rate;
                    }
                }

                $payload = [
                    "reference" => "VICOMMA_" . uniqid() . '_' . time(),
                    "amount" => (int)get_amount($totalCharge, $this->get_currency_id($request), $this->get_currency_rate($request)) * 100,
                    "email" => $vendor->email,
                    // "currency" => $job->currency->code,
                    "currency" => $this->get_currency_id($request),
                    // "payment_options" => $payment_method,
                    "callback_url" => route('wallet.credit.callback_paystack'),
                    // "subaccounts" => [
                    //     [
                    //         "id" => $subaccount->subaccount_id,
                    //     ]
                    // ],
                    "meta" => [
                        "vendor_id" => $job->vendor_id,
                        "job_id" => $job->id,
                        "creative_id" => $job->influencer_id,
                        "wallet_uid" => $wallet->uid,
                        "name" => $vendor->first_name . ' ' . $vendor->last_name,
                        "email" => $vendor->email,
                        "phone" => $vendor->phone_number,
                    ],
                    "customizations" => [
                        "title" => $percent . "% Payment for Job #" . $job->id,
                        "description" => $percent . "% Credit into Wallet #" . $wallet->uid,
                        "logo" => "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                        "color" => "#2ecc71"
                    ]
                ];

                // dd($payload);
                $this->createTransaction2($payload, $percent);
                $response = Http::withToken('sk_live_974f190a6a25edb247e277e322ec8ec885cd953c')->post('https://api.paystack.co/transaction/initialize', $payload);
                $data = json_decode($response);

                dd($data);
                $link = $data->data->authorization_url;

                return redirect($link);
            } else if ($request->gwallet == '1') {
                $gwallet = GeneralWallet::where('user_id', auth()->user()->id)->first();

                if ($wallet->vicomma_fee == null) {
                    $totalCharge = $amount + $vicCharge;
                } else {
                    $totalCharge = $amount;
                }

                $walletTrans = new WalletTransaction;
                $walletTrans->job_id =  $job->id;
                $walletTrans->vendor_id =  $job->vendor_id;
                $walletTrans->wallet_uid =  $wallet->uid;
                $walletTrans->status =  'pending';
                $walletTrans->amount = $totalCharge;
                $walletTrans->currency = $job->currency->code;
                $walletTrans->ref = "VICOMMA_GW_" . uniqid() . '_' . time();
                $walletTrans->percent = $percent;
                $walletTrans->save();

                if (!$gwallet) {
                    $general_wallet = new GeneralWallet;
                    $general_wallet->balance = '0';
                    $general_wallet->uid = 'GW' . rand(10000000, 99999999);
                    $general_wallet->currency_id = '97';
                    $general_wallet->user_id = $user->id;
                    $general_wallet->save();

                    $gwallet = GeneralWallet::where('user_id', auth()->user()->id)->first();
                }

                $GWtransaction = new GeneralWalletTransaction;
                $GWtransaction->name = 'Job Wallet Credit';
                $GWtransaction->desc = 'Job: ' . $job->name;
                $GWtransaction->tx_ref = self::getRandomString(12);
                $GWtransaction->amount = $totalCharge;
                date_default_timezone_set(auth()->user()->timezone);
                $GWtransaction->time = date("h:ia");
                $GWtransaction->date = date("d F Y");
                $GWtransaction->type = 'withdrawal';
                $GWtransaction->currency_id = $gwallet->currency_id;
                $GWtransaction->status = 'pending';
                $GWtransaction->user_id = $gwallet->user_id;
                $GWtransaction->save();

                if ($gwallet->balance < $totalCharge) {
                    return redirect()->back()->with('swal-error', 'You do not have sufficient balance in your Vicomma Wallet');
                }

                switch ($percent) {
                    case '25':
                        $percentage = 'twenty_five';
                        break;
                    case '50':
                        $percentage = 'fifty';
                        break;
                    case '75':
                        $percentage = 'seventy_five';
                        break;
                    case '100':
                        $percentage = 'hundred';
                        break;
                }

                $wallet->balance = $wallet->balance + $amount;
                if ($wallet->vicomma_fee == null) {
                    $wallet->vicomma_fee = $vicCharge;
                }

                $wallet->$percentage = $wallet->$percentage + $walletTrans->percent;
                $wallet->save();

                $GWtransaction->status = 'successful';
                $GWtransaction->save();

                //Update Wallet Balance
                $gwallet->balance = $gwallet->balance - $totalCharge;
                $gwallet->save();

                $vendor = $job->vendor->user_id;

                //create new transaction
                $noti = new Notification;
                $noti->sender = $vendor;
                $noti->receiver = User::where('id', $job->influencer_id)->first()->id;
                $noti->type = 'Wallet';
                $noti->type_id = $job->unique_id;
                $noti->message = $job->currency->symbol . '' . $walletTrans->amount . ' paid for Job: ' . $job->name;
                $noti->save();

                //create new Activity
                $activity = new Activity;
                $activity->type = 'gwallet_debit';
                $activity->name = 'General Wallet Transfer';
                $activity->description = 'You have transferred the sum of: <b>' . $job->currency->symbol . $totalCharge . '</b> out of your Vicomma Wallet';
                $activity->user_id = auth()->user()->id;
                $activity->url = '/gwallet/index';
                $activity->image = 'https://via.placeholder.com/50';
                $activity->account_type = 'user';
                $activity->save();

                //create new Activity
                $activity = new Activity;
                $activity->type = 'wallet_credit';
                $activity->name = 'Job Wallet Credited';
                $activity->description = 'You have credited the wallet for Job <b>(' . $job->name . ')</b> with <b>' . $job->currency->symbol . $walletTrans->amount . '</b>';
                $activity->user_id = $vendor;
                $activity->url = '/jobs/details/' . $job->unique_id;
                $activity->image = 'https://via.placeholder.com/50';
                $activity->account_type = 'vendor';
                $activity->save();

                return redirect()->back()->with('success', 'Transaction successful. ' . $job->currency->symbol . $amount . ' has been added into your wallet');
            }
        } else {
            return redirect()->back()->with('swal-error', 'Invalid Percentage');
        }
    }

    public function callback(Request $request)
    {
        $response = $request->all();
        $transaction = WalletTransaction::where('ref', $response['tx_ref'])->first();
        if ($transaction->status == 'completed') {
            // dd('Transaction already completed');
            return redirect()->back()->with('swal-error', 'Transaction already completed');
        }
        $percentage = $transaction->percent;

        switch ($percentage) {
            case '25':
                $percentage = 'twenty_five';
                break;
            case '50':
                $percentage = 'fifty';
                break;
            case '75':
                $percentage = 'seventy_five';
                break;
            case '100':
                $percentage = 'hundred';
                break;
        }

        if ($response['status'] == 'successful') {
            $transaction->status = 'completed';
            $transaction->save();

            $Nperc = $transaction->percent / 100;
            $wallet = Wallet::where('uid', $transaction->wallet_uid)->first();

            $amtToWallet = $wallet->budget * $Nperc;
            $vicCharge = $wallet->budget * 0.07;
            $job = $wallet->job;

            $wallet->balance = $wallet->balance + $amtToWallet;
            if ($wallet->vicomma_fee == null) {
                $wallet->vicomma_fee = $vicCharge;
            }
            $wallet->$percentage = $wallet->$percentage + $transaction->percent;
            $wallet->save();

            $vendor = $job->vendor->user_id;
            $vendor_user = Auth::user();
            // dd($vendor_user);

            //create new transaction
            $noti = new Notification;
            $noti->sender = $vendor;
            $noti->receiver = User::where('id', $job->influencer_id)->first()->id;
            $noti->type = 'Wallet';
            $noti->type_id = $job->unique_id;
            $noti->message = $job->currency->symbol . '' . $transaction->amount . ' paid for Job: ' . $job->name;
            $noti->save();

            //create new Activity
            $activity = new Activity;
            $activity->type = 'wallet_credit';
            $activity->name = 'Job Wallet Credited';
            $activity->description = 'You have credited the wallet for Job <b>(' . $job->name . ')</b> with <b>' . $job->currency->symbol . $transaction->amount . '</b>';
            $activity->user_id = $vendor;
            $activity->url = '/jobs/details/' . $job->unique_id;
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'vendor';
            $activity->save();

            //broadcast to pusher here...
            $usr = User::where('id', $job->vendor->user->id)->first();
            $creative = User::findOrFail($job->influencer->id);
            broadcast(new WalletUpdated(auth()->user(), $wallet))->toOthers();
            $details = [
                'url' => route('user.jobs.show', $job->unique_id),
                'user' => $usr->last_name . ' ' . $usr->first_name,
                'job' => $job->name,
                "currency" => $wallet->currency->symbol,
                "amount" => "$transaction->amount"
            ];
            $usr->notify(new NewPay($details));

            $details2 = [
                'url' => route('user.jobs.show', $job->unique_id),
                'user' => $creative->last_name . " " . $creative->first_name,
                "vendor" => $usr->last_name . ' ' . $usr->first_name,
                'job' => $job->name,
                "currency" => $wallet->currency->symbol,
                "amount" => "$transaction->amount"
            ];
            $creative->notify(new NewPay2($details2));

            broadcast(new NewNotification($vendor_user, $noti))->toOthers();
        } else {
            $transaction->status = 'failed';
            $transaction->save();
            return redirect('/jobs/details/' . $transaction->job->unique_id)->with('swal-error', 'Your transaction was not successful. Please try again');
        }
        return redirect('/jobs/details/' . $transaction->job->unique_id)->with('success', 'Transaction successful. ' . $job->currency->symbol . $amtToWallet . ' has been added into your wallet');
    }
    public function callback_paystack(Request $request)
    {
        $response = $request->all();
        $transaction = WalletTransaction::where('ref', $response['trxref'])->first();

        if ($transaction->status == 'completed') {
            // dd('Transaction already completed');
            return redirect()->back()->with('swal-error', 'Transaction already completed');
        }
        $percentage = $transaction->percent;

        switch ($percentage) {
            case '25':
                $percentage = 'twenty_five';
                break;
            case '50':
                $percentage = 'fifty';
                break;
            case '75':
                $percentage = 'seventy_five';
                break;
            case '100':
                $percentage = 'hundred';
                break;
        }
        $response2 = Http::withToken("sk_live_974f190a6a25edb247e277e322ec8ec885cd953c")->get('https://api.paystack.co/transaction/verify/' . $response['trxref'], []);
        $data2 = json_decode($response2);


        if ($data2->status == true) {
            $transaction->status = 'completed';
            $transaction->save();

            $Nperc = $transaction->percent / 100;
            $wallet = Wallet::where('uid', $transaction->wallet_uid)->first();

            $amtToWallet = $wallet->budget * $Nperc;
            $vicCharge = $wallet->budget * 0.07;
            $job = $wallet->job;

            $wallet->balance = $wallet->balance + $amtToWallet;
            if ($wallet->vicomma_fee == null) {
                $wallet->vicomma_fee = $vicCharge;
            }
            $wallet->$percentage = $wallet->$percentage + $transaction->percent;
            $wallet->save();

            $vendor = $job->vendor->user_id;
            $vendor_user = Auth::user();
            // dd($vendor_user);

            //create new transaction
            $noti = new Notification;
            $noti->sender = $vendor;
            $noti->receiver = User::where('id', $job->influencer_id)->first()->id;
            $noti->type = 'Wallet';
            $noti->type_id = $job->unique_id;
            $noti->message = $job->currency->symbol . '' . $transaction->amount . ' paid for Job: ' . $job->name;
            $noti->save();

            //create new Activity
            $activity = new Activity;
            $activity->type = 'wallet_credit';
            $activity->name = 'Job Wallet Credited';
            $activity->description = 'You have credited the wallet for Job <b>(' . $job->name . ')</b> with <b>' . $job->currency->symbol . $transaction->amount . '</b>';
            $activity->user_id = $vendor;
            $activity->url = '/jobs/details/' . $job->unique_id;
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'vendor';
            $activity->save();

            //broadcast to pusher here...
            $usr = User::where('id', $job->vendor->user->id)->first();
            $creative = User::findOrFail($job->influencer->id);
            broadcast(new WalletUpdated(auth()->user(), $wallet))->toOthers();
            $details = [
                'url' => route('user.jobs.show', $job->unique_id),
                'user' => $usr->last_name . ' ' . $usr->first_name,
                'job' => $job->name,
                "currency" => $wallet->currency->symbol,
                "amount" => "$transaction->amount"
            ];
            $usr->notify(new NewPay($details));

            $details2 = [
                'url' => route('user.jobs.show', $job->unique_id),
                'user' => $creative->last_name . " " . $creative->first_name,
                "vendor" => $usr->last_name . ' ' . $usr->first_name,
                'job' => $job->name,
                "currency" => $wallet->currency->symbol,
                "amount" => "$transaction->amount"
            ];
            $creative->notify(new NewPay2($details2));

            broadcast(new NewNotification($vendor_user, $noti))->toOthers();
        } else {
            $transaction->status = 'failed';
            $transaction->save();
            return redirect('/jobs/details/' . $transaction->job->unique_id)->with('swal-error', 'Your transaction was not successful. Please try again');
        }
        return redirect('/jobs/details/' . $transaction->job->unique_id)->with('success', 'Transaction successful. ' . $job->currency->symbol . $amtToWallet . ' has been added into your wallet');
    }
    public function pay($uid)
    {
        DB::beginTransaction();
        try {


            $milestone = Milestone::where('uid', $uid)->lockForUpdate()->first();
            if (!$milestone) {
                return redirect()->back()->with('swal-error', 'Milestone does not exist');
            }

            $wallet = Wallet::where('id', $milestone->wallet_id)->lockForUpdate()
                ->first();
            if (!$wallet) {
                return redirect()->back()->with('swal-error', 'Job Wallet does not exist');
            }

            $amount = $milestone->amt_due;
            $creative = User::where('id', $milestone->job->influencer_id)->first();
            $job = Job::where('id', $milestone->job_id)->first();
            $trans_ref = self::getRandomString(12);

            $gwallet = GeneralWallet::where('user_id', $creative->id)->lockForUpdate()->first();
            if (!$gwallet) {
                $general_wallet = new GeneralWallet;
                $general_wallet->balance = '0';
                $general_wallet->uid = 'GW' . rand(10000000, 99999999);
                $general_wallet->currency_id = "97";
                $general_wallet->user_id = $creative->id;
                $general_wallet->save();

                $gwallet = GeneralWallet::where('user_id', $creative->id)->lockForUpdate()->first();
            }

            //Create new Wallet Transaction
            $transaction = new GeneralWalletTransaction;
            $transaction->name = 'Milestone Payment';
            $transaction->desc = 'Job: ' . $job->name;
            $transaction->tx_ref = $trans_ref;
            $transaction->amount = $amount;
            date_default_timezone_set($creative->timezone);
            $transaction->time = date("h:ia");
            $transaction->date = date("d F Y");
            $transaction->type = 'credit';
            $transaction->currency_id = $gwallet->currency_id;
            $transaction->status = 'pending';
            $transaction->user_id = $gwallet->user_id;
            $transaction->save();

            // dd([$milestone, $wallet, $amount, $creative, $subaccount]);

            // Check Wallet balance
            if ($wallet->balance < $amount) {
                $lesser_by =  $amount - $wallet->balance;

                return redirect()->back()->with('swal-error', 'You do not have sufficient balance in your Job Wallet to perform this transaction. Please credit Job Wallet Bal with the sum of ' . $wallet->currency->symbol . $lesser_by);
            }

            if ($milestone->name == 'Video Uploaded' || $milestone->name == 'Video Watched') {

                $gwallet->balance = $gwallet->balance + $amount;
                $gwallet->save();

                //change General Wallet Transaction status to completed
                $existing_trans = GeneralWalletTransaction::where('tx_ref', $trans_ref)->first();
                $existing_trans->status = 'completed';
                $existing_trans->save();

                //change milestone status to completed
                $milestone->paid = '1';
                $milestone->save();

                //deduct amount from wallet
                $wallet->balance = $wallet->balance - $amount;
                $wallet->save();




                if ($milestone->name == 'Video Uploaded') {
                    $dataN = [
                        'job_id' => $job->id
                    ];
                    $tokenObject = $token = TokenBuilder::setData($dataN)->build();
                    $tokenObject->job_id = $job->id;
                    $tokenObject->save();

                    //Send token to SMS
                    // if ($user->isPhoneVerified) {
                    //     $this->sendMessage('Use Token to access video ' . $tokenObject->token, $phone_number);
                    // }

                    $user = User::where('id', $job->vendor->user->id)->first();
                    $creative = User::findOrFail($job->influencer->id);

                    //create new Activity
                    $activity = new Activity;
                    $activity->type = 'videoUploaded_payment';
                    $activity->name = 'Milestone Payment';
                    $activity->description = 'You paid <b>' . $creative->last_name . ' ' . $creative->first_name . ' ' . $job->currency->symbol . $transaction->amount . '</b> for Milestone <b>Video Uploaded</b> on Job <b>(' . $job->name . ')</b>';
                    $activity->user_id = $user->id;
                    $activity->url = '/jobs/details/' . $job->unique_id;
                    $activity->image = 'https://via.placeholder.com/50';
                    $activity->account_type = 'vendor';
                    $activity->save();
                    $influencer = $creative->last_name . ' ' . $creative->first_name;

                    // Send token to Email
                    $details = [
                        'subject' => 'Video Token',
                        'token' => $tokenObject->token,
                        'user' => $user->last_name . ' ' . $user->first_name,
                        'message' => "Use the token below to view the content from your Creative: $influencer. Note: that your token will expire in 48 hours."
                    ];
                    $user->notify(new JobUpdate($details));

                    $details2 = [
                        'urlChat' => route('user.jobs.show', $job->unique_id),
                        'user' => $user->last_name . ' ' . $user->first_name,
                        'job' => $job->name,
                        "milestone" => 'Video Uploaded',
                        "creative" => $creative->last_name . " " . $creative->first_name,
                    ];
                    $user->notify(new Payment($details2));

                    $details3 = [
                        'urlChat' => route('user.jobs.show', $job->unique_id),
                        'user' => $creative->last_name . " " . $creative->first_name,
                        "vendor" => $user->last_name . ' ' . $user->first_name,
                        'job' => $job->name,
                        "milestone" => 'Video Uploaded',
                    ];
                    $creative->notify(new Payment2($details3));
                    // broadcast(new WalletUpdated2(auth()->user(), $wallet))->toOthers();
                    broadcast(new Milestone1(auth()->user(), $job))->toOthers();

                    DB::commit();
                    return redirect()->back()->with('success', 'Your Payment of ' . $wallet->currency->symbol . $transaction->amount . ' was Successful');
                } elseif ($milestone->name == 'Video Watched') {
                    $job->isCompleted = '1';
                    $job->save();

                    $user = User::where('id', $job->vendor->user->id)->first();
                    $creative = User::findOrFail($job->influencer->id);

                    //create new Activity
                    $activity = new Activity;
                    $activity->type = 'videoWatched_payment';
                    $activity->name = 'Milestone Payment';
                    $activity->description = 'You paid <b>' . $creative->last_name . ' ' . $creative->first_name . ' ' . $job->currency->symbol . $transaction->amount . '</b> for Milestone <b>Video Watched</b> on Job <b>(' . $job->name . ')</b>';
                    $activity->user_id = $user->id;
                    $activity->url = '/jobs/details/' . $job->unique_id;
                    $activity->image = 'https://via.placeholder.com/50';
                    $activity->account_type = 'vendor';
                    $activity->save();

                    $details2 = [
                        'urlChat' => route('user.jobs.show', $job->unique_id),
                        'user' => $user->last_name . ' ' . $user->first_name,
                        'job' => $job->name,
                        "milestone" => 'Video Watched',
                        "creative" => $creative->last_name . " " . $creative->first_name,
                        'urlfile' => route('user.job.video.download', $job->id),
                    ];
                    $user->notify(new PaymentFinal($details2));

                    $details3 = [
                        'urlChat' => route('user.jobs.show', $job->unique_id),
                        'user' => $creative->last_name . " " . $creative->first_name,
                        "vendor" => $user->last_name . ' ' . $user->first_name,
                        'job' => $job->name,
                        "milestone" => 'Video Watched',
                    ];
                    $creative->notify(new PaymentFinal2($details3));
                    broadcast(new WalletUpdated2(auth()->user(), $wallet))->toOthers();

                    DB::commit();
                    return redirect()->back()->with('success', 'Your Payment of ' . $wallet->currency->symbol . $transaction->amount . ' was Successful. This Job is now completed');
                }
            } else {
                return redirect()->back()->with('swal-error', 'Undefined Milestone');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal-error', 'Something went wrong try again');
        }
    }

    // public function pay($uid){
    //     $milestone = Milestone::where('uid', $uid)->first();
    //     $wallet = Wallet::where('id', $milestone->wallet_id)->first();
    //     $amount = $milestone->amt_due;
    //     $creative = User::where('id', $milestone->job->influencer_id)->first();
    //     $subaccount = FlutterwaveSubaccount::where('user_id', $creative->id)->first();
    // 	$job = Job::where('id', $milestone->job_id)->first();

    //     // dd([$milestone, $wallet, $amount, $creative, $subaccount]);

    //     // Check Wallet balance
    //     if($wallet->balance < $amount){
    //         return redirect()->back()->with('swal-error', 'You do not have sufficient Wallet balance to perform this transaction. Please credit Job Wallet. Bal:');
    //     }

    //     $payload = [
    //         "account_bank"=> $subaccount->account_bank,
    //         "account_number"=> $subaccount->account_number,
    //         "amount"=> $amount,
    //         "narration"=> "Vicomma Limited",
    //         "currency"=> 'NGN',
    //         "reference"=> "CAM_test_".rand(100, 999)."_PMCK",
    //         "debit_currency"=> 'NGN',
    //         "callback_url"=> route('wallet.pay.callback'),
    //     ];

    //     // dd($payload);

    //     $response = Http::withToken('FLWSECK_TEST-d46a137ac8f01cd43a1e332416880dd2-X')->post('https://api.flutterwave.com/v3/transfers', $payload);
    //     $data = json_decode($response);

    //     //dd($data);

    //     if ($data->status == 'success') {
    //         // dd($data->message);
    //         $transfers = new WalletTransfer;
    //         $transfers->wallet_id = $wallet->id;
    //         $transfers->milestone_id = $milestone->id;
    //         $transfers->tx_id = $data->data->id;
    //         $transfers->acc_num = $data->data->account_number;
    //         $transfers->full_name = $data->data->full_name;
    //         $transfers->amount = $data->data->amount;
    //         $transfers->tx_created_at = $data->data->created_at;
    //         $transfers->currency = $data->data->currency;
    //         $transfers->status = $data->status;
    //         $transfers->tx_ref = $data->data->reference;
    //         $transfers->save();

    //         //change milestone status to completed
    //         $milestone->paid = '1';
    //         $milestone->save();

    //         //deduct amount from wallet
    //         $wallet->balance = $wallet->balance - $amount;
    //         $wallet->save();

    //          if ($milestone->name == 'Video Uploaded') {
    //             $dataN = [
    //                 'job_id' => $job->id
    //             ];
    //             $tokenObject = $token = TokenBuilder::setData($dataN)->build();
    //             $tokenObject->job_id = $job->id;
    //             $tokenObject->save();

    //             //Send token to SMS
    //             // if ($user->isPhoneVerified) {
    //             //     $this->sendMessage('Use Token to access video ' . $tokenObject->token, $phone_number);
    //             // }

    //             $user = User::where('id', $job->vendor->user->id)->first();
    //             $creative = User::findOrFail($job->influencer->id);

    //             //create new Activity
    //             $activity = new Activity;
    //             $activity->type = 'videoUploaded_payment';
    //             $activity->name = 'Milestone Payment';
    //             $activity->description = 'You paid <b>'. $creative->last_name . ' ' . $creative->first_name . ' '.$job->currency->symbol. $transfers->amount.'</b> for Milestone <b>Video Uploaded</b> on Job <b>(' . $job->name . ')</b>';
    //             $activity->user_id = $user->id;
    //             $activity->url = '/jobs/details/'. $job->unique_id;
    //             $activity->image = 'https://via.placeholder.com/50';
    //             $activity->account_type = 'vendor';
    //             $activity->save();
    //             $influencer = $creative->last_name . ' ' . $creative->first_name;
    //             // Send token to Email
    //             $details = [
    //                 'subject' => 'Video Token',
    //                 'token' => $tokenObject->token,
    //                 'user' => $user->last_name . ' ' . $user->first_name,
    //                 'message' => "Use the token below to view the content from your Creative: $influencer. Note: that your token will expire in 48 hours."
    //             ];
    //             $user->notify(new JobUpdate($details));

    //             $details2 = [
    //                 'urlChat' => route('user.jobs.show', $job->unique_id),
    //                 'user' => $user->last_name . ' ' . $user->first_name,
    //                 'job' => $job->name,
    //                 "milestone"=>'Video Uploaded',
    //                 "creative"=>$creative->last_name . " " . $creative->first_name,
    //             ];
    //             $user->notify(new Payment($details2));

    //             $details3 = [
    //                 'urlChat' => route('user.jobs.show', $job->unique_id),
    //                 'user' => $creative->last_name . " " . $creative->first_name,
    //                 "vendor"=>$user->last_name . ' ' . $user->first_name,
    //                 'job' => $job->name,
    //                 "milestone"=>'Video Uploaded',
    //             ];
    //             $creative->notify(new Payment2($details3));
    //             return redirect()->back()->with('success', 'Your Payment of ' . $wallet->currency->symbol . $data->data->amount . ' was Successful');
    //         }
    //         elseif($milestone->name == 'Video Watched'){
    //             $job->isCompleted = '1';
    //             $job->save();

    //             $user = User::where('id', $job->vendor->user->id)->first();
    //             $creative = User::findOrFail($job->influencer->id);

    //             //create new Activity
    //             $activity = new Activity;
    //             $activity->type = 'videoWatched_payment';
    //             $activity->name = 'Milestone Payment';
    //             $activity->description = 'You paid <b>'. $creative->last_name . ' ' . $creative->first_name . ' '.$job->currency->symbol. $transfers->amount.'</b> for Milestone <b>Video Watched</b> on Job <b>(' . $job->name . ')</b>';
    //             $activity->user_id = $user->id;
    //             $activity->url = '/jobs/details/'. $job->unique_id;
    //             $activity->image = 'https://via.placeholder.com/50';
    //             $activity->account_type = 'vendor';
    //             $activity->save();

    //             $details2 = [
    //                 'urlChat' => route('user.jobs.show', $job->unique_id),
    //                 'user' => $user->last_name . ' ' . $user->first_name,
    //                 'job' => $job->name,
    //                 "milestone"=>'Video Watched',
    //                 "creative"=>$creative->last_name . " " . $creative->first_name,
    //                 'urlfile'=>route('user.job.video.download', $job->id),
    //             ];
    //             $user->notify(new PaymentFinal($details2));

    //             $details3 = [
    //                 'urlChat' => route('user.jobs.show', $job->unique_id),
    //                 'user' => $creative->last_name . " " . $creative->first_name,
    //                 "vendor"=>$user->last_name . ' ' . $user->first_name,
    //                 'job' => $job->name,
    //                 "milestone"=>'Video Watched',
    //             ];
    //             $creative->notify(new PaymentFinal2($details3));
    //             return redirect()->back()->with('success', 'Your Payment of ' . $wallet->currency->symbol . $data->data->amount . ' was Successful. This Job is now completed');
    //         }

    //     }else{
    //         return redirect()->back()->with('error', $data);
    //     }
    // }

    public function payCallback(Request $request)
    {
        // $response = $request->all();
        dd('callback');
    }
}
