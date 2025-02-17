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
use App\Models\Portfolio;
use App\Models\Token;
use App\Models\VerifToken;
use App\Models\Activity;
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
use App\Notifications\UserRegistration2;
use Illuminate\Support\Facades\Storage;

class MobileCreative extends Controller
{   

    public function all_jobs(){
        $open = Job::with(["budget:*", 'currency:*', 'product:*'])->where(['isApproved' => Job::APPROVED, 'isAwarded' => Job::NOTAWARDED])->get();
        $awarded = Job::with(["budget:*", 'currency:*', 'product:*'])->where(['isApproved' => Job::APPROVED, 'isAwarded' => Job::AWARDED])->get();
        // $total = Job::with(["budget:*", 'currency:*'])->where(['isApproved' => Job::APPROVED])->get();
        $total = Job::join("vendors", "vendors.id", "jobs.vendor_id")->join("users", "users.id", "vendors.user_id")->where("users.email_verified_at", "!=", null)->with('budget', 'vendor', 'currency', 'bids', 'product')
        ->where(['jobs.isApproved' => Job::APPROVED, 'jobs.isAwarded' => Job::NOTAWARDED])->select("jobs.*")->latest()->paginate(20);
        return response()->json(compact('open', 'awarded', 'total'));
    }

    public function myBids()
    {
        $myBids = Bid::with(["job:*", "job.product"])->where('influencer_id', auth('api')->user()->id)->get();
        return response()->json(compact('myBids'));
    }

    public function myJobs()
    {
        $myBids = Job::with(["budget:*", 'product'])->where('influencer_id', auth('api')->user()->id)->get();
        return response()->json(compact('myBids'));
    }
    public function bidApplication(Request $request, Bid $bid)
    {
        // dd($request->all());
        // return response()->json($request->all());
        $influencer_id = auth('api')->user()->id;
        $user = auth('api')->user();
        $bid_exists = Bid::where([
            "influencer_id" => $influencer_id,
            "job_id" => $request->job_id
        ])->exists();
        $validator = Validator::make($request->all(),[
            'amount' => 'required|integer',
            'duration' => 'required|integer',
            'proposal' => 'required|string',
            'job_id'=>'required|integer',

        ]);

        if($user->email_verified_at == null){
            return response()->json([
                "message"=>"Your Email is not Verified, Please Verify Your Email"
            ], 400);
        }
        if($user->country_id == null){
            return response()->json([
                "message"=>"You have not added your country"
            ], 400);
        }
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
            }
            if($bid_exists){
                return response()->json(["message"=>"You can't Bid Twice on a Job"], 400);
                }
        // $bid = Bid::where("id" $request->bid_id)->first();

        // return response()->json($request->all());
        $data = "a{}";

        if ($request->amount > 0) {

            $initialPay = (int)$request->amount * (0.25); //25 percent of the milstone payment
            $finalPay = (int)$request->amount * (0.75); //75 percent of the milestone payment
            $data = serialize([
                ["Initial Payment", (string)$initialPay],
                ["Final Payment", (string)$finalPay],
            ]);

            // dd([
            //     "Initial Payment" => $initialPay,
            //     "Final Payment" => $finalPay,
            // ]);
        }

        $bid->milestone = false;
        $bid->milestone_data = $data;
        if ($request->milestone_count > 0) {
            $bid->milestone = true;
        }
        $job = Job::where('id', $request->job_id)->first();
        if ($job->isAwarded) {
            return response()->json(['message'=>'This Job Has been awarded to a creative'], 400);
        }
        if ($request->amount < $job->budget->min) {
            return response()->json(['message'=>'Bid amount cannot be less than the budget'], 400);
        } else if ($request->amount > $job->budget->max) {
            return response()->json(['message'=>'Bid amount cannot be greater than the budget'], 400);
        }

        $bid->amount = $request->amount;
        $bid->duration = $request->duration;
        $bid->proposal = $request->proposal;
        $bid->influencer_id = $influencer_id;
        $bid->job_id = $request->job_id;
        $bid->save();

        $job = Job::where('id', $bid->job_id)->first();
        $user = User::where('id', $job->vendor->user_id)->first();

        // Notify vendor that a bid has been placed...
        $details = [
            'url' => route('user.jobs.show', $job->unique_id),
            'message' => 'A bid has been placed on your job, click on the link to view the bids'
        ];
        $user->notify(new BidPlaced($details));

