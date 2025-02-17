<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Country;
use App\Models\Role;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Notifications\UserRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Contact;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Notifications\VendorRegistration;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    //public function to mark Activity as READ and return a json response
    public function markAsRead()
    {
        $auth_user = Auth::user();

        $old_activity = Activity::where(['user_id' => $auth_user->id, 'status' => 0])->orderBy('created_at', 'desc')->limit(20)->get();
        // $old_activity->update(['status' => Activity::READ]);

        $activity_ids = [];
        foreach ($old_activity as $activity) {
            $activity->status = 1;
            $activity->save();

            array_push($activity_ids, strval($activity->id));
        }

        return response()->json(['success' => true, 'activity_ids' => $activity_ids]);
    }

    public function markSingleRead(Request $request)
    {
        $auth_user = Auth::user();
        $act = Activity::find($request->a_id);

        $old_activity = Activity::where(['user_id' => $auth_user->id, 'status' => 0])->orderBy('created_at', 'desc')->limit(20)->get();

        $act->status = 1;
        $act->save();

        $all_activities = [];
        foreach ($old_activity as $activity) {
            array_push($all_activities, strval($activity->id));
        }

        return response()->json(['success' => true, 'all_activities' => $all_activities]);
    }

    public function index()
    {
        $auth_user = Auth::user();
        if ($auth_user->role == null) {
            return redirect()->route('auth.register');
        }

        if ($auth_user->email_verified_at == Null) {
            return view('pages.user.verify.email');
        }

        $activities = Activity::where(['user_id' => $auth_user->id, 'status' => Activity::UNREAD])->orderBy('created_at', 'desc')->limit(10)->get() ?? array();
        // dd($activities);

        $id = auth()->user()->id; // user id
        $remaining_profile_fields = User::where('id', $id)->get()->toArray();
        //$roles = Auth::check() ? Auth::user()->role->pluck('id')->toArray() : [];

        $usersFields = count(Schema::getColumnListing('users')) - 7;
        $user_record = User::where('id', $id)->get()->toArray()[0];
        //check the number of empty user fields in DB.
        $null_count = 0;
        $null_array = [];
        foreach ($user_record as $record => $item) {
            if ($item == NULL) {
                $null_count = $null_count + 1;
                array_push($null_array, $record);
            }
        }

        $completed_count = ($usersFields - ($null_count - 6)) + 3;
        $current_progress = (round((float)$completed_count / count($user_record), 2)) * 100;
        $suggestion_box = [];
        foreach ($null_array as $fields => $item) {
            $suggestion_box[$item] = 1;
        }


        if (!empty($suggestion_box)) {
            $suggested_option = array_rand($suggestion_box); //randomize the suggestion..
        } else {
            $current_progress = 100;
            $suggested_option = 'completed';
            $suggested_action = NULL;
            $suggested_action_icon = NULL;
        }


        switch ($suggested_option) {
            case 'phone_number':
                $suggested_action = 'Add Phone Number';
                $suggested_action_icon = 'fas fa-phone-alt';
                $suggested_link = route('user.profile');
                break;
            case 'email_verified_at':
                $suggested_action = 'Verify Email Address';
                $suggested_action_icon = 'fas fa-envelope';
                $suggested_link = route('user.profile');
                break;
            case 'facebook':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-facebook';
                $suggested_link = route('user.profile');
                break;
            case 'instagram':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-instagram';
                $suggested_link = route('user.profile');
                break;
            case 'tiktok':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-tiktok';
                $suggested_link = route('user.profile');
                break;
            case 'snapchat':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-snapchat';
                $suggested_link = route('user.profile');
                break;
            case 'telegram':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-telegram';
                $suggested_link = route('user.profile');
                break;
            case 'twitter':
                $suggested_action = 'Verify your Social Media';
                $suggested_action_icon = 'fab fa-twitter';
                $suggested_link = route('user.profile');
                break;
            case 'street-address':
                $suggested_action = 'Verify your Home Address';
                $suggested_action_icon = 'fas fa-home';
                $suggested_link = route('user.profile');
                break;
            case 'postal_code':
                $suggested_action = 'Add a Postal Code';
                $suggested_action_icon = 'fas fa-home';
                $suggested_link = route('user.profile');
                break;
            case 'city':
                $suggested_action = 'Verify your City';
                $suggested_action_icon = 'fas fa-home';
                $suggested_link = route('user.profile');
                break;
            case 'state':
                $suggested_action = 'Verify your State';
                $suggested_action_icon = 'fas fa-home';
                $suggested_link = route('user.profile');
                break;
            case 'country_id':
                $suggested_action = 'Verify your Country';
                $suggested_action_icon = 'fas fa-home';
                $suggested_link = route('user.profile');
                break;
            case 'description':
                $suggested_action = 'Update your Description';
                $suggested_action_icon = 'fas fa-pen';
                $suggested_link = route('user.profile');
                break;
            default:
                $suggested_action = 'Update your Profile';
                $suggested_action_icon = 'fas fa-user';
                $suggested_link = route('user.profile');
                break;
        }



        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();

        foreach ($random_products as $k => $p) {

            if ($p->image != '[]') {
                $resolve = trim($p->image, '[]');



                $toArray = explode(',', $resolve);

                foreach ($toArray as $k => $val) {

                    $val = trim($val, '"');

                    // dd($val);
                }

                $p->image = $toArray;
            } else {

                $p->image = [];
            }
        }
        // dd($random_products);



        return view('pages.user.dashboard', compact('random_products', 'activities', 'current_progress', 'suggested_action', 'suggested_action_icon', 'suggested_link'));
    }



    public function verifyEmail(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);
        $token = Str::random(64);
        $email = $request->email;

        DB::table('verif_tokens')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        // Mail::send('pages.auth.verify-email', compact('token', 'email', 'user'), function ($message) use ($request) {
        //     $message->from('toshfuture@gmail.com', 'Vicomma');
        //     $message->to($request->email);
        //     $message->subject('Email Verification');
        // });
        $agent = $request->userAgent();
        $ip = $request->getClientIp(); /* Static IP address */
        $loc_info = Location::get($ip);
        $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";

        $details = [
            'url' => route('email.verify.get', $token),
            'user' => $user->last_name . ' ' . $user->first_name,
            "agent" => "$agent",
            "location" => "$location",
            "time" => Carbon::now(),
            'message' => 'Thanks for registering with us. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
        ];
        $user->notify(new UserRegistration($details));
        return redirect()->back()->with('verified', 'Verification email has been sent');
    }
    public function set_role(Request $request)
    {
        if (!auth()->user()) {
            return redirect('/login');
        }
        $user = auth()->user();
        $user->role = "vendor";
        $user->save();
        $role = $request->role;

        $creative = Role::where('name', 'Creative')->first();
        $vendor = Role::where('name', 'Vendor')->first();
        $v_role = DB::table("role_user")->where(['user_id' => auth()->user()->id, "role_id" => $vendor->id])->first();
        $c_role = DB::table("role_user")->where(['user_id' => auth()->user()->id, "role_id" => $creative->id])->first();

        if ($role == "vendor") {
            DB::table("role_user")->where(["id" => $v_role->id, "user_id" => $user->id])->update([
                "active" => 1
            ]);
            DB::table("role_user")->where(["id" => $c_role->id, "user_id" => $user->id])->update([
                "active" => 0
            ]);
            $user->role = "vendor";
            $user->save();
        }
        if ($role == "creative") {
            DB::table("role_user")->where(["id" => $v_role->id, "user_id" => $user->id])->update([
                "active" => 0
            ]);
            DB::table("role_user")->where(["id" => $c_role->id, "user_id" => $user->id])->update([
                "active" => 1
            ]);
            $user->role = "influencer";
            $user->save();
        }
        return redirect('/dashboard');
    }

    public function user_details(Request $request, $id)
    {
        $user = User::where("id", $id)->first();
        if (!$user) {
            return response()->json([
                "data" => "",
                "country" => ""
            ], 400);
        }
        $country = Country::find($user->country_id);
        return response()->json([
            "data" => $user,
            "country" => $country
        ], 400);
    }

    public function contact_us(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $msg = $request->message;
        $details = [
            'user' => "Vicomma Admin",
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "user_message" => $msg,
            'message' => 'You have recieved a new contact us message on the vicomma platform'
        ];
        Mail::to("contactus@vicomma.com")->send(new Contact($details));
        return response()->json(["message" => "Message Sent"]);
    }

    public function vendor_info(Request $request)
    {
        $name = $request->name;
        $business = $request->business;
        $email = $request->email;
        // $phone = $request->phone;
        $whatsapp = $request->whatsapp;
        $service = $request->service;
        // $socials = $request->socials;

        // $request->validate([
        //     'email' => 'required|email|unique:users',
        //     // "g-recaptcha-response" => 'required|captcha',
        //     'business' => 'required|string|unique:vendors,vendor_station'
        // ]);
        // Check if user exists
        $email_exists = User::where('email', $request->email)->first();
        if ($email_exists) {
            $data['message'] = 'A User With this Email is already registered';
            return response()->json($data, 400);
        }


        $station_exists = Vendor::where('vendor_station', $request->business)->first();
        if ($email_exists) {
            $data['message'] = 'This Business Name is already Registered';
            return response()->json($data, 400);
        }



        $role = Role::where('name', 'General User')->first();
        $user = new User;
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->email = $request->email;

        $user->role = "vendor";
        $user->image = "https://ui-avatars.com/api/?background=random&name=" . $request->fname . "+" . $request->lname . "&size=128";
        $user->password = Hash::make($request->password);
        $user_saved = $user->save();
        $user->role()->attach($role->id); // role 5 is a general user id

        if (!$user_saved) {
            $data['error'] = 'User could not be saved';
            return response()->json($data);
        }

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
            'user' => $user->lname . ' ' . $user->fname,
            "agent" => "$agent",
            "location" => "$location",
            "time" => Carbon::now(),
            'message' => 'Thanks for registering with us. We at Vicomma take the trust and safety of our users seriously. We just need you to verify your email address by clicking the Verify Email button below. See you soon.'
        ];
        $user->notify(new UserRegistration($details));
        $details2 = [
            'user' => $user->last_name . ' ' . $user->first_name,
            'url' => route('user.profile', ""),
            'urlverify' => route('email.verify.get', $token),
            'message' => 'You have successful registered your vendor account, explore all the functionalities available for you now'
        ];
        if (!$request->direct) {
            $user->notify(new VendorRegistration($details2));
        }
        // Make user a Vendor
        //$vendor = Vendor::where('user_id', $user->id)->first();

        $vtype = VendorType::where('name', 'Free')->first();
        $role = Role::where('name', 'Vendor')->first();

        // Saving Vendor
        $vendor = new Vendor;
        $vendor->vendor_station = $request->business;
        $vendor->user_id = $user->id;
        $vendor->vendor_type_id = $vtype->id;
        $vendor_saved = $vendor->save();
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        DB::table("vendor_contacts")->insert([
            "name" => $name,
            "business" => $business,
            "service" => $service,
            "phone" => $whatsapp,
            "whatsapp" => $whatsapp,
            "email" => $email,
        ]);
        return response()->json(["message" => "Registration Successful"]);
    }

    public function getstates($id)
    {
        $countryid = $id;
        $states = DB::table("states")->where('country_id', $countryid)->get();
?>
        <option value="" selected disabled>Select State</option>
        <?php
        foreach ($states as $state) {
            echo '<option value="' . $state->id . '">' . $state->name . '</option>';
        }
        ?>
    <?php
    }
    public function getcities($id)
    {
        $stateid = $id;
        $cities = DB::table("cities")->where('state_id', $stateid)->get();
    ?>
        <option value="" selected disabled>Select City</option>
        <?php
        foreach ($cities as $city) {
            echo '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        ?>
<?php
    }
}
