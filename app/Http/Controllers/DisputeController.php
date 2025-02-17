<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\disputeMessage;
use App\Models\FlutterwaveSubaccount;
use App\Models\GeneralWallet;
use App\Models\GeneralWalletTransaction;
use App\Models\Milestone;
use App\Models\Mitigation;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\NewDispute;
use App\Notifications\NewDisputeMessage;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Dispute;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\NewPay;
use Illuminate\Support\Facades\DB;
use App\Models\PivotDispute;
use App\Events\NewDisputeMsg;


class DisputeController extends Controller
{
    public function index(Request $request)
    {
        //check if mechant has a dispute
        $job_id = $request->job_id;

        //check if $job_id is sent in request
        if (!$job_id) {
            return redirect()->route('user.dashboard')->with('swal-error', 'Invalid Request, Use Appropriate Channels');
        }

        $job = Job::where('id', $job_id)->first();
        $actor_id = Auth::user()->id;
        $role = Auth::user()->role;

        //return back if user can't partake in dispute
        if ($job->vendor->user_id != $actor_id && $job->influencer->id != $actor_id && !Auth::user()->hasRole('admin')) {
            return redirect()->back()->with('swal-error', 'You cannot participate in this dispute; You may need to switch roles');
        }

        // check if dispute exists in the records
        $check = $this->isDisputeExist($request->job_id);
        if ($check['status']) {

            //redirect to the stage of the dispute module.
            if ($check['data'] !== NULL) {
                $stage = $check['data']->stage;
                switch ($stage) {
                    case 'two':
                        $current_stage = 'Two';
                        break;
                    case 'three':
                        $current_stage = 'Three';
                        break;
                    case 'four':
                        $current_stage = 'Four';
                        break;
                    default:
                        $current_stage = 'One';
                        break;
                }

                $route = 'stage' . $current_stage;

                return $this->$route($request->job_id);
                // return redirect()->route('user.dispute.'. $current_stage, ['dispute_id'=> $check['data']->id, 'job_id' => $request->job_id]);
            } else {
                return view('pages.user.dispute.start', compact('job_id'));
            }

        }
        return view('pages.user.dispute.start', compact('job_id'));


        if ($role[0] == '45' && count($role) == 1) {
            return redirect()->route('user.dashboard');
        }
    }

    public function stageTwo($job_id)
    {
        $job = Job::find($job_id);
        $dispute = Dispute::where('job_id', $job_id)->first();
        $messages = $dispute->disputeMessage()->get();

        return view('pages.user.dispute.stage-two')->with(['job_id' => $job_id, 'dispute' => $dispute, 'messages' => $messages, 'job' => $job]);
    }

    public function set_dispute_three(Request $request, $id)
    {
        $dispute = Dispute::find($id);
        $dispute->stage = 'three';
        $dispute->settlement_amount = htmlentities($request->amount);
        $job_id = $dispute->job_id;
        $dispute->save();
        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
    }

    public function back_dispute_two(Request $request, $id)
    {
        $dispute = Dispute::find($id);
        $dispute->stage = 'two';
        $dispute->settlement_amount = null;
        $job_id = $dispute->job_id;
        $dispute->save();
        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
    }

    public function stageThree($job_id)
    {
        $job = Job::find($job_id);
        $dispute = Dispute::where('job_id', $job_id)->first();
        $milestone = Milestone::where(['paid' => '0', 'job_id' => $job_id])->first();
        $mitigation = Mitigation::where(['status'=>'open', 'dispute_id'=>$dispute->id])->first();

        return view('pages.user.dispute.stage-three')->with(['dispute' => $dispute, 'job' => $job, 'job_id' => $job->id, 'milestone' => $milestone, 'mitigation'=>$mitigation]);
    }

    public function stageFour($job_id)
    {
        $job = Job::find($job_id);
        $dispute = $job->dispute;
        $mitigation = Mitigation::where(['status'=>'closed', 'dispute_id'=>$dispute->id])->first();

        return view('pages.user.dispute.stage-four')->with(['dispute'=>$dispute, 'mitigation'=>$mitigation, 'job'=>$job]);
    }

