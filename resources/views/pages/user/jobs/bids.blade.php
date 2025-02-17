@extends('pages.app')

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

    .chat {
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
        <h6>Bids Insight</h6>
    </div>
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="jbContainer bg-white shadow-sm p-4 w-100" style="margin-top: -2rem;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Time of Bid</th>
                            <th>Won Bid</th>
                            <th>Your Bid</th>
                            <th>Vendor</th>
                            <th>Chat initiated</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    <tbody>
                        @foreach ($myBids as $bid)
                        <tr>
                            <td>
                                <a href="{{route('user.jobs.show', $bid->job->unique_id)}}" class="text-snd" target="_blank">
                                    {{$bid->job->name}}
                                </a>
                            </td>
                            <td>{{\Carbon\Carbon::parse($bid->created_at)->diffForHumans()}}</td>
                            <td>
                                @if ($bid->job->influencer_id == Auth::user()->id)
                                Yes
                                @else
                                No
                                @endif
                            </td>
                            <td>{{$bid->job->currency->symbol}}{{number_format($bid->amount)}}</td>
                            <td>
                                <a href="{{route('mall.vendor', $bid->job->vendor->vendor_station)}}" class="text-snd">
                                    {{$bid->job->vendor->vendor_station}}
                                </a>
                            </td>
                            <td>
                                <div class="p-2 rounded chat align-items-center">
                                    <span class="bg-gray mr-2 status"></span> Chat
                                </div>
                            </td>
                            <td>
                                <div class="d-flex mt-1">
                                    {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                                    @if ($bid->job->isAwarded)
                                    <span class="bg-gray mr-2 mt-1 status" style="background: red!important;"></span>
                                    Awarded
                                    @else
                                    <span class="bg-gray mr-2 mt-1 status" style="background: green!important;"></span>
                                    Open
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-sm details" data-bs-toggle="collapse" href="#col_{{$bid->id}}"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-chevron-down text-lg dwn"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="border-0">
                                <div class="collapse" id="col_{{$bid->id}}">
                                    <div class="card card-body border-0 shadow-none">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-5 col-xl-5">
                                                <div class="mt-2 jbDetailsSection">
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Project Name</h6>
                                                    <p class="text-sm">{{$bid->job->name}}</p>
                                                    <h6 class="mt-3 text-sm fw-semibold text-uppercase mb-1">Project
                                                        Description</h6>
                                                    <p class="text-sm">{{$bid->job->description}}</p>
                                                    <div class="mt-4">
                                                        <h6 class="text-uppercase text-sm mb-0">Vendor Details</h6>
                                                        <p class="mb-1"> <i class="fas fa-store text-muted mr-2"></i>
                                                            {{$bid->job->vendor->vendor_station}}</p>
                                                        <p class="mb-1">
                                                            @php
                                                            $j = \App\Models\Job::where('vendor_id',
                                                            $bid->job->vendor->id)->count();
                                                            @endphp
                                                            <i class="fas fa-check text-muted mr-2"></i> Completed Jobs
                                                            -
                                                            {{$j}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-7 col-xl-7">
                                                <div class="jbDetailsSection pl-4 pr-4">
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Your Bid</h6>
                                                    <p class="text-sm">{{$bid->proposal}}</p>
                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Duration</h6>
                                                    <p class="text-sm">{{$bid->duration}} Days</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

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
    jQuery(document).ready(function() {
        jQuery('.details').on('click', '.fas', function() {
            // jQuery(this).find('i').toggleClass('fAsRT')
            // if(jQuery('.details').not(this).find('i').hasClass('fAsRT')) {
            //     jQuery('.details').not(this).find('i').toggleClass('fAsRT')
            // }
            // jQuery('.dwn').toggleClass('fAsRT')
            console.log(jQuery(this).find('i'));
        })
// $(".btn_body").click(function () {
// $(this).find('i').toggleClass('glyphicon-asterisk glyphicon-star');
// if ($(".btn_body").not(this).find("i").hasClass("glyphicon-star")) {
// $(".btn_body").not(this).find("i").toggleClass('glyphicon-asterisk glyphicon-star');
// }
// });
    })
</script>
@endpush
@endsection
