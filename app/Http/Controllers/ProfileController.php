<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Currency;
use App\Models\FlutterwaveSubaccount;
use App\Models\Influencer;
use App\Models\InfluencerDetails;
use App\Models\Job;
use App\Models\Role;
use App\Models\Bid;
use App\Models\Portfolio;
use App\Models\Vendor;
use App\Models\RoleUser;
use App\Models\Skill;
use App\Models\StripeAccount;
use App\Models\VendorType;
use App\Notifications\PhoneVerification;
use App\Notifications\VendorRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;


use Image;


class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $subaccounts = FlutterwaveSubaccount::where('user_id', Auth::user()->id)->get();
        $countries = Country::select('id', 'code', 'name')->get();
        $portfolio = Portfolio::where("user_id", Auth::user()->id)->orderBy("id", "DESC")->get();
        return view('pages.user.profile.index', compact('user', 'countries', 'subaccounts', 'portfolio'));
    }

    public function profileDetails(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'last_name' => 'required|string|max:30',
            'first_name' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'city' => 'required|string|max:30',
            'country' => 'required|string',
        ]);

        $country_id = Country::where('name', $request->country)->select('id')->first();
        // dd($country_id->id);
        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->street_address = $request->address;
        $user->postal_code = $request->postal_code;
        $user->city = $request->city;
        $user->country_id = $country_id->id;
        $user->save();

        //create activity log
        $activity = new Activity;
        $activity->type = 'profile_update';
        $activity->name = 'Profile Details Updated';
        $activity->user_id = $user->id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = $user->role;
        $activity->save();

        try {
            $country = Country::find($user->country_id);
            $country_code = $country->sort;

            // what is the notation for the currency?
            $currency = Currency::where('country_code', '=', $country_code)->first();

            if (!$currency) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Currency not found');
            }
            $user->currency = $currency->code;
            $user->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $currency = Currency::where('country_code', '=', 'US')->first();
            $user->currency = $currency->code;
            $user->save();
        }
        // dd($user->save());
        return redirect()->back()->with('success', 'Profile details updated successfully');
    }

    public function updateEmail(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|unique:users|email|max:50',
            'current_password' => 'required|min:6'
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->email = $request->email;
            $user->email_verified_at = NULL;
            $user->save();
            return redirect()->back()->with('success', 'Email updated successfully');
        } else {
            return redirect()->back()->with('swal-error', 'Incorrect Password');
        }
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $request->validate([
                'password' => [
                    'required',
                    'min:6',
                    'confirmed'
                ],
                'password_confirmation' => 'required'
            ]);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->with('swal-error', 'Incorrect Password');
        }
    }

    public function updatePhoneNumber(Request $request)
    {
        // dd($request->all());
        $user = User::find(Auth::user()->id);
        $request->validate([
            'phone_number' => 'required|max:10|min:10'
        ]);
        $country = Country::where('id', $user->country_id)->select('phone_code')->first();
        $phone_number = '+' . $country->phone_code . $request->phone_number;
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
        // return redirect()->view('pages.user.profile.verify-phone', compact(['phone_number' => $request->phone_number]));
    }

    public function phoneVerificationView(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
            'phone_number' => 'required'
        ]);
        /* Get credentials from .env */
        $token = env("TWILIO_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(array('to' => $request->phone_number, "code" => $request->verification_code));
        if ($verification->valid) {
            $user = User::where('phone_number', Auth::user()->phone_number)->where('id', Auth::user()->id)->first();
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
            if ($user->role == 'vendor') {
                $vendor = auth()->user()->vendor;
                $product = DB::table("products")->where("vendor_id", $vendor->id)->latest()->first();
                return redirect()->route('user.vendors.edit', ['id' => $product->id])->with(['success' => 'Phone number verified']);
            } else {
                return redirect()->route('user.profile')->with(['success' => 'Phone number verified']);
            }
        }
        return back()->with(['phone_number' => $request->phone_number, 'swal-error' => 'Invalid verification code entered!']);
    }

    public function viewProfile()
    {
        if (Auth::user()->hasRole('Creative')) {
            $skills = Skill::all();
            $influencer_skills = InfluencerDetails::where('user_id', Auth::user()->id)->first();
            $i_skills = json_decode($influencer_skills->influencer_skills);
        } else {
            $skills = [];
            $i_skills = [];
        }

        $portfolio = Portfolio::where("user_id", Auth::user()->id)->orderBy("id", "DESC")->get();


        return view('pages.user.profile.view-profile', compact('skills', 'i_skills', 'portfolio'));
    }

    public function viewReferrals()
    {
        return view('pages.user.influencer.referrals');
    }

    public function flutterwaveBanks()
    {
        $response = Http::withToken("FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X")->get('https://api.flutterwave.com/v3/banks/NG');
        $data = json_decode($response);
        return ([$data]);
    }

    public function flutterwaveSubAccount(Request $request, FlutterwaveSubaccount $subaccount)
    {
        $request->validate([
            'account_bank' => 'required|string',
            'account_number' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|string'
        ]);
        $details = [];

        $user = User::find(Auth::user()->id);
        $country = Country::find($user->country_id);
        $c = $country->sort;
        $u = $user->last_name . ' ' . $user->first_name;

        $a = array_merge($details, [$c, $u]);

        $response = Http::withToken("FLWSECK-a28b00eb5e62c1e55f88f3d5b48f09a3-1892c8408e1vt-X")->post('https://api.flutterwave.com/v3/subaccounts', [
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
        if ($user->hasRole('Creative') && Bid::where("influencer_id", Auth::user()->id)->count() < 1) {

            return ([$response, "/jobs"]);
        }
        return ($response);
    }

    public function deleteSubaccount($id)
    {
        $subaccount = FlutterwaveSubaccount::find($id);
        // dd($subaccount);
        // $response = Http::withToken(env('FLUTTERWAVE_BEARER_TOKEN'))->delete('https://api.flutterwave.com/v3/subaccounts/'.$subaccount->flutterwave_id);
        // dd($response);
        $subaccount->delete();
        return redirect()->back()->with('success', 'Account deleted successfully');
    }

    public function updateDescription(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255'
        ]);

        $check = User::find(Auth::user()->id);

        if ($check->role == 'influencer') {
            $user = InfluencerDetails::where('user_id', Auth::user()->id)->first();
            $user->influencer_description = $request->description;
            $user->save();
        } else {
            $user = Vendor::where('user_id', Auth::user()->id)->first();
            $user->vendor_description = $request->description;
            $user->save();
        }

        // return redirect()->back()->with('success', 'Description updated');
        return response()->json('Description updated');
    }

    public function description()
    {
        $user = User::find(Auth::user()->id);
        if ($user->role == 'influencer') {
            $description = InfluencerDetails::where('user_id', Auth::user()->id)
                ->select('influencer_description')
                ->first();
        } else {
            $description = Vendor::where('user_id', Auth::user()->id)
                ->select('influencer_description')
                ->first();
        }
        return response()->json($description);
    }

    public function uploadImage(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $image = $request->image;
        $image_parts = explode(";base64,", $request->image);
        $image_base64 = base64_decode($image_parts[1]);

        Storage::disk('s3')->put('profiles/' . $user->email, $image_base64, 'public');
        $user->image = Storage::disk('s3')->url('profiles/' . $user->email);
        $user->save();

        return response()->json($image);
    }

    public function RegistrationForVendors(Request $request, Vendor $vendor)
    {
        // dd($request->all());
        $vtype = VendorType::where('name', 'Free')->first();
        $role = Role::where('name', 'Vendor')->first();
        $user = User::find(Auth::user()->id);
        $user->role = "vendor";
        $user->save();
        $request->validate([
            'station' => 'required|string|unique:vendors,vendor_station'
        ]);
        // $slug = Str::slug($request->station, '-');
        $vendor->vendor_station = $request->station;
        $vendor->user_id = Auth::user()->id;
        // $vendor->slug = $slug;
        $vendor->vendor_type_id = $vtype->id; // assigning vendor to free category type
        $vendor->save();
        // DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [$role->id, Auth::user()->id]); // role_id = 3, this is the ID for Vendor
        $user->role()->attach($role->id); // role 5 is a general user id
        if ($user->hasRole('Creative')) {
            $role2 = Role::where('name', 'Creative')->first();
            DB::table("role_user")->where(["role_id" => $role2->id, "user_id" => $user->id])->update([
                "active" => 0
            ]);
        }

        //create activity log
        $activity = new Activity;
        $activity->type = 'account_update_vendor';
        $activity->name = 'Account Updated to Vendor';
        $activity->description = 'You are now a <b>Vendor</b>, your vendor station <a href="' . route('user.vendors.index') . '">' . $request->station . '</a> is ready, click the link to <b>Post a Job</b>';
        $activity->user_id = $user->id;
        $activity->url = '/create/jobs';
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        $details = [
            'user' => $user->last_name . ' ' . $user->first_name,
            'url' => route("user.profile"),
            'message' => 'You have successful upgraded your account to become a vendor, explore all the functionalities available for you now'
        ];
        $user->notify(new VendorRegistration($details));
        return response()->json(['message' => 'Vendor Station Created', 'data' => $request->station]);
    }

    public function RegistrationForInfluencers(Request $request, Influencer $influencer)
    {
        return response()->json(['message' => $request->all()]);
    }

    public function updateVendorDetails(Request $request)
    {
        // dd($request->all());
        return $request->all();
        $user = Auth::user()->id;
        $request->validate([
            // 'station' => 'required|string|unique:vendors,vendor_station',
            'phone_number' => 'required|integer',
            'address' => 'required|string'
        ]);

        $vendor = Vendor::where('user_id', $user)->first();
        $vendor->phone_number = $request->phone_number;
        $vendor->location = $request->address;
        $vendor->save();
        return redirect()->back()->with('success', 'Vendor details updated successfully');
    }

    public function addStripe(Request $request)
    {
        // \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        \Stripe\Stripe::setApiKey(env('STRIPE_PUBLISHABLE_KEY'));

        $account = \Stripe\Account::create([
            // 'country' => 'US', //optional key
            'type' => 'express',
            // 'email' => ''
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
        ]);

        $acc = $account->id;

        $account_links = \Stripe\AccountLink::create([
            'account' => $acc,
            'refresh_url' => 'https://www.instagram.com',
            'return_url' => env('APP_URL') . ":8000/payment-method/list?stripe=verified", //were are they redirected to
            'type' => 'account_onboarding',
        ]);

        return redirect($account_links->url);
    }

    public function stripeWebHook(Request $request, StripeAccount $stripeAccount)
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['error' => 'Invalid Request!']);
            exit;
        }

        // $payload = file_get_contents('php://input');
        $payload = $request->all();

        // ob_start();
        // var_dump($payload);
        Log::info($request->account);


        // if $request->data->object->details_submitted ===  false
        // redirect to stripe to update account

        // else save account id and details_submitted status
        // to DB

        $stripeAccount->account = $request->account;
        // $stripeAccount->details_submitted_status = $request->data['object']->details_submitted;
        $stripeAccount->user_id = Auth::user()->id;
        $stripeAccount->save();

        return redirect()->route('user.profile')->with('success', 'stripe account added');


        // Log::info($request->account);
        // error_log(ob_get_clean(), 4);
        // echo json_encode(['status' => 'success']);
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


        $video = new Portfolio();
        $video->name  = $request->video_title;
        $video->description  = $request->video_desc;
        $video->thumbnail  = Storage::disk('s3')->url($thumb_path);;
        $video->file = Storage::disk('s3')->url($video_path);
        $video->user_id = auth()->user()->id;
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
        $activity->user_id = Auth::user()->id;
        $activity->url = '/settings';
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'creative';
        $activity->save();

        return response()->json([
            "message" => "you have succesfully added an item to your portfolio"
        ]);
    }
}
