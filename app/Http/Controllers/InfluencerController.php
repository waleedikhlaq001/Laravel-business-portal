<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Influencer;
use App\Models\InfluencerCategory;
use App\Models\InfluencerDetails;
use App\Models\InfluencerType;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AccountUpdate;
use App\Notifications\SocialAccountLink;
use App\Notifications\UserRegistration;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class InfluencerController extends Controller
{
    public function general()
    {
        //$user = User::where('id', Auth::user()->id)->first();
        $currencies = Currency::all();
        $categories = Category::all();
        $skills = Skill::all();
        return view('pages.user.influencer.general', compact('currencies', 'skills', 'categories'));
    }

    public function email_exists(Request $request)
    {
        $email = $request->email;
        $email_exists = User::where('email', $email)->first();
        // $data['email'] = $email;
        if ($email_exists) {
            $data['error'] = 'This email already exists';
            return response()->json($data);
        } else {
            $data['success'] = 'Email check complete';
            return response()->json($data);
        }
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $categories = Category::all();
        $currencies = Currency::all();
        $skills = Skill::all();
        return view('pages.user.influencer.register', compact('user', 'currencies', 'skills', 'categories'));
    }

    public function register(Request $request, Influencer $influencer, InfluencerDetails $influencerDetails)
    {
        // dd($request->all());
        $type = InfluencerType::where('name', 'free')->first();
        // dd($request->all());
        // return;
        // influencer type id
        // get user instagram followers, this will be useed to categorize the influencer
        // influencer category
        $category = InfluencerCategory::where('name', 'Nano Influencers')->first();
        $request->validate([
            'influencer_years_experience' => 'required|string',
            'inflencer_services_provided' => 'required|string',
            'influencer_followers' => 'required|string',
            'influencer_previous_job' => 'required|string',
            // 'influencer_turnaround_time' => 'required|string',
            'influencer_charges' => 'required|string',
            // 'influencer_clients' => 'required|string',
        ]);
        // dd($request->all());
        if ($request->has('guser')) {
            // $request->validate(
            //     [
            //         'email' => 'required|string|unique:users',
            //         'first_name' => 'required|string',
            //         'last_name' => 'required|string',
            //         'password' => 'required|string',
            //         // 'g-recaptcha-response' => 'required|captcha',
            //     ],
            //     [
            //         // 'email.required' => 'Email field is required',
            //         // 'email.unique' => 'This email already exists',
            //         'first_name.required' => 'First Name field is required',
            //         'last_name.required' => 'Last Name field is required',
            //         'instagram_handle.required' => 'Instagram Handle field is required',
            //         // 'g-recaptcha-response.required' => 'reCaptcha is required',
            //         // 'password.required' => 'Password field is required',
            //     ]
            // );

            $role = Role::where('name', 'General User')->first();

            $user = User::findOrFail(Auth::user()->id);
            $user->role = 'influencer';

            $user->instagram = $request->instagram_handle;
            $user->vcoin = 10;
            $user->tiktok = $request->tiktok_handle;
            $user->twitter = $request->twitter_handle;
            $user->save();
            $user->role()->attach($role->id);

            $token = Str::random(64);


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


            $influencerDetails->video_title  = $request->video_title;
            $influencerDetails->video_description  = $request->video_desc;
            $influencerDetails->video = Storage::disk('s3')->url($video_path);
        } else {
        }

        // Saving influencer details

        $user = User::findOrFail(Auth::user()->id);
        $influencerDetails->influencer_years_experience = $request->influencer_years_experience;
        $influencerDetails->influencer_followers = $request->influencer_followers;
        $influencerDetails->influencer_previous_job = $request->influencer_previous_job;
        $influencerDetails->inflencer_services_provided = $request->inflencer_services_provided;
        $influencerDetails->influencer_charges = $request->influencer_charges;
        $influencerDetails->influencer_clients = $request->influencer_clients;
        $influencerDetails->charge_per_hour = $request->charge_per_hour;
        $influencerDetails->experience_level = $request->experience_level;
        $influencerDetails->influencer_turnaround_time = $request->influencer_turnaround_time;
        if ($request->has('guser')) {
            $influencerDetails->currency_id = '5';
        } else {
            $influencerDetails->currency_id = '5';
        }
        $influencerDetails->user_id = $user->id;
        $influencerDetails->save();

        $code = Str::random(20);
        $influencer->user_id = $user->id;
        $influencer->influencer_type_id = $type->id;
        $influencer->influencer_category_id = $category->id;
        $influencer->code = $code;

        $role = Role::where('name', 'Creative')->first();

        $user->role = 'influencer';

        $user->instagram = $request->instagram_handle;
        $user->vcoin = 10;
        $user->tiktok = $request->tiktok_handle;
        $user->twitter = $request->twitter_handle;
        $user->save();

        $user->role()->attach($role->id);
        $user->role()->attach($role->id); // role 4 is the influencer role id
        if ($user->hasRole('vendor')) {
            $role2 = Role::where('name', 'Vendor')->first();
            DB::table("role_user")->where(["role_id" => $role2->id, "user_id" => $user->id])->update([
                "active" => 0
            ]);
        }
        $influencer->save();

        if ($request->has('guser')) {
            //create activity log
            $activity = new Activity;
            $activity->type = 'creative_register';
            $activity->name = 'Creative Account Created';
            $activity->description = 'You are now a Creative, click the link to <b>Complete your Profile</b>';
            $activity->user_id = $user->id;
            $activity->url = '/settings';
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'influencer';
            $activity->save();
        } else {
            //create activity log
            $activity = new Activity;
            $activity->type = 'account_update_creative';
            $activity->name = 'Account Updated to Creative';
            $activity->description = 'You are now a Creative, click the link to see available <b>Jobs</b>';
            $activity->user_id = $user->id;
            $activity->url = '/settings';
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'influencer';
            $activity->save();
        }

        $email = $user->email;
        $token = Str::random(64);
        // Notify user
        if ($request->has('guser')) {
            $details = [
                'user' => $user->last_name . ' ' . $user->first_name,
                'url' => route('email.verify.get', $token),
                'message' => 'You have successful created your Creative account, explore all the functionalities available for you now'
            ];
        } else {
            $details = [
                'user' => $user->last_name . ' ' . $user->first_name,
                'url' => route('email.verify.get', $token),
                'message' => 'You have successful upgraded your account to become a Creative, explore all the functionalities available for you now'
            ];
        }

        if (!$request->direct) {
            $user->notify(new AccountUpdate($details));
        }
        if (!$user->email_verified_at) {
            $agent = $request->userAgent();
            $ip = $request->ip(); /* Static IP address */
            $loc_info = Location::get($ip);
            $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
            DB::table('verif_tokens')->insert(
                ['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]
            );
            $details2 = [
                'url' => route('email.verify.get', $token),
                'user' => $user->lname . ' ' . $user->fname,
                "agent" => "$agent",
                "location" => "$location",
                "time" => Carbon::now(),
                'message' => 'Ok, so you have made it this far… 
                Here is your referral link to share which can earn you credits and cash: <a href="https://vicomma.com/referral/' . $user->id . '">https://vicomma.com/referral/' . $user->id . '</a><br />. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
            ];
            $user->notify(new UserRegistration($details2));
        }


        return redirect()->route('user.jobs.index')->with('success', 'You have successfully upgraded your account to become a Creative');
    }

    public function instagram(Request $request)
    {
        // return response()->json(['username' => $username]);
        // dd($request->all());
        $response = Http::get('https://instagram.com/' . $request->username . '?__a=1');
        // dd(json_decode($response));
        return redirect()->back()->with($response);
        // return response()->json(['message' => $response, 'worked' => 'hitting the route']);
    }

    public function redirectToInstagram()
    {
        return redirect()->to('https://api.instagram.com/oauth/authorize?client_id=' . env('INSTAGRAM_CLIENT_ID') . '&redirect_uri=' . env('INSTAGRAM_REDIRECT_URI') . '&scope=user_profile,user_media&response_type=code');
    }

    public function redirectToFacebook()
    {
        $client_id = env('FACEBOOK_CLIENT_ID');
        $client_secret = env('FACEBOOK_CLIENT_SECRET');
        $client_redirect = env('FACEBOOK_INFLUENCER_REDIRECT_URI');
        $randomId = uniqid("vm-");
        return redirect()->to("https://www.facebook.com/v12.0/dialog/oauth?client_id=$client_id&redirect_uri=$client_redirect&state=$randomId");
    }

    public function authInstagram(Request $request, Influencer $influencer)
    {
        $code = $request->code;
        $response = Http::asform()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => env('INSTAGRAM_CLIENT_ID'),
            'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
            'redirect_uri' => env('INSTAGRAM_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => $code
        ]);

        $content = json_decode($response);
        if ($response->status() != 200) {
            // return redirect()->route('auth.login')->with('error', 'Unauthorized login to Instagram.');
            dd("Error Occured");
        }
        $user_ig_details = Http::get(
            'https://graph.instagram.com/v11.0/' . $content->user_id . '?fields=id,username,media_count&access_token=' . $content->access_token
        );

        $user_ig_details = json_decode($user_ig_details);
        // 17841402414680357

        // Updating instagram column on users table
        $user = User::find(Auth::user()->id);
        $user->instagram = $user_ig_details->username;
        $user->user_instagram_id = $user_ig_details->id;
        $user->save();

        // $influencer->instagram_followers =
        $details = [
            'user' => $user->first_name . ' ' . $user->last_name,
            'message' => 'You have successfully linked Instagram to your account',
            'account' => $user->instagram
        ];
        //Notify user by sending email
        $user->notify(new SocialAccountLink($details));

        //redirect user
        return redirect(route('user.profile'))->with('success', 'Instagram linked successfully');
    }

    public function authFacebook(Request $request, Influencer $influencer)
    {
        $client_id = env('FACEBOOK_CLIENT_ID');
        $client_secret = env('FACEBOOK_CLIENT_SECRET');
        $client_redirect = env('FACEBOOK_INFLUENCER_REDIRECT_URI');
        $furl = "https://graph.facebook.com/v12.0/oauth/access_token?client_id=$client_id&redirect_uri=$client_redirect&client_secret=$client_secret&code=$request->code";

        $fbAuthResponse = Http::get($furl);

        $fbUserDetailsURL = "https://graph.facebook.com/v12.0/me?fields=id,name,email";
        $access_token = $fbAuthResponse->json()['access_token'];
        $response = Http::withToken($access_token)->get($fbUserDetailsURL);
        $id = $response->json()['id'];
        $email = $response->json()['email'];
        $name = $response->json()['name'];
        $names = explode(" ", $name);


        // Updating instagram column on users table
        $user = User::find(Auth::user()->id);
        $user->facebook = $name;
        $user->user_instagram_id = $id;
        $user->save();

        // $influencer->instagram_followers =
        $details = [
            'user' => $user->first_name . ' ' . $user->last_name,
            'message' => 'You have successfully linked Facebook to your account',
            'account' => $user->facebook
        ];

        //Notify user by sending email
        $user->notify(new SocialAccountLink($details));

        //redirect user
        return redirect(route('user.profile'))->with('success', 'Facebook linked successfully');
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

    public function influencerProfile($code)
    {
        $influencer = Influencer::where('user_id', $code)->first();
        $user = User::find($influencer->user_id);
        $portfolio = Portfolio::where("user_id", $user->id)->orderBy("id", "DESC")->get();
        $details = InfluencerDetails::where("user_id", $user->id)->orderBy("id", "DESC")->first();
        return view('pages.user.influencer.profile', compact('influencer', 'user', 'portfolio', "details"));
    }

    public function addSkills(Request $request)
    {
        $request->validate([
            'skills'  => 'required|array|min:1',
        ]);
        $details = InfluencerDetails::where('user_id', Auth::user()->id)->first();
        $skills = [];
        if ($request->skills) {
            foreach ($request->skills as $skill) {
                $skills[] = $skill;
            }
        }

        $details->influencer_skills = json_encode($skills);
        $details->save();
        return redirect()->back()->with('success', 'skills added');
    }
}
