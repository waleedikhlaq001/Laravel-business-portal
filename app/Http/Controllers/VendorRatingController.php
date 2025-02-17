<?php

namespace App\Http\Controllers;

use App\Models\VendorRating;
use Illuminate\Http\Request;

class VendorRatingController extends Controller
{
    public function store(Request $request)
    {


        $request->validate(
            [
                'communication_rating' => 'required',
                'easy_to_work_with_rating' => 'required',
                'fair_rating' => 'required',
            ],
            [
                'fair_rating.required' => 'Please Rate if the Vendor was fair',
                'easy_to_work_with_rating.required' => 'Please Rate the Vendor was easy to work with',
                'communication_rating.required' => 'Please Rate the Vendor was easy to communicate with',
            ]

        );




        $rating = new VendorRating();
        $rating->communication = $request->communication_rating;
        $rating->easy_to_work_with = $request->easy_to_work_with_rating;
        $rating->fair = $request->fair_rating;
        $rating->job_id = $request->job_id;
        $rating->user_id = $request->user_id;
        $rating->vendor_id = $request->vendor_id;
        $rating->save();

        return redirect()->back()->with('success', 'Thank you for rating this vendor. Your feedback is much appreciated');
    }
}
