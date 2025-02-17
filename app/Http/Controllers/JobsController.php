<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\v1\JobController;
use App\Models\Attachment;
use App\Models\Bid;
use App\Models\Budget;
use App\Models\Job;
use App\Models\Category;
use App\Models\Currency;
use App\Models\InfluencerDetails;
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
use App\Models\Role;
use App\Models\Wallet;
use App\Models\CreativeRating;
use App\Notifications\BidPlaced;
use App\Notifications\Bids;
use App\Notifications\JobAwardNotification;
use App\Notifications\JobAwardNotification2;
use App\Notifications\UploadContent;
use App\Notifications\VideoGuidelines;
use App\Notifications\UploadContent2;
use App\Notifications\JobUpdate;
use App\Models\Notification;
use App\Models\GeneralNotification;
//use Dawson\Youtube\Facades\Youtube;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Events\NewBid;
use App\Events\BidAccepted;
use App\Events\ContentUploaded;
use App\Events\NewGeneralNotification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Shetabit\TokenBuilder\Facade\TokenBuilder;

use App\Http\Controllers\api\v1\JobController as JobManagmentController;
use App\Models\Activity;
use App\Models\VendorRating;
use Shetabit\TokenBuilder\Models\Token;

use stdClass;

class JobsController extends Controller
{
    public function general()
    {
        if (Auth::check()) {
            $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        } else {
            $vendor = '';
        }

        $budgets = Budget::all();
        $currencies = Currency::all();
        $categories = Category::all();


        return view('pages.user.jobs.general', compact('budgets', 'currencies', 'categories', 'vendor'));
    }

    public function general_info()
    {


        return view('pages.user.jobs.video');
    }

    public function general_2($id)
    {
        $user = DB::table("users")->where("id", $id)->first();
        if(!$user){
            return redirect("/");
        }
        if (Auth::check()) {
            $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        } else {
            $vendor = '';
        }

        $budgets = Budget::all();
        $currencies = Currency::all();
        $categories = Category::all();


        return view('pages.user.jobs.general_ref', compact('budgets', 'currencies', 'categories', 'vendor', 'user'));
    }

    public function index()
    {
        $vendor_id = Auth::user()->vendor->id;
        $budgets = Budget::all();
        $currencies = Currency::all();
        $categories = Category::all();

        // selecting Products that does not have jobs created for them already
        $jobs = Job::pluck('product_id')->all();
        //show approved products only
        $products = Product::where(['status' => Product::APPROVED, 'vendor_id' => $vendor_id])->whereNotIn('id', $jobs)->select('id', 'name', 'unique_id')->latest()->get();

        return view('pages.user.jobs.index', compact('budgets', 'currencies', 'categories', 'products'));
    }

    public function jobs()
    {
        //only approved jobs will show
        //$completed_jobs = Job::where(['vendor_id'=> $vendor_id->id, 'isCompleted' => Job::COMPLETED])->get();
        $open = Job::join("vendors", "vendors.id", "jobs.vendor_id")->join("users", "users.id", "vendors.user_id")->where("users.email_verified_at", "!=", null)->where(['jobs.isApproved' => Job::APPROVED, 'jobs.isAwarded' => Job::NOTAWARDED])->count();
        $awarded = Job::join("vendors", "vendors.id", "jobs.vendor_id")->join("users", "users.id", "vendors.user_id")->where("users.email_verified_at", "!=", null)->where(['jobs.isApproved' => Job::APPROVED, 'jobs.isAwarded' => Job::AWARDED])->count();
        $total = Job::join("vendors", "vendors.id", "jobs.vendor_id")->join("users", "users.id", "vendors.user_id")->where("users.email_verified_at", "!=", null)->where(['jobs.isApproved' => Job::APPROVED])->count();
        return view('pages.user.jobs.jobs', compact('open', 'awarded', 'total'));
    }

    public function jobsList()
    {
        return Job::join("vendors", "vendors.id", "jobs.vendor_id")->join("users", "users.id", "vendors.user_id")->where("users.email_verified_at", "!=", null)->with('budget', 'vendor', 'currency', 'bids')
            ->where(['jobs.isApproved' => Job::APPROVED, 'jobs.isAwarded' => Job::NOTAWARDED])->select("jobs.*")->latest()->paginate(20);
    }

    public function jobsListSearch(Request $request, $data)
    {
        // 'name',
        // 'description',
        // return Job::with('budget', 'vendor', 'currency', 'bids')->latest()->paginate(20);
        return  Job::with('budget', 'vendor', 'currency', 'bids')
            ->where('isApproved', Job::APPROVED)
            ->where('name', 'like', "%{$data}%")
            ->orwhere('description', 'like', "%{$data}%")
            ->orwhereHas('budget', function ($query) use ($data) {
                $query->where('budgets.name', 'like', "%{$data}%");
            })
            ->orwhereHas('vendor', function ($query) use ($data) {
                $query->where('vendors.vendor_station', 'like', "%{$data}%");
            })
            ->latest()
            ->paginate(20);
    }

    public function jobsListAdvancedSearch(Request $request)
    {
        $data = $request->only(
            'category_id',
            'budget_id',
            'residule_payment',
            'search_keyword',
        );

        $category_id = $data['category_id'];
        $budget_id = $data['budget_id'];
        $residule_payment = $data['residule_payment'];
        $search_keyword = $data['search_keyword'];

        // var_dump($category_id);
        // var_dump($budget_id);
        // var_dump($residule_payment);
        // var_dump($search_keyword);

        // return  DB::table('jobs')
        return Job::with('budget', 'vendor', 'currency', 'bids', 'product')
            ->when($budget_id, function ($query, $budget_id) {
                return $query->where('budget_id', $budget_id);
            })
            ->when($search_keyword, function ($query, $search_keyword) {
                return  $query->where('name', 'like', "%{$search_keyword}%")->orwhere('description', 'like', "%{$search_keyword}%");
            })
            ->when($residule_payment, function ($query, $residule_payment) {
                return $query->whereNotNull('payment_id');
            })
            // ->when($category_id, function ($query, $category_id) {
            //     return $query->whereHas('product', function ($query) use ($category_id) {
            //         $query->where('products.category_id', $category_id);
            //     });
            // })
            // ->with('budget', 'vendor', 'currency', 'bids','product')
            ->latest()
            ->paginate(20);
    }

