<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\disputeMessage;
use App\Models\FlutterwaveSubaccount;
use App\Models\GeneralWallet;
use App\Models\GeneralWalletTransaction;
use App\Models\Milestone;
use App\Models\Mitigation;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\NewDispute;
use App\Notifications\NewDisputeMessage;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Dispute;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\NewPay;
use Illuminate\Support\Facades\DB;
use App\Models\PivotDispute;
use App\Events\NewDisputeMsg;


class AmbassadorController extends Controller
{

    public function index()
    {
       
        return view('pages.ambassador.index')->with(["id"=>1]);
    }

}
