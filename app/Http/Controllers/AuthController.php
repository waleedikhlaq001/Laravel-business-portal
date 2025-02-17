<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Token;
use App\Models\VerifToken;
use App\Models\User;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Controllers\UserController;
use App\Models\Activity;
use App\Models\Job;
use App\Models\Product;
use App\Models\Vendor;
use App\Notifications\TwoFa;
use App\Notifications\GoogleRegistration;
use App\Notifications\FacebookRegistration;
use App\Notifications\PasswordReset;
use App\Notifications\UserRegistration;


class AuthController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $reff = "";
        if ($request->ref) {
            $reff = $request->ref;
        }
        // $this->middleware('guest')->except('logout');
        return view('pages.auth.login-ajax', compact("reff"));
    }

    public function dash()
    {
        return redirect()->route('user.dashboard');
    }

    public function two_fa_toggle(Request $request)
    {
        $id = $request->id;
        $user = User::where("id", $id)->first();
        if (!$id) {
            return response()->json(["message" => "Invalid User"], 404);
        }
        if ($user->two_fa) {
            User::where("id", $user->id)->update(["two_fa" => 0]);
            return response()->json(["message" => "Updated"]);
        } else {
            User::where("id", $user->id)->update(["two_fa" => 1]);
            return response()->json(["message" => "Updated"]);
        }
    }

    // regular login
    public function regularLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        //check if email exist
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //no user with the requested email
            return redirect()->back()->with('login-error', 'No user associated with the requested username!');
        }

        //check if email exist
        $user = User::where('email', $request->email)->where('status', User::ACTIVE)->first();

        if (!$user) {
            //no user with the requested email
            return redirect()->back()->with('login-error', 'Your account is Inactive, kindly contact Vicomma Admin!');
        }
        if (!$user->email_verified_at) {
            // User's email is not verified
            $verificationLink = route('verification.resend');
            $message = 'Please verify your email address before logging in! <a href="' . $verificationLink . '" id="resendVerification">Resend verification email</a>';
            // return response()->json(['message' => $message], 403);
            return redirect()->back()->with('login-error', $message);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])) {
            $user = User::where('email', $request->email)->first();

            //create activity log
            $activity = new Activity;
            $activity->type = 'login';
            $activity->name = 'You Logged in';
            $activity->user_id = $user->id;
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = $user->role;
            $activity->save();
            if ($request->ref) {
                return redirect($request->ref);
            }
            //redirect deactivated user
            if ($user->hasRole('Admin')) {
                // return redirect()->intended('/admin/dashboard');
                return redirect('/admin/dashboard');
            } elseif ($user->hasRole('Vendor')) {
                return redirect()->intended('/dashboard');
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('Creative')) {
                return redirect()->intended('/dashboard');
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('General User')) {
                return redirect()->intended('/guser');
                // return redirect()->route('user.guser.index');
            }
        } else {
            return redirect()->back()->with('login-error', 'Incorrect username or password');
        }
    }

    public function ajaxLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);
        //check if email exist
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message' => 'No user associated with the requested username!'], 401);
        }

        if (!$user->email_verified_at) {
            // User's email is not verified
            $verificationLink = route('verification.resend');
            $message = 'Please verify your email address before logging in! <a href="' . $verificationLink . '" id="resendVerification">Resend verification email</a>';
            return response()->json(['message' => $message], 401);
            die();
        }

        //check if email exist
        $user = User::where('email', $request->email)->where('status', User::ACTIVE)->first();

        if (!$user) {
            //no user with the requested email
            return response()->json(['message' => 'Your account is Inactive, kindly contact Vicomma Admin!'], 403);
        }


        if ($user->two_fa == 1) {
            if (Hash::check($request->password, $user->password)) {
                // Password is correct

                $token = rand(000000, 999990);
                DB::table("users")->where("id", $user->id)->update(["token" => $token]);
                $details = [
                    'user' => $user->last_name . ' ' . $user->first_name,
                    'message' => 'Use The token provided below to complete your login request. If you have not initiated a login request, please ensure your reset your account password.',
                    'token' => $token,
                ];
                $user->notify(new TwoFa($details));
                return response()->json(["redirect" => '/admin/dashboard', "message" => "Check Your Email for your One Time Login Token", "two_fa" => true]);
            } else {


                // Password is incorrect
                return response()->json(['message' => 'Incorrect username or password'], 401);
            }
        } else if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])) {
            $user = User::where('email', $request->email)->first();

            //create activity log
            $activity = new Activity;
            $activity->type = 'login';
            $activity->name = 'You Logged in';
            $activity->user_id = $user->id;
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = $user->role;
            $activity->save();
            // dd($user);
            if ($request->ref) {
                return redirect($request->ref);
            }
            //redirect deactivated user
            if ($user->hasRole('Admin')) {
                // return redirect()->intended('/admin/dashboard');
                return response()->json(["redirect" => '/admin/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
            } elseif ($user->hasRole('Vendor')) {
                // return redirect()->intended('/dashboard');
                return response()->json(["redirect" => '/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('Creative')) {
                // return redirect()->intended('/dashboard');
                return response()->json(["redirect" => '/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.dashboard');
            } elseif ($user->role == 'influencer' || $user->role == null) {
                // return redirect()->intended('/dashboard');
                return response()->json(["redirect" => '/register', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('General User')) {
                // return redirect()->intended('/guser');
                return response()->json(["redirect" => '/guser', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.guser.index');
            }
        } else {

            return response()->json(['message' => 'Incorrect username or password'], 401);
        }
    }


    public function register()
    {
        return view('pages.auth.register');
    }
    public function welcome()
    {
        return view('pages.auth.welcome');
    }


    public function login_2fa(Request $request)
    {
        $otp = $request->otp;
        $email = $request->email;
        $user = User::where("email", $request->email)->first();

        if (DB::table("users")->where(["token" => $otp, "email" => $email])->exists()) {
            Auth::loginUsingId($user->id, true);
            DB::table("users")->where("id", $user->id)->update([
                "token" => null
            ]);
            //create activity log
            $activity = new Activity;
            $activity->type = 'login';
            $activity->name = 'You Logged in';
            $activity->user_id = $user->id;
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = $user->role;
            $activity->save();
            if ($request->ref) {
                return redirect($request->ref);
            }
            //redirect deactivated user
            if ($user->hasRole('Admin')) {
                // return redirect()->intended('/admin/dashboard');
                return response()->json(["redirect" => '/admin/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
            } elseif ($user->hasRole('Vendor')) {
                // return redirect()->intended('/dashboard');
                return response()->json(["redirect" => '/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('Creative')) {
                // return redirect()->intended('/dashboard');
                return response()->json(["redirect" => '/dashboard', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.dashboard');
            } elseif ($user->hasRole('General User')) {
                // return redirect()->intended('/guser');
                return response()->json(["redirect" => '/guser', "message" => "Sign in sucessful...", "two_fa" => false]);
                // return redirect()->route('user.guser.index');
            }
        } else {
            return response()->json(['message' => 'Invalid Otp Provided'], 401);
        }
    }

    public function firstRegister(Request $request, User $user)
    {
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        // dd($request->email_reg);
        // $role = Role::where('name', 'General User')->first();
        $messages = [
            'password.strong_password' => 'The :attribute must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:6',
                'strong_password'
            ],
            // 'g-recaptcha-response' => 'required|captcha',
        ], $messages);



        // try {
        //     //create the motherfuckers on stripe
        //     $customer = $stripe->customers->create([
        //         'description' => $request->first_name . " " . $request->last_name,
        //         'email' => $request->email
        //     ]);
        // } catch (\Stripe\Exception\AuthenticationException $e) {
        //     return 'Error occured with Stripe Connection : .' . $e->getError()->message;
        // }
        $ref_code = "";
        $ref_earned = 0;
        if ($request->ref_code) {
            $ambassador = DB::table("ambassadors")->where("ref_code", $request->ref_code)->first();
            if ($ambassador) {
                $ref_code = $ambassador->id;
                $a_user = DB::table("ambassador_users")->where("email", $request->email)->first();
                if (DB::table('ambassador_users')->where('email', $email)->exists()) {
                    // return response()->json(['message'=>"You've already added a user with this email"], 403);
                    DB::table("ambassador_users")->where("email", $email)->delete();
                }
                DB::table("ambassador_users")->insert([
                    "ambassador_id" => $ambassador->id,
                    "name" => " $request->fname  $request->lname",
                    "user_type" => "general user",
                    "email" => $request->email,
                    "phone" => "00000000",
                    'video' => 'null',
                ]);
                // if($a_user){
                $ref_earned = 0;
                // DB::table("ambassadors")->where("id", $ambassador->id)->increment("wallet", 450);
                // }
            }
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($ref_code) {
            $user->ref_code = $ref_code;
            $user->ref_earned = $ref_earned;
        }
        $user->image = "https://ui-avatars.com/api/?background=random&name=" . $request->first_name . "+" . $request->last_name . "&size=128";
        $user->password = Hash::make($request->password);
        // $user->role = 'General_User';
        $user->save();
        // $user->role()->attach($role->id); // role 5 is a general user id

        $email = $request->email;
        $token = Str::random(64);
        $agent = $request->userAgent();
        $ip = $request->getClientIp(); /* Static IP address */
        $loc_info = Location::get($ip);
        $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
        DB::table('verif_tokens')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        $details = [
            'url' => route('email.verify.get', $token),
            'user' => $user->last_name . ' ' . $user->first_name,
            "agent" => "$agent",
            "location" => "$location",
            "time" => Carbon::now(),
            'message' => 'Thanks for registering with us. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
        ];
        $user->notify(new UserRegistration($details));


        //create customer on Stripe.
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])) {
        //     $user = User::where('email', $request->email)->first();
        //     //redirect deactivated user
        //     if ($user->hasRole('Admin')) {
        //         return redirect()->intended('admin/dashboard');
        //         // return redirect()->route('admin.dashboard');
        //     } elseif ($user->hasRole('Vendor')) {
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.dashboard');
        //     } elseif ($user->hasRole('Creative')) {
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.dashboard');
        //     } elseif ($user->hasRole('General User')) {
        //         // return redirect()->intended('/guser')->with('verified', 'Now go and check your email to verify your account.');
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.guser.index');
        //     }
        // } else {
        //     return redirect()->back()->with('login-error', 'Incorrect username or password');
        // }
        return redirect()->route('auth.login')->with('verified', 'Now go and check your email to verify your account.');
    }

    // regular register
    public function buyRegister(Request $request, User $user)
    {
        $role = Role::where('name', 'General User')->first();
        $user = User::findOrFail(Auth::user()->id);
        $user->role = 'General_User';
        $user->save();
        $user->role()->attach($role->id);
        return redirect()->intended('/dashboard');
    }
    public function regularRegister(Request $request, User $user)
    {
        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        // dd($request->email_reg);
        $role = Role::where('name', 'General User')->first();
        $messages = [
            'password.strong_password' => 'The :attribute must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:6',
                'strong_password'
            ],
            'g-recaptcha-response' => 'required|captcha',
        ], $messages);



        // try {
        //     //create the motherfuckers on stripe
        //     $customer = $stripe->customers->create([
        //         'description' => $request->first_name . " " . $request->last_name,
        //         'email' => $request->email
        //     ]);
        // } catch (\Stripe\Exception\AuthenticationException $e) {
        //     return 'Error occured with Stripe Connection : .' . $e->getError()->message;
        // }
        $ref_code = "";
        $ref_earned = 0;
        if ($request->ref_code) {
            $ambassador = DB::table("ambassadors")->where("ref_code", $request->ref_code)->first();
            if ($ambassador) {
                $ref_code = $ambassador->id;
                $a_user = DB::table("ambassador_users")->where("email", $request->email)->first();
                if (DB::table('ambassador_users')->where('email', $email)->exists()) {
                    // return response()->json(['message'=>"You've already added a user with this email"], 403);
                    DB::table("ambassador_users")->where("email", $email)->delete();
                }
                DB::table("ambassador_users")->insert([
                    "ambassador_id" => $ambassador->id,
                    "name" => " $request->fname  $request->lname",
                    "user_type" => "general user",
                    "email" => $request->email,
                    "phone" => "00000000",
                    'video' => 'null',
                ]);
                // if($a_user){
                $ref_earned = 0;
                // DB::table("ambassadors")->where("id", $ambassador->id)->increment("wallet", 450);
                // }
            }
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($ref_code) {
            $user->ref_code = $ref_code;
            $user->ref_earned = $ref_earned;
        }
        $user->image = "https://ui-avatars.com/api/?background=random&name=" . $request->first_name . "+" . $request->last_name . "&size=128";
        $user->password = Hash::make($request->password);
        $user->role = 'General_User';
        $user->save();
        $user->role()->attach($role->id); // role 5 is a general user id

        $email = $request->email;
        $token = Str::random(64);
        $agent = $request->userAgent();
        $ip = $request->getClientIp(); /* Static IP address */
        $loc_info = Location::get($ip);
        $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
        DB::table('verif_tokens')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        $details = [
            'url' => route('email.verify.get', $token),
            'user' => $user->last_name . ' ' . $user->first_name,
            "agent" => "$agent",
            "location" => "$location",
            "time" => Carbon::now(),
            'message' => 'Thanks for registering with us. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
        ];
        $user->notify(new UserRegistration($details));


        //create customer on Stripe.
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => User::ACTIVE])) {
        //     $user = User::where('email', $request->email)->first();
        //     //redirect deactivated user
        //     if ($user->hasRole('Admin')) {
        //         return redirect()->intended('admin/dashboard');
        //         // return redirect()->route('admin.dashboard');
        //     } elseif ($user->hasRole('Vendor')) {
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.dashboard');
        //     } elseif ($user->hasRole('Creative')) {
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.dashboard');
        //     } elseif ($user->hasRole('General User')) {
        //         // return redirect()->intended('/guser')->with('verified', 'Now go and check your email to verify your account.');
        //         return redirect()->intended('/dashboard')->with('verified', 'Now go and check your email to verify your account.');
        //         // return redirect()->route('user.guser.index');
        //     }
        // } else {
        //     return redirect()->back()->with('login-error', 'Incorrect username or password');
        // }
        return redirect()->route('auth.login')->with('verified', 'Now go and check your email to verify your account');
    }

    public function resendEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);
        $agent = $request->userAgent();
        $ip = $request->getClientIp(); /* Static IP address */
        $loc_info = Location::get($ip);
        $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
        DB::table('verif_tokens')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        $details = [
            'url' => route('email.verify.get', $token),
            'user' => $user->last_name . ' ' . $user->first_name,
            "agent" => "$agent",
            "location" => "$location",
            "time" => Carbon::now(),
            'message' => 'Thanks for registering with us. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
        ];
        $user->notify(new UserRegistration($details));
        return response()->json(["message" => "Now go and check your email to verify your account"]);
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
        $request->validate([
            'email' => 'required|email|exists:users',
            'token' => 'required'
        ]);
        $vemail = DB::table('verif_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        if (!$vemail) {
            return redirect()->back()->with('error', 'Invalid Token');
        }

        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        // if ($user->vendor) {
        //     $user_jobs = Job::where('vendor_id', $user->vendor->id)->get();
        //     if ($user_jobs) {
        //         foreach ($user_jobs as $job) {
        //             $job->update(['isApproved' => Job::PENDING]);
        //         }
        //     }
        // }
        DB::table('verif_tokens')->where('email', $request->email)->delete();
        if (!auth::user()) {
            return redirect()->route('auth.login')->with('verified', 'Email verified successfully');
        } else {

            return redirect()->route('auth.register')->with(['verified' => 'Email verified successfully']);
        }
    }

    public function resetEmail()
    {
        return view('pages.auth.reset.forgot-password');
    }

    public function resetPostEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        // // dd($token);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $user = User::where('email', $request->email)->first();

        $details = [
            'action' => 'reset',
            'user' => $user->last_name . ' ' . $user->first_name,
            'url' => route('auth.reset.password.get', $token),
            'message' => 'Vicomma.com has received a request to reset the password for your account. If you did not request to reset your password, please ignore this email.'
        ];

        $user->notify(new PasswordReset($details));

        return redirect()->route('auth.reset.email')->with('verified', 'reset password link sent');
    }

    public function getResetPassword($token)
    {
        return view('pages.auth.reset.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $messages = [
            'password.strong_password' => 'The :attribute must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
        //  // dd($request->all());
        //  $request->validate([
        //     'email' => 'required|email|exists:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'password_confirmation' => 'required'
        // ], $messages);
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => [
                'required',
                'min:6',
                'strong_password'
            ],
            'password_confirmation' => 'required'
        ], $messages);

        $update_password = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        if (!$update_password) {
            return redirect()->back()->with('error', 'Invalid Token');
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
        return redirect(route('auth.login'))->with('message', 'Password reset successfully, Log in now!');
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


        $client_id = env('FACEBOOK_CLIENT_ID');
        $client_secret = env('FACEBOOK_CLIENT_SECRET');
        $client_redirect = env('FACEBOOK_REDIRECT_URI');

        $furl = "https://graph.facebook.com/v12.0/oauth/access_token?client_id=$client_id&redirect_uri=$client_redirect&client_secret=$client_secret&code=$request->code";

        $fbAuthResponse = Http::get($furl);

        $fbUserDetailsURL = "https://graph.facebook.com/v12.0/me?fields=id,name,email";
        $access_token = $fbAuthResponse->json()['access_token'];
        $response = Http::withToken($access_token)->get($fbUserDetailsURL);
        //$response->body();
        $email = $response->json()['email'];
        $name = $response->json()['name'];
        $names = explode(" ", $name);
        $isUser = User::where('email', '=', $email)->first();
        $role = Role::where('name', 'General User')->first();

        if (!$isUser) {
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
            $user->role()->attach($role->id); // role 5 is a general user id

            // $user = $user->last_name;
            $email = $email;
            $details = [
                'password' => $password,
                'user' => $user->last_name . ' ' . $user->first_name,
                'email' => $email,
                'message' => 'Thank you registering with us'
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

            // Auth::login($user);
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = User::where('email', $email)->first();

                return redirect()->route('user.dashboard');
            } else {
                return redirect()->back()->with('login-error', 'Login Failed');
            }
        } else {
            // check for active user account
            //check if email exist
            $user = User::where('email', $email)->where('status', User::ACTIVE)->first();

            if (!$user) {
                //user account was deactivated
                return redirect()->route('auth.login')->with('login-error', 'Your account is Inactive, kindly contact Vicomma Admin!');
            } else {
                Auth::login($user);
                return redirect()->route('user.dashboard');
            }

            // $user = User::where('email', $email)->first();

            // if ($user) {
            //     Auth::login($user);
            //     return redirect()->route('user.dashboard');
            // } else {
            //     return redirect()->route('auth.login')->with('login-error', 'Login Failed');
            // }
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
    protected function authGoogle()
    {

        $stripe = new \Stripe\StripeClient([
            "api_key" => env('STRIPE_PUBLISHABLE_KEY'),
            "stripe_version" => "2020-08-27"
        ]);

        $data = Socialite::driver('google')->user();
        // dd($data);
        $isUser = User::where('email', '=', $data->email)->first();
        $role = Role::where('name', 'General User')->first();
        // dd($isUser);
        if (!$isUser) {
            $user = new User();
            $user->first_name = $data->user['given_name'];
            $user->last_name = $data->user['family_name'];
            $user->email = $data->user['email'];
            $user->email_verified_at = Carbon::now();
            $password = Str::random(8);
            $user->password = Hash::make($password);
            $user->image = $data->avatar;
            $user->save();
            $user->role()->attach($role->id); // role 5 is a general user id

            // $user = $user->last_name;
            $email = $data->user['email'];
            $details = [
                'password' => $password,
                'user' => $user->last_name . ' ' . $user->first_name,
                'email' => $email,
                'message' => 'Thank you registering with us'
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

            // Auth::login($user);
            if (Auth::attempt(['email' => $data->email, 'password' => $password])) {
                $user = User::where('email', $data->email)->first();

                return redirect()->route('user.dashboard');
            } else {
                return redirect()->back()->with('login-error', 'Login Failed');
            }
        } else {
            //check if email exist
            $user = User::where('email', $data->email)->where('status', User::ACTIVE)->first();

            if (!$user) {
                //user account was deactivated
                return redirect()->route('auth.login')->with('login-error', 'Your account is Inactive, kindly contact Vicomma Admin!');
            } else {
                Auth::login($user);
                return redirect()->route('user.dashboard');
            }

            // $user = User::where('email', $isUser->email)->first();
            // if ($user) {
            //     Auth::login($user);
            //     return redirect()->route('user.dashboard');
            // } else {
            //     return redirect()->route('auth.login')->with('login-error', 'Login Failed');
            // }
        }
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user && Auth::check()) {
            Auth()->logout();
            return redirect()->route('public.index');
        } else {
            return redirect()->back();
        }
    }

    // public function redirectYouTube() {

    // }

    public function youtube()
    {
        return view('pages.auth.youtube');
    }
}
