<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\VideoContent;
use App\Models\VideoContentComment;
use Illuminate\Database\Eloquent\Builder;

class VideoContentController extends Controller
{
    //
    public function search(Request $request)
    {
        $name = $request->query('name');
        $query = VideoContent::query();

        if($request->has("name")) {
            $query = $query->where('name', 'like', "%{$name}%");
        }

        $videos = $query->withCount(['likes', 'comments', 'views'])->whereHas('job', function(Builder $query) {
            $query->where('isApproved', Job::APPROVED);
        })->paginate();

        return response()->json(['success' => true , 'message' => 'successful.', 'data' => $videos]);
    }

    public function trending()
    {
        //\DB::connection()->enableQueryLog();
        $trendingVideos = VideoContent::join('video_content_views', 'video_content_views.video_content_id', '=', 'video_contents.id')
        ->orderBy('video_content_views.last_view', 'desc')
        ->orderBy('video_content_views.views', 'desc')
        ->select('video_contents.*')->paginate();
        //dd(\DB::getQueryLog());
        $trendingVideos->loadCount(['likes', 'comments', 'views']);
        return response()->json(['success' => true , 'message' => 'successful.', 'data' => $trendingVideos]);
    }

    public function latest()
    {
        $videos = VideoContent::latest()->withCount(['likes', 'comments', 'views'])->whereHas('job', function(Builder $query) {
            $query->where('isApproved', Job::APPROVED);
        })->paginate();
        return response()->json(['success' => true , 'message' => 'successful.', 'data' => $videos]);
    }

    public function related($videoId) {
        $video = VideoContent::find($videoId);
        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }
        $categoryId = $video->job->product->category->id;

        $relatedvideos = VideoContent::latest()
        ->where('id', '!=', $video->id)
        ->withCount(['likes', 'comments', 'views'])
        ->whereHas('job.product', function(Builder $query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
        ->whereHas('job', function(Builder $query) {
            $query->where('isApproved', Job::APPROVED);
        })->paginate();

        return response()->json(['success' => true , 'message' => 'Video liked successfully.', 'data' => $relatedvideos]);
    }

    public function like($videoId) {
        $video = VideoContent::find($videoId);
        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }
        $like = $video->likes()->firstOrCreate(['user_id' => auth()->user()->id, 'video_content_id' => $video->id]);
        return response()->json(['success' => true , 'message' => 'Video liked successfully.', 'data' => $like]);
    }

    public function show($videoId)
    {
        $video = VideoContent::where('id', $videoId)
        ->withCount(['likes', 'comments', 'views'])
        ->with(['job.vendor.user', 'job.product', 'job.influencer', 'job.product.category'])
        ->whereHas('job', function(Builder $query) {
            $query->where('isApproved', Job::APPROVED);
        })->first();

        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }
        return response()->json(['success' => true, 'message' => 'successful', 'data' => $video]);
    }

    public function comments($videoId)
    {
        $video = VideoContent::find($videoId);
        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }
        $comments = $video->comments()->latest()->with('user')->withCount('replies')->paginate();
        return response()->json(['success' => true, 'message' => 'successful', 'data' => $comments]);
    }

    public function postComment(Request $request, $videoId)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:191']
        ]);

        $video = VideoContent::find($videoId);
        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }

        $comment = $video->comments()->create([
            'user_id' => auth()->user()->id,
            'video_content_id' => $video->id,
            'comment' => $request->get('comment')
        ]);
        $comment->load(['user']);
        $comment->loadCount('replies');
        return response()->json(['success' => true, 'message' => 'Successful created', 'data' => $comment]);
    }

    public function postCommentReply(Request $request, $videoId, $commentId)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:191']
        ]);

        $comment = VideoContentComment::find($commentId);
        if(empty($comment)) {
            return response()->json(['success' => false, 'message' => 'No comment with that id found', 'data' => []], 404);
        }

        $reply = $comment->replies()->create([
            'user_id' => auth()->user()->id,
            'video_content_id' => $comment->video_content_id,
            'parent_id' => $comment->id,
            'comment' => $request->get('comment')
        ]);
        $reply->load(['user']);
        $reply->loadCount('replies');
        return response()->json(['success' => true, 'message' => 'Successful created', 'data' => $reply]);
    }

    public function commentsReply(Request $request, $videoId, $commentId)
    {
        $comment = VideoContentComment::find($commentId);
        if(empty($comment)) {
            return response()->json(['success' => false, 'message' => 'No comment with that id found', 'data' => []], 404);
        }

        $replies = $comment->replies()->with('user')->withCount('replies')->paginate();
        return response()->json(['success' => true, 'message' => 'Successful', 'data' => $replies]);
    }

    public function increaseViews($videoId)
    {
        $video = VideoContent::find($videoId);
        if(empty($video)) {
            return response()->json(['success' => false, 'message' => 'No video with that id found', 'data' => []], 404);
        }

        $views = $video->views()->firstOrNew([
            'video_content_id' => $video->id, 'user_id' => auth()->user()->id
        ]);
        $views->views++;
        $views->last_view = now();
        $views->save();
        return response()->json(['success' => true, 'message' => 'Successful increased', 'data' => $views]);
    }
}
