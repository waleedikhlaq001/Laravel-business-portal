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
        <h6>Deleted Jobs</h6>
      
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
                            <th>Status</th>
                            <th>Progress</th>
                            <th></th>
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
                                    <a href="{{route('user.influencer.profile', $job->influencer->id ?? '')}}" class="text-snd">
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
                                    <div class="d-flex mt-1">
                                            <span class="mr-2 mt-1 status" style="background: red !important;"></span>
                                            Deleted
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
                                                        <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Content Type</h6>
                                                        @foreach($content_type as $key=>$type)
                                                            @if($key == 0)
                                                            <span class="text-sm" style="font-family: 'Poppins'; color: gray;">{{$type}}</span>
                                                            @else
                                                            <span class="text-sm" style="font-family: 'Poppins'; color: gray;">, &nbsp;{{$type}}</span>
                                                            @endif
                                                        @endforeach
                                                        
                                                        <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Content Delivery Method</h6>
                                                        <p class="text-sm">{{$job->product_delivery_method ?? ''}}</p>

                                                        <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Experience Level Required</h6>
                                                        <p class="text-sm">{{$job->experience_required ?? ''}}</p>

                                                        <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Job Type</h6>
                                                        <p class="text-sm">{{$job->type ?? ''}}</p>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <h1>You have not deleted any Jobs yet</h1>
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


@endpush
@endsection
