<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Job;
use App\Models\Influencer;
use App\Models\FlutterwaveSubaccount;
use App\Models\Bid;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\Vendor;
use App\Models\Country;

use App\Notifications\JobUpdate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Shetabit\TokenBuilder\Facade\TokenBuilder;
use App\Mail\JobApprovalStatus;

use Twilio\Rest\Client;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? Job::with('vendor', 'budget')->latest()->paginate(50) : abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        // 'name',
        // 'description',
        return $request->ajax() ? Job::where('name', 'like', "%{$data}%")
            ->orWhere('description', 'like', "%{$data}%")
            ->with('vendor', 'budget')
            ->latest()
            ->paginate(20) : abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "email" => ['required', 'email', 'unique:jobs,email'],
            "phone_number" => ['string', 'unique:jobs,phone_number'],
            "last_name" => ['required', 'string', 'max:30'],
            "first_name" => ['required', 'string', 'max:30'],
            "postal_code" => ['required', 'integer', 'max:30'],
            "city" => ['required', 'string', 'max:30'],
            "country_id" => ['required', 'integer', 'max:191'],
        ]);

        $selectedRole = !empty($request['role']) ? $request['role'] : 'General Job';

        $role = Role::where('name', $selectedRole)->first();

        $job = Job::create([
            'last_name' => $request['last_name'],
            'first_name' => $request['first_name'],
            'phone_number' => $request['phone_number'],
            'street_address' => $request['street_address'],
            'status' => $request['status'],
            'city' => $request['city'],
            'postal_code' => $request['postal_code'],
            'facebook' => $request['facebook'],
            'instagram' => $request['instagram'],
            'tiktok' => $request['tiktok'],
            'snapchat' => $request['snapchat'],
            'telegram' => $request['telegram'],
            'twitter' => $request['twitter'],
            'email' => $request['email'],
            'country_id' => $request['country_id'],
            'password' => \Hash::make($request['password']),
            'email_verified_at' => Carbon::now(),
        ]);

        $job->role()->attach($role->id); // role 5 is a general job id
        $newVicommJob = Job::with('role', 'details')->findOrFail($job->id);
        return response()->json(['success' => 'Job created successfully', 'job' => $newVicommJob], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return $request->ajax() ? Job::with('attachment', 'budget', 'payment', 'video', 'vendor', 'currency', 'bids', 'influencer', 'product')->findOrFail($id) : abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmailToUser(int $userId, array $details = [])
    {
        $user = \App\Models\User::find($userId);
        if(isset($details['message'])) {
        \Mail::to($user->email)->send(new JobApprovalStatus($details));
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
        ]);

        $vicommJob = Job::with('vendor')->findOrFail($id);

        // $request['isAwarded'] = $request['isAwarded']? 1: 0;
        // $request['isApproved'] = $request['isApproved']? 1: 0;
        // print_r($request->isAwarded);
        if($request->isApproved == 1 && $vicommJob->isApproved == 2){
            $details = [
                'user' => $vicommJob->vendor->user->first_name . ' ' . $vicommJob->vendor->user->last_name,
                'message' => 'Your Job has been approved!'
            ];
            $this->sendEmailToUser($vicommJob->vendor->user->id, $details);
            // return response()->json(["tests"=>1]);
        }
        $vicommJob->update($request->all());


        return response()->json(['success' => 'Job updated successfully', 'job' => $vicommJob], Response::HTTP_OK);
    }

    public function UpdateVideoTimer(Request $request)
    {
        $this->validate($request, [
            'time' => 'required'
        ]);

        $job = Job::findOrfail($request->id);
        $time = json_encode($request->time);
        $job->video_timer = $time;
        $job->save();
        return response()->json(['message' => 'saved', 'time' => $time]);
    }

    public function updateJobPaymentMilestone(Request $request)
    {
        $this->validate($request, [
            'paymentMilestone'
        ]);

        // dd($request->all());

        $job = Job::findOrfail($request->id);
        $payment_milestone = json_encode($request->paymentMilestone);
        $job->payment_milestone = $payment_milestone;
        $job->save();

        return response()->json(['message' => 'saved', 'job' => $job]);
    }

    public function finalPayment($id)
    {
        $job = Job::where('unique_id', $id)->first();
        $influencer = Influencer::where('user_id', $job->influencer_id)->first();
        $influencer_id = $influencer->id;
        $bid = Bid::where('job_id', $job->id)->first();
        $milestone = (int) unserialize($bid->milestone_data)[1][1];
        $subaccount = FlutterwaveSubaccount::where('user_id', $influencer->user_id)->first();
        $subaccountId =  $subaccount->subaccount_id;
        return view('pages.user.jobs.final-payment', compact('job','milestone','influencer_id','subaccountId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Job = Job::findOrFail($id);

        $Job->delete();

        return response()->json(['success' => 'Job deleted successfully'], Response::HTTP_OK);
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    private function sendMessage($message, $recipient)
    {
        $token = env("TWILIO_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($twilio_sid, $token);
        $client->messages->create(
            $recipient,
            ["messagingServiceSid" => "MG090d805400505d8fa0448b97be60b01b", 'body' => $message]
        );
    }

    public function generateToken(Request $request, Job $job)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();
        $job = Job::where('vendor_id', $vendor->id)->latest()->first();

        $phone_number = Auth::user()->phone_number;
        //retrieve token
        // $token = TokenBuilder::setUniqueId($code)->findValidToken();
        // dd($token->data['job_id']);


        $data = [
            'job_id' => $job->id
        ];
        $tokenObject = $token = TokenBuilder::setData($data)->build();
        $tokenObject->job_id = $job->id;
        $tokenObject->save();

        //Send token to SMS
        // if ($user->isPhoneVerified) {
        //     $this->sendMessage('Use Token to access video ' . $tokenObject->token, $phone_number);
        // }

        // Send token to Email
        $details = [
            'token' => $tokenObject->token,
            'user' => $user->last_name . ' ' . $user->first_name,
            'message' => "Use token to view video uploaded by the creative. Token Expires in 48hrs."
        ];
        $user->notify(new JobUpdate($details));
        // }

        return response()->json(['success' => true, 'message' => 'successful.', 'data' => $tokenObject->token]);



        // generate token

        //send token to vendor's email and sms


        // if (is_null($token)) {
        //     $tk = Str::random(64);
        //     $token = new Token();
        //     $token->token = $tk;
        //     $token->job_id = $job->id;
        //     $token->email = $job->vendor->user->email;
        //     $token->expired_at = null;
        //     $token->save();

        //     // notifying the vendor with the token sent along
        //     $details = [
        //         'token' => $token->token,
        //         'user' => $user->last_name . ' ' . $user->first_name,
        //         'message' => "Use token to view video uploaded by the creative. Token Expires in 48hrs."
        //     ];
        //     $user->notify(new JobUpdate($details));
        // }
    }
}