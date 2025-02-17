<?php

use App\Http\Controllers\Admin\JobsController as AdminJobsController;
use App\Http\Controllers\Admin\LandingPageController as AdminLandingPageController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\MitigationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\GeneralUserController;
use App\Http\Controllers\DisputeController;
use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\GeneralJobPostController;
use App\Http\Controllers\GeneralWalletController;
use App\Http\Controllers\api\v1\UserController as UserManagementController;
use App\Http\Controllers\api\v1\JobController as JobManagementController;
use App\Http\Controllers\api\v1\ProductController as ProductManagementController;
use App\Http\Controllers\api\v1\CountryController as CountriesManagementController;
use App\Http\Controllers\api\v1\RoleController as RolesManagementController;
use App\Http\Controllers\api\v1\CategoryController as CategoryManagementController;
use App\Http\Controllers\api\v1\ResidulePaymentController as ResidulePaymentManagementController;
use App\Http\Controllers\api\v1\SkillController as SkillManagementController;
use App\Http\Controllers\api\v1\VendorController as VendorManagementController;
use App\Http\Controllers\api\v1\VideoContentController;
use App\Http\Controllers\CreativeRatingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VendorRatingController;
use App\Http\Controllers\WalletController;
use App\Models\Influencer;
use App\Models\Job;
use App\Models\Product;
use App\Models\FlutterwaveSubaccount;
use App\Models\WalletTransaction;
use App\Models\WalletTransfer;
use Database\Seeders\LandingPageSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\CreativeRating;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Public routes::  These routes does not require AUTH
Route::post("/message-vendor", [MallController::class, 'message_vendor']);
Route::post("/send-message", [UserController::class, 'contact_us']);
Route::post("/vendor-info", [UserController::class, 'vendor_info']);

Route::get('/', [PagesController::class, 'index'])->name('public.index');
Route::get('/ambassadorhub', [AmbassadorController::class, 'index'])->name('ambassador.index');
Route::get('/privacy', [PagesController::class, 'privacy'])->name('public.privacy');
Route::get('/about', [PagesController::class, 'about'])->name('public.about');
Route::get('/acceptable-use', [PagesController::class, 'accepted'])->name('public.acceptable_use');
Route::get('/contact', [PagesController::class, 'contact'])->name('public.contact');
Route::get('/faq', [PagesController::class, 'faq'])->name('public.faq');
Route::get('/terms', [PagesController::class, 'terms'])->name('public.terms');
Route::get('/advertise', [PagesController::class, 'advertise'])->name('public.advertise');
Route::get('/team', [GeneralUserController::class, 'team'])->name('public.team');
Route::get('/message', [PagesController::class, 'message'])->name('public.message');
Route::get('/vendor-info', [PagesController::class, 'vendor_info'])->name('public.vendorinfo');
Route::get('/plans', [PagesController::class, 'viewUserPlans'])->name('public.plans');
Route::get('/vendor-user-information', [PagesController::class, 'vendorUserInformation'])->name('public.vendor-user-information');
Route::get('/online-video-submission', [PagesController::class, 'onlineVideoSubmission'])->name('public.online-video-submission');

Route::get('/cartsession', [MallController::class, 'getCartSession'])->name('guser.cart');
Route::post('/cartsession/delete', [MallController::class, 'deleteProductCartSession'])->name('guest.cart.delete');
/**
 * Add cart to the session
 */
