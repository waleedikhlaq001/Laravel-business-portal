<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attachment;
use App\Models\Job;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorType;
use Stevebauman\Location\Facades\Location;
use App\Notifications\UserRegistration;
use App\Notifications\VendorRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Http;

class GeneralJobPostController extends Controller
{


public function get_currency_id($req)
{
    // Fetch IP details using Laravel HTTP client
    $ipDetailsResponse = Http::get('http://ipinfo.io');
    $details = $ipDetailsResponse->json();

    // Get the IP address
    $ip = $req->getClientIp(); // Assuming you still want to use the client IP
    
    // Fetch geo data using Laravel HTTP client
    $geoResponse = Http::get("https://api.timanetglobaltech.com/?ip={$ip}&time=" . date('H:i:s'));
    $geo_data = $geoResponse->json();

    // Find country based on geo data
    $country = DB::table("countries")->where("name", $geo_data['country'])->first();

    // If country found, get currency
    if ($country) {
        $currency = DB::table("currencies")->where("country_code", $country->sort)->first();
        if ($currency) {
            return $currency->id;
        } else {
            return 231; // Default currency ID if not found
        }
    } else {
        return 231; // Default currency ID if country not found
    }
}

    public function submit_register(Request $request, Job $job, Attachment $attachment, Product $product)
    {

        $request->validate([
            // 'email' => 'required|email|unique:users',
            // "g-recaptcha-response" => 'required|captcha',
        ]);
        // Check if user exists
        // $email_exists = User::where('email', $request->email)->first();
        // if($email_exists){
        //     $data['error'] = 'User already exists';
        //     return response()->json($data);
        // }


        // save user
        $ref_code = "";
        $ref_earned = 0;

        $role = Role::where('name', 'General User')->first();
        $user = User::findOrFail(Auth::user()->id);
        $user->role = "vendor";
        $user_saved = $user->save();
        $user->role()->attach($role->id); // role 5 is a general user id


        $email = $user->email;
        $token = Str::random(64);
        $agent = $request->userAgent();
        $ip = $request->getClientIp(); /* Static IP address */
        $loc_info = Location::get($ip);
        $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
        DB::table('verif_tokens')->insert(
            ['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $details2 = [
            'user' => $user->last_name . ' ' . $user->first_name,
            'url' => route('user.profile', $job->unique_id),
            'urlverify' => route('email.verify.get', $token),
            'message' => 'You have successful upgraded your account to become a vendor, explore all the functionalities available for you now'
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
        $vendor->vendor_station = $request->st_name;
        $vendor->user_id = $user->id;
        $vendor->vendor_type_id = $vtype->id;
        $vendor_saved = $vendor->save();

        $user->role()->attach($role->id); // role 5 is a general user id
        if ($user->hasRole('Creative')) {
            $role2 = Role::where('name', 'Creative')->first();
            DB::table("role_user")->where(["role_id" => $role2->id, "user_id" => $user->id])->update([
                "active" => 0
            ]);
        }
        if (!$vendor_saved) {
            $data['error'] = 'Could not create Vendor record';
            return response()->json($data);
        }
        // Saving Product
        $images = [];
        $vendor_id = $user->vendor->id;

        //create activity log
        $activity = new Activity;
        $activity->type = 'Vendor_register';
        $activity->name = 'Vendor Station Created';
        $activity->description = 'You are now a <b>Vendor</b>, your vendor station <a href="' . route('user.vendors.index') . '">' . $request->st_name . '</a> is ready, click the link to complete your profile';
        $activity->user_id = $user->id;
        $activity->url = '/settings';
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $filename = $image->getClientOriginalName();
                $filename = time() . '_' . $filename;
                $path = $image->StoreAs('public/products', $filename);
                $images[] = $filename;
            }
        }

        $product->name = $request->p_name;
        $product->description = $request->p_description;
        $product->category_id = $request->category_id;
        $product->vendor_id = $user->vendor->id;
        $product->unique_id = 'VIC-' . Str::random(26);
        $product->image = json_encode($images);
        $product->price = $request->price;
        $product_saved = $product->save();

        //create Activity
        $activity = new Activity;
        $activity->type = 'product_add';
        $activity->name = 'Product Added';
        $activity->description = 'You added a Product <b>(' . $product->name . ')</b> to your store';
        $activity->user_id = $user->id;
        $activity->url = '/mall/show/' . $product->id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        if (!$product_saved) {
            $data['error'] = 'Product could not be saved';
            return response()->json($data);
        }
        $payment = 1;

        // Save Job
        $job->budget_id = $request->budget;
        $job->name = $request->title;
        $job->description = $request->description;
        $job->currency_id = $this->get_currency_id($request);
        $job->payment_id = $payment;
        $job->isApproved = 1;
        $job->isAwarded = 0;
        $job->duration = $request->job_duration;
        $job->type = $request->type;
        $job->experience_level = $request->experience_level;
        $job->vendor_id = $vendor_id;
        $job->product_id = $product->id;
        $job->product_delivery_method = $request->prod_delivery;
        $job->content_type = json_encode($request->content_type);
        $job->unique_id = rand();
        $job_saved = $job->save();

        //create activity log
        $activity = new Activity;
        $activity->type = 'job_add';
        $activity->name = 'Job Created';
        $activity->description = 'You created a new Job with the name <b>(' . $job->name . ')</b>';
        $activity->user_id = $user->id;
        $activity->url = '/jobs/details/' . $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        if (!$job_saved) {
            $data['error'] = 'Job could not be saved';
            return response()->json($data);
        }

        $docs = [];
        $format = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file')  as $file) {
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
        $attachment->uploaded_by = $user->id;
        $attachment_saved = $attachment->save();

        if (!$attachment_saved) {
            $data['error'] = 'Attachment could not be saved';
            return response()->json($data);
        }

        $update_job = Job::find($job->id);
        $update_job->attachment_id = $attachment->id;
        $update_job->save();
        $update_job_saved = $update_job->save();

        if (!$update_job_saved) {
            $data['error'] = 'Attachment could not be saved';
            return response()->json($data);
        }

        $data['success'] = 'Job Posted Successfully';
        $data['redirect'] = route('user.dashboard');
        return response()->json($data);
    }

