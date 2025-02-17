<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Events\ApprovedJob;
use App\Mail\JobApprovalStatus;
class AutoApproveJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Approve jobs that do not contain any abbusive word!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
          // get pending jobs to process
       $jobs =  Job::inRandomOrder()->with('vendor', 'budget')->where('isApproved', Job::PENDING)->limit(20)->get();
       $valid_job = true;
       //messges and settings cannot be empty
       if (!empty($jobs)) {
            foreach ($jobs as $job) {
                //get job title and description
                $text_to_validate = $job->description.' '.$job->name;
                $words_to_valdate = explode(" ",$text_to_validate);
                for ($i=0; $i < count($words_to_valdate); $i++) {
                    if (in_array(strtolower($words_to_valdate[$i]), Job::ABUSIVE_WORDS)) {
                        //flagg
                        $valid_job = false;
                    break;
                    }
                }
                if ($valid_job && $job->vendor->user->email_verified_at == ''){
                    $job->update(['isApproved'=> Job::UNVERIFIEDEMAIL]);
                    //send email notification
                    $details = [
                        'user' => $job->vendor->user->first_name . ' ' . $job->vendor->user->last_name,
                        'message' => 'Your Job has been approved! Please Verify your email from your dashboard so that your job can be listed.'
                    ];
                    $this->sendEmailToUser($job->vendor->user->id, $details);
                }
                else if ($valid_job && $job->vendor->user->email_verified_at) {
                    $job->update(['isApproved'=> Job::APPROVED]);
                    //send email notification
                    $details = [
                        'user' => $job->vendor->user->first_name . ' ' . $job->vendor->user->last_name,
                        'message' => 'Your Job has been approved!'
                    ];
                    $this->sendEmailToUser($job->vendor->user->id, $details);

                }else {
                    $job->update(['isApproved'=> Job::FLAGGED]);
                    //send email notification
                    $details = [
                        'user' => $job->vendor->user->first_name . ' ' . $job->vendor->user->last_name,
                        'message' => 'Your Job has been flagged! Please kindly reach out to the admin for more information'
                    ];

                    $this->sendEmailToUser($job->vendor->user->id, $details);
                }
            }
       }
    }


    public function sendEmailToUser(int $userId, array $details = [])
    {
        $user = \App\Models\User::find($userId);
        if(isset($details['message'])) {
        \Mail::to($user->email)->send(new JobApprovalStatus($details));
        }
    }

}
