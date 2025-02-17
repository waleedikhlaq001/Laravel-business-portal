@extends('pages.app')
@push('scripts')
<script>
    document.title = "My Jobs";
</script>
@endpush

<style>
    .table thead th {
        font-weight: 500;
        font-size: 15px;
        border-bottom: 1px solid #dee2e6 !important;
    }

    .table td,
    .table th {
        border-top: 0 !important;
    }

    .table td,
    .table th {
        font-size: 15px;
    }

    .chat-init {
        display: inline-flex;
        background: #f3f6f9;
    }

    .status {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .details .fas {
        transition: .3s all;
    }

    .fAsRT {
        transform: rotate(180deg);
    }

</style>

@section('content')
@include('includes.messages')
<div class="container-fluid">
    <div class="contactFreelancersContainer"
        style="height: 200px; background: url(/img/bdbg.png) center center / cover no-repeat; padding-left: 1rem; padding-right: 1rem;">
        <h6>My Jobs</h6>
        <a href="{{route('user.vendor.jobs.index')}}" class="btn btn-primary btn-sm d-blck d-md-inlie-block mt-2">
            Post a Job
        </a>
    </div>
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="jbContainer bg-white p-4 w-100 shadow" style="margin-top: -2rem;">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-left">
                        <tr>
                            <th>Project</th>
                            <th>Creative Awarded</th>
                            <th>Posted</th>
                            <th>Budget</th>
                            <th>Chat initiated</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($my_jobs)>0)
                        @foreach ($my_jobs as $job)
                        <tr>
                            <td class="position-relative">
                                <a href="{{route('user.jobs.show', $job->unique_id)}}" class="text-snd" target="_blank">
                                    {{$job->name}}
                                </a>
                                @if ($job->milestone)
                                @foreach($job->milestone as $milestone)
                                @if($milestone->completed == 1 && $milestone->paid == 0)
                                <span class="noti-badge" style="top: 15px; right:30px;"></span>
                                @endif
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($job->isAwarded != null)
                                <a href="{{route('user.influencer.profile', $job->influencer->id ?? '')}}"
                                    class="text-snd">
                                    {{$job->influencer->last_name ?? ''}} {{$job->influencer->first_name ?? ''}}
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($job->created_at)->diffForHumans()}}</td>
                            <td>{{$job->currency->symbol ?? ''}}{{number_format($job->budget->min ?? '')}} -
                                {{number_format($job->budget->max)}}</td>
                            <td>
                                <div class="p-2 rounded chat-init align-items-center">
                                    <span class="bg-gray mr-2 status"></span> Chat
                                </div>
                            </td>
                            <td>
                                <div class="d-flex mt-1">
                                    {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                                    @if ($job->isApproved == 3)
                                    <span class="mr-2 mt-1 status" style="background: red !important;"></span>
                                    Verify Email
                                    @elseif ($job->isApproved == 2)
                                    <span class="mr-2 mt-1 status" style="background: red !important;"></span>
                                    Flagged
                                    @elseif ($job->isApproved == 1 && $job->isAwarded)
                                    <span class="mr-2 mt-1 status" style="background: green !important;"></span>
                                    Awarded
                                    @elseif ($job->isApproved == 1 && $job->isAwarded == 0)
                                    <span class="mr-2 mt-1 status" style="background: #ffbf00 !important;"></span>
                                    Open
                                    @elseif ($job->isApproved == 0)
                                    <span class="mr-2 mt-1 status" style="background: #6f3c96 !important;"></span>
                                    Pending
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if ($job->isApproved == 1)
                                @if ($job->isAwarded && $job->isCompleted)
                                <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Completed">
                                    <i class="fa fa-check" aria-hidden="true" style="font-size: 15px;"></i>
                                </button>
                                @elseif ($job->isAwarded && !$job->isCompleted)
                                <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Ongoing">
                                    <i class="fas fa-spinner" aria-hidden="true"></i>
                                </button>
                                @else
                                <p> - </p>
                                @endif
                                @else
                                <p>-</p>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm details" data-bs-toggle="collapse" href="#col_{{$job->unique_id}}"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-chevron-down text-lg dwn"></i>
                                </a>
                            </td>
                            <td>
                                <button @if($job->isAwarded == 1) disabled @endif @if($job->isAwarded !== 1)
                                    onclick="delete_job({{$job->id}})" @endif class="btn btn-danger btn-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Delete Job">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="border-0">
                                <div class="collapse" id="col_{{$job->unique_id}}">
                                    <div class="card card-body border-0 shadow-none">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-5 col-xl-5">
                                                <div class="mt-2 jbDetailsSection">
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Project Name</h6>
                                                    <p class="text-sm">{{$job->name ?? ''}}</p>
                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Project
                                                        Description</h6>
                                                    <p class="text-sm">{{$job->description ?? ''}}</p>
                                                    @if($job->isAwarded)
                                                    <div class="mt-4">
                                                        <h6 class="text-uppercase text-sm mb-0">Creative Details</h6>
                                                        {{--<p class="mb-1"> <i class="fas fa-store text-muted mr-2"></i>
                                                                {{$job->vendor->vendor_station ?? ''}}
                                                        </p>--}}
                                                        <?php 
                                                                $creative_completed = \App\Models\Job::where(['influencer_id' => $job->influencer_id, 'isCompleted'=> '1'])->get();
                                                                $creative_jobs = \App\Models\Job::where(['influencer_id' => $job->influencer_id])->get();
                                                            ?>
                                                        <p class="mb-1">
                                                            <i class="fas fa-check text-muted mr-2"></i> Completed Jobs
                                                            -
                                                            @if ($creative_completed)
                                                            {{count($creative_completed)}}
                                                            @endif

                                                        </p>
                                                        <p class="mb-1">
                                                            <i class="fas fa-equals text-muted mr-2"></i> Total Jobs
                                                            -
                                                            @if ($creative_jobs)
                                                            {{count($creative_jobs)}}
                                                            @endif

                                                        </p>
                                                    </div>
                                                    @endif
                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Project
                                                        Duration</h6>
                                                    <p class="text-sm">{{$job->duration ?? ''}}</p>

                                                    <?php 
                                                            $content_type = json_decode($job->content_type);
                                                        ?>
                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Content
                                                        Type</h6>
                                                    @foreach($content_type as $key=>$type)
                                                    @if($key == 0)
                                                    <span class="text-sm"
                                                        style="font-family: 'Poppins'; color: gray;">{{$type}}</span>
                                                    @else
                                                    <span class="text-sm" style="font-family: 'Poppins'; color: gray;">,
                                                        &nbsp;{{$type}}</span>
                                                    @endif
                                                    @endforeach

                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Content
                                                        Delivery Method</h6>
                                                    <p class="text-sm">{{$job->product_delivery_method ?? ''}}</p>

                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Experience
                                                        Level Required</h6>
                                                    <p class="text-sm">{{$job->experience_level ?? ''}}</p>

                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Job Type
                                                    </h6>
                                                    <p class="text-sm">{{$job->type ?? ''}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-7 col-xl-7">
                                                <div class="jbDetailsSection pl-4 pr-4">
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Awarded To</h6>
                                                    <p class="text-sm">
                                                        @if ($job->isAwarded)
                                                        {{$job->influencer->last_name ?? ''}}
                                                        {{$job->influencer->first_name ?? ''}}
                                                        @else
                                                        -
                                                        @endif
                                                    </p>
                                                    @php
                                                    $bid = \App\Models\Bid::where(['job_id'=>$job->id, 'influencer_id'
                                                    => $job->influencer_id])->first();
                                                    @endphp
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Proposal</h6>
                                                    <p>
                                                        @if ($bid)
                                                        {{$bid->proposal ?? '-'}}
                                                        {{-- {{Str::words($bid->proposal, 30, '...')  ?? ''}} --}}
                                                        @endif
                                                    </p>

                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Job Content</h6>
                                                    @if($job->video_id != '')
                                                    <div class="product--video__container">
                                                        <a href="{{route('user.guser.show', $job->video->id)}}"
                                                            style="width:300px; display: block; position: relative;">
                                                            <img height="100" src="{{$job->video->video_thumb}}" alt=""
                                                                class="img-fluid shadow" style="border-radius: 10px;">
                                                            <div class="overlay" style="border-radius: 10px;">
                                                                <img src="{{ asset('images/video_icon.svg') }}"
                                                                    class="icon" height="15"
                                                                    style="top: 44%; left:44%;">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @else
                                                    <p class="text-sm"> - </p>
                                                    @endif
                                                    @if ($job->milestone)
                                                    @foreach($job->milestone as $milestone)
                                                    @if($milestone->completed == 1 && $milestone->paid == 0)
                                                    <div class="position-relative" style="width: 50%">
                                                        <a class="btn btn-primary btn-sm ml-auto mt-3"
                                                            href="{{route('wallet.pay', $milestone->uid)}}"
                                                            role="button">Pay Milestone
                                                            {{$milestone->wallet->currency->symbol}}{{$milestone->amt_due}}</a>
                                                        @if($milestone->wallet->balance < $milestone->amt_due)
                                                            <a class="btn btn-warning btn-sm ml-auto mt-3"
                                                                href="/jobs/details/{{$job->unique_id}}#pills-vwallet-tab"
                                                                role="button">Credit Wallet</a>
                                                            @endif
                                                            <span class="noti-badge"
                                                                style="top: 25px; right:0px;"></span>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <h1>You have not posted any Jobs yet</h1>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>
</div>
@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
// jQuery(document).ready(function() {
//     jQuery('.details').on('click', '.fas', function() {
//     jQuery('.dwn').toggleClass('fAsRT')
//         console.log('icon');
//     })
// })

const delete_job = (id) => {
    Swal.fire({
  title: 'Looks, like you want to delete your Job; are you sure? ',
  text: 'Well, if you really must, just click delete.',
  showDenyButton: true,
  icon: "info",
  confirmButtonText: 'Delete',
  denyButtonText: `Cancel`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $.post('/jobs/delete-job',{
          id,
          "_token":"{{csrf_token()}}"
        }).done((res)=>{
            Swal.fire("",res.message,"success")
            setTimeout(()=>{
              location.reload();
            },1000)
        }).fail((err)=>{
        //   $("button").attr("disabled",false)
            Swal.fire("",err.responseJSON.message,"error")
        })
  } else if (result.isDenied) {
    // Swal.fire('Changes are not saved', '', 'info')
  }
})
}
</script>
@endpush
@endsection