        return response()->json(['message'=>'Proposal submitted successfully']);
    }

    public function viewSkills()
    {
            $skills = Skill::all();
            $influencer_skills = InfluencerDetails::where('user_id', auth('api')->user()->id)->first();
            if(!$influencer_skills){
                $my_skills = [];
                return response()->json(compact('skills', 'my_skills'));  
            }
            $my_skills = json_decode($influencer_skills->influencer_skills);


        // dd($i_skills);

        return response()->json(compact('skills', 'my_skills'));
    }

    public function flutterwaveBanks()
    {
        $response = Http::withToken('FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X')->get('https://api.flutterwave.com/v3/banks/NG');
        $data = json_decode($response);
        return ([$data]);
    }

    public function flutterwaveSubAccount(Request $request, FlutterwaveSubaccount $subaccount)
    {
         $validator = Validator::make($request->all(),[
            'account_bank' => 'required|string',
            'account_number' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
            }
        $details = [];

        $user = User::find(auth("api")->user()->id);
        $country = Country::find($user->country_id);
        if(!$country){
            return response()->json([
            "message"=>"Please add your country and address details"
            ], 403);
        }
        $c = $country->sort;
        $u = $user->last_name . ' ' . $user->first_name;

        $a = array_merge($details, [$c, $u]);

        $response = Http::withToken('FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X')->post('https://api.flutterwave.com/v3/subaccounts', [
            'account_number' => $request->account_number,
            // 'account_bank' => "044",
            'account_bank' => $request->account_bank,
            'business_email' => $request->email,
            'business_name' => $u,
            'business_contact_mobile' => $request->phone_number,
            'country' => $c,
            'split_type' => 'percentage',
            "split_value" => 0.5
        ]);
        if ($response['status'] === 'error') {
            return response()->json([
                'messages' => $response['message'],
            ], 400);
        }

        $subaccount->account_number = $response['data']['account_number'];
        $subaccount->account_bank = $response['data']['account_bank'];
        $subaccount->full_name = $response['data']['full_name'];
        $subaccount->split_type = $response['data']['split_type'];
        $subaccount->split_value = $response['data']['split_value'];
        $subaccount->subaccount_id = $response['data']['subaccount_id'];
        $subaccount->bank_name = $response['data']['bank_name'];
        $subaccount->flutterwave_id = $response['data']['id'];
        $subaccount->user_id = $user->id;
        $subaccount->save();
        // if($user->hasRole('Creative') && Bid::where("influencer_id", auth("api")->user()->id)->count() < 1){

        //     return ([$response, "/jobs"]);
        // }
        // return ($response);
        return response()->json([
            "message"=>"Payment Details Added"
        ]);
    }

    public function deleteSubaccount(Request $request)
    {
        //delete from flutterwave
        $subaccount = FlutterwaveSubaccount::where('id', $request->id)->where('user_id', auth("api")->user()->id)->first();
        $flutterwave_id = $subaccount->flutterwave_id;
        $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->delete("https://api.flutterwave.com/v3/subaccounts/$flutterwave_id");
        $data = json_decode($response);
        //delete from database
        $subaccount = FlutterwaveSubaccount::where('id', $request->id)->where('user_id', auth("api")->user()->id)->first();
        $subaccount->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Subaccount deleted successfully'
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

    public function getPaymentDetails()
    {
        $subaccount = FlutterwaveSubaccount::where('user_id', Auth('api')->user()->id)->get();
        // dd($subaccount);
        // if (is_null($subaccount)) {
        //     $subaccount = new FlutterwaveSubaccount;
        //     $subaccount->user_id = auth("api")->user()->id;
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
            'user_id' => auth("api")->user()->id
        ], 200);
    }

    public function portfolioUpload(Request $request, Portfolio $video)
    {


 



        if ($request->hasFile('file')) {


            // $file = $request->video_file;
            // $filename = $file->getClientOriginalName();
            // $filename = time() . '_' . $filename;
            $video_path =  $request->file('file')->store('jobs-video', 's3');

            Storage::disk('s3')->setVisibility($video_path, 'public');
        }

        if ($request->hasFile('video_thumb')) {
            $file = $request->video_thumb;
            $filename = $file->getClientOriginalName();
            $filename = time() . '_' . $filename;
            $thumb_path =  $request->file('video_thumb')->store('video-thumbnail', 's3');

            //$thumb_path =  $request->file('video_file')->store('video-thumbnail', 's3', $filename);
            Storage::disk('s3')->setVisibility($thumb_path, 'public');
        }

// return response()->json(['test'=> $request->all()]);
        $video = new Portfolio();
        $video->name  = $request->video_title;
        $video->description  = $request->video_desc;
        $video->thumbnail  = Storage::disk('s3')->url($thumb_path);;
        $video->file = Storage::disk('s3')->url($video_path);
        $video->user_id = auth('api')->user()->id;
        $video->views = $request->video_views;
        $video->link = $request->video_link;
        $video->channel = "WEB";
        $video->for_kids = $request->for_kids;
        $video->save();



        //create new Activity
        $activity = new Activity;
        $activity->type = 'portfolio_upload';
        $activity->name = 'Portfolio Update';
        $activity->description = 'You Added a new item to your portfolio';
        $activity->user_id = auth('api')->user()->id;
        $activity->url = '/settings';
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'creative';
        $activity->save();

        return response()->json([
            "message"=>"you have succesfully added an item to your portfolio"
        ]);
    }
    public function portfolio(){
        $portfolio = Portfolio::where("user_id", auth('api')->user()->id)->orderBy("id", "DESC")->get();
        return response()->json(["porfolio"=>$portfolio]);
    }

    public function removeBid(Request $request){
        $job = Job::where("id", $request->jobid)->where("isAwarded", 0)->first();
        
        if(!$job){
            return response()->json(['message'=>"This Job Has been Awarded"], 400);
        }
        $bid = Bid::where('influencer_id', auth('api')->user()->id)->where("job_id", $request->jobid)->first();
        // if($job->isAwarded){
        //     return response()->json(['message'=>"This Job Failed to delete as it has been awarded."], 400);
        // }

        $bid->delete();
        $logged = auth('api')->user();
        broadcast(new NewBid($logged, $job))->toOthers();
        return response()->json(["message"=>"Bid Removed Successful"]);


    }
}
