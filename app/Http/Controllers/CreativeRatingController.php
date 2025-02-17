<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreativeRating;

class CreativeRatingController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'skilled_rating' => 'required',
            'otd_rating' => 'required',
            'communication_rating' => 'required',
            'affordable_rating' => 'required'
        ],
        [
            'skilled_rating.required' => 'Please Rate how skilled the Creative is',
            'otd_rating.required' => 'Please Rate if the Creative delivered your content on time',
            'communication_rating.required' => 'Please Rate the communication skills of the Creative',
            'affordable_rating.required' => 'Please Rate how affordable the Creative is'
        ]

        );

        $rating = new CreativeRating;
        $rating->skilled = $request->skilled_rating;
        $rating->otd = $request->otd_rating;
        $rating->communication = $request->communication_rating;
        $rating->affordable = $request->affordable_rating;
        $rating->reuse = $request->reuse;
        $rating->comment = $request->comment;
        $rating->job_id = $request->job_id;
        $rating->user_id = $request->user_id;
        $rating->vendor_id = $request->vendor_id;
        $rating->save();

        return redirect()->back()->with('success', 'Thank you for rating this creative. Your feedback is much appreciated');
    }
}
