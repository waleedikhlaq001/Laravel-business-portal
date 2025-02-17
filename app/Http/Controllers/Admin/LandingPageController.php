<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\HowVicommaWork;
use App\Models\Admin\LandingPage;
use App\Models\Admin\NotJustAnotherVideoPlatform;
use App\Models\Admin\VicommaBenefit;
use App\Models\Admin\WhoUsesVicomma;
use App\Models\Admin\WhyJoinVicomma;
use App\Models\Admin\WhyVicommaIsForYou;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $main_content = LandingPage::first();
        $why_vicomma = WhyVicommaIsForYou::first();
        $not_just_platform = NotJustAnotherVideoPlatform::first();
        $how_vicomma_works = HowVicommaWork::first();
        // dd($how_vicomma_works);
        $why_join_vicomma = WhyJoinVicomma::first();
        $who_uses_vicomma = WhoUsesVicomma::all();
        $benefits = VicommaBenefit::all();
        return view(
            'admin.site-pages.landing-page',
            compact('main_content', 'why_vicomma', 'not_just_platform', 'how_vicomma_works', 'why_join_vicomma', 'who_uses_vicomma', 'benefits')
        );
    }

    public function mainHeader(Request $request)
    {
        $request->validate([
            'main_header' => 'required|string',
            'main_description' => 'required|string'
        ]);

        $content = LandingPage::find($request->id);
        $content->main_header = $request->main_header;
        $content->main_description = $request->main_description;
        $content->save();
        return redirect()->back()->with('success', 'Content updated');
    }

    public function whyVicomma(Request $request)
    {
        $request->validate([
            'hire_creative' => 'required|string',
            'hire_creative_description' => 'required|string',
            'earm_money' => 'required|string',
            'earm_money_description' => 'required|string',
            'watch_buy' => 'required|string',
            'watch_buy_description' => 'required|string',
        ]);

        $content = WhyVicommaIsForYou::find($request->id);
        $content->hire_creative = $request->hire_creative;
        $content->hire_creative_description = $request->hire_creative_description;
        $content->earm_money = $request->earm_money;
        $content->earm_money_description = $request->earm_money_description;
        $content->watch_buy = $request->watch_buy;
        $content->watch_buy_description = $request->watch_buy_description;
        $content->save();
        return redirect()->back()->with('success', 'Content updated');
    }

    public function NotJustAnotherPlatform(Request $request)
    {
        $request->validate([
            'not_just_platform' => 'required|string',
            'not_just_another_platform_description' => 'required|string',
            'vcomm_icon' => 'required|string',
            'vcomm_icon_description' => 'required|string',
        ]);

        $content = NotJustAnotherVideoPlatform::find($request->id);
        $content->not_just_another_platform = $request->not_just_platform;
        $content->not_just_another_platform_description = $request->not_just_another_platform_description;
        $content->vcomm_icon = $request->vcomm_icon;
        $content->vcomm_icon_description = $request->vcomm_icon_description;
        $content->save();
        return redirect()->back()->with('success', 'Content updated');
    }

    public function WhyJoinVicomma(Request $request)
    {
        $request->validate([
            'why_join_vicomma_description' => 'required|string'
        ]);

        $content = WhyJoinVicomma::find($request->id);
        $content->why_join_vicomma_description = $request->why_join_vicomma_description;
        $content->save();
        return redirect()->back()->with('success', 'Content updated');
    }

    public function howVicommaWorks(Request $request)
    {
        $request->validate([
            'step1_header' => 'required|string',
            'step1_description' => 'required|string',
            'step2_header' => 'required|string',
            'step2_description' => 'required|string',
            'step3_header' => 'required|string',
            'step3_description' => 'required|string',
            'step4_header' => 'required|string',
            'step4_description' => 'required|string',
        ]);

        $content = HowVicommaWork::find($request->id);
        $content->step1_header = $request->step1_header;
        $content->step1_description = $request->step1_description;
        $content->step2_header = $request->step2_header;
        $content->step2_description = $request->step2_description;
        $content->step3_header = $request->step3_header;
        $content->step3_description = $request->step3_description;
        $content->step4_header = $request->step4_header;
        $content->step4_description = $request->step4_description;
        $content->save();
        return redirect()->back()->with('success', 'Content updated');
    }
}