    public function jobsCategories()
    {
        return Category::latest()->paginate(20);
    }

    public function jobsBudgets()
    {
        return Budget::latest()->paginate(20);
    }

    public function delete_job(Request $request){
        
        $job = Job::where('id', $request->id)->first();
        if(!$job){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }
        if(Auth::user()->hasRole('vendor') && $job->vendor->user_id != Auth::user()->id){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }

        if(Auth::user()->hasRole('creative')){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }
        if($job->isAwarded){
            return response()->json(['message'=>"This Job Failed to delete as it has been awarded."], 400);
        }

        $job->delete();
        return response()->json(["message"=>"Job Deletion Successful"]);


    }
    public function removeBid(Request $request){
        $job = Job::where("id", $request->jobid)->where("isAwarded", 0)->first();
        
        if(!$job){
            return response()->json(['message'=>"This Job Has been Awarded"], 400);
        }
        $bid = Bid::where('influencer_id', $request->id)->where("job_id", $request->jobid)->first();
        // if($job->isAwarded){
        //     return response()->json(['message'=>"This Job Failed to delete as it has been awarded."], 400);
        // }

        $bid->delete();
        $logged = Auth::user();
        broadcast(new NewBid($logged, $job))->toOthers();
        return response()->json(["message"=>"Bid Removed Successful"]);


    }
    public function jobsShow($job)
    {
        $job = Job::where('unique_id', $job)->first();
        // dd(["vrndro"=>Auth::user()->hasRole('vendor'), 'creative'=>Auth::user()->hasRole('creative'), 'user_id'=>Auth::user()->id, "vendor_id"=>$job->vendor->user_id]);
        if (Auth::user()->hasRole('vendor') && Auth::user()->hasRole('creative') && $job->isAwarded && $job->vendor->user_id != Auth::user()->id && Auth::user()->id !== $job->influencer->id){
            return redirect('/jobs')->with('swal-info', 'This job has been awarded to another Creative.
            There are plenty others to bid on so stand by!!');
        }
        else if (Auth::user()->hasRole('creative') && !Auth::user()->hasRole('vendor') && $job->isAwarded && Auth::user()->id !== $job->influencer->id){
            return redirect('/jobs')->with('swal-info', 'This job has been awarded to another Creative.
            There are plenty others to bid on so stand by!!!!');
        }else if(Auth::user()->hasRole('vendor') && !Auth::user()->hasRole('creative') && $job->isAwarded && $job->vendor->user_id !=  Auth::user()->id){
            return redirect('/jobs')->with('swal-info', "You cannot view this job as it has been awarded");
        }

        $hasBid = DB::table('bids')
            ->where('job_id', $job->id)
            ->where('influencer_id', Auth::user()->id)
            ->first();
        // dd($hasBid);
        $bids = Bid::where('job_id', $job->id)->latest()->paginate(15);

        $amt = array();
        foreach ($bids as $bid) {
            array_push($amt, $bid->amount);
        }
        if (count($bids) > 0) {
            $bidAverage = array_sum($amt) / count($bids);
        } else {
            $bidAverage = 0;
        }
        $attachments = Attachment::where('job_id', $job->id)->latest()->get();
        $files = [];
        $users = User::whereIn('id', $attachments->pluck('uploaded_by'))->select('id', 'first_name', 'last_name')->get();

        foreach ($attachments as $attach) {
            $file = json_decode($attach->file);
            $ext = json_decode($attach->format);
            foreach ($file as $index => $f) {
                if (Storage::disk('s3')->exists($f)) {
                    $p = $users->where("id", $attach->uploaded_by)->first();
                    $at = new stdClass();
                    $at->name = basename(explode('/', $f)[1], '.' . $ext[$index]);
                    $at->size = Storage::disk('s3')->size($f) / 1024;
                    $at->user = $p->first_name . " " . $p->last_name;
                    $at->created_at = $attach->created_at;
                    $at->link = str_replace("/", "@", $f);
                    array_push($files, $at);
                }
            }
        }
        $wallet = Wallet::where('job_id', $job->id)->first();

        // dd($wallet);
        if($job->isAwarded && $wallet){
            $milestones = Milestone::where('job_id', $job->id)->get();
            $paid_m = Milestone::where('job_id',$job->id)->where(['completed'=>'1', 'paid'=>'1'])->sum('amt_due');



            $milestone_video = Milestone::where('job_id', $job->id)->where('name', 'Video Watched')->first();



            $pay = Milestone::where('job_id',$job->id)->where(['completed'=>'1', 'paid'=>'0'])->first();

            $percentage = [$wallet->twenty_five, $wallet->fifty, $wallet->seventy_five, $wallet->hundred];
            $total = array_sum($percentage);

            $twenty_five = '0'; $fifty = '0'; $seventy_five = '0'; $hundred = '0';

            if($total == '25'){ $hundred = '1'; }
            if($total == '50'){ $seventy_five = '1'; $hundred = '1'; }
            if($total == '75'){ $fifty = '1'; $seventy_five = '1'; $hundred = '1'; }
            if($total == '100'){ $twenty_five = '1'; $fifty = '1'; $seventy_five = '1'; $hundred = '1'; }
        }else{
            $milestone_video = null;
            $milestones = null;
            $pay = null;
            $paid_m = null;
            $twenty_five = '0'; $fifty = '0'; $seventy_five = '0'; $hundred = '0';
        }

        $rated_creative = CreativeRating::where(['job_id'=> $job->id, 'vendor_id' => $job->vendor_id])->first();
        $rated_vendor = VendorRating::where(['job_id'=> $job->id, 'vendor_id' => $job->vendor_id])->first();
        $video = VideoContent::where('job_id', $job->id)->first();
        if(isset($video->file)) {
            $b64_enc = base64_encode($video->file);
            $rev_b64_enc = strrev($b64_enc).'%'.base64_encode('fire_and_forget_ms');

            $video->file = $rev_b64_enc;
        }

        $token = DB::table('tokens')->where('job_id', $job->id)->latest()->first();
        $users = User::whereIn('id', $job->bids->pluck('influencer_id'))->select('id', 'first_name', 'last_name')->get();


        if (Auth::user()->hasRole('creative') || Auth::user()->hasRole('vendor') ||  Auth::user()->hasRole('admin')) {
            if (Auth::user()->hasRole('vendor') && !$job->isAwarded || Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id ) {
                return view('pages.user.jobs.show', compact('job', 'rated_creative', 'rated_vendor', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'milestone_video', 'token', 'users', 'wallet', 'milestones', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred' , 'paid_m'));
            } else if (Auth::user()->hasRole('creative') && !$job->isAwarded) {
                return view('pages.user.jobs.show', compact('job', 'rated_creative','rated_vendor', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'milestone_video', 'token', 'users', 'wallet', 'milestones', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred' , 'paid_m'));
            } else if (Auth::user()->hasRole('creative') && $job->isAwarded && Auth::user()->id === $job->influencer->id) {
                return view('pages.user.jobs.show', compact('job', 'rated_creative','rated_vendor', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'milestone_video', 'token', 'users', 'wallet', 'milestones', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred' , 'paid_m'));
            } else {
                return view('pages.user.jobs.show', compact('job', 'rated_creative','rated_vendor', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'milestone_video', 'token', 'users', 'wallet', 'milestones', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred' , 'paid_m'));
            }
        } else {
            return redirect()->back();
        }
        // dd($token);
        // return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));

        // $video = VideoContent::where('job_id', $job->id)->first();
        // $token = DB::table('tokens')->where('job_id', $job->id)->latest()->first();
        // $users = User::whereIn('id', $job->bids->pluck('influencer_id'))->select('id', 'first_name', 'last_name')->get();

        // if (Auth::user()->hasRole('creative') || Auth::user()->hasRole('vendor')) {
        //     if (Auth::user()->hasRole('vendor') && !$job->isAwarded || Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id ) {
        //         return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));
        //     } else if (Auth::user()->hasRole('creative') && !$job->isAwarded) {
        //         return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));
        //     } else if (Auth::user()->hasRole('creative') && $job->isAwarded && Auth::user()->id === $job->influencer->id) {
        //         return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));
        //     } else {
        //         return redirect()->back();
        //     }
        // } else {
        //     return redirect()->back();
        // }
        // dd($token);
        // return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));
    }

    public function checkIfInit($query)
    {
        if ($query) {
            $result = Chat::where('pairing', $query)->first();
            return (is_null($result)) ? false : true;
        }
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
        if($country){

            $currency = DB::table("currencies")->where("country_code", $country->sort)->first();
            if($currency){
                return $currency->id;
            }else {
                return 231;
            }
        }else{
            return 231;
        }
    }
    public function createJob(Request $request, Job $job, Attachment $attachment)
    {
        $user = Auth::user();
        $vendor_id = $user->vendor->id;

        if ($request->payment == 'residule') {
            // dd("Residule");
            $payment = 2;
            $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:8000',
                'payment' => 'required',
                'category' => 'required',
            ]);
            $job->budget_id = NULL;
        } else {
            $payment = 1;
            $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:8000',
                'payment' => 'required',
                'budget' => 'required',
            ]);
            $job->budget_id = $request->budget;
        }

        $job->name = $request->title;
        $job->description = $request->description;
        $job->currency_id = "97";
        $job->payment_id = $payment;
        // $job->budget_id = $request->budget;
        $job->isApproved = 0; // 0 = in progress 1 = Completed
        $job->isAwarded = 0;
        $job->duration = $request->job_duration;
        $job->type = $request->type;
        $job->experience_level = $request->experience_level;
        $job->vendor_id = $vendor_id;
        $job->product_id = $request->product_id;
        $job->content_type = json_encode($request->content_type);
        if($request->has('prod_delivery')){
            $job->product_delivery_method = $request->prod_delivery;
        }else{
            $job->product_delivery_method = 'none';
        }
        $job->unique_id = rand();
        $job->save();

        //create new general notification to influencers

        $noti = new GeneralNotification;
        $noti->receivers = 'influencer';
        $noti->type = 'job';
        $noti->type_id = $job->id;
        $noti->message = $job->name;
        $noti->save();

        //broadcast pusher notification alert here.
        broadcast(new NewGeneralNotification($user, $noti))->toOthers();

        //create activity log
        $activity = new Activity;
        $activity->type = 'job_add';
        $activity->name = 'Job Created';
        $activity->description = 'You created a new Job with the name <b>(' . $job->name . ')</b>';
        $activity->user_id = $user->id;
        $activity->url = '/jobs/details/'. $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        $docs = [];
        $format = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents')  as $file) {
                $filename = $file->getClientOriginalName();
                $filename = str_replace(["_", " ", "@", "/"], "-", $filename);
                $filename = time() . '_' . $filename;
                //$file->StoreAs('public'.DIRECTORY_SEPARATOR.'attachments', $filename);
                $file->storePubliclyAs('jobs-attachment', $filename, 's3');
                //$path = Storage::disk('s3')->url($path);
                $docs[] = "jobs-attachment/" . $filename;
                $format[] = $file->extension();
            }
        }

        // Attachment::insert($insert);
        $attachment->name = $user->vendor->vendor_station . ' ' . 'file';
        $attachment->file = json_encode($docs);
        $attachment->format = json_encode($format);
        $attachment->job_id = $job->id;
        $attachment->vendor_id = $vendor_id;
        $attachment->uploaded_by = Auth::user()->id;
        $attachment->save();

        $update_job = Job::find($job->id);
        $update_job->attachment_id = $attachment->id;
        $update_job->save();

        return redirect()->route('user.jobs.index');
    }

    public function bidApplication(Request $request, Bid $bid)
    {
        // dd($request->all());
        $influencer_id = Auth::user()->id;
        $influencer = Auth::user();

        $request->validate([
            'amount' => 'required|integer',
            'duration' => 'required|integer',
            'proposal' => 'required|string',
        ]);

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
        if ($request->amount < $job->budget->min) {
            return redirect()->back()->with('swal-error', 'Bid amount cannot be less than the budget');
        } else if ($request->amount > $job->budget->max) {
            return redirect()->back()->with('swal-error', 'Bid amount cannot be greater than the budget');
        }

        $bid->amount = $request->amount;
        $bid->duration = $request->duration;
        $bid->proposal = $request->proposal;
        $bid->influencer_id = $influencer_id;
        $bid->job_id = $request->job_id;
        $bid->save();

        $job = Job::where('id', $bid->job_id)->first();
        $user = User::where('id', $job->vendor->user_id)->first();

        $activity = new Activity;
        $activity->type = 'bid_application';
        $activity->name = 'Bid Application';
        $activity->description = 'You placed a Bid of <b>'. $bid->job->currency->symbol. $bid->amount. '</b> for Job <b>(' . $job->name . ')</b>';
        $activity->user_id = $bid->influencer_id;
        $activity->url = '/jobs/details/'. $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'creative';
        $activity->save();

        // Notify vendor that a bid has been placed...
        $details1 = [
            'url' => route('user.jobs.show', $job->unique_id),
            'message' => "You have recieved a new bid for your job"
        ];
        if(Bid::where("job_id", $job->id)->count() < 11){
        $user->notify(new BidPlaced($details1));
        }
        $details = [
            'url' => route('user.jobs.show', $job->unique_id),
            'message' => "Your bid was submitted succesfully"
        ];
        $influencer->notify(new BidPlaced($details));




        //create new transaction

        $noti = new Notification;
        $noti->sender = Auth::user()->id;
        $noti->receiver =  User::where('id', $job->vendor->user_id)->first()->id;
        $noti->type = 'bid';
        $noti->type_id = $job->unique_id;
        $noti->message = $bid->proposal;
        $noti->save();

        $logged = Auth::user();

        //broadcast to pusher here...
        broadcast(new NewNotification($logged, $noti))->toOthers();
        broadcast(new NewBid($logged, $job))->toOthers();

        return redirect()->back()->with('success', 'Proposal submitted successfully');
    }

    public function bidsInsight()
    {
        $myBids = Bid::where('influencer_id', Auth::user()->id)->latest()->get();
        return view('pages.user.jobs.bids', compact('myBids'));
    }

    public function myJobs()
    {

        $vendor_id = Vendor::where('user_id', Auth::user()->id)->first();
        $my_jobs = Job::where('vendor_id', $vendor_id->id)->latest()->get();
        $completed_jobs = Job::where(['vendor_id' => $vendor_id->id, 'isCompleted' => Job::COMPLETED])->get();
        return view('pages.user.jobs.my-jobs', compact('my_jobs', 'completed_jobs'));
    }

    public function deletedJobs()
    {

        $vendor_id = Vendor::where('user_id', Auth::user()->id)->first();
        $my_jobs = Job::withTrashed()->where('vendor_id', $vendor_id->id)->where("deleted_at", "!=", null)->latest()->get();
        return view('pages.user.jobs.deleted_jobs', compact('my_jobs'));
    }

    public function bidEdit($bid)
    {
        $bid =  Bid::where('id', $bid)->first();
        $job = Job::where('unique_id', $bid->job->unique_id)->first();
        $hasBid = DB::table('bids')
            ->where('job_id', $bid->job->id)
            ->where('influencer_id', Auth::user()->id)
            ->get();
        // dd($hasBid);
        // $bids = Bid::latest()->paginate(15);
        // $amt = array();
        // foreach ($bids as $bid) {
        //     array_push($amt, $bid->amount);
        // }
        // $bidAverage = array_sum($amt) / count($bids);
        // dd($bid);

        $milestones = ($bid->milestone > 0 && is_array(unserialize($bid->milestone_data))) ?  unserialize($bid->milestone_data) : [];
        //dd($milestones);
        return view('pages.user.jobs.edit-bid', compact('job', 'hasBid', 'bid', 'milestones'));
    }

    public function bidUpdate(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'duration' => 'required|integer',
            'proposal' => 'required|string',
        ]);


        function registerNewMilestones($request)
        {
            if ($request->amount > 0) {

                $initialPay = (int)$request->amount * (5 / 100);
                $finalPay = (int)$request->amount * (95 / 100);
                return serialize([
                    ["Initial Payment", (string)$initialPay],
                    ["Final Payment", (string)$finalPay],
                ]);

                // dd([
                //     "Initial Payment" => $initialPay,
                //     "Final Payment" => $finalPay,
                // ]);
            }
        }


        $bid = Bid::findOrFail($request->bid);
        if ($request->amount < $bid->job->budget->min) {
            return redirect()->back()->with('swal-error', 'Bid amount cannot be less than the budget');
        } else if ($request->amount > $bid->job->budget->max) {
            return redirect()->back()->with('swal-error', 'Bid amount cannot be greater than the budget');
        }

        $bid->milestone = false;
        if ($request->milestone_count > 1) {
            $bid->milestone = true;
        }

        if ($request->amount != $bid->amount) {
            $bid->amount = $request->amount;
            $bid->milestone_data = registerNewMilestones($request);
        }


        $bid->amount = $request->amount;
        $bid->duration = $request->duration;
        $bid->proposal = $request->proposal;
        $bid->save();
        return redirect()->route('user.jobs.show', $bid->job->unique_id)->with('success', 'Bid updated');
    }

    public function award(Request $request)
    {
        // dd($request->all());
        $job = Job::findOrFail($request->job_id);
        if ($job->isAwarded) {
            return redirect()->back()->with('swal-error', 'Job already Assigned to a creative');
        }
        $job->influencer_id = $request->influencer_id;
        $job->isAwarded = 1;
        $job->bid_id = $request->bid_id;
        $job->save();

        $wallet = new Wallet;
        $wallet->job_id = $job->id;
        $wallet->currency_id = '5';
        $wallet->budget = $request->bid_amount;
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
        $milestone1->amt_due = $request->bid_amount * 0.25;
        $milestone1->completed = '0';
        $milestone1->paid = '0';
        $milestone1->uid = rand(10000000, 99999999);
        $milestone1->wallet_id = $wallet->id;
        $milestone1->save();

        $milestone2 = new Milestone;
        $milestone2->job_id = $job->id;
        $milestone2->name = 'Video Watched';
        $milestone2->amt_due = $request->bid_amount * 0.75;
        $milestone2->completed = '0';
        $milestone2->paid = '0';
        $milestone2->uid = rand(10000000, 99999999);
        $milestone2->wallet_id = $wallet->id;
        $milestone2->save();
        $user = User::findOrFail($job->vendor->user->id);
        // $creative_awarded = Influencer::findOrFail($request->influencer_id);

        $creative = User::findOrFail($request->influencer_id);

        $activity = new Activity;
        $activity->type = 'job_award';
        $activity->name = 'Job Awarded';
        $activity->description = 'You awarded the Job <b>(' . $job->name . ')</b> to <b>' . $creative->first_name . ' ' . $creative->last_name. '</b>';
        $activity->user_id = $user->id;
        $activity->url = '/jobs/details/'. $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();


        $details = [
            'user' => $user->last_name . ' ' . $user->first_name,
            'creative' => $creative->last_name . " " . $creative->first_name,
            'urlChat' => route('user.jobs.show', $job->unique_id),
            'urlPayment'=>route('user.jobs.show', $job->unique_id),
            // 'urlPayment' => route('user.vendors.milestones.pay') . "?id=" . $job->unique_id . "&creative=" . $job->influencer_id,
            'message' => 'You have successful awarded your job to a creative, proceed with the next steps to have complete the job.',
            'job' => $job->name,
        ];
        $details2 = [
            'vendor' => $user->last_name . ' ' . $user->first_name,
            'user' => $creative->last_name . " " . $creative->first_name,
            'urlChat' => route('user.jobs.show', $job->unique_id),
            'message' => 'Your Bid has beeen approved and you have been awarded the job, proceed with the next steps to have deliver and complete the job.',
            'job' => $job->name,
        ];
        $details3 = [
            'vendor' => $user->last_name . ' ' . $user->first_name,
            'user' => $creative->last_name . " " . $creative->first_name,
            'url' => route('public.online-video-submission'),
            'message' => 'Creative, make sure the content you create adheres to our guidelines, for information on what these guidelines are simply visit the Frequently Asked Questions section or just click on the following link:',
            'job' => $job->name,
        ];
        $user->notify(new JobAwardNotification($details));
        $creative->notify(new JobAwardNotification2($details2));
        $creative->notify(new VideoGuidelines($details3));
        //create new transaction

        $noti = new Notification;
        $noti->receiver = $creative->id;
        $noti->sender =  User::where('id', $job->vendor->user_id)->first()->id;
        $noti->type = 'award';
        $noti->type_id = $job->unique_id;
        $noti->message = $job->name;
        $noti->save();

        $logged = Auth::user();

        //broadcast to pusher here...
        broadcast(new NewNotification($logged, $noti))->toOthers();
        broadcast(new BidAccepted($logged, $job))->toOthers();
        return redirect()->back()->with('success', 'You have a Creative now for your Job! Let’s go!');
    }

    public function fileDownload($file)
    {
        try {
            $file = str_replace("@", "/", $file);
            if (Storage::disk('s3')->exists($file)) {
                return Storage::disk('s3')->download($file);
            } else {
                return redirect()->back()->with("swal-error", "File doesn't exist");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with("swal-error", "Error downloading file");
        }
    }

    public function fileUpload(Request $request, Attachment $attachment)
    {
        $request->validate([
            'file' => 'required'
        ]);
        $job = Job::find($request->job_id)->first();
        $docs = [];
        $format = [];
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $filename = str_replace(["_", " ", "@", "/"], "-", $filename);
            $filename = time() . '_' . $filename;
            //$file->StoreAs('public'.DIRECTORY_SEPARATOR.'attachments', $filename);

            $file->storePubliclyAs('jobs-attachment', $filename, 's3');
            //$path = Storage::disk('s3')->url($path);
            $docs[] = "jobs-attachment/" . $filename;
            $format[] = $file->extension();
        }

        $attachment->name = $job->name;
        $attachment->file = json_encode($docs);
        $attachment->format = json_encode($format);
        $attachment->job_id = $request->job_id;
        $attachment->vendor_id = $job->vendor_id;
        $attachment->uploaded_by = Auth::user()->id;
        $attachment->save();

        return redirect()->back()->with('success', 'File uploaded');
    }

    public function videoUpload(Request $request, VideoContent $video)
    {


        $request->validate([
            'video_file' => 'required',
            'video_title' => 'required',
            'video_desc' => 'required',
            'kids_compliant' => 'required',
        ]);



        $job = Job::where('id', $request->job_id)->first();
        // $user = User::where('id', $job->vendor->user->id)->first();
        //dd($request);



        $video = $job->video;
        if ($video) {
            return redirect()->back()->with('swal-error', ' Video already uploaded for this Job');
        }
        if ($request->hasFile('video_file')) {


            // $file = $request->video_file;
            // $filename = $file->getClientOriginalName();
            // $filename = time() . '_' . $filename;
            $video_path =  $request->file('video_file')->store('jobs-video', 's3');

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


        $video = new VideoContent();
        $video->name  = $request->video_title;
        $video->video_desc  = $request->video_desc;
        $video->video_thumb  = Storage::disk('s3')->url($thumb_path);;
        $video->file = Storage::disk('s3')->url($video_path);
        $video->job_id = $job->id;
        $video->influencer_id = auth()->user()->id;
        $video->viewed_at = null;
        $video->kids_compliant = $request->kids_compliant;
        $video->save();

        $job->video_id = $video->id;
        $job->save();
		$milestone = Milestone::where('job_id', $job->id)->where('name', 'Video Uploaded')->first();
        $milestone->completed = '1';
        $milestone->save();

        //redirect to generateToken action in JobManagementController
        // $token = redirect('/jobs/'.$job->id.'/generateToken');
        // dd($token->data);

        // $data = [
        //     'job_id' => $job->id
        // ];
        // $tokenObject = $token = TokenBuilder::setData($data)->build();
        // $tokenObject->job_id = $job->id;
        // $tokenObject->save();

        //Send token to SMS
        // if ($user->isPhoneVerified) {
        //     $this->sendMessage('Use Token to access video ' . $tokenObject->token, $phone_number);
        // }
        $user = User::findOrFail($job->vendor->user->id);
        // $creative_awarded = Influencer::findOrFail($request->influencer_id);
        $creative = User::findOrFail($job->influencer->id);


        //create new Activity
        $activity = new Activity;
        $activity->type = 'video_upload';
        $activity->name = 'Video Uploaded';
        $activity->description = 'You Uploaded Content for Job <b>(' . $job->name . ')</b>';
        $activity->user_id = $creative->id;
        $activity->url = '/jobs/details/'. $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'creative';
        $activity->save();


        $details = [
            'url' => route('user.jobs.show', $job->unique_id),
            'user' => $user->last_name . ' ' . $user->first_name,
            'message' => 'Congratulations! Your content is ready and has been sent to your Vendor Station; click on the button below to view it.'
        ];
        $user->notify(new UploadContent($details));
           // Send token to Email
        // $detail = [
        //     'token' => $tokenObject->token,
        //     'user' => $user->last_name . ' ' . $user->first_name,
        //     'message' => "Use token to view video uploaded by the creative. Token Expires in 48hrs."
        // ];
        // $user->notify(new JobUpdate($detail));
        $details2 = [
            'url' => route('user.jobs.show', $job->unique_id),
            'user' => $creative->last_name . " " . $creative->first_name,
            'message' => 'Your Content Delivery for a job was successful.'
        ];
        $creative->notify(new UploadContent2($details2));


        //create new notification to influencers



        $noti = new Notification;
        $noti->sender = Auth::user()->id;
        $noti->receiver = $user->id;
        $noti->type = 'videoUpload';
        $noti->type_id = $job->unique_id;
        $noti->message = $video->name;
        $noti->save();

        $logged = Auth::user();


        //broadcast pusher notification alert here.

        broadcast(new NewNotification($logged, $noti))->toOthers();
        broadcast(new ContentUploaded($logged, $job))->toOthers();




        //Todo: change this to send last payment link
        return redirect()->back()->with('success','Video uploaded successfully, vendor will be notified');
    }

    public function videoDownload($id)
    {
        $job = Job::where('id', $id)->first();
        if(!$job->isCompleted){
            return redirect()->back()->with('swal-error', 'This Job is not completed');
        }
        $video = VideoContent::where('job_id', $id)->first();
        $path = $video->file;
        $file = explode('/', $path);
        $fileName = end($file);

        return Storage::disk('s3')->download('jobs-video/' . $fileName);
    }

    public function videoToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'jobId' => 'required|integer'
        ]);

        //0217897023 GTB



        // $token = Token::where([['token', '=', $request->token], ['job_id', '=', $request->input('jobId')]])->latest()->first();
        $token = Token::where('token', $request->token)
            ->where('job_id', $request->jobId)
            ->latest()
            ->first();


        if (!$token) {
            return response()->json([
                'Token is not valid'
            ], 400);
        } else {
            $token->verified_at = now();
            $token->save();
            return response()->json(['data' => 'Token is valid']);
        }



        // $job = Job::find($request->jobId);
        // $videoContent = $job->video;

        //they have 48hr to view video and approve
        // if ($token->hasExpired()) {
        //     return response()->json([
        //         "You've exceeded the 48hrs limit you have to approve content"
        //     ], 400);
        // }
        // if (is_null($token->expired_at)) {
        //     $token->expired_at = now()->addHours(Token::EXPIRATION_IN_HOURS);
        //     $token->save();
        // }

        // if(!empty($videoContent) && $videoContent->hasExpired()) {
        //     return response()->json([
        //         "You've exceeded the 24hrs limit you have to approve video"
        //     ], 400);
        // }
        // if(is_null($videoContent->viewed_at)) {
        //     $videoContent->viewed_at = now();
        //     $videoContent->save();
        // }
        // $tk = DB::table('tokens')
        //     ->where('token', $request->token)
        //     ->where('email', Auth::user()->email)
        //     ->delete();
    }

