<?php

use App\Http\Controllers\api\v1\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Job;
use App\Models\Category;
use App\Models\Influencer;
use App\Models\User;
use App\Models\Bid;
use App\Models\Cart;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MobileWallet;
use App\Http\Controllers\MobileCreative;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Gets all products on the vicomma platform. aprroved Products
 */
Route::get('products', function () {
    return response()->json(Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->orderBy("id", "DESC")->paginate(21));
});
Route::get('featured', function () {
    return response()->json(Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("featured", 1)->orderBy("id", "DESC")->paginate(21));
});


// chat routes


Route::get('/chats/vendor/individual/get', [ChatController::class, 'getIndividualChatsVendor'])->name('getIndividualChatsVendor');

Route::get('/chats/influencer/individual/get', [ChatController::class, 'getIndividualChatsInfluencer'])->name('getIndividualChatsInfluencer');

Route::get('/chats/get', [ChatController::class, 'getChats'])->name('getChats');

Route::post('/chats/store', [ChatController::class, 'chatStore'])->name('chatStore');



//notification routes
Route::get('/notifications/get', [NotificationController::class, 'getUserNotifications'])->name('getUserNotifications');
Route::get('/notifications/mark', [NotificationController::class, 'markUserNotifications'])->name('markUserNotifications');

//get bids for job
Route::get('/job/bids/get', [JobsController::class, 'getJobBids'])->name('getJobBids');


//admin mitigation

/**
 * Gets all countries on the vicomma platform.
 */
Route::get('countries', function () {
    return response()->json(Country::all());
});

/**
 * Gets all categories on the  vicomma platform.
 */
Route::get('categories', function () {
    return response()->json(Category::all());
});


Route::get('bids-alert', [JobsController::class, 'bids_alert']);

Route::get('user-details/{id}', [UserController::class, 'user_details']);

Route::get('jobs/{id}', function($id) {
    try{
        $job = Job::findOrFail($id);
        return response()->json([ 'data' => $job ]);
    }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        return response()->json(['message' => 'Job not found'], 404);
    }
});


/**
 * Gets all jobs in a category on the  vicomma platform.
 */
Route::get('categoryJobs/{id}', function ($id) {
    $products = Product::where('category_id', '=', $id)->get();
    $jobsList = [];
    foreach ($products as $product) {
        $jobs = Job::where('product_id', '=', $product->id)->get();
        // $jobsList[] = $jobs;
        if (!empty($jobs[0])) {
            $jobsList[] = $jobs[0];
        }
    }

    return response()->json($jobsList);
});


/**
 * Gets a specific influencer for a Job.
 */
Route::get('influencers/{id}', function ($id) {
    try {
        $influencer = Influencer::findOrFail($id);
        $user = User::find($influencer->user_id);
        $data = [
            'status' => 'success',
            'influencer_id' => $influencer->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            "email" => $user->email,
            "phone" => $user->phone_number,
        ];
        return response()->json($data);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'User not found'], 404);
    }
});

/**
 * Gets a list of all the influencers.
 */
Route::get('influencers', function () {
    //needs more work on security
    return response()->json(Influencer::all());
});

/**
 * Gets the Awarded Influencer for a Job. !important needs some re-work
 */
Route::get('influencers/job/{id}', function ($id) {
    try {
        $job = Job::findOrFail($id);
        $influencer = Influencer::findOrFail($job->influencer_id);
        $user = User::find($influencer->user_id);
        $data = [
            'status' => 'success',
            'influencer_id' => $influencer->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            "email" => $user->email,
            "phone" => $user->phone_number,
        ];
        return response()->json($data);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'User not found'], 404);
    }
});

Route::get('carts', function () {
    return response()->json(Cart::all());
});

