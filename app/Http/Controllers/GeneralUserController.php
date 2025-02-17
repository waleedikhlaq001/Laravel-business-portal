<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Influencer;
use App\Models\Job;
use App\Models\Product;
use App\Models\User;
use App\Models\Team;
use App\Models\VideoContent;
use App\Models\VideoContentComment;
use App\Models\VideoContentView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class GeneralUserController extends Controller
{
    public function index(Request $request)
    {
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        // dd($completed_jobs);
        $awarded = Job::orderBy('id', 'desc')->where('isAwarded', Job::AWARDED)->get();
        $get_creatives = Influencer::inRandomOrder()
            ->leftJoin('influencer_details', 'influencers.user_id', '=', 'influencer_details.user_id')
            ->select('influencers.*', 'influencer_details.influencer_skills')
            ->limit(15)->get();
        $creatives = [];

        foreach ($get_creatives as $value) {
            $value->influencer_skills = json_decode($value->influencer_skills);
            if (is_array($value->influencer_skills)) {
                $value->influencer_skills = implode(", ", $value->influencer_skills);
            }
            $creatives[] = $value;
        }


        $featured_video = VideoContent::orderBy('created_at', 'desc')->whereIn('job_id', $completed_jobs)->first();
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();
        $videos = VideoContent::orderBy('created_at', 'desc')->whereIn('job_id', $completed_jobs)->limit(12)->get();

        if ($featured_video) {
            $featured_job = Job::where('video_id', $featured_video->id)->first();
        } else {
            $featured_job = '';
        }
        //get video views count
        if ($featured_job) {
            $featured_product = Product::where('id', $featured_job->product_id)->first() ?? '';
        } else {
            $featured_product = '';
        }

        if ($featured_product) {
            $image = json_decode($featured_product->image);
            $related_products = Product::where('category_id', $featured_product->category_id)->inRandomOrder()->limit(5)->get();
        } else {
            $image = '';
            $related_products = '';
        }

        $geo = $this->currencyConverter($request);

        return view('pages.guser.index', compact('creatives', 'image', 'awarded', 'videos', 'related_products', 'featured_video', 'trending_videos', 'featured_product', 'geo'));
    }

    public function currencyConverter($req)
    {

        $details = json_decode(file_get_contents("http://ipinfo.io"), true);
        // echo $details->country;
        $ip = $details['ip'];
        $ip = $req->getClientIp();

        $geo = file_get_contents("https://api.timanetglobaltech.com/?ip=" . $ip . "&time=" . date('H:i:s'));
        // print_r($geo);
        $geo_data = json_decode($geo, true);

        if ($geo_data['country'] == false || $geo_data['country'] != 'Nigeria') {
            $data['currency_symbol'] = '$';
            $data['exchange_rate'] = '1';

            $geo_data = $data;
        }

        return $geo_data;
    }

    public function loadCreatives()
    {
        //an ajax function call
        $creatives = Influencer::inRandomOrder()->limit(15)->get();
        $output = "";
        if (count($creatives) > 0) {
            foreach ($creatives as $creative) {
                $output .= '<div class="partner-item">';
                $output .= '<img src="' . $creative->user->image . '" onclick="creativeDetails(' . $creative->user->id . ')"
                        class="partner-image">';
                $output .= '<div class="row text-black pt-2">
                <b style="text-align: center; font-size: 9px;">';
                $output .= Str::ucfirst(strtolower($creative->user->first_name)) . '&nbsp;' . Str::ucfirst(strtolower($creative->user->last_name));
                $output .= '</b>';
                $output .= '</div>
                </div>';
            }
        }

        return $output;
    }

    public function cvideo(Request $request, $id)
    {
        $awarded = Job::orderBy('id', 'desc')->where('isAwarded', Job::AWARDED)->get();
        $creatives = Influencer::orderBy('id', 'desc')->inRandomOrder()->limit(20)->get();
        $featured_video = VideoContent::find($id);
        if(!$featured_video){
            return redirect()->back();
        }
        $completed_jobs = Job::where(['isAwarded' => Job::AWARDED, 'isCompleted' => Job::COMPLETED])->pluck('id');
        $related = VideoContent::orderBy('created_at', 'desc')->whereIn('job_id', $completed_jobs)->where("id", "!=", $id)->limit(6)->get();


        if ($featured_video) {
            $featured_job = Job::where('video_id', $featured_video->id)->first();
            $comments = VideoContentComment::where('video_content_id', $featured_video->id)->orderBy('id', 'desc')->limit(12)->get();
        } else {
            $featured_job = '';
            $comments = '';
        }
        if ($featured_job) {
            $featured_product = Product::where('id', $featured_job->product_id)->first() ?? '';
        } else {
            $featured_product = '';
        }
        if ($featured_product) {
            $image = json_decode($featured_product->image);
            $related_products = Product::where('category_id', $featured_product->category_id)->inRandomOrder()->limit(5)->get();
        } else {
            $image = '';
            $related_products = '';
        }

        $url = "staging.vicomma.com/show/" . $id;

        $this->updateVideoViewCount($id);
        //get video comments

        $geo = $this->currencyConverter($request);

        return view('pages.guser.cvideo', compact("related",'creatives', 'image', 'awarded', 'featured_video', 'featured_product', 'related_products', 'comments', 'url', 'geo'));
    }

    //function to get user details

    public function getUserDetails($uid)
    {
        $user = User::find($uid);
        return $user;
    }

    public function updateVideoViewCount($vid)
    {

        //if user is logged in
        if (Auth::check()) {
            //get user id
            $uid = Auth::user()->id;
            $video_view_exist = VideoContentView::where(['user_id' => $uid, 'video_content_id' => $vid])->first();
            if ($video_view_exist) {
                //update view count for user
                //get last view count
                $record = VideoContentView::where(['user_id' => $uid, 'video_content_id' => $vid])->first();
                $lastView = $record->views;
                $newView = ($lastView + 1);
                DB::update('UPDATE video_content_views SET views = ? WHERE user_id = ?', [$newView, $uid]);

                //update video content views_count for general public
                $record = VideoContent::where('id', $vid)->first();
                $lastView = $record->view_count;
                $newView = ($lastView + 1);
                DB::update("UPDATE video_contents SET view_count = '$newView' WHERE id = '$vid'");
            } else {
                //submit details to video_content_views table
                DB::table('video_content_views')->insert([
                    'user_id' => $uid,
                    'views' => 1,
                    'video_content_id' => $vid,
                    'created_at' => date('Y-m-d H:i:s'),
                    'last_view' => date('Y-m-d H:i:s'),
                    'updated_at' =>  date('Y-m-d H:i:s')
                ]);


                //update video content views_count for general public
                $record = VideoContent::where('id', $vid)->first();
                $lastView = $record->view_count;
                $newView = ($lastView + 1);
                DB::update("UPDATE video_contents SET view_count = '$newView' WHERE id = '$vid'");
            }
        } else {
            //update video content views_count for general public only
            $record = VideoContent::where('id', $vid)->first();
            $lastView = $record->view_count;
            $newView = ($lastView + 1);
            DB::update("UPDATE video_contents SET view_count = '$newView' WHERE id = '$vid'");
        }

        //strftime("%b %d, %Y", strtotime($date));
    }

    public function updateVideoCommentCount($vid)
    {
        //update video content views_count for general public
        $record = VideoContent::where('id', $vid)->first();
        $lastView = $record->comment_count;
        $newView = ($lastView + 1);
        DB::update('UPDATE video_contents SET comment_count = ? WHERE id = ?', [$newView, $vid]);
    }

    public function submitComment(Request $request)
    {
        $vid = $request->input('vid_id');
        $comment = $request->input('comment');
        $date = date("Y-m-d H:i:s");

        if (Auth::check()) {
            $uid = Auth::user()->id;
            DB::insert('INSERT INTO video_content_comments (user_id,video_content_id, comment, created_at)
            VALUES (?, ?, ?, ?)', [$uid, $vid, $comment, $date]);

            //update comments count

            $this->updateVideoCommentCount($vid);

            $response['status'] = "Success";
            return json_encode($response);
        } else {
            $response['status'] = "not_logged";
            return json_encode($response);
        }
    }

    public function submitCommentResponse(Request $request)
    {
        $cid = $request->input('cid');
        $comment = $request->input('comment');
        $date = date("Y-m-d H:i:s");

        if (Auth::check()) {
            $uid = Auth::user()->id;
            DB::insert('INSERT INTO video_content_comments (user_id, parent_id, comment, created_at)
            VALUES (?, ?, ?, ?)', [$uid, $cid, $comment, $date]);

            $response['status'] = "Success";
            return json_encode($response);
        } else {
            $response['status'] = "not_logged";
            return json_encode($response);
        }
    }

    public function fetchDetails($cid)
    {
        $data['user'] = User::find($cid);
        //get jobs count
        $data['all_jobs'] = count(Job::where('influencer_id', '=', $cid)->where('isAwarded', '1')->get());

        // var_dump($data['jobs']);
        //get jobs delivered
        $data['jobs_delivered'] = count(VideoContent::where('influencer_id', '=', $cid)->where('isApproved', '1')->get());
        $data['url'] = route('user.influencer.profile', $cid);
        //get skills set


        return json_encode($data);
    }

    public static function hasResponse($cid)
    {
        $exist = count(VideoContentComment::where('parent_id', $cid)->get());
        if ($exist > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function reloadComments($vid)
    {
        //get video comments

        $comments = VideoContentComment::where('video_content_id', $vid)->orderBy('id', 'desc')->limit(20)->get();

        $output = "";
        foreach ($comments as $com) {

            $output .= '<div class="mb-4"><div class="row">';
            $output .= '<div class="col-md-1 col-1 p-2">
                            <img src="' . $com->user->image . '" class="img-fluid author-img shadow" style="height: 50px;">
                        </div>';
            $output .= '<div class=col-md-11 col-11 px-2 pb-2">
                    <div class="row">
                        <div class="col-10 pt-2">
                            <h4 style="font-size: 20px;" class="comment-name mb-0">' . $com->user->first_name . ' ' . $com->user->last_name . '</h4>
                            <span class="w-100 comment-details">' . strftime("%b %d, %Y", strtotime($com->created_at)) . ' @ ' . date('h:i a', strtotime($com->created_at)) . '</span>
                        </div>
                        <div class="col-2 pt-4">
                            <button class="btn btn-sm reply-btn float-end" onclick="replyComment(' . $com->id . ')">Reply</button>
                        </div>
                    </div>
                    <div class="w-100 mt-2">
                        <p class=" comment-text"  style="font-size: 18px;">' . $com->comment . '</p>
                    </div>
                </div>
            </div>';

            //checking if comment has response(s)
            if ($this->hasResponse($com->id)) {
                //if response, fetch the responses
                $output .= $this->fetchCommentResponse($com->id);
            } else {
                //response(s) not found. Let's ride
            }
            $output .= '</div>';

            $output .= '<!--reply comment form-->
            <div class="row" id="cmnt-response' . $com->id . '" style="display: none">
                <form method="post" action="#" id="guser-comment-reply-form' . $com->id . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" id="cid' . $com->id . '" value="' . $com->id . '">
                    <div class="form-group ml-5">
                        <textarea class="form-control comment-textarea" id="ucommentresp' . $com->id . '" placeholder="Add public comment"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="float-end">
                            <button class="btn-sm share-it-btn" id="cancelCmtRespBtn{{$com->id}}" onclick="cancelCommentResp(' . $com->id . ')">Cancel</button>
                            <button class="btn-sm make-comment-btn ml-2" id="commentRespBtn{{$com->id}}" onclick="postCommentResp(' . $com->id . ',' . $com->video_content_id . ')">Comment</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--/end of reply comment form-->
            </div>';
        }

        return $output;
    }

    public static function fetchCommentResponse($cid)
    {
        //get video comments

        $commentResponse = VideoContentComment::where('parent_id', $cid)->orderBy('id', 'desc')->get();

        $output = "";
        foreach ($commentResponse as $com) {

            $output .= '<div class="row">';
            $output .= '<div class="col-md-8 p-2 m-auto">
                        <div class="row">
                        <div class="col-md-2 col-2 p-2">
                            <img src="' . $com->user->image . '" class="img-fluid author-img shadow"  style="height: 50px;">
                        </div>
                        <div class="col-md-8 pt-3">
                        <h4 class="comment-name mb-0" style="font-size: 20px;">' . $com->user->first_name . ' ' . $com->user->last_name . '</h4>';
            $output .= '<span class="w-100 comment-details">' . strftime("%b %d, %Y", strtotime($com->created_at)) . ' @ ' . date('h:i a', strtotime($com->created_at)) . '</span>';
            $output .= '<div class="w-100 mt-3">
                        <p class="comment-text" style="font-size: 18px;">' . $com->comment . '</p></div>';
            $output .= '</div></div></div>';
        }

        return $output;
    }

    public function team()
    {
        $team = Team::orderBy('hierachy', 'ASC')->get();
        return view('pages.others.team', compact('team'));
    }
}