    public function register_dispute(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'job_id' => 'required',
        ]);

        $user = Auth::user();

        $dispute = new Dispute;
        $job = Job::find($request->job_id);
        $job_id = $job->id;
        $dispute->initial_message = $request->message;
        $dispute->influencer_id = $job->influencer_id;
        $dispute->job_id = $request->job_id;
        $dispute->title = $job->name;
        $dispute->stage = 'two';

        $message = new disputeMessage;
        $message->message = $request->message;

        if ($job->vendor->user_id == $user->id) {
            $message->sender = 'Vendor';
        } elseif ($job->influencer_id == $user->id) {
            $message->sender = 'Influencer';
        }
        $message->user_id = $user->id;

        $dispute->save();

        $message->dispute_id = $dispute->id;
        $message->save();

        //mail sending

        //send mail here to influencer
        $details = [
            'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
            'user' => $job->influencer->last_name . ' ' . $job->influencer->first_name,
            'message' => 'A dispute process was started by the vendor for job ' . $job->name . '; click on the button below to join the dispute discussion.'
        ];
        $job->influencer->notify(new NewDispute($details));

        // Send mail to vicomma admin
        $admin = User::where("id", RoleUser::where("id", 1)->first()->id)->first();

        $details2 = [
            'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
            'user' => $admin->last_name . ' ' . $admin->first_name,
            'message' => 'A dispute process was started by the vendor for job ' . $job->name . '; click on the button below to join the dispute discussion. You are getting this mail because you are a vicomma admin'
        ];

        $admin->notify(new NewDispute($details2));



        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
        // return response()->json([ 'status' => 'success', 'message' => 'Dispute registered successfully!']);
    }

    public function register_dispute_message(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'job_id' => 'required',
        ]);

        $user = Auth::user();
        $job = Job::find($request->job_id);
        $job_id = $job->id;
        $dispute = Dispute::where('job_id', $request->job_id)->with("disputeMessage", 'disputeMessage.user')->first();

        // Send mail to vicomma admin
        $admin = User::where("id", RoleUser::where("id", 1)->first()->id)->first();

        $message = new disputeMessage;
        $message->message = $request->message;

        if ($job->vendor->user_id == $user->id) {
            $message->sender = 'Vendor';
            $person_to_receive = User::where("id", $job->influencer_id)->first();

        } elseif ($job->influencer_id == $user->id) {
            $message->sender = 'Influencer';
            $person_to_receive = $job->vendor->user;

        } elseif ($user->id == $admin->id) {
            $message->sender = 'Admin';
            $person_to_receive = User::where("id", $job->influencer_id)->first();
            $person_to_receive2 = $job->vendor->user;
        }

        $message->user_id = $user->id;
        $message->dispute_id = $dispute->id;
        $message->save();


        //mail sending starts

        //send mail here to influencer or vendor
        $details = [
            'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
            'user' => $person_to_receive->last_name . ' ' . $person_to_receive->first_name,
            'message' => 'A new message sent in discussion for dispute ' . $job->name . '; click on the button below to join the dispute discussion.'
        ];
        $person_to_receive->notify(new NewDisputeMessage($details));


        if ($user->id == $admin->id) {

            $details2 = [
                'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
                'user' => $person_to_receive2->last_name . ' ' . $person_to_receive2->first_name,
                'message' => 'A new message sent in discussion for dispute ' . $job->name . '; click on the button below to join the dispute discussion.'
            ];
            $person_to_receive2->notify(new NewDisputeMessage($details2));

        } else {

            $details2 = [
                'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
                'user' => $admin->last_name . ' ' . $admin->first_name,
                'message' => 'A new message sent in discussion for dispute ' . $job->name . '; click on the button below to join the dispute discussion.'
            ];
            $admin->notify(new NewDispute($details2));
        }

        broadcast(new NewDisputeMsg($user, $dispute))->toOthers();

        //mail sending ends

        // return $this->stageTwo($request->job_id);
        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
        // return response()->json([ 'status' => 'success', 'message' => 'Dispute registered successfully!']);
    }

    private function isDisputeExist($job_id)
    {
        try {
            $dispute = Dispute::where('job_id', $job_id)->first();
            return ['status' => true, 'data' => $dispute];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ['status' => false, 'data' => NULL];
        }

    }

    public function get_dispute_details($id)
    {
        // dd($id);
        $dispute = Dispute::find($id);
        // dd($dispute);
        return response()->json(['status' => 'success', 'data' => $dispute]);
    }

    public function cancel_dispute($id)
    {
        $dispute = Dispute::find($id);
        $dispute->status = 'cancelled';
        $job_id = $dispute->job_id;
        $dispute->save();

        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
    }

    public function mitigate_dispute($id)
    {
        $dispute = Dispute::find($id);
        $dispute->status = 'mitigated';
        $job_id = $dispute->job_id;
        $job = Job::find($job_id);

        $logged = Auth::user();
        $milestone = Milestone::where(['paid' => '0', 'job_id' => $job_id])->first();
        $dispute->stage = 'three';
        $dispute->settlement_amount = 0;

        if ($milestone) {

            if ($logged->id == $job->vendor->user_id) {
                $dispute->settlement_amount = $milestone->amt_due * 0.25;
            } else {
                $dispute->settlement_amount = $milestone->amt_due * 0.15;
            }
        }

        $dispute->save();
        return redirect()->route('user.dispute.arbitration', compact(['job_id']));
    }

    public function resolve_dispute($id)
    {
        $dispute = Dispute::find($id);
        $dispute->status = 'dropped';
        $job_id = $dispute->job_id;

        $job = Job::find($job_id);

        $dispute->save();

        //send mail here to influencer
        $details = [
            'url' => route('user.jobs.show', $job->unique_id),
            'user' => $job->influencer->last_name . ' ' . $job->influencer->first_name,
            'message' => 'Dispute process for job ' . $job->name . ' has been dropped by the vendor.'
        ];
        $job->influencer->notify(new NewDisputeMessage($details));

        // Send mail to vicomma admin
        $admin = User::where("id", RoleUser::where("id", 1)->first()->id)->first();

        $details2 = [
            'url' => route('user.jobs.show', $job->unique_id),
            'user' => $admin->last_name . ' ' . $admin->first_name,
            'message' => 'Dispute process for job ' . $job->name . ' has been dropped by the vendor.'
        ];

        $admin->notify(new NewDisputeMessage($details2));

        return redirect()->route('user.jobs.show', $job->unique_id);
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

    public function pay_mitigation(Request $request)
    {
        $amount = $request->amt;
        $dispute_id = $request->dispute_id;


        if(!$amount  || !$dispute_id ){
            return back()->with('swal-error', 'Use appropriate channels to access route');
        }

        $dispute = Dispute::find($dispute_id);
        $user = auth()->user();
        $gwallet = Wallet::where('job_id', $dispute->job_id)->first();

        $general_wallet = GeneralWallet::where('user_id', $user->id)->first();
        $tx_ref = self::getRandomString(12);

        //check if user has money on his platform wallet
        if($general_wallet && $general_wallet->balance >= $amount){
            //reduce from general wallet instead of flutterwave

            $general_wallet->balance -= $amount;

            //create new Mitigation
            $mitigation = new Mitigation;
            $mitigation->payment_ref = $tx_ref;
            $mitigation->dispute_id = $dispute_id;
            $mitigation->title = 'Mitigation for job (' . $dispute->job->name . ')';
            $mitigation->mitigation_amount = $amount;
            $mitigation->save();

            //create transaction
            $transaction = new GeneralWalletTransaction;
            $transaction->name = 'Mitigation Payment for job' . $dispute->job->name;
            $transaction->desc = 'Mitigation Payment for job' . $dispute->job->name;
            $transaction->tx_ref = $mitigation->tx_ref;
            $transaction->amount = $amount;
            date_default_timezone_set($user->timezone);
            $transaction->time = date("h:ia");
            $transaction->date = date("d F Y");
            $transaction->type = 'Dispute mitigation';
            $transaction->currency_id = $gwallet->currency_id;
            $transaction->status = 'successful';
            $transaction->user_id = auth()->user()->id;
            $transaction->save();

            $general_wallet->save();

            $job = $mitigation->dispute->job;

            return redirect(route('user.dispute.arbitration', ['job_id' => $job->id]))->with('success', 'Transaction successful. ' . $gwallet->currency->symbol . $transaction->amount . ' has been paid for mitigation');

        }


        $payment_method = "card,account,ussd,mpesa,qr,PayPal,credit,paga,mobilemoneytanzania,mobilemoneyzambia,mobilemoneyrwanda,mobilemoneytanzania,payattitude,barter";


        $payload = [
            "tx_ref" => $tx_ref,
            "amount" => $amount,
            "currency" => 'USD',
            "payment_options" => $payment_method,
            "redirect_url" => route('user.dispute.mitigation.callback'),
            "customer" => [
                "name" => $user->first_name . ' ' . $user->last_name,
                "email" => $user->email,
                "phone" => $user->phone_number,
            ],
            "customizations" => [
                "title" => 'Vicomma Mitigation Fee Payment for job ' . $dispute->job->name.'.',
                "description" => 'Vicomma Mitigation Fee Payment for job' . $dispute->job->name.' by '.$user->first_name . ' ' . $user->last_name . '.',
                "logo" => "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                "color" => "#2ecc71"
            ]
        ];

        $pending_mitigations = Mitigation::where(['status'=>'pending', 'dispute_id' => $dispute_id])->get();

        foreach($pending_mitigations as $miti){
            $miti->delete();
        }

        //create new Mitigation
        $mitigation = new Mitigation;
        $mitigation->payment_ref = $tx_ref;
        $mitigation->dispute_id = $dispute_id;
        $mitigation->title = 'Mitigation for job (' . $dispute->job->name . ')';
        $mitigation->mitigation_amount = $amount;
        $mitigation->save();

        //create transaction
        $transaction = new GeneralWalletTransaction;
        $transaction->name = 'Mitigation Payment for job' . $dispute->job->name;
        $transaction->desc = 'Mitigation Payment for job' . $dispute->job->name;
        $transaction->tx_ref = $tx_ref;
        $transaction->amount = $amount;
        date_default_timezone_set($user->timezone);
        $transaction->time = date("h:ia");
        $transaction->date = date("d F Y");
        $transaction->type = 'Dispute mitigation';
        $transaction->currency_id = $gwallet->currency_id;
        $transaction->status = 'pending';
        $transaction->user_id = auth()->user()->id;
        $transaction->save();

        $response = Http::withToken("FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X")->post('https://api.flutterwave.com/v3/payments', $payload);
        $data = json_decode($response);

        // dd($data);
        $link = $data->data->link;

        return redirect($link);
    }

    public function callback_self_mitigation(Request $request)
    {
        $response = $request->all();
        $transaction = GeneralWalletTransaction::where('tx_ref', $response['tx_ref'])->first();
        $mitigation = Mitigation::where('payment_ref', $response['tx_ref'])->first();
        $user = auth()->user();
        $gwallet = Wallet::where('job_id', $mitigation->dispute->job_id)->first();

        $job = $mitigation->dispute->job;

        // dd([$transaction, $response]);
        if ($transaction->status == 'completed') {
            // dd('Transaction already completed');
            return redirect(route('user.dispute.arbitration', ['job_id' => $job->id]))->with('swal-error', 'Transaction already completed');
        }

        if ($response['status'] == 'successful') {
            $transaction->status = 'successful';
            $transaction->save();

            //Update Wallet Balance
            // $gwallet->balance = $gwallet->balance + $transaction->amount;
            // $gwallet->save();

            //update Mitigation
            $mitigation->status = 'open';
            $mitigation->save();

            //create new Activity
            $activity = new Activity;
            $activity->type = 'Mitigation Payment';
            $activity->name = 'Mitigation payment for job (' . $job->name . ')';
            $activity->description = 'You have paid mitigation fees of: <b>' . $transaction->amount . ' for dispute on job (' . $job->name . ') </b>';
            $activity->user_id = $user->id;
            $activity->url = route('user.dispute.arbitration', ['job_id' => $job->id]);
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'user';
            $activity->save();

            //Create General Notification
            $details = [
                'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
                'user' => $user->last_name . ' ' . $user->first_name,
                'job' => $transaction->name,
                "currency" => $gwallet->currency->symbol,
                "amount" => "$transaction->amount"
            ];
            $user->notify(new NewPay($details));


            // Send mail to vicomma admin
            $admin = User::where("id", RoleUser::where("id", 1)->first()->id)->first();

            $details2 = [
                'url' => route('user.jobs.show', $job->unique_id),
                'user' => $admin->last_name . ' ' . $admin->first_name,
                'message' => 'A mitigation payment has been made for job ' . $job->name . '; click on the button below to see job details. You are getting this mail because you are a vicomma admin'
            ];

            $admin->notify(new NewDispute($details2));
        } else {
            $transaction->status = 'failed';
            $transaction->save();
            return redirect(route('user.dispute.arbitration', ['job_id' => $job->id]))->with('swal-error', 'Your transaction was not successful. Please try again');
        }
        return redirect(route('user.dispute.arbitration', ['job_id' => $job->id]))->with('success', 'Transaction successful. ' . $gwallet->currency->symbol . $transaction->amount . ' has been paid for mitigation');

    }
}
