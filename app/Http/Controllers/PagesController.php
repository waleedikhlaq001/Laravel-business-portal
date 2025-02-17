<?php

namespace App\Http\Controllers;

use App\Models\Admin\HowVicommaWork;
use App\Models\Admin\LandingPage;
use App\Models\Admin\NotJustAnotherVideoPlatform;
use App\Models\Admin\VicommaBenefit;
use App\Models\Admin\WhoUsesVicomma;
use App\Models\Admin\WhyJoinVicomma;
use App\Models\Admin\WhyVicommaIsForYou;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Job;
use App\Models\VideoContent;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        $main_content = LandingPage::first();
        $why_vicomma = WhyVicommaIsForYou::first();
        $not_just_platform = NotJustAnotherVideoPlatform::first();
        $how_vicomma_works = HowVicommaWork::first();
        $why_join_vicomma = WhyJoinVicomma::first();
        $who_uses_vicomma = WhoUsesVicomma::all();
        $benefits = VicommaBenefit::all();

        return view('pages.index', compact('main_content', 'why_vicomma', 'not_just_platform', 'how_vicomma_works', 'why_join_vicomma', 'who_uses_vicomma', 'benefits'));
    }

    public function privacy()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $privacy = DB::table("cms")->where("type", "privacy")->first();
        if(!$privacy){
            return redirect("/");
        }
        return view('pages.others.privacy', compact('random_products','trending_videos', "privacy"));
    }
    public function about()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $about = DB::table("cms")->where("type", "about")->first();
        if(!$about){
            return redirect("/");
        }
        return view('pages.others.about', compact('random_products','trending_videos', "about"));

    }

    public function accepted()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $info = DB::table("cms")->where("type", "accepted")->first();
        if(!$info){
            return redirect("/");
        }
        return view('pages.others.accept', compact('random_products','trending_videos', "info"));

    }
    public function contact()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        return view('pages.others.contact', compact('random_products','trending_videos'));
    }
    public function faq()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        return view('pages.others.faq', compact('random_products','trending_videos'));
    }
    public function terms()
    {

        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $terms = DB::table("cms")->where("type", "terms")->first();
        if(!$terms){
            return redirect("/");
        }
        return view('pages.others.terms', compact('random_products','trending_videos', "terms"));

    }
    public function advertise()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        return view('pages.others.advertise', compact('random_products','trending_videos'));
    }
    public function message()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        return view('pages.others.message', compact('random_products','trending_videos'));
    }

    public function vendor_info()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        return view('pages.others.request', compact('random_products','trending_videos'));
    }
    public function vendorUserInformation()
    {

        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $info = DB::table("cms")->where("type", "vendor")->first();
        if(!$info){
            return redirect("/");
        }
        return view('pages.others.vendor-user-information', compact('random_products','trending_videos', "info"));
    }
    public function onlineVideoSubmission()
    {
        //get random products
        $random_products = Product::inRandomOrder()->limit(10)->get() ?? array();
        //trending videos
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $info = DB::table("cms")->where("type", "online")->first();
        if(!$info){
            return redirect("/");
        }
        return view('pages.others.online', compact('random_products','trending_videos', "info"));
    }

    public function viewUserPlans()
    {
        return view('pages.user.plans.index');
    }

}