    public function oldUser_job(Request $request, Job $job, Attachment $attachment, Product $product)
    {
        // Check if user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $data['error'] = 'Email does not exist';
            return response()->json($data);
        }

        if (!Hash::check(request('password'), $user->password)) {
            $data['error'] = 'Incorrect Password';
            return response()->json($data);
        }

        //Check if user is already a vendor
        $vendor = Vendor::where('user_id', $user->id)->first();

        // Make user a Vendor
        if (!$vendor) {
            $vtype = VendorType::where('name', 'Free')->first();
            $role = Role::where('name', 'Vendor')->first();

            // Saving Vendor
            $vendor = new Vendor;
            $vendor->vendor_station = $request->st_name;
            $vendor->user_id = $user->id;
            $vendor->vendor_type_id = $vtype->id;
            $vendor->save();
            $user->role()->attach($role->id);

            //create activity log
            $activity = new Activity;
            $activity->type = 'Vendor_register';
            $activity->name = 'Vendor Station Created';
            $activity->description = 'You are now a <b>Vendor</b>, your vendor station <a href="' . route('user.vendors.index') . '">' . $request->st_name . '</a> is ready, click the link to complete your profile';
            $activity->user_id = $user->id;
            $activity->url = '/settings';
            $activity->image = 'https://via.placeholder.com/50';
            $activity->account_type = 'vendor';
            $activity->save();
        }

        // Saving Product
        $images = [];
        $vendor_id = $user->vendor->id;

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $filename = $image->getClientOriginalName();
                $filename = time() . '_' . $filename;
                $path = $image->StoreAs('public/products', $filename);
                $images[] = $filename;
            }
        }

        $product->name = $request->p_name;
        $product->description = $request->p_description;
        $product->category_id = $request->category_id;
        $product->vendor_id = $user->vendor->id;
        $product->unique_id = 'VIC-' . Str::random(26);
        $product->image = json_encode($images);
        $product->price = $request->price;
        $product->save();

        //create Activity
        $activity = new Activity;
        $activity->type = 'product_add';
        $activity->name = 'Product Added';
        $activity->description = 'You added a Product <b>(' . $product->name . ')</b> to your store';
        $activity->user_id = $user->id;
        $activity->url = '/mall/show/' . $product->id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        $payment = 1;

        // Save Job
        $job->budget_id = $request->budget;
        $job->name = $request->title;
        $job->description = $request->description;
        $job->currency_id = '97';
        $job->payment_id = $payment;
        $job->isApproved = 0;
        $job->isAwarded = 0;
        $job->duration = $request->job_duration;
        $job->content_type = json_encode($request->content_type);
        $job->vendor_id = $vendor_id;
        $job->product_id = $product->id;
        if ($request->has('prod_delivery')) {
            $job->product_delivery_method = $request->prod_delivery;
        } else {
            $job->product_delivery_method = 'none';
        }
        $job->unique_id = rand();
        $job->save();

        //create activity log
        $activity = new Activity;
        $activity->type = 'job_add';
        $activity->name = 'Job Created';
        $activity->description = 'You created a new Job with the name <b>(' . $job->name . ')</b>';
        $activity->user_id = $user->id;
        $activity->url = '/jobs/details/' . $job->unique_id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        $docs = [];
        $format = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file')  as $file) {
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
        $attachment->uploaded_by = $user->id;
        $attachment->save();

        $update_job = Job::find($job->id);
        $update_job->attachment_id = $attachment->id;
        $update_job->save();

        $data['success'] = 'Job Posted Successfully';
        return response()->json($data);
    }

    public function login(Request $request)
    {
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

            $data['success'] = 'Login Successful';
            return response()->json($data);
        } else {
            $data['error'] = 'Login Failed';
            return response()->json($data);
        }
    }
}