Route::delete('carts/{id}', function ($id) {
    try {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(['message' => 'Cart deleted successfully']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
});

Route::put('carts/{id}', function ($id, Request $request) {
    try {
        $cart = Cart::findOrFail($id);
        $cart->products = $request->products;
        $cart->save();
        return response()->json(['message' => 'Cart updated successfully']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
});

Route::get('carts/{id}', function ($id) {
    try {
        $cart = Cart::findOrFail($id);
        return response()->json($cart);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
});

Route::post('carts/{id}', function (Request $request, $id) {
    $cart = Cart::find($id);

    if(!$cart) {
        $cart = new Cart();
        $cart->user_id = $id;
        $cart->products = $request->products;
        $cart->save();
        return response()->json($cart);
    }

    return response()->json(['error' => 'Cart Already Exists'], 404);
});

Route::get('carts/user/{id}', function ($id) {
    try {
        $carts = Cart::where('user_id', '=', $id)->get();
        $carts_array = [];
        foreach ($carts as $cart) {
            $carts_array[] = $cart;
        }
        return response()->json($carts_array);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
});

Route::post('carts/user/{id}', function (Request $request,$id) {
    try {
        $cart = Cart::where('user_id', '=', $id)->get();
        $carts_array = [];
        if(!$cart){
            $cart = new Cart();
            $cart->user_id = $id;
            $cart->products = $request->products;
            $cart->save();
            return response()->json($cart);
        }
        return response()->json($carts_array);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
});

Route::get('user/location', function () {
    $response = Http::get('http://ip-api.com/json'); //returns the current country and timezone of a user
    return response()->json($response->json());
});
Route::get('setcurrency', function (Request $request) {
    if (!$request->country_id) {
        return response()->json(['error' => 'Country not in request']);
    }

    if (!$request->user_id) {
        return response()->json(['error' => 'user_id not in request']);
    }

    if (!$request->user_id && !$request->country_id) {
        return response()->json(['error' => 'no params present in request']);
    }

    // dd($request->all());

    $user = User::find($request->user_id);
    $country_id = $request->country_id ?? 2305; //2305 is the default country_id for the US

    try {

        $country = Country::find($country_id);
        $country_code = $country->sort;

        // what is the o notation for the currency?
        $currency = Currency::where('country_code', '=', $country_code)->first();

        if (!$currency) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Currency not found');
        }
        $user->currency = $currency->code;

        $user->save();

        return response()->json(['message' => 'Currency set successfully', 'currency' => $currency->code]);

    }
    catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $currency = Currency::where('country_code', '=', 'US')->first();

        $user->currency = $currency->code;

        $user->save();
        return response()->json(['error' => 'Country not found, defaulting to US', 'currency' => $currency->code]);
    }


});
Route::prefix('users')->group(function () {
    Route::get('/me', [MobileController::class, 'me']);
    Route::get('/notifications', [MobileController::class, 'notifications']);
Route::prefix('auth')->group(function () {
    Route::post('/register', [MobileController::class, 'register']);
    Route::post('/login', [MobileController::class, 'login']);
    Route::post('/resend-otp', [MobileController::class, 'resend_otp']);
    Route::post('/login-2fa', [MobileController::class, 'login_2fa']);
    Route::post('/verify', [MobileController::class, 'verifyEmail']);
    Route::post('/forgot-password', [MobileController::class, 'forgot']);
    Route::post('/reset-password', [MobileController::class, 'reset']);
    // Route::get('login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::post('/login-facebook/callback', [MobileController::class, 'authFacebook']);
    Route::post('/login-google/callback', [MobileController::class, 'authGoogle']);
    Route::post('/register-facebook/callback', [MobileController::class, 'regFacebook']);
    Route::post('/register-google/callback', [MobileController::class, 'regGoogle']);
});
// Route::post('/update-email', [MobileController::class, 'updateEmail']);
Route::post("/set-2fa", [MobileController::class, 'two_fa_toggle']);
Route::post('/update-password', [MobileController::class, 'changePassword']);
Route::post('/update-phone', [MobileController::class, 'updatePhoneNumber']);
Route::post('/verify-phone', [MobileController::class, 'phoneVerificationView']);
Route::post('/update-profile', [MobileController::class, 'updateProfile']);

Route::prefix('role')->group(function () {
    Route::post('/creative', [MobileController::class, 'become_creative']);
    Route::post('/general', [MobileController::class, 'become_user']);
    Route::post('/vendor', [MobileController::class, 'become_vendor']);
});
Route::prefix('lists')->group(function () {
    Route::get('/skills', [MobileController::class, 'all_skills']);
    Route::get('/currencies', [MobileController::class, 'all_currencies']);
});
Route::prefix('general')->group(function () {
    Route::get('/home', [MobileController::class, 'general_user_home']);
});


Route::prefix('jobs')->group(function () {
    Route::get('/', [MobileCreative::class, 'all_jobs']);
    Route::get('/{id}', [MobileController::class, 'job_info']);
    Route::post('/search', [MobileController::class, 'jobs_search']);
});

Route::prefix('payment')->group(function () {
    Route::get('/details', [MobileCreative::class, 'getPaymentDetails']);
    Route::get('/banks', [MobileCreative::class, 'flutterwaveBanks']);
    Route::post('/resolve-account', [MobileCreative::class, 'resolveAccount']);
    Route::post('/add-account', [MobileCreative::class, 'flutterwaveSubAccount']);
});
Route::prefix('chats')->group(function () {
    Route::get('/', [MobileController::class, 'getChats']);
    Route::get('/messages', [MobileController::class, 'getMsgs']);
});


Route::prefix('vendor')->group(function () {
    Route::get('/my-jobs', [MobileController::class, 'myJobs']);
    Route::get('/my-store', [MobileController::class, 'my_products']);
    Route::get('/deleted-jobs', [MobileController::class, 'deletedJobs']);
    Route::get('/add-product-details', [MobileController::class, 'new_product_details']);
    Route::get('/add-job-details', [MobileController::class, 'job_new_details']);
    Route::post('/add-product', [MobileController::class, 'add_product']);
    Route::post('/upload-image', [MobileController::class, 'upload_image']);
    Route::post('/add-job', [MobileController::class, 'add_job']);
    Route::post('/delete-job', [MobileController::class, 'delete_job']);
    Route::post('/delete-product', [MobileController::class, 'delete_product']);

    Route::post('/award-job', [MobileController::class, 'award']);
    Route::post('/add-job', [MobileController::class, 'add_job']);
    // Route::post('/search', [MobileController::class, 'jobs_search']);
     Route::post('/creatives-search', [MobileController::class, 'creatives_search']);
     Route::post('/update-store', [MobileController::class, 'update_store']);
});

Route::prefix('creative')->group(function () {
    Route::get('/my-bids', [MobileCreative::class, 'myBids']);
    Route::get('/jobs', [MobileCreative::class, 'myJobs']);
    Route::post('/make-bid', [MobileCreative::class, 'bidApplication']);
    Route::post('/remove-bid', [MobileCreative::class, 'removeBid']);
    Route::get('/skills', [MobileCreative::class, 'viewSkills']);
    Route::get('/portfolio', [MobileCreative::class, 'portfolio']);

    Route::post("/add-portfolio", [MobileCreative::class, 'portfolioUpload']);
});

Route::prefix('mall')->group(function () {
    Route::get('/', [MobileController::class, 'home']);
    Route::get('/products', [MobileController::class, 'mall_products']);
    Route::get('/product/{id}', [MobileController::class, 'mall_product']);
    Route::get('/my-orders', [MobileController::class, 'my_orders']);
    Route::post('/rate-product', [MobileController::class, 'rate']);
});

Route::prefix('wallet')->group(function () {
    Route::get('/', [MobileWallet::class, 'wallet']);
    Route::post('/start-topup', [MobileWallet::class, 'initiate_topup']);
    Route::post('/callback-topup', [MobileWallet::class, 'callback_self_topup']);
});






});
