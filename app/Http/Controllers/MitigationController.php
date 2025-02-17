<?php

namespace App\Http\Controllers;

use App\Models\Dispute;
use App\Models\Mitigation;
use Illuminate\Http\Request;
use App\Notifications\NewDispute;
use App\Notifications\NewDisputeMessage;

class MitigationController extends Controller
{
    public function index()
    {
        $mitigations = Mitigation::where(['status'=>'open'])->orWhere('status', 'closed')->get();
        return view('admin.mitigation.index');
    }

    public function getAll()
    {
        $mitigations = Mitigation::where(['status'=>'open'])->orWhere('status', 'closed')->get();
        return $mitigations;
    }

    public function viewJob(Request $request)
    {
        $mitigation = Mitigation::find($request->mitigation);

        $unique_id = $mitigation->dispute->job->unique_id;

        return route('user.jobs.show', $unique_id);
        // $mitigations = Mitigation::where(['status'=>'open'])->orWhere('status', 'closed')->get();
        // return $mitigations;
    }

    public function viewDispute(Request $request)
    {
        $mitigation = Mitigation::find($request->dispute);

        $job_id = $mitigation->dispute->job->id;

        return route('user.dispute.arbitration', compact('job_id'));
        // $mitigations = Mitigation::where(['status'=>'open'])->orWhere('status', 'closed')->get();
        // return $mitigations;
    }

    public function close(Request $request)
    {
        $mitigation = Mitigation::find($request->mitigation_id);
        $mitigation->decision = htmlentities($request->decision);
        $mitigation->reason = htmlentities($request->reason);
        $mitigation->to_pay = htmlentities($request->to_pay);
        $mitigation->settlement_amount = htmlentities($request->amount);

        if($request->to_pay == 'vendor'){
            $mitigation->payee_id = htmlentities($mitigation->dispute->job->vendor->user->id);
        }else{
            $mitigation->payee_id = htmlentities($mitigation->dispute->job->influencer->id);
        }

        $mitigation->status = 'closed';

        $dispute = Dispute::find($mitigation->dispute->id);
        $dispute->stage = 'four';

        $dispute->save();
        $mitigation->save();

        $vendor = $mitigation->dispute->job->vendor->user;
        $influencer = $mitigation->dispute->job->influencer;
        $job = $mitigation->dispute->job;

        //send mail here to influencer
        $details = [
            'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
            'user' => $influencer->last_name . ' ' . $influencer->first_name,
            'message' => 'Mitigation decision has been made for dispute ' . $job->name . '; click on the button below to see more.'
        ];
        $influencer->notify(new NewDisputeMessage($details));

        //send mail here to vendor
        $details = [
            'url' => route('user.dispute.arbitration', ['job_id' => $job->id]),
            'user' => $vendor->last_name . ' ' . $vendor->first_name,
            'message' => 'Mitigation decision has been made for dispute ' . $job->name . '; click on the button below to see more.'
        ];
        $vendor->notify(new NewDisputeMessage($details));

        return $mitigation;
        // $mitigations = Mitigation::where(['status'=>'open'])->orWhere('status', 'closed')->get();
        // return $mitigations;
    }
}
