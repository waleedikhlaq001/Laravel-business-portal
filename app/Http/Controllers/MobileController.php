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
use App\Models\Notification;
use App\Models\GeneralNotification;
use App\Models\Milestone;
use App\Models\VideoContent;
use App\Notifications\TwoFa;
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
use App\Models\VideoContentView;use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\AccountUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
use App\Notifications\VendorRegistration;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Activity;
use App\Notifications\PhoneVerification;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use stdClass;

class MobileController extends Controller
{   
    protected function respondWithToken($token, $role, $em, $two)
{
    return response()->json([
        'active'=>false,
        'message'=>'Authentication Successful!',
        'access_token' => $token,
        "email" => $em,
        'user_type'=>$role,
        'two_fa'=>$two,
        'token_type' => 'bearer',
        // 'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
}


    // regular login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        //check if email exist
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message'=>'No user associated with the requested Email Address!'], 404);
        }

        //check if email exist
        $user = User::where('email', $request->email)->where('status', User::ACTIVE)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message'=>'Your account is Inactive, kindly contact Vicomma Admin!'], 403);
        }
        if($user->email_verified_at == null){
            return response()->json([
                "message"=>"Your Email is not Verified, Please Verify Your Email"
            ], 400);
        }

        $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])) {
            $user = User::where('email', $request->email)->first();
            if($user->two_fa == 1){
                if (Hash::check($request->password, $user->password)) {
                    // Password is correct
                    $token = rand(000000, 999990);
                    DB::table("users")->where("id", $user->id)->update(["token"=>$token]);
                    $details = [
                        'user' => $user->last_name . ' ' . $user->first_name,
                        'message' => 'Use The token provided below to complete your login request. If you have not initiated a login request, please ensure your reset your account password.',
                        'token' => $token,
                    ];
                    $user->notify(new TwoFa($details));
                    return response()->json(["message"=>"Check Your Email for your One Time Login Token", "two_fa"=>true]);
                } else {
                    // Password is incorrect
                    return response()->json(['message'=>'Incorrect username or password'], 401);
                }
            } 
            else {   
                    //redirect deactivated user
                    if ($user->hasRole('Admin')) {
                        return response()->json(['message'=>'Incorrect Email or password'], 401);
                    } elseif ($user->hasRole('Vendor')) {
                        return $this->respondWithToken($token, 'vendor', $user->email, false);
                    } elseif ($user->hasRole('Creative')) {
                        return $this->respondWithToken($token, 'creative', $user->email, false);
                    } elseif ($user->hasRole('General User')) {
                        return $this->respondWithToken($token, 'user', $user->email, false);
                    }
                    else {
                        return $this->respondWithToken($token, 'none', $user->email, false);
                    }
                }
        } else {
            return response()->json(['message'=>'Incorrect Email or password'], 401);
        }
    }

    public function resend_otp(Request $request){
          // Password is correct
          $user = User::where("email", $request->email)->first();
          $token = rand(000000, 999990);
          DB::table("users")->where("id", $user->id)->update(["token"=>$token]);
          $details = [
              'user' => $user->last_name . ' ' . $user->first_name,
              'message' => 'Use The token provided below to complete your login request. If you have not initiated a login request, please ensure your reset your account password.',
              'token' => $token,
          ];
          $user->notify(new TwoFa($details));
          return response()->json(["message"=>"OTP Resent to $request->email"]);
    }
    public function login_2fa(Request $request)
    {
    $otp = $request->otp;
    $email = $request->email;
    $user = User::where("email",$request->email)->first();

    if(DB::table("users")->where(["token"=>$otp, "email"=>$email])->exists()){
        // Auth::loginUsingId($user->id, true);
        // $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])
        $token = auth('api')->login($user);
        DB::table("users")->where("id", $user->id)->update([
            "token"=>null
        ]);
           //create activity log
           $activity = new Activity;
           $activity->type = 'login';
           $activity->name = 'You Logged in';
           $activity->user_id = $user->id;
           $activity->image = 'https://via.placeholder.com/50';
           $activity->account_type = $user->role;
           $activity->save();
           if($request->ref){
               return redirect($request->ref);
           }
        //redirect deactivated user
        if ($user->hasRole('Admin')) {
            return response()->json(['message'=>'Incorrect Email or password'], 401);
        } elseif ($user->hasRole('Vendor')) {
            return $this->respondWithToken($token, 'vendor', $user->email, true);
        } elseif ($user->hasRole('Creative')) {
            return $this->respondWithToken($token, 'creative', $user->email, true);
        } elseif ($user->hasRole('General User')) {
            return $this->respondWithToken($token, 'user', $user->email, true);
        }
        else {
            return $this->respondWithToken($token, 'none', $user->email, true);
        }
    }else{
        return response()->json(['message'=>'Invalid Otp Provided'], 401);
    }
    }
    // regular register
    public function register(Request $request, User $user)
    {
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        // dd($request->email_reg);
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:6'
            ]
        ]);

        // if($validator->fails()){
        //         return response()->json($validator->errors()->toJson(), 400);
        // }
                if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }


        try {
            //create the motherfuckers on stripe
            $customer = $stripe->customers->create([
                'description' => $request->first_name . " " . $request->last_name,
                'email' => $request->email
            ]);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            if($e && $e->getError()){

            return 'Error occured with Stripe Connection : .' . $e->getError()->message;
            }
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->image = "https://ui-avatars.com/api/?background=random&name=" . $request->first_name . "+" . $request->last_name . "&size=128";
        $user->password = Hash::make($request->password);
        $user->save();
        $email = $request->email;
        // $token = Str::random(64);
        $token = rand(1111, 9999);

        DB::table('verif_tokens')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        $details = [
            'url' => route('email.verify.get', $token),
            'user' => $user->last_name . ' ' . $user->first_name,
            "token"=>$token,
            'message' => 'Thanks for registering with on the Vicomma Mobile App.
                        We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address with the Token Below on the Vicomma App.'
        ];
        $user->notify(new UserRegistration2($details));

        //create customer on Stripe.
        return response()->json(['message'=>'Your registration was successful!']);
    }

    public function vemail($token)
    {
        $tk = VerifToken::where('token', $token)->first();
        if (!$tk) {
            return redirect()->route('public.index');
        }
        $email = User::where('email', $tk->email)->select('email')->first();
        return view('pages.auth.verify', compact('token', 'email'));
    }

    public function verifyEmail(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'token' => 'required'
        ]);

                if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        $vemail = DB::table('verif_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        if (!$vemail) {
            return response()->json(['message'=>'Invalid Token Provided'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        DB::table('verif_tokens')->where('email', $request->email)->delete();

        return response()->json(['message'=>'Account Verified Successfully']);
        // if (!auth::user()) {
        //     return redirect()->route('public.index')->with('verified', 'Email verified successfully');
        // } else {
        //     return redirect()->route('user.dashboard')->with('verified', 'Email verified successfully');
        // }
    }

    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        // $token = Str::random(64);
        $token = rand(1122,9999);

        // // dd($token);
        DB::table('password_resets')->where('email', $request->email)->delete();
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $user = User::where('email', $request->email)->first();

        $details = [
            'action' => 'reset',
            'user' => $user->last_name . ' ' . $user->first_name,
            'token' => $token,
            'message' => "Vicomma.com has received a request to reset the password for your account. Use the Token: <center><h4>$token</h4></center> to reset your Password On The Vicomma Mobile App. If you did not request to reset your password, please ignore this email."
        ];

        $user->notify(new PasswordReset2($details));

        return response()->json(['message'=>'A password reset token has been sent to your email']);
    }

    public function reset(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'token' => "required",
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
    }

        $update_password = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        if (!$update_password) {
            return response()->json(['message'=>'Invalid Token']);
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();
        $user = User::where('email', $request->email)->first();
        $details = [
            'action' => 'successful',
            'user' => $user->last_name . ' ' . $user->first_name,
            'message' => 'Your password was changed, if you did not initiate this change contact our support now.'

        ];
        $user->notify(new PasswordReset($details));
        return response()->json(['message'=>'Password reset successfully, Log in now!']);
    }

    // public function test()
    // {
    //     return view('pages.auth.reset.verify');
    // }

    // Google login
    public function redirectToGoogle()
    {
        // dd(env('GOOGLE_CLIENT_ID'));
        return Socialite::driver('google')->redirect();
    }

    public function become_creative(Request $request, Influencer $influencer, InfluencerDetails $influencerDetails){
        $user = User::find(auth("api")->user()->id);
        $type = InfluencerType::where('name', 'free')->first();

        // influencer type id
        // get user instagram followers, this will be useed to categorize the influencer
        // influencer category
        $category = InfluencerCategory::where('name', 'Nano Influencers')->first();
        $validator = Validator::make($request->all(),[
            'influencer_years_experience' => 'required|string',
            'influencer_services_provided' => 'required|string',
            'influencer_followers' => 'required|string',
            'influencer_previous_job' => 'required|string',
            'influencer_turnaround_time' => 'required|string',
            'influencer_charges' => 'required|string',
            'influencer_clients' => 'required|string',
            "charge_per_hour"=>"required|string", 
            "experience_level"=>"required|string", 
            "currency_id"=> "required|string"
        ]);

        if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }

        $user->instagram = $request->instagram_handle;
        $user->vcoin = 10;
        $user->tiktok = $request->tiktok_handle;
        $user->twitter = $request->twitter_handle;
        $user->save();

          // Saving influencer details 
          $influencerDetails->influencer_years_experience = $request->influencer_years_experience;
          $influencerDetails->influencer_followers = $request->influencer_followers;
          $influencerDetails->influencer_previous_job = $request->influencer_previous_job;
          $influencerDetails->inflencer_services_provided = $request->influencer_services_provided;
          $influencerDetails->influencer_charges = $request->influencer_charges;
          $influencerDetails->influencer_clients = $request->influencer_clients;
          $influencerDetails->influencer_description = $request->bio;
          $influencerDetails->charge_per_hour = $request->charge_per_hour;
          $influencerDetails->experience_level = $request->experience_level;
          
          $influencerDetails->influencer_skills = $request->skills;
          $influencerDetails->influencer_turnaround_time = $request->influencer_turnaround_time;
          if ($request->has('guser')) {
              $influencerDetails->currency_id = '5';
          } else {
              $influencerDetails->currency_id = $request->currency_id;
          }
          $influencerDetails->user_id = $user->id;
          $influencerDetails->save();
  
          $code = Str::random(20);
          $influencer->user_id = $user->id;
          $influencer->influencer_type_id = $type->id;
          $influencer->influencer_category_id = $category->id;
          $influencer->code = $code;
          $role = Role::where('name', 'Creative')->first();
          $user->role()->attach($role->id); // role 4 is the influencer role id
          if($user->hasRole('vendor')){
          $role2 = Role::where('name', 'Vendor')->first();
          DB::table("role_user")->where(["role_id"=>$role2->id,"user_id"=>$user->id])->update([
              "active"=>0
          ]);
          }
          $influencer->save();
  
          // Notify user
        //   $details = [
        //       'user' => $user->last_name . ' ' . $user->first_name,
        //       'message' => 'You have successfully upgraded your account to become a Creative, explore all the functionalities available for you now'
        //   ];
        //   $user->notify(new AccountUpdate($details));
          return response()->json(["message"=>"Creative Registration Succcessful"]);
    }

    public function all_currencies() {
        $currencies = Currency::all();
        
        return response()->json($currencies);
    }

    public function all_skills(){
        $skills = Skill::all();
        return response()->json($skills);
    }

    public function become_vendor(Request $request, Vendor $vendor){
        $vtype = VendorType::where('name', 'Free')->first();
        $role = Role::where('name', 'Vendor')->first();
        $user = User::find(auth('api')->user()->id);

        $validator = Validator::make($request->all(),[
        'station' => 'required|string'
        // 'station' => 'required|string|unique:vendors,vendor_station'
        ]);

        if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }        
        if($vendor->where("vendor_station", $request->station)->exists()){
            return response()->json(["message"=>"This Store name has already been taken"], 400);
        }
        // $slug = Str::slug($request->station, '-');
        $vendor->vendor_station = $request->station;
        $vendor->user_id = auth('api')->user()->id;
        // $vendor->slug = $slug;
        $vendor->vendor_type_id = $vtype->id; // assigning vendor to free category type
        $vendor->save();
        $user->role = "vendor";
        $user->save();
        // DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [$role->id, Auth::user()->id]); // role_id = 3, this is the ID for Vendor
        $user->role()->attach($role->id); // role 5 is a general user id
        if($user->hasRole('Creative')){
            $role2 = Role::where('name', 'Creative')->first();
            DB::table("role_user")->where(["role_id"=>$role2->id,"user_id"=>$user->id])->update([
                "active"=>0
            ]);
        }// role 5 is a general user id
        // $details = [
        //     'user' => $user->last_name . ' ' . $user->first_name,
        //     'message' => 'You have successful upgraded your account to become a vendor, explore all the functionalities available for you now'
        // ];
        // $user->notify(new VendorRegistration($details));
        return response()->json(["message"=>"Vendor Registration Succcessful"]);
    }

    public function become_user(Request $request){
        $user = auth("api")->user();
        $role = Role::where('name', 'General User')->first();
        $user->save();
        $user->role()->attach($role->id); // role 5 is a general user id
        return response()->json(["message"=>"General User Registration Succcessful"]);
    }

    public function me(){
        $user = Auth("api")->user();
        
        $activities =  Activity::where(['user_id'=> $user->id, 'status' => Activity::UNREAD])->orderBy('created_at', 'desc')->limit(10)->get() ?? array();
        if(!$user){
            return response()->json(["message"=>"Invalid token"]);
        }

        $countryName = null;
        if($user->country_id){
            $countryName = DB::table("countries")->where("id", $user->country_id)->first()->name;
        }
        if ($user->hasRole('Admin')) {
             $role = 'Admin';
        } elseif ($user->hasRole('Vendor')) {
             $role = 'Vendor';
        } elseif ($user->hasRole('Creative')) {
             $role = 'Creative';
             $awarded_jobs = DB::table('jobs')->where('isAwarded', 1)->where("influencer_id", $user->id)->count();
             $complete_jobs = DB::table('jobs')->where('isCompleted', 1)->where("influencer_id", $user->id)->count();
             $ratings = DB::table('reviews')->where("user_id", $user->id)->avg('rating');
             $disputes = DB::table('disputes')->where("influencer_id", $user->id)->count();
        $user->awarded_jobs = $awarded_jobs;
        $user->ratings = $ratings;
        $user->disputes = $disputes;
        $user->complete_jobs = $complete_jobs;
        } elseif ($user->hasRole('General User')) {
             $role = 'General User';;
        }else {
            $role = 'None';
        }
        $user->role = $role;
        $user->countryName = $countryName;
       
        return response()->json([$user, $activities]);
    }


        public function my_orders(Order $order, OrderDetail $details){
            $orders = $order::where("user_id", auth("api")->user()->id)->with("details")->orderBy("id", "DESC")->paginate(20);
            // dd($orders);
            return response()->json(compact("orders"));
        }
    

    public function general_user_home(Request $request){
        $user = auth('api')->user();
        $awarded = Job::orderBy('id', 'desc')->where('isAwarded', Job::AWARDED)->get();
        $creatives = Influencer::with('user')->inRandomOrder()->limit(15)->get();
        $featured_video = VideoContent::orderBy('created_at', 'desc')->first();
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();
        $videos = VideoContent::orderBy('created_at', 'desc')->paginate($request->limit? $request->limit : 5);

        if($featured_video){
            $featured_job = Job::where('video_id', $featured_video->id)->exists()? Job::where('video_id', $featured_video->id)->first() : '';
        }else{
            $featured_job = '';
        }
        //get video views count
        if($featured_job){
            $featured_product = Product::where('id', $featured_job->product_id)->exists() && Product::where('id', $featured_job->product_id)->first()->image !== "[]"? Product::where('id', $featured_job->product_id)->first() : '';
        }else{
            $featured_product = '';
        }
        if($featured_product){
            $image = json_decode($featured_product->image);
            $related_products = Product::where('category_id', $featured_product->category_id)->inRandomOrder()->limit(5)->get();
        }else{
            $image = '';
            $related_products = '';
        }

        return response()->json(["data"=>compact('creatives', 'image', 'awarded', 'videos', 'related_products', 'featured_video', 'trending_videos', 'featured_product')]);

    }


    public function jobs_search(Request $request) {
        $data = $request->text;
         $res = Job::with('budget', 'vendor', 'currency', 'bids', 'product')
            ->where('isApproved', Job::APPROVED)
            ->where('isAwarded', 0)
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
            return response()->json(["results"=>$res]);
    }

    public function creatives_search(Request $request) {
        $data = $request->text;
         $res = User::with(["details"])->where("role", 'influencer')
            ->where('first_name', 'like', "%{$data}%")
            ->orwhere('last_name', 'like', "%{$data}%")
            ->orwhere('email', 'like', "%{$data}%")
            ->withCount(['job as awarded_jobs' => function ($query) {
                $query->select(DB::raw('count(*)'))
                    ->where('isAwarded', 1)
                    ->whereRaw('jobs.influencer_id = users.id');
            },
            'job as completed_jobs' => function ($query) {
                $query->select(DB::raw('count(*)'))
                    ->where('isCompleted', 1)
                    ->whereRaw('jobs.influencer_id = users.id');
            }])
            ->latest()
            ->paginate(50);
            return response()->json(["results"=>$res]);
    }

    public function all_products(){
    
    }

    public function all_categories(){

    }


    public function changePassword(Request $request)
    {
        $user = User::find(auth('api')->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $validator = Validator::make($request->all(),[
                'password' => [
                    'required',
                    'min:6',
                    'confirmed'
                ],
                'password_confirmation' => 'required'
            ]);

            if($validator->fails()){
                        return response()->json(["message"=>$validator->errors()->all()[0]], 400);
                }
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message'=>'Password updated successfully']);
        } else {
            return response()->json(['message'=>'Incorrect Password'], 401);
        }
    }
    public function job_new_details(){
        $vendor_id = auth('api')->user()->vendor->id;
        $budgets = Budget::all();
        $currencies = Currency::all();
        $categories = Category::all();
        $durations = [
            "1 - 3 days",
            "3 - 7 days",
            "1 - 3 weeks",
            "3 - 7 weeks",
            "1 - 3 months",
            "3 - 7 months"
        ];

        // selecting Products that does not have jobs created for them already
        $jobs = Job::pluck('product_id')->all();
        //show approved products only
        $my_products = Product::where(['status' => Product::APPROVED, 'vendor_id' => $vendor_id])->whereNotIn('id', $jobs)->select('id', 'name', 'unique_id')->latest()->get();

        return response()->json(compact('budgets', 'currencies', 'categories', 'my_products', "durations"));
    }
    public function new_product_details()
    {
        $categories = Category::all();
        return response()->json(compact('categories'));
    }
    public function add_product(Request $request, Product $product){

            $user = auth('api')->user();
            $vendor = Vendor::where('user_id', $user->id)->first();
            if(!$vendor){
                return response()->json([
                    "message"=>"You are not authorized to upload products."
                ], 400);
            }
            if($user->email_verified_at == null){
                return response()->json([
                    "message"=>"Your Email is not Verified, Please Verify Your Email"
                ], 400);
            }
            $phone_number = $user->phone_number;
            if ($phone_number === null || !$user->isPhoneVerified) {
                return  response()->json([
                    "message"=>"You can't post a job because you have not verified your phone number"
                ], 403);
            }
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:30',
                'description' => 'required|string|max:191',
                'images' => 'required',
                'category_id' => 'required',
                'price' => 'required|integer',
                'stock'=> 'required|integer',
                'shipping'=> 'required|integer'
            ]);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
            }
            
            $images = [];
            $colors = [];
            if($request->images && $request->images[0] == "["){
                if($request->images[1] != "'" && $request->images[1] != '"' && $request->images[1] != "`"){
                $strings = substr($request->images, 1, -1);
                $strs = str_replace(' ', '', $strings);
                $arry = explode(",",$strs);
                foreach($arry as $d){
                    array_push($images, "$d");
                }
                }
            }

            // return response()->json([
            //     "data"=>$images,
            //     "encoded"=>json_encode($images)
            // ]);
            // return response()->json($request->images);
            // if ($request->hasFile('images')) {
            if($request->image){
                // foreach( $request->file('images') as $mainItem){
                    // foreach ($request->images as $image) {
                    //     $filename = $image->getClientOriginalName();
                    //     $filename = $user->id . '_' . $filename;
                    //     // $path = $image->StoreAs('public/products', $filename);
                    //     $path =  $image->storePubliclyAs('product-images', $filename, 's3');
                    //     Storage::disk('s3')->setVisibility($path, 'public');
                    //     $images[] = $filename;

                        
                    // }
                // }
            }
    
            // if ($request->colors) {
            //     foreach (json_decode($request->colors) as $color) {
            //         $colors[] = $color;
            //     }
            // }
    
            // dd($colors);
    
    
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->vendor_id = $user->vendor->id;
            $product->unique_id = 'VIC-' . Str::random(26);
            $product->image = json_encode($images);
            $product->colors = $request->colors;
            $product->price = $request->price;
            $product->shipping = $request->shipping;
            $product->stock = $request->stock;
            $product->save();
    
            return response()->json([
                "message"=>"Product Added Succcessfully",
                'product'=>$product
            ]);
    
    }  
    public function upload_image(Request $request, Product $product){
        $user = auth('api')->user();

        $validator = Validator::make($request->all(),[
            'image' => 'required|file',
            "type" => 'required|string'
        ]);
        if($request->type == "job"){
        $bucket = "jobs-attachments";
        }
        if($request->type == "job-video"){
            $bucket = "jobs-video";
        }
        else if($request->type == "product"){
        $bucket = "product-images"; 
        }
        else{
        $bucket = "product-images"; 
        }
        if($validator->fails()){
                return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
                    $filename = $image->getClientOriginalName();
                    $filename = $user->id . '_' . $filename;
                    // $path = $image->StoreAs('public/products', $filename);
                    $path =  $image->storePubliclyAs($bucket, $filename, 's3');
                    Storage::disk('s3')->setVisibility($path, 'public');
                    // $array[] = $filename;
        
        }


        return response()->json([
            "message"=>"Image Added Succcessfully",
            "full_url"=>"$filename",
            "url"=>"https://viccomma-videos.s3.us-east-2.amazonaws.com/$bucket/$filename"
        ]);
    }
    public function add_job(Request $request, Job $job, Attachment $attachment) {
        // return response()->json(['tt'=>$request->all()]);
        $user = auth('api')->user();
        // dd("");
        // return;

        // return response()->json([
        //     "body"=>$request->all()
        // ]);
        if(!$user->vendor){
            return response()->json([
                "message"=>"You can't post a job because you are not a vendor"
            ], 403);
        }
        if($user->email_verified_at == null){
            return response()->json([
                "message"=>"Your Email is not Verified, Please Verify Your Email"
            ], 400);
        }
        $vendor_id = $user->vendor->id;


        if ($request->payment == 'residule') {
            // dd("Residule");
            $payment = 2;
            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:8000',
                'payment' => 'required',
                'category' => 'required',
            ]);
            $job->budget_id = NULL;
        } else {
            $payment = 1;
            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:8000',
                'payment' => 'required',
                'budget' => 'required',
            ]);
            $job->budget_id = $request->budget;
        }

        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        $job->name = $request->title;
        $job->description = $request->description;
        $job->currency_id = '5';
        $job->payment_id = $payment;
        $job->budget_id = $request->budget;

        $job->isApproved = 1; // 0 = in progress 1 = Completed
        $job->isAwarded = 0;
        $job->duration = $request->job_duration;
        $job->vendor_id = $vendor_id;
        $job->experience_level = $request->experience_level;
        $job->type = $request->type;
        $job->product_id = $request->product_id;
        if($request->prod_delivery){
            $job->product_delivery_method = $request->prod_delivery;
        }else{
            $job->product_delivery_method = 'none';
        }
        $job->unique_id = rand();
        $job->save();
        $docs = [];
        $format = [];
        if($request->docs && $request->docs[0] == "["){
            if($request->docs[1] != "'" && $request->docs[1] != '"' && $request->docs[1] != "`"){
            $strings = substr($request->docs, 1, -1);
            $strs = str_replace(' ', '', $strings);
            $arry = explode(",",$strs);
            foreach($arry as $d){
                array_push($docs, "$d");
            }
            }
        }
        // if ($request->hasFile('documents')) {
        //     foreach ($request->documents  as $file) {
        //         $filename = $file->getClientOriginalName();
        //         $filename = str_replace(["_", " ", "@", "/"], "-", $filename);
        //         $filename = time() . '_' . $filename;
        //         //$file->StoreAs('public'.DIRECTORY_SEPARATOR.'attachments', $filename);
        //         $file->storePubliclyAs('jobs-attachment', $filename, 's3');
        //         //$path = Storage::disk('s3')->url($path);
        //         $docs[] = "jobs-attachment/" . $filename;
        //         $format[] = $file->extension();
        //     }
        // }

        // Attachment::insert($insert);
        if($request->docs && $request->formats){
        $attachment->name = $user->vendor->vendor_station . ' ' . 'file';
        $attachment->file = json_encode($docs);
        $attachment->format = $request->formats;
        $attachment->job_id = $job->id;
        $attachment->vendor_id = $vendor_id;
        $attachment->uploaded_by = auth('api')->user()->id;
        $attachment->save();

        $update_job = Job::find($job->id);
        $update_job->attachment_id = $attachment->id;
        $update_job->save();
        }

       return response()->json([
        "message"=>"Job Uploaded"
    ]); 

    }  
    public function my_jobs() {
        $vendor_id = Vendor::where('user_id', auth('api')->user()->id)->first();
        $my_jobs = Job::with(['product'])->withCount('bids')->where('vendor_id', $vendor_id->id)->latest()->get();
        $completed_jobs = Job::where(['vendor_id' => $vendor_id->id, 'isCompleted' => Job::COMPLETED])->withCount('bids')->get();
        return response()->json(compact('my_jobs', 'completed_jobs'));
    }

    public function job_info($id)
    {
        $job = Job::where('id', $id)->with(["product"])->first();
        // dd(["vrndro"=>auth('api')->user()->hasRole('vendor'), 'creative'=>auth('api')->user()->hasRole('creative'), 'user_id'=>Auth::user()->id, "vendor_id"=>$job->vendor->user_id]);
        if (auth('api')->user()->hasRole('vendor') && auth('api')->user()->hasRole('creative') && $job->isAwarded && $job->vendor->user_id != auth('api')->user()->id && auth('api')->user()->id !== $job->influencer->id){
            // return response()->json(['message'=>'Job has been Awarded to another Creative'], 403);
        }
        else if (auth('api')->user()->hasRole('creative') && !auth('api')->user()->hasRole('vendor') && $job->isAwarded && auth('api')->user()->id !== $job->influencer->id){
            // return response()->json(['message'=>'Job has been Awarded to another Creative'], 403);
        }else if(auth('api')->user()->hasRole('vendor') && !auth('api')->user()->hasRole('creative') && $job->isAwarded && $job->vendor->user_id !=  auth('api')->user()->id){
            // return response()->json(['message'=>'Job has been Awarded']);
        }
        $vendor = Vendor::where("id", $job->vendor_id)->first();
        $vendor_info = User::where('id', $vendor->user_id)->first();
        $currency = $job->currency->symbol;
        $job_budget_min = $job->budget->min;
        $job_budget_max = $job->budget->max;
        $hasBid = DB::table('bids')
            ->where('job_id', $job->id)
            ->where('influencer_id', auth('api')->user()->id)
            ->exists();

        $awarded_creative = $job->influencer_id? User::where("id", $job->influencer_id)->first(): [];
        // dd($hasBid);
        $bids = Bid::with(["influencer:*"])->where('job_id', $job->id)->latest()->get();
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
        if ($job->isAwarded && $wallet) {
            $milestones = Milestone::where('job_id', $job->id)->get();
            $pay = Milestone::where(['job_id' => $job->id])->where(['completed' => '1', 'paid' => '0'])->first();
            $milestone_video = Milestone::where(['job_id' => $job->id, 'name' => 'Video Watched'])->first();

            $percentage = [$wallet->twenty_five, $wallet->fifty, $wallet->seventy_five, $wallet->hundred];
            $total = array_sum($percentage);



            $twenty_five = '0';
            $fifty = '0';
            $seventy_five = '0';
            $hundred = '0';

            if ($total == '25') {
                $hundred = '1';
            }
            if ($total == '50') {
                $seventy_five = '1';
                $hundred = '1';
            }
            if ($total == '75') {
                $fifty = '1';
                $seventy_five = '1';
                $hundred = '1';
            }
            if ($total == '100') {
                $twenty_five = '1';
                $fifty = '1';
                $seventy_five = '1';
                $hundred = '1';
            }
        } else {
            $milestone_video = null;
            $milestones = null;
            $pay = null;
            $twenty_five = '0';
            $fifty = '0';
            $seventy_five = '0';
            $hundred = '0';
        }

        // $subaccounts = Subaccount::where('user_id', Auth::user()->id)->get();
        $video = VideoContent::where('job_id', $job->id)->first();
        $token = DB::table('tokens')->where('job_id', $job->id)->latest()->first();
        $users = User::whereIn('id', $job->bids->pluck('influencer_id'))->select('id', 'first_name', 'last_name')->get();

        if (auth('api')->user()->hasRole('creative') || auth('api')->user()->hasRole('vendor')) {
            if (auth('api')->user()->hasRole('vendor') && !$job->isAwarded || Auth('api')->user()->hasRole('vendor') && $job->vendor->user_id == auth('api')->user()->id) {
                return response()->json(compact('job_budget_min', 'job_budget_max', 'currency', 'vendor_info', 'job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users', 'wallet', 'milestones', 'milestone_video', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred', 'awarded_creative'));
            } else if (auth('api')->user()->hasRole('creative') && !$job->isAwarded) {
                return response()->json( compact('job_budget_min', 'job_budget_max', 'currency', 'vendor_info', 'job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users', 'wallet', 'milestones', 'milestone_video', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred', 'awarded_creative'));
            } else if (auth('api')->user()->hasRole('creative') && $job->isAwarded && auth('api')->user()->id === $job->influencer->id) {
                return response()->json(compact('job_budget_min', 'job_budget_max', 'currency', 'vendor_info', 'job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users', 'wallet', 'milestones', 'milestone_video', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred', 'awarded_creative'));
            } else {
                // return response()->json(["message"=>"Unauthorized to view this job"], 403);
                return response()->json(compact('job_budget_min', 'job_budget_max', 'currency', 'vendor_info', 'job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users', 'wallet', 'milestones', 'milestone_video', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred', 'awarded_creative'));
            }
        } else {
            // return response()->json(["message"=>"Unauthorized to view this job"], 403);
            return response()->json(compact('job_budget_min', 'job_budget_max', 'currency', 'vendor_info', 'job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users', 'wallet', 'milestones', 'milestone_video', 'pay', 'twenty_five', 'fifty', 'seventy_five', 'hundred', 'awarded_creative'));
        }
        // dd($token);
        // return view('pages.user.jobs.show', compact('job', 'hasBid', 'bids', 'bidAverage', 'files', 'video', 'token', 'users'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'last_name'=>'required|string|max:30',
            'first_name' => 'required|string|max:30',
            'address' => 'required|string|max:70',
            'postal_code' => 'required|integer',
            'city' => 'required|string|max:30',
            'country_code' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
        }
        $country = DB::table("countries")->where("sort", $request->country_code)->first();
        if(!$country){
            return response()->json(['message'], 400);
        }
        $user = User::find(auth('api')->user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->street_address = $request->address;
        $user->postal_code = $request->postal_code;
        $user->city = $request->city;
        $user->country_id = $country->country_id;
        if($request->image){
            $user->image = $request->image;
        }
        $user->save();

        try {
            // $country = Country::find($user->country_id);
            $country_code = $country->sort;

            // what is the o notation for the currency?
            $currency = Currency::where('country_code', '=', $country_code)->first();

            if (!$currency) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Currency not found');
            }
            $user->currency = $currency->code;
            $user->save();
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $currency = Currency::where('country_code', '=', 'US')->first();
            $user->currency = $currency->code;
            $user->save();
        }
        // dd($user->save());
        return response()->json(['message'=>'Profile details updated successfully']);
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function authFacebook(Request $request)
    {   
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        try{
            $provider_user = Socialite::driver('facebook')->userFromToken($request->access_token);
        }catch (\Exception $e) {
            return response()->json(["message"=>"Please Check your access token"], 400);
        }
        if (!$provider_user) {
            //no user with the requested email
            return response()->json(['message'=>"There was an error with your request, check access token"], 400);
        }
        // $access_token = $fbAuthResponse->json()['access_token'];
        // $response = Http::withToken($request->access_token)->get($fbUserDetailsURL);
        //$response->body();
        // return response()->json($provider_user);
        $email = $provider_user->email;
        $name = $provider_user->name;
        $names = explode(" ", $name);
        $isUser = User::where('email', '=', $email)->first();
        $role = Role::where('name', 'General User')->first();
        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message'=>'No user associated with the requested Email Address!: '.$email], 404);
        }

        //check if email exist
        $user_active = User::where('email', $email)->where('status', User::ACTIVE)->first();

        if (!$user_active) {
            //no user with the requested email
            return response()->json(['message'=>'Your account is Inactive, kindly contact Vicomma Admin!'], 403);
        }
        if($user->email_verified_at == Null){
            return response()->json(['message'=>'Please Verify your account'], 403);
        }

            $token = auth('api')->fromUser($user);


            if ($user->hasRole('Admin')) {
                return response()->json(['message'=>'Incorrect Email or password'], 401);
            } elseif ($user->hasRole('Vendor')) {
                return $this->respondWithToken($token, 'vendor', $user->email);
            } elseif ($user->hasRole('Creative')) {
                return $this->respondWithToken($token, 'creative', $user->email);
            } elseif ($user->hasRole('General User')) {
                return $this->respondWithToken($token, 'user', $user->email);
            }
            else {
                return $this->respondWithToken($token, 'none', $user->email);
            }
    }

    public function regFacebook(Request $request)
    {
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);
        try{
            $provider_user = Socialite::driver('facebook')->userFromToken($request->access_token);
        }catch (\Exception $e) {
            return response()->json(["message"=>"Please Check your access token"], 400);
        }
        
        if (!$provider_user) {
            //no user with the requested email
            return response()->json(['message'=>"There was an error with your request, check access token"], 400);
        }
        // $access_token = $fbAuthResponse->json()['access_token'];
        // $response = Http::withToken($request->access_token)->get($fbUserDetailsURL);
        //$response->body();
        // return response()->json($provider_user);
        $email = $provider_user->email;
        $name = $provider_user->name;
        $names = explode(" ", $name);
        $isUser = User::where('email', '=', $email)->first();
        // $role = Role::where('name', 'General User')->first();
        $user = User::where('email', $email)->first();

        if (!$email) {
            //no user with the requested email
            return response()->json(['message'=>"Your account has no email address linked"], 400);
        }
        if ($user) {
            //no user with the requested email
            return response()->json(['message'=>"The Email Address: $email has already been registered"], 400);
        }
            $user = new User();
            $names = explode(" ", $name);
            $user->first_name = $names[1];
            $user->last_name = $names[0];
            $user->email = $email;
            $user->email_verified_at = Carbon::now();
            $password = Str::random(8);
            $user->password = Hash::make($password);
            $user->image = "https://ui-avatars.com/api/?background=random&name=$names[0]+$names[1]&size=128";
            $user->save();
            // $user->role()->attach($role->id); // role 5 is a general user id

            // $user = $user->last_name;
            $email = $email;
            $details = [
                'password' => $password,
                'user' => $user->last_name . ' ' . $user->first_name,
                'email' => $email,
                'message' => 'Thank you for registering with us'
            ];

            try {
                //create the motherfuckers on stripe
                $customer = $stripe->customers->create([
                    'description' => $user->first_name . " " . $user->last_name,
                    'email' => $email
                ]);
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return 'Error occured with Stripe Connection : .' . $e->getError()->message;
            }


            $user->notify(new FacebookRegistration($details));
            $token = auth('api')->fromUser(User::where('email', "=", $email)->first());

            if ($user->hasRole('Admin')) {
                return response()->json(['message'=>'Incorrect Email or password'], 401);
            } elseif ($user->hasRole('Vendor')) {
                return $this->respondWithToken($token, 'vendor', $user->email);
            } elseif ($user->hasRole('Creative')) {
                return $this->respondWithToken($token, 'creative', $user->email);
            } elseif ($user->hasRole('General User')) {
                return $this->respondWithToken($token, 'user', $user->email);
            }
            else {
                return $this->respondWithToken($token, 'none', $user->email);
            }
        //     // Auth::login($user);
        //     if (Auth::attempt(['email' => $email, 'password' => $password])) {
        //         $user = User::where('email', $email)->first();

        //         return redirect()->route('user.dashboard');
        //     } else {
        //         return redirect()->back()->with('login-error', 'Login Failed');
        //     }
       
    }

    public function regGoogle(Request $request){
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);
        try{
            $provider_user = Socialite::driver('google')->userFromToken($request->access_token);
        }catch (\Exception $e) {
            return response()->json(["message"=>"Please Check your access token"], 400);
        }
        
        if (!$provider_user) {
            //no user with the requested email
            return response()->json(['message'=>"There was an error with your request, check access token"], 400);
        }
        // $access_token = $fbAuthResponse->json()['access_token'];
        // $response = Http::withToken($request->access_token)->get($fbUserDetailsURL);
        //$response->body();
        // return response()->json($provider_user);
        $email = $provider_user->email;
        $name = $provider_user->name;
        $names = explode(" ", $name);
        $isUser = User::where('email', '=', $email)->first();
        // $role = Role::where('name', 'General User')->first();
        $user = User::where('email', $email)->first();

        if (!$email) {
            //no user with the requested email
            return response()->json(['message'=>"Your account has no email address linked"], 400);
        }
        if ($user) {
            $user_active = User::where('email', $email)->where('status', User::ACTIVE)->first();

        if (!$user_active) {
            //no user with the requested email
            return response()->json(['message'=>'Your account is Inactive, kindly contact Vicomma Admin!'], 403);
        }
        // if($user->email_verified_at == Null){
        //     return response()->json(['message'=>'Please Verify your account'], 403);
        // }

            $token = auth('api')->fromUser($user);

            if ($user->hasRole('Admin')) {
                return response()->json(['message'=>'Incorrect Email or password'], 401);
            } elseif ($user->hasRole('Vendor')) {
                return $this->respondWithToken($token, 'vendor', $user->email, false);
            } elseif ($user->hasRole('Creative')) {
                return $this->respondWithToken($token, 'creative', $user->email, false);
            } elseif ($user->hasRole('General User')) {
                return $this->respondWithToken($token, 'user', $user->email, false);
            }
            else {
                return $this->respondWithToken($token, 'none', $user->email,  false);
            }
        }
            $user = new User();
            $names = explode(" ", $name);
            $user->first_name = $names[1];
            $user->last_name = $names[0];
            $user->email = $email;
            $user->email_verified_at = Carbon::now();
            $password = Str::random(8);
            $user->password = Hash::make($password);
            $user->image = "https://ui-avatars.com/api/?background=random&name=$names[0]+$names[1]&size=128";
            $user->save();
            // $user->role()->attach($role->id); // role 5 is a general user id

            // $user = $user->last_name;
            $email = $email;
            $details = [
                'password' => $password,
                'user' => $user->last_name . ' ' . $user->first_name,
                'email' => $email,
                'message' => 'Thank you for registering with us'
            ];

            try {
                //create the motherfuckers on stripe
                $customer = $stripe->customers->create([
                    'description' => $user->first_name . " " . $user->last_name,
                    'email' => $email
                ]);
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return 'Error occured with Stripe Connection : .' . $e->getError()->message;
            }


            $user->notify(new GoogleRegistration($details));
            $token = auth('api')->fromUser(User::where('email', "=", $email)->first());

            if ($user->hasRole('Admin')) {
                return response()->json(['message'=>'Incorrect Email or password'], 401);
            } elseif ($user->hasRole('Vendor')) {
                return $this->respondWithToken($token, 'vendor', $user->email);
            } elseif ($user->hasRole('Creative')) {
                return $this->respondWithToken($token, 'creative', $user->email);
            } elseif ($user->hasRole('General User')) {
                return $this->respondWithToken($token, 'user', $user->email);
            }
            else {
                return $this->respondWithToken($token, 'none', $user->email);
            }
    }

    // Instagram login
    public function redirectToInstagram()
    {
        return Socialite::driver('instagram')->redirect();
    }

    public function authInstagram()
    {
        $user = Socialite::driver('instagram')->user();
    }

    // Twitter login
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function authTwitter()
    {
        $user = Socialite::driver('twitter')->user();

        return $user;
    }

    // Google callback
    public function handleGoogleCallback()
    {
        // $user = Socialite::driver('google')->user();

        // $this->_registerOrLoginUserGoogle($user);

        // Return home after login
        // return redirect()->route('user.dashboard');
    }

    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        //$this->_registerOrLoginUserGoogle($user);

        // Return home after login
        return 'Successfully logged in';
    }
    protected function authGoogle(Request $request)
    {

        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        try{
            $provider_user = Socialite::driver('google')->userFromToken($request->access_token);
        }catch (\Exception $e) {
            return response()->json(["message"=>"Please Check your access token"], 400);
        }
        if (!$provider_user) {
            //no user with the requested email
            return response()->json(['message'=>"There was an error with your request, check access token"], 400);
        }
        // $access_token = $fbAuthResponse->json()['access_token'];
        // $response = Http::withToken($request->access_token)->get($fbUserDetailsURL);
        //$response->body();
        // return response()->json($provider_user);
        $email = $provider_user->email;
        $name = $provider_user->name;
        $names = explode(" ", $name);
        $isUser = User::where('email', '=', $email)->first();
        $role = Role::where('name', 'General User')->first();
        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message'=>'No user associated with the requested Email Address!: '.$email], 404);
        }

        //check if email exist
        $user_active = User::where('email', $email)->where('status', User::ACTIVE)->first();

        if (!$user_active) {
            //no user with the requested email
            return response()->json(['message'=>'Your account is Inactive, kindly contact Vicomma Admin!'], 403);
        }
        // if($user->email_verified_at == Null){
        //     return response()->json(['message'=>'Please Verify your account'], 403);
        // }

            $token = auth('api')->fromUser($user);

            if ($user->hasRole('Admin')) {
                return response()->json(['message'=>'Incorrect Email or password'], 401);
            } elseif ($user->hasRole('Vendor')) {
                return $this->respondWithToken($token, 'vendor', $user->email, false);
            } elseif ($user->hasRole('Creative')) {
                return $this->respondWithToken($token, 'creative', $user->email, false);
            } elseif ($user->hasRole('General User')) {
                return $this->respondWithToken($token, 'user', $user->email, false);
            }
            else {
                return $this->respondWithToken($token, 'none', $user->email, false);
            }
    }


    // public function redirectYouTube() {

    // }

    public function youtube()
    {
        return view('pages.auth.youtube');
    }


    public function updateEmail(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'email' => 'required|unique:users|email|max:50',
            'current_password' => 'required|min:6'
        ]);
        
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
            }
        $user = User::find(auth("api")->user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->email = $request->email;
            $user->email_verified_at = NULL;
            $user->save();
            return response()->json(['message'=>'Email updated successfully, Please verify your new email address']);
        }
        else {
            return response()->json(['message'=>'Incorrect Password'], 400);
        }
    }



    public function myJobs()
    {
        $auth_user = auth('api')->user();
        $vendor_id = Vendor::where('user_id', auth('api')->user()->id)->first();
        $station_details = $vendor_id;
        $my_jobs = Job::with(["budget:*", 'product:*'])->withCount('bids')->where('vendor_id', $vendor_id->id)->latest()->get();
        $completed_jobs = Job::with(["budget:*"])->withCount('bids')->where(['vendor_id' => $vendor_id->id, 'isCompleted' => Job::COMPLETED])->get();
        $my_rating = DB::table("reviews")->join("products", "products.id", "reviews.product_id")->where("products.vendor_id", $vendor_id->id)->avg("reviews.rating");
        $total_ratings = DB::table("reviews")->join("products", "products.id", "reviews.product_id")->where("products.vendor_id", $vendor_id->id)->count();
        $total_jobs = Job::where('vendor_id', $vendor_id->id)->count();
        $disputes = DB::table("disputes")->where("vendor_id", $auth_user->id)->count();
        return response()->json(compact('my_jobs', 'completed_jobs', "station_details", "my_rating", "total_jobs", "disputes", "total_ratings"));
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
        ]);
        $job = Job::where('id', $request->job_id)->first();
        // $user = User::where('id', $job->vendor->user->id)->first();
        //dd($request);
        
        $video = $job->video;
        if ($video) {
            return redirect()->back()->with('swal-error', 'Video already uploaded for this Job');
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
        $video->save();

        $job->video_id = $video->id;
        $job->save();
		$milestone = Milestone::where('job_id', $job->id)->where('name', 'Video Uploaded')->first();
        $milestone->completed = '1';
        $milestone->save();

        //redirect to generateToken action in JobManagementController
        // $token = redirect('/jobs/'.$job->id.'/generateToken');
        // dd($token->data);

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
        $user = User::findOrFail($job->vendor->user->id);
        // $creative_awarded = Influencer::findOrFail($request->influencer_id);
        $creative = User::findOrFail($job->influencer->id);
        $details = [
            'url' => route('user.jobs.show', $job->unique_id),
            'user' => $user->last_name . ' ' . $user->first_name,
            'message' => 'A New Content has been delivered for your job.'
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


        //Todo: change this to send last payment link
        return redirect()->back()->with('success','Video uploaded successfully, vendor will be notified');
    }

    public function videoDownload($id)
    {
        $video = VideoContent::where('job_id', $id)->first();
        // dd($video, $id);
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
        $milestone = Milestone::where('job_id', $request->job_id)->where('name', 'Video Watched')->first();
        if (is_null($video->viewed_at)) {
            $video->viewed_at = now();
            $milestone->completed = '1';
            $milestone->save();
            $video->save();
        }
        return response()->json(['video' => $milestone]);
    }

    public function my_products()
    {
        $vendor = Vendor::where('user_id', auth("api")->user()->id)->first();
        //show only approved products
        $products = Product::where(['vendor_id'=> $vendor->id, 'status' => Product::APPROVED])->get();
        $product_count = Product::where(['vendor_id'=> $vendor->id, 'status' => Product::APPROVED])->count();
        $cover_photo = $vendor->banner != '' ? asset($vendor->banner) : 'https://staging.vicomma.com/img/vendorBG.jpg';
        $sold = DB::table("orderdetails")->join("products", "products.id", "orderdetails.product_id")->where("products.vendor_id", $vendor->id)->count();
        $disputes = DB::table("disputes")->where("vendor_id", $vendor->id)->count();
        $ratings = DB::table("reviews")->join("products", "products.id", "reviews.product_id")->where("products.vendor_id", $vendor->id)->avg("rating");
        $ratings_count = DB::table("reviews")->join("products", "products.id", "reviews.product_id")->where("products.vendor_id", $vendor->id)->count();
        $verified =  auth("api")->user()->country_id &&  auth("api")->user()->flutterwaveSubaccount &&  auth("api")->user()->email_verified_at;
        return response()->json(compact('vendor', 'products', "cover_photo", "sold", "disputes", "ratings", "ratings_count", "verified"));
    }

    public function award(Request $request)
    {        
        $validator = Validator::make($request->all(),[
        'job_id' => 'required|integer',
        'influencer_id'=> 'required|integer',
        'bid_amount'=> 'required|integer'

    ]);

    if($validator->fails()){
        return response()->json(["message"=>$validator->errors()->all()[0]], 400);
    }
        // dd($request->all());
        $job = Job::findOrFail($request->job_id);
        if ($job->isAwarded) {
            return redirect()->back()->with('swal-error', 'Job already Assigned to a creative');
        }
        $job->influencer_id = $request->influencer_id;
        $job->isAwarded = 1;
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
            'url' => route('public.faq'),
            'message' => 'Creative, make sure the content you create adheres to our guidelines, for information on what these guidelines are simply visit the Frequently Asked Questions section or just click on the following link:',
            'job' => $job->name,
        ];
        // $user->notify(new JobAwardNotification($details));
        // $creative->notify(new JobAwardNotification2($details2));
        // $creative->notify(new VideoGuidelines($details3));
        return response()->json(['message'=>'Job Assigned to Creative successfully']);
    }

    public function getChats(Request $request)
    {
        $uid = User::find(auth("api")->user()->id)->id;
        $all_chats = [];
        $latest = [];
        $chats = Chat::orderBy('created_at', 'desc')->where('sender', $uid)->orWhere('receiver', $uid)->where('job_status', 1)->get()->groupBy(function($val){
            return $val->bid_id;
        });
        

        foreach($chats as $key=>$chat){
            $latest_chat = ['bid'=>$key, 'chat'=>$chat[0]];
            array_push($latest, $latest_chat);
            
        }

        
        // $count = count($latest_chat);

        foreach($latest as $data){

            if($data['chat']['sender'] == $request->user){
                $datetime = $data['chat']['created_at'];
                $time = date('D, h:m', strtotime($datetime));

                $bid = Bid::find($data['bid']);
                $job_name = $bid->job->name;
                $sent_chats = ['last_chat'=>$data['chat'],  'job_name'=>$job_name, 'time'=>$time, 'sender'=>'user', 'receiver'=>User::find($data['chat']['receiver']), 'bid'=>Bid::find($data['chat']['bid_id']), 'job'=>Job::find($data['chat']['job_id'])];
                array_push($all_chats, $sent_chats);
            
            }else{
                $datetime = $data['chat']['created_at'];
                $time = date('D, h:m', strtotime($datetime));
                
                $bid = Bid::find($data['bid']);
                $job_name = $bid->job->name;

                $received_chats = ['last_chat'=>$data['chat'], 'job_name'=>$job_name, 'time'=>$time, 'sender'=> User::find($data['chat']['sender']), 'receiver'=>'user', 'bid'=>Bid::find($data['chat']['bid_id']), 'job'=>Job::find($data['chat']['job_id'])];
                array_push($all_chats, $received_chats);

            }
        }
        
        return response()->json(["data"=>$all_chats]);
    }
    public function getMsgs(Request $request)
    {
        $b_id = $request->b_id;
        if(auth("api")->user()){
        if(auth("api")->user()->hasRole("vendor")){
        $bid = Bid::find($b_id);
        $influencer = User::find($bid->influencer_id);
        $job = Job::find($bid->job_id);
        $vend = Vendor::find($job->vendor_id);
        $vendor = User::find($vend->user_id);
        $chats = Chat::where('bid_id', $b_id)->get();

        $milestone = Milestone::where('job_id', $job->id)->where(['completed' => '1', 'paid'=> '0'])->first();

        $currency = $job->currency->symbol;

        if($milestone){
            
            $milestone['currency'] = $currency;
        }

        foreach($chats as $chat){
            $datetime = $chat['created_at'];
            $time = date('D, h:m', strtotime($datetime));
            $chat['time'] = $time;
        }
        

        
        return response()->json(['chats'=>$chats, 'job'=>$job, 'vendor'=>$vendor,  'influencer'=>$influencer, 'bid'=>$bid, 'milestone'=>$milestone]);
    
        }else if(auth("api")->user()->hasRole("creative")){
            $bid = Bid::find($b_id);
            $influencer = Vendor::find($bid->influencer_id);
            $job = Job::find($bid->job_id);
            $vendor = User::find($job->vendor_id);
            $chats = Chat::where('bid_id', $b_id)->get();
            return response()->json(['chats'=>$chats, 'job'=>$job,'influencer'=> $influencer, 'bid'=>$bid]);
        }else {
            return response()->json([
                "message"=>"No chats available"
            ]);
        }
    }
    else {
        return response()->json([
            "message"=>"You're not logged in"
        ]);
    }
    }


    public function mall_products(Request $request){
        $from = $request->from;
        $to = $request->to;
        $cat = $request->cat;
        $search = $request->search;
        $show = $request->show;
        if($request->sort && $request->sort == "DESC" || $request->sort == "ASC"){
        $sort = $request->sort;
        }else{
        $sort = "DESC";
        }
        $category = "";
        if($cat){
            $category = DB::table("categories")->where("id", $cat)->first();
        }
        if($request->show){
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*', "reviews:*"])
            ->when($from, function ($query, $from){
                $query->where('price', ">=", $from);
            })
            ->when($to, function ($query, $to){
                $query->where('price', "<=", $to);
            })
            ->when($category, function ($query, $category){
                $query->where('category_id', $category->id);
            })
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orderBy("id", $sort)->paginate($show);
        }else {
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])
            ->when($from, function ($query, $from){
                $query->where('price', ">=", $from);
            })
            ->when($to, function ($query, $to){
                $query->where('price', "<=", $to);
            })
            ->when($category, function ($query, $category){
                $query->where('category_id', $category->id);
            })
            ->when($search, function ($query, $search){
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orderBy("id", $sort)->paginate(18);
        }
        // dd($products);
        return response()->json(compact("products", "show", "from", "to", "sort", "category", "search"));
    }

    public function home(Request $request){
        $current_category = "all";
        $categories = Category::all();
        $cat = $request->category;
        $category = "";
        if($cat){
            $category = DB::table("categories")->where("id", $cat)->first();
            $current_category = DB::table("categories")->where("id", $cat)->first();
        }
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])
            ->when($category, function ($query, $category){
                $query->where('category_id', $category->id);
            })
            ->limit(40)
            ->orderBy("id", "DESC")->paginate(18);

        $banners = [
            "https://staging.vicomma.com/new/VICOMMA SLIDER.jpeg",
            "https://staging.vicomma.com/new/VICOMMA SLIDER1.jpeg",
            "https://staging.vicomma.com/new/VICOMMA SLIDER2.jpeg",
        ];
        // dd($products);
        return response()->json(compact("products","category", "current_category", "categories", "banners"));
    }
    public function mall_product($id){
        $product = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("id", $id)->first();
        if(!$product){
            return response()->json([
                "message"=> "No Product associated with the provided ID"
            ], 404);
        }
        $pid = $product->id;
        $images = json_decode($product->image);
        $colors = json_decode($product->colors);
        function get_perc($num, $main){
            if($main == 0 || $num == 0){
                return 0;
            }
            $count1 = $num / $main;
            $count2 = $count1 * 100;
            $count = number_format($count2, 0);
            return $count;
        }

        //no=
        $job = Job::where('product_id',$id)->where('isApproved', Job::APPROVED)->with('video')->first();
        if($job && $job->isCompleted == Job::COMPLETED){
            $video = $job->video;
        }else{
            $video = null;
        }
        $has_logged_in_user_commented = auth("api")->check()? DB::table("reviews")->where("product_id", $product->id)->where("user_id", auth('api')->user()->id)->exists() : false;
        $reviews = DB::table("reviews")->join("users", "reviews.user_id", "users.id")->where("reviews.product_id", $product->id)->orderBy("reviews.id", "DESC")->select("reviews.*", "users.first_name", "users.last_name", "users.image")->paginate(10);
        $count = DB::table("reviews")->where("product_id", $product->id)->count();
        $five = DB::table("reviews")->where("product_id", $product->id)->where("rating", 5)->count();
        $four = DB::table("reviews")->where("product_id", $product->id)->where("rating", 4)->count();
        $three = DB::table("reviews")->where("product_id", $product->id)->where("rating", 3)->count();
        $two = DB::table("reviews")->where("product_id", $product->id)->where("rating", 2)->count();
        $one = DB::table("reviews")->where("product_id", $product->id)->where("rating", 1)->count();
        $rating = DB::table("reviews")->where("product_id", $product->id)->avg('rating');
        $total = DB::table("reviews")->where("product_id", $product->id)->sum('rating');
        $five_perc = get_perc($five, $count);
        $four_perc = get_perc($four, $count);
        $three_perc = get_perc($three, $count);
        $two_perc = get_perc($two, $count);
        $one_perc = get_perc($one, $count);

        $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("vendor_id", $product->vendor->id)->where("id", "!=", $product->id)->orderBy("id", "DESC")->limit(3)->get();
        // dd($product->vendor->user);
        return response()->json(compact('pid', 'product', 'images', 'colors','video', "products", "rating", "five_perc", "four_perc", "three_perc", "two_perc", "one_perc", "count", "has_logged_in_user_commented", "total", "reviews"));
    }
    public function rate(Request $request){
        $rating = $request->rating;
        $review = $request->review;
        $product_id = $request->product;
        if(DB::table("reviews")->where(["product_id"=>$product_id, "user_id"=>auth('api')->user()->id])->exists()){
            return response()->json([
                "message"=>"You can't rate this product twice"
            ], 400);
        }
        DB::table("reviews")->insert([
            "product_id"=>$product_id,
            "user_id"=>auth('api')->user()->id,
            "rating"=>$rating,
            "review"=>$review
        ]);
        return response()->json([
            "message"=>"Thanks for your feedback"
        ]);
    }

    public function notifications(){
        $notifications = [];
        $user = auth('api')->user();
        $id = $user->id;
        $notis = Notification::where('receiver', $id)->orderBy('created_at', 'asc')->get();
        $unread = Notification::where('receiver', $id)->where('status', 0)->get();
        $general = GeneralNotification::where('receivers', $id)->orderBy('created_at', 'asc')->get();
        foreach($notis as $not){
            $not['senderObject'] = User::find($not->sender);
            $not['about'] = 'individual';
            $date = date('dS M, Y, h:i', strtotime($not->created_at));
            $not['date'] = $date;
            array_push($notifications, $not);
        }

        foreach($general as $gen){
            $gen['about'] = 'general';
            $gen['senderObject'] = '';
            $date = date('dS M, Y, h:i',  strtotime($gen->created_at));
            $gen['date'] = $date;
            array_push($notifications, $gen);
        }

        $count = count($unread);



        return ['notifications'=>array_reverse($notifications), 'count'=>$count];
        

    }

    public function update_store(Request $request)
    {
        $user_id = Auth('api')->user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        $request->validate([
            'header' => 'string|max:50',
            'slogan' => 'string|max:50',
            'primary_color' => 'string|max:50',
            'secondary_color' => 'string|max:50',
            'button_color' => 'string|max:50',
        ]);

        $vendor->header = $request->header;
        $vendor->slogan = $request->slogan;
        $vendor->primary_color = $request->primary_color;
        $vendor->secondary_color = $request->secondary_color;
        $vendor->button_color = $request->button_color;
        $vendor->save();
        return response()->json(['message'=>'Station Updated']);
    }

    public function two_fa_toggle(Request $request){
        $id = auth('api')->user()->id;
        $user = User::where("id", $id)->first();
        if(!$id){
            return response()->json(["message"=>"Invalid User"], 404);
        }
        if($user->two_fa){
            User::where("id", $user->id)->update(["two_fa"=>0]);
            return response()->json(["message"=>"2FA has been disabled"]);
        }else {
            User::where("id", $user->id)->update(["two_fa"=>1]);
            return response()->json(["message"=>"2FA is now enabled"]);
        }
    }

    public function updatePhoneNumber(Request $request)
    {
        // dd($request->all());
        $user = User::find(auth('api')->user()->id);
        $request->validate([
            'phone_number' => 'required|max:10|min:10'
        ]);
        // $country = Country::where('id', $user->country_id)->select('phone_code')->first();
        $country_code = $request->country_code;
        $phone_number = '+' . $country_code . $request->phone_number;
        $user->phone_number = $phone_number;

        $user->save();
        /* Get credentials from .env */
        $token = env("TWILIO_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phone_number, "sms");
        return response()->json([
            'message'=>"A Token has been sent to: $phone_number, for confirmation."
        ]);
        // return redirect()->view('pages.user.profile.verify-phone', compact(['phone_number' => $request->phone_number]));
    }

    public function phoneVerificationView(Request $request)
    {

       $validator =Validator::make($request->all(),[
            'verification_code' => 'required',
            'phone_number' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->all()[0]], 400);
            }
        /* Get credentials from .env */
        $token = env("TWILIO_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        
        $twilio = new Client($twilio_sid, $token);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(array('to' => "+".$request->phone_number, "code"=>$request->verification_code));
        if ($verification->valid) {
            $user = User::where('phone_number', auth('api')->user()->phone_number)->where('id',  auth('api')->user()->id)->first();
            $user->isPhoneVerified = true;
            $user->save();
            // Send email
            $details = [
                'user' => $user->last_name . ' ' . $user->first_name,
                'message' => 'Your phone number was successfully Verified!.'
            ];
            $user->notify(new PhoneVerification($details));
            /* Verification successful for the user */
            // user.vendors.products
            // if($user->role == 'vendor'){
            //     $vendor = auth()->user()->vendor;
            //     $product = DB::table("products")->where("vendor_id", $vendor->id)->latest()->first();
            //     return redirect()->route('user.vendors.edit',['id' => $product->id])->with(['success' => 'Phone number verified']);
            // }else{
            //     return redirect()->route('user.profile')->with(['success' => 'Phone number verified']);
            // } 
            return response()->json(['message' => 'Phone number verified']);
        }
        return response()->json(['message' => 'Invalid verification code entered!'], 400);
    }
    public function delete_job(Request $request){
        $job = Job::where('id', $request->id)->first();
        if(!$job){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }
        if(auth('api')->user()->hasRole('vendor') && $job->vendor->user_id != auth('api')->user()->id){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }

        if(auth('api')->user()->hasRole('creative')){
            return response()->json(['message'=>"Invalid Job ID Provided"], 400);
        }
        if($job->isAwarded){
            return response()->json(['message'=>"This Job Failed to delete as it has been awarded."], 400);
        }

        $job->delete();
        return response()->json(["message"=>"Job Deletion Successful"]);


    }
    public function deletedJobs()
    {
        $vendor_id = Vendor::where('user_id', auth('api')->user()->id)->first();
        if(!$vendor_id){
            return response()->json(["message"=>"You're not a vendor"], 400);
        }
        $deleted_jobs = Job::withTrashed()->where('vendor_id', $vendor_id->id)->where("deleted_at", "!=", null)->latest()->get();
        return response()->json(compact("deleted_jobs"));
    }


    public function delete_product(Request $request)
    {
        $vendor = auth('api')->user()->vendor;
        $id = $request->id;
        $product = Product::where('id', $id)->where("vendor_id", $vendor->id)->first();
        if(!$product){
            return response()->json(["message"=>"You cannot delete this Product"], 400);
        }
        $product->delete();
        return response()->json(["message"=>"Product Deleted"]);
    }

}