Route::get("/mall", [MallController::class, 'mall_home'])->name('public.newmall');
Route::get("/mall/products", [MallController::class, 'mall_products'])->name('public.newproducts');
Route::get("/mall/cart", [MallController::class, 'mall_cart'])->name('mall.cart');
Route::get("/mall/checkout", [MallController::class, 'mall_checkout'])->name('mall.checkout');
Route::get("/mall/success/{id}", [MallController::class, 'success'])->name('public.success');
Route::get("/mall/products/{id}", [MallController::class, 'mall_product'])->name('public.newproducts.single');
Route::post("/mall/callback", [CheckoutController::class, 'checkout'])->name('public.make_checkout');
Route::post("/review", [MallController::class, 'rate'])->name('public.review');
Route::get('/getstates/{id}', [UserController::class, 'getstates'])->name("getstates");
Route::get('/getcities/{id}', [UserController::class, 'getcities'])->name("getcities");
Route::post('/cartsession', function (Request $request) {

    $cart = $request->session()->get('cart', []);
    //check if the product is already in the cart

    // if(in_array($request->product_id, $cart)){
    //     return response()->json(['status' => 'error', 'message' => 'Product already in cart'], 409);
    // }

    //check Product ID
    if (!isset($request->product_id)) {
        return response()->json(['message' => 'Product ID is required'], 400);
    }

    // dd($request->product_id);

    try {
        //check if product exists
        $products = Product::where('id', '=', $request->product_id)->first();
        $product = [
            'id' => $products->id,
            'name' => $products->name,
            'image' => $products->image && gettype(json_decode($products->image)) == 'array' && count(json_decode($products->image)) > 0 && json_decode($products->image)[0] ? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/' . json_decode($products->image)[0] : '/img/empty.png',
            'qty' => 1,
            'shipping' => $products->shipping ?? 0,
            'price' => $products->price,
        ];

        // Example usage


        if (in_array($product, $cart)) {
            return response()->json(['message' => 'Product Qty updated ', 'product' => $product, 'cart_count' => count($cart)]);
        }
        $cart[] = $product;
        $request->session()->put('cart', $cart);
        return response()->json(['message' => 'Product added to cart', 'product' => $product, 'cart_count' => count($cart)]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Product not found'], 404);
    }
});


/**
 * By Aemmi
 */
Route::get('/vids', function () {
    return view('pages.others.videos');
});
Route::get('/register', [AuthController::class, 'welcome'])->name('auth.register');

// Auth Routes
Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/auth/login', [AuthController::class, 'regularLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/xlogin', [AuthController::class, 'regularLogin'])->name('login.regular');
    Route::post('/login', [AuthController::class, 'ajaxLogin'])->name('login.ajax');
    Route::post('/login-2fa', [AuthController::class, 'login_2fa'])->name('login.2fa');

    // Regular Registration
    Route::get('/signup', [AuthController::class, 'register'])->name('auth.welcome');

    Route::post('/firstregister', [AuthController::class, 'firstRegister'])->name('register.first');
    Route::post('/xregister', [AuthController::class, 'regularRegister'])->name('register.regular');
    // Google login
    Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [AuthController::class, 'authGoogle']);
    // Facebook login
    Route::get('login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('login/facebook/callback', [AuthController::class, 'authFacebook']);
    //Twitter Login
    Route::get('login/twitter', [AuthController::class, 'redirectToTwitter'])->name('login.twitter');
    Route::get('login/twitter/callback', [AuthController::class, 'authTwitter']);

    // Route::get('/youtube/callback', [AuthController::class, 'redirectYouTube'])->name('youtube.callback');
    // Route::get('/youtube', [AuthController::class, 'youtube'])->name('youtube');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Register

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'resetEmail'])->name('auth.reset.email');
Route::post('/forgot-password', [AuthController::class, 'resetPostEmail'])->name('auth.post.email');

Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('auth.reset.password.get');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('auth.reset.password');
//Verify Email
Route::get('/email/verify/{token}', [AuthController::class, 'vemail'])->name('email.verify.get');
Route::post('/email/verify/', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::post('/email/resend/', [AuthController::class, 'resendEmail'])->name('verification.resend');

// Route::get('/test', [AuthController::class, 'test'])->name('test');
Route::get('/set-role', [UserController::class, 'set_role'])->name('user.set_role'); //switch active role

// Route::get('/mall', [MallController::class, 'index'])->name('mall.index');
Route::get('/mall/show/{id}', [MallController::class, 'show'])->name('mall.show');
Route::get('/mall/{station}', [MallController::class, 'vendor'])->name('mall.vendor');
Route::get('/mall/checkout/cart', [MallController::class, 'checkout'])->name('mall.checkout1');
Route::get('products', [MallController::class, 'getProducts'])->name('mall.products');



Route::post('/subaccount/delete', [PaymentController::class, 'deleteSubaccount'])->name('subaccount.delete');


//Payment Link for Flutterwave
Route::post('/pay/link', [PaymentController::class, 'getPaymentLink'])->name('pay.link');
Route::get('/pay/details', [PaymentController::class, 'getPaymentDetails'])->name('pay.details');
Route::post('/pay/resolveacc', [PaymentController::class, 'resolveAccount'])->name('pay.resolveacc');

// make request to route to notify user that their account has been updated (payment method added)
Route::get('/payment/method/update', [PaymentController::class, 'paymentMethodAddedToAccount'])->name('account.payment.update');



Route::get('/flutterwave/banGeneralUserControllerks', [ProfileController::class, 'flutterwaveBanks'])->name('flutterwave.banks');
Route::post('/flutterwave/subaccount', [ProfileController::class, 'flutterwaveSubAccount'])->name('flutterwave.subaccount');
Route::post('/stripe/webhook', [ProfileController::class, 'stripeWebHook'])->name('user.stripe.redirect');



//General User Routes
Route::get('/guser', [GeneralUserController::class, 'index'])->name('user.guser.index');
Route::get('/video/{id}', [GeneralUserController::class, 'cvideo'])->name('user.guser.show');
Route::get('/guser/fetchDetails/{cid}', [GeneralUserController::class, 'fetchDetails'])->name('user.guser.fetchDetails');
Route::post('/guser/submitcomment', [GeneralUserController::class, 'submitComment'])->name('user.guser.submitComment');
Route::get('/guser/loadcomments/{vid}', [GeneralUserController::class, 'reloadComments'])->name('user.guser.reloadComments');
Route::get('/guser/loadcreatives', [GeneralUserController::class, 'loadcreatives'])->name('user.guser.loadcreatives');
Route::post('/guser/submitcommentresp', [GeneralUserController::class, 'submitCommentResponse'])->name('user.guser.submitCommentResponse');
//end of general user routes

//search route
Route::get('/search/{query}', [SearchController::class, 'processSearchQuery']);
//end of search route

Route::get('/register/creative', [InfluencerController::class, 'general'])->name('register.creative');
Route::post('/store/creative', [InfluencerController::class, 'register'])->name('store.creative');
Route::post('/creative-email', [InfluencerController::class, 'email_exists'])->name('creative.email.exists');

Route::get('/post/info', [JobsController::class, 'general_info'])->name('job.info');
Route::get('/post/job', [JobsController::class, 'general'])->name('job.post');
Route::get('/referral/{id}', [JobsController::class, 'general_2'])->name('job.post2');
Route::post('/post-register/job-user', [GeneralJobPostController::class, 'submit_register'])->name('post.job.register');
Route::post('/post/old-user/job', [GeneralJobPostController::class, 'oldUser_job'])->name('post.oldUser.job');
Route::post('/login/user', [GeneralJobPostController::class, 'login'])->name('post.job.login');
Route::get('/buyregister', [AuthController::class, 'buyRegister'])->name('register.buyregular');

// Route::post('/create/general/jobs', [JobsController::class, 'createJobGeneral'])->name('user.general.jobs.create');

// All the Route naming must start user, to render the appropriate header and navigation
Route::group([
    'middleware' => ['custom.auth']
], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/verify-email', function () {
        return view('pages.user.verify.email');
    });
    //checkout for all users
    Route::get('/checkout', [MallController::class, 'checkout'])->name('user.checkout');
    Route::post('/placeorder', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    // Profile Details
    Route::get('/settings', [ProfileController::class, 'index'])->name('user.profile');
    Route::post("/upload-portfolio", [ProfileController::class, 'portfolioUpload'])->name("add_portfolio");
    Route::post('/profile-details', [ProfileController::class, 'profileDetails'])->name('user.profile.details');
    Route::post('/update-email', [ProfileController::class, 'updateEmail'])->name('user.email.update');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('user.change.password');
    Route::post('/update-phone-number', [ProfileController::class, 'updatePhoneNumber'])->name('user.update.phone');
    Route::post('/delete/subaccount/{id}', [ProfileController::class, 'deleteSubaccount'])->name('user.subaccount.delete');
    Route::get('/payment-method/list', [PaymentController::class, 'indexAction'])->name('user.payment.methods');

    Route::get('/verify/phone', function () {
        $phone_number = Auth::user()->phone_number;
        if ($phone_number === null || Auth::user()->isPhoneVerified) {
            return redirect()->route('user.dashboard');
        }
        return view('pages.user.profile.verify-phone', compact('phone_number'));
    })->name('user.phone.view');

    Route::post('/verify/phone/code', function () {
        dd('route-verified');
    })->name('user.phone.verify');

    Route::post('/verify/phone/code', [ProfileController::class, 'phoneVerificationView'])->name('user.phone.verify');

    Route::get('/my-orders', [MallController::class, 'orders'])->name('user.mall.orders');
    Route::post('/twofa-toggle', [AuthController::class, 'two_fa_toggle'])->name('user.twofa.toggle');

    Route::get('/view-profile', [ProfileController::class, 'viewProfile'])->name('user.view.profile');
    Route::get('/referrals', [ProfileController::class, 'viewReferrals'])->name('user.profile.referrals');
    Route::get('/user/description', [ProfileController::class, 'description'])->name('user.description');
    Route::post('/update-description', [ProfileController::class, 'updateDescription'])->name('user.update.description');
    Route::post('/upload/image', [ProfileController::class, 'uploadImage'])->name('user.upload.image');
    // Registration for vendors
    Route::post('/become-vendor', [ProfileController::class, 'RegistrationForVendors'])->name('user.register.vendor');
    Route::post('/update/vendor/details', [ProfileController::class, 'updateVendorDetails'])->name('user.vendor.update.details');

    //Registration for influencers
    Route::get('/influencer/register', [InfluencerController::class, 'index'])->name('user.influencer.index');
    Route::post('/influencer/register', [InfluencerController::class, 'register'])->name('user.influencer.register');
    Route::get('/influencer/instagram', [InfluencerController::class, 'redirectToInstagram'])->name('login.instagram');
    Route::get('/influencer/instagram/callback', [InfluencerController::class, 'authInstagram']);
    Route::get('/influencer/facebook', [InfluencerController::class, 'redirectToFacebook'])->name('login.facebook.verif');
    Route::get('/influencer/facebook/callback', [InfluencerController::class, 'authFacebook']);
    Route::get('/influencer/twitter', [InfluencerController::class, 'redirectToTwitter'])->name('influencer.login.twitter');
    Route::get('/influencer/twitter/callback', [InfluencerController::class, 'authTwitter']);
    Route::post('/skills', [InfluencerController::class, 'addSkills'])->name('user.skill.add');

    //Support Ticket
    Route::get('/support-ticket', [SupportTicketController::class, 'index'])->name('user.support.ticket');
    Route::get('/support-ticket/create', [SupportTicketController::class, 'create'])->name('user.support.ticket.create');
    Route::post('/support-ticket/store', [SupportTicketController::class, 'store'])->name('user.support.ticket.store');
    Route::get('/support-ticket/show', [SupportTicketController::class, 'show'])->name('user.support.ticket.show');
    Route::post('/support-ticket/reply/{id}', [SupportTicketController::class, 'reply'])->name('user.support.ticket.reply');
    Route::get('/support-ticket/close', [SupportTicketController::class, 'close'])->name('user.support.ticket.close');



    //Dispute and Arbitration
    Route::get('/dispute', [DisputeController::class, 'index'])->name('user.dispute.arbitration');
    Route::get('/dispute/stage-two', [DisputeController::class, 'stageTwo'])->name('user.dispute.two');
    Route::get('/dispute/stage-three', [DisputeController::class, 'stageThree'])->name('user.dispute.three');
    Route::get('/dispute/stage-four', [DisputeController::class, 'stageFour'])->name('user.dispute.details.four');
    Route::get('/dispute/details/{id}', [DisputeController::class, 'get_dispute_details'])->name('user.dispute.details');
    Route::get('/dispute/drop/{dispute_id}', [DisputeController::class, 'resolve_dispute'])->name('user.dispute.drop');
    Route::get('/dispute/mitigation/{dispute_id}', [DisputeController::class, 'mitigate_dispute'])->name('user.dispute.mitigate');
    Route::post('/dispute/cancel/{dispute_id}', [DisputeController::class, 'cancel_dispute'])->name('user.dispute.cancel');
    Route::post('/dispute/register', [DisputeController::class, 'register_dispute'])->name('user.dispute.register');
    Route::post('/dispute/message/register', [DisputeController::class, 'register_dispute_message'])->name('user.dispute.message.store');
    Route::post('/dispute/next/stage-three/{id}', [DisputeController::class, 'set_dispute_three'])->name('user.dispute.next.three');
    Route::get('/dispute/back/stage-two/{id}', [DisputeController::class, 'back_dispute_two'])->name('user.dispute.back.two');

    //dispute mitigation payment
    Route::post('/dispute/mitigation/pay', [DisputeController::class, 'pay_mitigation'])->name('user.dispute.mitigation.pay');
    Route::get('/dispute/mitigation/pay/callback', [DisputeController::class, 'callback_self_mitigation'])->name('user.dispute.mitigation.callback');


    //Jobs
    //will jobs api controller to get jobs
    Route::get('/create/jobs', [JobsController::class, 'index'])->name('user.vendor.jobs.index');
    Route::post('/create/jobs/save', [JobsController::class, 'createJob'])->name('user.vendor.jobs.create');

    Route::get('/jobs', [JobsController::class, 'jobs'])->name('user.jobs.index');
    Route::get('/fetch_bids', [JobsController::class, 'fetch_bids'])->name('user.jobs.fetch_bids');
    Route::get('/jobs-list', [JobsController::class, 'jobsList'])->name('user.jobs.jobs-list');
    Route::get('/jobs-list/advanced/filter', [JobsController::class, 'jobsListAdvancedSearch'])->name('user.jobs.jobs-list-search-advanced');
    Route::get('/jobs-list/filter/{data?}', [JobsController::class, 'jobsListSearch'])->name('user.jobs.jobs-list-search');
    Route::get('/jobs-budgets', [JobsController::class, 'jobsBudgets'])->name('user.jobs.budgets');
    Route::get('/jobs-categories', [JobsController::class, 'jobsCategories'])->name('user.jobs.categories');

    Route::get('/jobs/details/{job}', [JobsController::class, 'jobsShow'])->name('user.jobs.show');

    // Wallet route here
    Route::post('/vwallet/credit', [WalletController::class, 'credit'])->name('wallet.credit');
    Route::get('status', [WalletController::class, 'capturePayment'])->name('payment.status');
    Route::get('/wallet/{job_uid}/create', [WalletController::class, 'create'])->name('wallet.create');
    Route::get('/milestone/{uid}/pay', [WalletController::class, 'pay'])->name('wallet.pay');
    //callback route
    Route::get('/wallet/credit/callback', [WalletController::class, 'callback'])->name('wallet.credit.callback');
    Route::get('/wallet/credit/callback-paystack', [WalletController::class, 'callback_paystack'])->name('wallet.credit.callback_paystack');
    Route::get('/wallet/pay/callback', [WalletController::class, 'payCallback'])->name('wallet.pay.callback');
    //Wallet end

    // General Wallet
    Route::get('/gwallet/index', [GeneralWalletController::class, 'index'])->name('user.gwallet.index');
    Route::post('/gwallet/topup', [GeneralWalletController::class, 'self_topup'])->name('gwallet.credit.topup');
    Route::post('/gwallet/withdraw', [GeneralWalletController::class, 'withdrawal'])->name('gwallet.withdraw');
    // Withdraw otp
    Route::post('/gwallet/withdraw/otp', [GeneralWalletController::class, 'otpSystem'])->name('gwallet.withdraw.otp');
    Route::get('/gwallet/topup/callback', [GeneralWalletController::class, 'callback_self_topup'])->name('gwallet.credit.callback');

    //Truncate Routes, do not visit!!!
    Route::get('/truncate-tables', function () {
        FlutterwaveSubaccount::truncate();
        WalletTransfer::truncate();
        WalletTransaction::truncate();

        echo 'Tables Truncated Successfully';
    });

    //Rating Routes
    Route::post('rate/creative', [CreativeRatingController::class, 'store'])->name('rate.creative');
    Route::post('rate/vendor', [VendorRatingController::class, 'store'])->name('rate.vendor');

    //activity Routes
    Route::get('/activity/clear', [UserController::class, 'markAsRead'])->name('user.clear.activity');
    Route::post('/activity/delete', [UserController::class, 'markSingleRead'])->name('user.delete.activity');

    //update job payment milestone
    Route::post('/job/update/payment-milestone', [JobsController::class, 'updateJobPaymentMilestone'])->name('user.job.update.payment.milestone');

    Route::get('/job/finial/payment/{id}', [JobManagementController::class, 'finalPayment'])->name('user.job.final.payment');

    Route::post('/jobs/bid', [JobsController::class, 'bidApplication'])->name('user.jobs.bid');
    Route::post('/jobs/remove-bid', [JobsController::class, 'removeBid'])->name('user.jobs.delete');
    Route::get('/jobs/bids/insight', [JobsController::class, 'bidsInsight'])->name('user.jobs.bids.insight');
    Route::get('/jobs/my-jobs', [JobsController::class, 'myJobs'])->name('user.jobs.my-jobs');
    Route::get('/jobs/deleted-jobs', [JobsController::class, 'deletedJobs'])->name('user.jobs.deleted-jobs');
    Route::get('/jobs/bids/{job}/edit', [JobsController::class, 'bidEdit'])->name('user.jobs.bid.edit');
    Route::post('/jobs/bids/update', [JobsController::class, 'bidUpdate'])->name('user.jobs.bid.update');
    Route::post('/jobs/bid/award', [JobsController::class, 'award'])->name('user.jobs.bid.award');
    Route::get('/jobs/file/download/{file}', [JobsController::class, 'fileDownload'])->name('user.jobs.file.download');
    Route::post('/jobs/file/upload', [JobsController::class, 'fileUpload'])->name('user.jobs.file.upload');
    Route::post('/job/video', [JobsController::class, 'videoUpload'])->name('user.job.video.upload');
    Route::post('/jobs/delete-job', [JobsController::class, 'delete_job'])->name('user.job.video.delete');
    Route::get('/job/video/download/{id}', [JobsController::class, 'videoDownload'])->name('user.job.video.download');
    Route::post('/job/video/token', [JobsController::class, 'videoToken'])->name('user.job.video.token');
    Route::get('/job/video/code/{code}', [JobsController::class, 'YTVideoCode'])->name('user.job.video.code');

    Route::post('/approve/jobs/video/', [JobsController::class, 'approveVideo'])->name('approve.video');

    Route::get('/fetch/video/{video_id}/status', [JobsController::class, 'videoStatus'])->name('fetch.video.status');
    Route::get('job/search', [JobsController::class, 'search'])->name('user.job.search');
    Route::get('/jobs/available', [JobsController::class, 'getAvailableJobs'])->name('user.jobs.available');
    Route::get('category/search', [JobsController::class, 'searchByCategory'])->name('user.category.search');
    Route::get('/category/available', [JobsController::class, 'getAvailableCategory'])->name('user.category.available');
    Route::get('/job/unique/{id}', [JobsController::class, 'jobUniqueid'])->name('job.unique.id');
    Route::get('job/checkAwarded/{job_id}', [JobsController::class, 'isJobAwarded'])->name('job.check.awarded');
    // Stripe
    Route::post('/stripe/add-user', [ProfileController::class, 'addStripe'])->name('user.stripe.account');

    // Vendors
    Route::get('/my-store', [VendorsController::class, 'index'])->name('user.vendors.index');
    Route::get('/my-store/create', [VendorsController::class, 'create'])->name('user.vendors.create');
    Route::get('/my-store/edit/{id}', [VendorsController::class, 'edit'])->name('user.vendors.edit2');
    Route::get('/my-store/edit', [VendorsController::class, 'edit2'])->name('user.vendors.edit');
    Route::post('/my-store/save', [VendorsController::class, 'save'])->name('user.vendors.save');
    Route::post('/my-store/edit', [VendorsController::class, 'update'])->name('user.vendors.edit');

    // Vendor Digitally Sign
    Route::post('/my-store/digitalSign', [VendorsController::class, 'digitalSign'])->name('user.vendors.digitalSign');

    Route::post('/my-store/customaize', [VendorsController::class, 'customaize'])->name('user.vendors.custom');
    Route::post('/my-store/save/banner', [VendorsController::class, 'uploadBanner'])->name('user.vendors.save.banner');
    Route::get('/my-store/products', [VendorsController::class, 'products'])->name('user.vendors.products');
    Route::get('/my-store/deleted-products', [VendorsController::class, 'deleted_products'])->name('user.vendors.deletedproducts');
    Route::post('/my-store/start-shipping', [VendorsController::class, 'start_shipping'])->name('user.vendors.start_shipping');
    Route::post('/my-store/start-delivery', [VendorsController::class, 'start_delivery'])->name('user.vendors.start_delivery');
    Route::post('/my-store/delete-product', [VendorsController::class, 'delete_product'])->name('user.vendors.delete_product');
    Route::post('/my-store/deliver', [VendorsController::class, 'deliver'])->name('user.vendors.deliver');
    Route::get('/milestones/pay', [JobsController::class, 'milestones'])->name('user.vendors.milestones.pay');
    Route::get('/video/review', [VendorsController::class, 'viewVideo'])->name('user.vendors.video.review');
    Route::get('/video/approve', [JobsController::class, 'completed'])->name('user.vendors.video.approve');
    Route::get('/vendor/orders', [VendorsController::class, 'orders'])->name('user.vendor.orders');

    Route::get('/influencer/profile/{code}', [InfluencerController::class, 'influencerProfile'])->name('user.influencer.profile');
    Route::post('/become-influencer', [ProfileController::class, 'RegistrationForInfluencers'])->name('user.register.influencer');
    Route::post('/verify/email', [UserController::class, 'verifyEmail'])->name('user.verify.email');

    // chat
    Route::get('/chat', [ChatController::class, 'index'])->name('user.chat');
    Route::get('/registerChat', [ChatController::class, 'getInfluencerDetails'])->name('user.chat.register');
    Route::get('/irc/{query}/', [ChatController::class, 'checkIfInit'])->name('user.chat.exist');

    //video content

    Route::post('/video/{videoId}/like', [VideoContentController::class, 'like'])->name('api.video.like');
    Route::post('/video/{videoId}/comments', [VideoContentController::class, 'postComment'])->name('api.video.postComment');
    Route::post('/video/{videoId}/comments/{commentId}', [VideoContentController::class, 'postCommentReply'])->name('api.video.postCommentReply');
    Route::put('/video/{videoId}/increase-views', [VideoContentController::class, 'increaseViews'])->name('api.video.increaseViews');

    Route::get('/video/{videoId}/comments', [VideoContentController::class, 'comments'])->name('api.video.comments');
    Route::get('/video/{videoId}/comments/{commentId}/replies', [VideoContentController::class, 'commentsReply'])->name('api.video.comments.reply');
    Route::get('/video/search', [VideoContentController::class, 'search'])->name('api.video.search');
    Route::get('/video/trending', [VideoContentController::class, 'trending'])->name('api.video.trending');
    Route::get('/video/latest', [VideoContentController::class, 'latest'])->name('api.video.latest');
    Route::get('/video/{videoId}/related', [VideoContentController::class, 'related'])->name('api.video.related');
    Route::get('/video/{videoId}', [VideoContentController::class, 'show'])->name('api.video.show');

    // Update Video timer
    Route::post('/video/time/update', [JobManagementController::class, 'UpdateVideoTimer'])->name('video.update.timer');

    //update video view_at
    Route::post('/video/viewat/', [JobsController::class, 'VendorWatchedVideo'])->name('video.update.viewat');



    Route::get("/jobs/{job}/generateToken", [JobManagementController::class, 'generateToken'])->name('jobs.generatetoken');
});

Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'admin',
], function () {
    Route::get('/dashboard', [AdminPagesController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminPagesController::class, 'users'])->name('admin.users.index');
    Route::get('/categories', [AdminPagesController::class, 'categories'])->name('admin.categories.index');
    Route::get('/products', [AdminPagesController::class, 'products'])->name('admin.products.index');
    Route::get('/users-csv', [AdminPagesController::class, 'downloadcsv'])->name('admin.users.csv');
    Route::get('/support', [AdminPagesController::class, 'support'])->name('admin.support.index');
    Route::get('/support/{id}', [AdminPagesController::class, 'support_ticket'])->name('admin.support.ticket');
    Route::get('/skills', [AdminPagesController::class, 'skills'])->name('admin.skills.index');
    Route::get('/cms', [AdminPagesController::class, 'cms'])->name('admin.cms.index');
    Route::get('/residules', [AdminPagesController::class, 'residules'])->name('admin.residules.index');
    Route::get('/ambassadors', [AdminPagesController::class, 'ambassadors'])->name('admin.ambassadors.index');
    Route::get('/vendor-contacts', [AdminPagesController::class, 'vendor_contacts'])->name('admin.vendor_contacts.index');
    Route::get('/ambassadors/notifications', [AdminPagesController::class, 'ambassador_notifications'])->name('admin.ambassadors.notifications');
    Route::get('/delete-noti/{id}', [AdminPagesController::class, 'removeNotification'])->name('admin.ambassadors.removenotifications');
    Route::get('/ambassadors/{id}', [AdminPagesController::class, 'ambassador'])->name('admin.ambassadors.user');
    Route::get('/site/landing-page', [AdminLandingPageController::class, 'index'])->name('admin.site.landing');
    Route::post('/change-status', [AdminPagesController::class, 'changestatus'])->name('admin.changestatus');
    Route::post('/change-status2', [AdminPagesController::class, 'changestatus2'])->name('admin.changestatus2');
    Route::post('/add-notification', [AdminPagesController::class, 'addNotification'])->name('admin.addnotif');

    // Landing page settings
    Route::post('/site/landing-page/main-content', [AdminLandingPageController::class, 'mainHeader'])->name('admin.site.landing.main');
    Route::post('/site/why-vicomma', [AdminLandingPageController::class, 'whyVicomma'])->name('admin.site.why-vicomma');
    Route::post('/site/not-just-another-platform', [AdminLandingPageController::class, 'NotJustAnotherPlatform'])->name('admin.site.platform');
    Route::post('/site/why-join-vicomma', [AdminLandingPageController::class, 'WhyJoinVicomma'])->name('admin.site.why-join-vicomma');
    Route::post('/site/how-vicomma-works', [AdminLandingPageController::class, 'howVicommaWorks'])->name('admin.site.how-vicomma-works');
    //for managing team
    Route::get('/team', [AdminPagesController::class, 'team'])->name('admin.team');
    Route::post('/team', [AdminPagesController::class, 'addTeam'])->name('admin.addTeam');
    Route::get('/editTeam/{id}', [AdminPagesController::class, 'editTeam'])->name('admin.editTeam');
    Route::post('/editTeam/{id}', [AdminPagesController::class, 'saveTeamChanges'])->name('admin.saveTeamChanges');
    Route::get('/deleteTeam/{file}', [AdminPagesController::class, 'deleteTeam'])->name('admin.deleteTeam');
    //end of team route
    //cms
    Route::get('/cms/about', [CmsController::class, 'about'])->name('admin.cms.about');
    Route::get('/cms/acceptable-use', [CmsController::class, 'accepted'])->name('admin.cms.acceptable_use');
    Route::post('/cms/update-about', [CmsController::class, 'post_about'])->name('admin.cms.post_about');
    Route::post('/cms/update-accepted', [CmsController::class, 'post_accepted'])->name('admin.cms.post_accepted');
    Route::get('/cms/terms', [CmsController::class, 'terms'])->name('admin.cms.terms');
    Route::post('/cms/update-terms', [CmsController::class, 'post_terms'])->name('admin.cms.post_about');
    Route::get('/cms/online', [CmsController::class, 'online'])->name('admin.cms.online');
    Route::post('/cms/update-online', [CmsController::class, 'post_online'])->name('admin.cms.post_about');

    Route::get('/cms/vendor', [CmsController::class, 'vendor'])->name('admin.cms.vendor');
    Route::post('/cms/update-vendor', [CmsController::class, 'post_vendor'])->name('admin.cms.post_about');
    Route::get('/cms/privacy', [CmsController::class, 'privacy'])->name('admin.cms.privacy');
    Route::post('/cms/update-privacy', [CmsController::class, 'post_privacy'])->name('admin.cms.post_about');
    // Jobs
    Route::get('/jobs', [AdminJobsController::class, 'index'])->name('admin.jobs.index');

    // Mitigation
    Route::get('/mitigation', [MitigationController::class, 'index'])->name('admin.mitigation.index');
    Route::get('/mitigations/getAll', [MitigationController::class, 'getAll'])->name('admin.mitigation.get');
    Route::get('/mitigation/viewJob/{mitigation?}', [MitigationController::class, 'viewJob'])->name('admin.mitigation.viewJob');
    Route::get('/mitigation/viewDispute/{dispute?}', [MitigationController::class, 'viewDispute'])->name('admin.mitigation.viewDispute');
    Route::put('/mitigation/close', [MitigationController::class, 'close'])->name('admin.mitigation.close');

    //api routes for admin
    //when we integrate passport or jwt we can move these routes to api.php
    Route::group(['prefix' => 'api/v1'], function () {
        Route::get('/users/filter/{data?}', [UserManagementController::class, 'filter'])->name('admin.user.filter');
        Route::get('/categories/filter/{data?}', [CategoryManagementController::class, 'filter'])->name('admin.categories.filter');
        Route::get('/skills/filter/{data?}', [SkillManagementController::class, 'filter'])->name('admin.skills.filter');
        Route::get('/residules/filter/{data?}', [ResidulePaymentManagementController::class, 'filter'])->name('admin.residules.filter');
        Route::get('/jobs/filter/{data?}', [JobManagementController::class, 'filter'])->name('admin.jobs.filter');
        Route::get('/products/filter/{data?}', [ProductManagementController::class, 'filter'])->name('admin.products.filter');
        Route::apiResources(
            [
                'users' => UserManagementController::class
            ]
        );
        Route::apiResources(
            [
                'jobs' => JobManagementController::class
            ]
        );
        Route::apiResources(
            [
                'countries' => CountriesManagementController::class
            ]
        );
        Route::apiResources(
            [
                'roles' => RolesManagementController::class
            ]
        );
        Route::apiResources(
            [
                'categories' => CategoryManagementController::class
            ]
        );
        Route::apiResources(
            [
                'residules' => ResidulePaymentManagementController::class
            ]
        );
        Route::apiResources(
            [
                'products' => ProductManagementController::class
            ]
        );
        Route::apiResources(
            [
                'skills' => SkillManagementController::class
            ]
        );
        Route::apiResources(
            [
                'vendors' => VendorManagementController::class
            ]
        );
    });
});

// zafzyfklirfrzxfu app password