    public function VendorWatchedVideo(Request $request)
    {
        $request->validate([
            'job_id' => 'required'
        ]);
        $video = VideoContent::where('job_id', $request->job_id)->first();
        $milestone = Milestone::where(['job_id'=> $request->job_id, 'name'=> 'Video Watched'])->first();
        if (is_null($video->viewed_at)) {
            $video->viewed_at = now();
            $video->save();
        }
        $milestone->completed = '1';
        $milestone->save();
        // dd($milestone->completed);
        return response()->json(['video' => $video]);
    }

    public function YTVideoCode($code)
    {

        if (is_null($code)) {
            return response()->json([
                'message' => 'Null value passed. Expected jobId'
            ], 404);
        }

        try {
            $job = Job::findOrFail($code);
            $content = VideoContent::where('job_id', $job->id)->first();
            //$videoCode = $job->video->file;
            // dd($content);
            if (is_null($content)) {
                return response()->json([
                    'message' => 'No video found for this job'
                ], 404);
            }
            $videoCode = $content->file;
            return response()->json($videoCode);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Job not foud'
            ], 500);
        }
    }

    public function approveVideo(Request $request)
    {
        $video_id = $request->video;
        // Job::where('video_id','=',$video_id)->update([
        //     'isApproved' => 1
        // ]);
        VideoContent::where('id', $video_id)->update([
            'isApproved' => 1
        ]);
        return response()->json(['success' => true, 'msg' => 'Approved successfully']);
    }

    public function videoStatus($video_id)
    {
        $video = VideoContent::where('id', '=', $video_id)->first();
        $video->file = '';
        return response()->json(['success' => true, 'data' => compact('video')]);
    }

    public function milestones(Request $request)
    {
        if (Auth::user()->email_verified_at == '') {
            return redirect()->back()->with('swal-error', 'Please verify your Email to Make Deposit');
        }
        if (Auth::user()->flutterwaveSubaccount == '') {
            return redirect()->back()->with('swal-error', 'Please add Payment Information to Make Deposit');
        }

        $unique_id = $request->id;
        $influencer_id = $request->creative;
        $job = Job::where('unique_id', $unique_id)->first();
        $jobid = $job->id;
        $bid = Bid::where('job_id', $job->id)->where('influencer_id', $influencer_id)->first();
        $milestones = unserialize($bid->milestone_data);
        $influencer = Influencer::where('user_id', $influencer_id)->first();

        //get influencers flutterwave
        $user = User::where('id', $influencer->user_id)->first();
        $influencer_account = $user->flutterwaveSubaccount;
        if (!$influencer_account) {
            return redirect()->back()->with('swal-error', 'Creative does not have Account Information.');
        }

        $subaccount = FlutterwaveSubaccount::where('user_id', $influencer->user_id)->first();
        $subaccountId =  $subaccount->subaccount_id;
        if ($bid->milestone == 0) {
            $milestone = $milestones[0][1];
        } else {
            $milestone = $milestones[1][1];
        }

        return view('pages.user.vendor.milestones', compact('milestone', 'jobid', 'influencer_id', 'subaccountId'));
    }

    public function search()
    {
        $jobs = Job::where('isAwarded', '!=', '1')->get();
        return view('pages.user.influencer.search', compact('jobs'));
    }

    public function updateJobPaymentMilestone(Request $request)
    {
        $this->validate($request, [
            'paymentMilestone'
        ]);

        // dd($request->all());

        $job = Job::findOrfail($request->id);
        $payment_milestone = (int) $request->paymentMilestone;
        $job->payment_milestone = $payment_milestone;
        $job->save();

        return response()->json(['message' => 'saved', 'job' => $job]);
    }


    public function getAvailableJobs(Request $request)
    {
        $search_q = strtolower($request->search);
        $filters = [
            'location' => $request->location,
            'category' => $request->category,
            'type' => $request->type,
            'AvgPrice' => $request->AvgPrice,
            'AvgHrRate' => $request->AvgHrRate,
            'duration' => $request->duration,
            'projType' => $request->projType,
        ];

        while (list($key, $value) = each($filters)) {
            if (is_null($value)) {
                unset($filters[$key]);
            }
        }

        if (count($filters) > 0 && isset($search_q)) {
            try {
                $jobs = Job::where('isAwarded', '!=', '1')->where('isApproved', '!=', '2')->where('name', 'like', '%' . $search_q . '%')->get();
                $jobs = $this->filterJobs($jobs, $filters, $request->search);
                // $jobs = $this->searchJobs($jobs, $request->search);
                return response()->json(['success' => true, 'data' => $jobs]);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'Job not found'
                ], 500);
            }
        }

        if (isset($search_q) && count($filters) == 0) {
            if ($search_q == '') {
                $jobs = Job::where('isAwarded', '!=', '1')->where('isApproved', '!=', '2')->get();
                return response()->json(['success' => true, 'data' => $jobs]);
            }
            try {
                $jobs = Job::where('isAwarded', '!=', '1')->where('isApproved', '!=', '2')->where('name', 'like', '%' . $search_q . '%')->get();
                return response()->json(['success' => true, 'data' => $jobs]);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'Job not found'
                ], 500);
            }
        }


        $jobs = Job::where('isAwarded', '!=', '1')->where('isApproved', '!=', '2')->get();

        return response()->json(['success' => true, 'msg' => 'Successfully Fetched', 'data' => $jobs]);
    }

    public function filterJobs($jobs, $filters)
    {
        //get the country of the merchant
        //get vendor's user id
        //get the country of the vendor
        $filtered_jobs = [];
        foreach ($jobs as $job) {
            $vendor = Vendor::where('id', $job->vendor->id)->first();
            // dd($vendor);
            $user = User::where('id', $vendor->user_id)->first();
            // dd($user->country_id);

            if (!is_null($user->country_id)) {
                $country = Country::where('country_id', $user->country_id)->first();
                // dd($country->name, $filters['location']);
                if ($country->name === $filters['location']) {
                    $filtered_jobs[] = $job;
                }
            }
        }
        return $filtered_jobs;
    }

    public function searchByCategory()
    {
        return view('pages.user.influencer.searchByCategory');
    }

    public function getAvailableCategory()
    {
        $categories = Category::all();
        return response()->json(['success' => true, 'msg' => 'Successfully Fetched', 'data' => $categories]);
    }

    public function getAvailableJobsByCategory(Request $request)
    {
        $jobs = Job::where('isAwarded', '!=', '1')->where('category_id', $request->category_id)->get();
        return response()->json(['success' => true, 'msg' => 'Successfully Fetched', 'data' => $jobs]);
    }

    public function categoriesDetails(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $jobs = Job::where('category_id', $request->id)->get();
        return view('pages.user.influencer.categoriesDetails', compact('jobs', 'category'));
    }

    public function getJobsByCategory(Request $request)
    {
        $jobs = Job::where('category_id', $request->category_id)->get();
        return response()->json(['success' => true, 'msg' => 'Successfully Fetched', 'data' => $jobs]);
    }

    public function getJobsByKeyword(Request $request)
    {
        $jobs = Job::where('title', 'like', '%' . $request->keyword . '%')->get();
        return response()->json(['success' => true, 'msg' => 'Successfully Fetched', 'data' => $jobs]);
    }

    public function completed()
    {
        return view('pages.user.vendor.complete');
    }

    public function isJobAwarded(Request $request)
    {
        $job = Job::where('id', $request->job_id)->where('isApproved', '!=', '2')->first();
        if ($job->isAwarded == 1) {
            return response()->json(['isAwarded' => true, 'msg' => 'Job is already awarded']);
        } else {
            return response()->json(['isAwarded' => false, 'msg' => 'Job is not awarded']);
        }
    }

    public function jobUniqueid($id)
    {
        $job = Job::where('id', $id)->first();
        $jobId = $job->unique_id;
        return response()->json(['id' => $jobId]);
    }
    public function bids_alert(Job $job, Bid $bid)
    {
        $data = $job::with(['user:*', 'bids:*', 'bids.influencer:*'])->whereDate('created_at', '>=', \Carbon\Carbon::today())->get();
        // $data = $job::with(['user:*', 'bids:*', 'bids.influencer:*'])->get();
        foreach($data as $job){
        $bids = $bid::where("job_id", $job->id)->whereBetween('created_at', [
            now()->subHours(2)->format('Y-m-d H:00:00'), now()->addHours(1)->format('Y-m-d H:00:00')])->get();
        $user = User::findOrFail($job->vendor->user->id);
        if(count($bids) > 0 && !$job->isAwarded){
        $details = [
            'user' => $user->last_name . ' ' . $user->first_name,
            'url' => route('user.jobs.show', $job->unique_id),
            'message' => 'You have recieved a few bids for your job',
            'job' => $job->name,
            "bids"=> $bids
        ];
            $user->notify(new Bids($details));
        }
        }

        return response()->json([
            "data"=>$data
        ]);
    }


    public function getJobBids(Request $request) {
        $job = Job::where("id", $request->job)->first();
        $currency = $job->currency->symbol;

        $job['currencySymbol'] = $currency;
        $vendor = User::find($job->vendor->user_id);

        $budget = Budget::find($job->budget);

        $job['budgetObj'] = $budget;

        $bids = Bid::where("job_id", $request->job)->orderBy("created_at", "desc")->get();

        $bid_average = Bid::where("job_id", $request->job)->avg('amount');

        if($job->isAwarded){
            $awarded_bid = Bid::find($job->bid_id);
            $key = array_search($awarded_bid, $bids->toArray());

            if($key){
                unset($bids[$key]);
                array_unshift($bids, $awarded_bid);
            }
        }

        $milestone = Milestone::where('job_id', $job->id)->where(['completed' => '1', 'paid'=> '0'])->first();

        $job['bid_average'] = $bid_average;

        if($milestone){
          $job['amtDue'] = $milestone->amt_due;
        }

        foreach ($bids as $bid) {
            $influencer = User::find($bid->influencer_id);
            $details = InfluencerDetails::where("user_id", $bid->influencer_id)->first();
            $video = $details? $details->video : "";
            $job_count = count(Job::where(['isCompleted' => '1', 'influencer_id'=> $bid->influencer_id])->get());
            $rating = CreativeRating::where('user_id', $bid->influencer_id)->first();

            $avg_rating = 1;

            if($rating){
                $avg_rating = ($rating->communication + $rating->affordable + $rating->skilled + $rating->otd)/4;
            }

            $bid['country'] = $influencer->country? $influencer->country->name : "";

            $bid['influencerObj'] = $influencer;
            $bid['jobCount'] = $job_count;
            $bid['video'] = $video;
            $bid['influencer_rating'] = $avg_rating;
            $bid['instagram_count'] = $influencer->influencer->instagram_followers;
        }

        return ['bids'=>$bids, 'job'=>$job, 'vendor'=>$vendor];

    }





}
