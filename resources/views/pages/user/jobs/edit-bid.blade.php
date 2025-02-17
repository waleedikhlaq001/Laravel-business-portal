@extends('pages.app')

<style>
    .error {
        font-weight: 400 !important;
        font-size: 12px;
        color: red;
    }

    .milestone-container {
            display: flex !important;
    }

</style>
@section('content')
@include('includes.messages')

<div class="container-fluid">
    <div class="contactFreelancersContainer" style="height: 200px;">
        <div class="row g-2">
            <div class="col-sm-12 col-md-12 col-lg-9">
                <h6>{{$job->name}} <span class="badge bg-primary text-success bg-white font-weight-normal"
                        style="color:#28a745 !important; font-size: 18px;"> Open</span>
                </h6>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="d-flex justify-content-sm-start justify-content-lg-end">
                    {{-- <button class="btn btn-primary">Open</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2">
        <div class="row g-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="jbContainer">
                    <div class="row g-3 details">
                        <div class="col-sm-12 col-md-12 col-lg-9" style="margin-top: 190px;" >
                            <div class="card jbCardContainer bg-white p-2 shadow">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-snd font-weight-normal text-lg">Project Details</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <h6>{{$job->currency->symbol}}{{number_format($job->budget->min)}} -
                                            {{$job->currency->symbol}}{{number_format($job->budget->max)}}
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="jbDetailsSection">
                                        <p>
                                            {{$job->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if (!$job->isAwarded && Auth::user()->hasRole('influencer'))
                            <div class="card p-2 shadow">
                                <div class="card-header">
                                    <h6 class="text-snd font-weight-normal">Edit Bid</h6>
                                </div>
                                <div class="card-body">
                                    <p>You will be able to edit your bid until the job is awarded to someone</p>
                                    <form action="{{route('user.jobs.bid.update')}}" method="POST" id="bidForm">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{$job->id}}">
                                        <h6 class="font-weight-normal">Bid Details</h6>
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="amount" class="font-weight-normal">Bid
                                                        Amount</label>
                                                    <span
                                                        style="position: absolute; left: 18px; bottom: 28px;">{{$job->currency->symbol}}</span>
                                                    <input type="text" name="amount" id="amount" class="form-control"
                                                        value="{{$bid->amount}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="duration" class="font-weight-normal">This job
                                                        will be
                                                        completed
                                                        in days</label>
                                                    <input type="number" name="duration" id="duration"
                                                        class="form-control" min="1" value="{{$bid->duration}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="proposal" class="font-weight-normal">Describe your
                                                proposal</label>
                                            <textarea name="proposal" id="" cols="30" rows="5" class="form-control"
                                                placeholder="What makes you the best candidate for this job">{{$bid->proposal}} </textarea>
                                        </div>
                                        <div class="form-group">
                                            <h6 class="font-weight-normal">Milestone Payment Details</h6>
                                            <label for="milestone-1" class="font-weight-normal">Funds will be credited to your account added before and after job completion</label>
                                            <div id="milestone-inputs">
                                                
                                                @for ($i = 0; $i < count($milestones); $i++)
                                                    <div class="milestone-container first-milestone mb-2">
                                                        <input type="text" name="milestone_{{$i + 1}}" id="milestone-{{$i + 1}}-desc" value="{{$milestones[$i][0]}}" placeholder="Fx: Initial Cut payment" disabled="disabled"
                                                        class="float-left form-control @error('milestone-1') is-invalid @enderror">
                                                        <span class="input-group-text">$</span>
                                                            <input type="number" name="milestone-{{$i + 1}}-amt" id="milestone-{{$i + 1}}-amt" value="{{$milestones[$i][1]}}"
                                                            class="float-right form-control @error('milestone-{{$i + 1}}-amt') is-invalid @enderror">
                                                    </div>
                                                @endfor
                                            </div>

                                            <input id="milestone-data" name="milestone_count" type="hidden" value='{{ count($milestones)}}' />
                                        </div>
                                        <input type="hidden" name="bid" value="{{$bid->id}}">
                                        <button type="submit" class="btn btn-success">Update bid</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3" style="margin-top: 179px;">
                            <div class="card rounded-0 border-0 jbCardContainer p-2 shadow">
                                <div class="card-header pt-0 pb-3">
                                    <h6 class="text-snd font-weight-normal text-md mb-1">Vendor Details</h6>
                                </div>
                                <div class="card-body">
                                    {{-- <h6 class="text-md font-weight-normal mb-4">Vendor Details</h6> --}}
                                    <ul class="nav mb-4">
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div>
                                                <i class="fas fa-map-marker-alt text-muted mr-2"></i>
                                                @if ($job->vendor->location == '')
                                                Not verified yet
                                                @else
                                                {{$job->vendor->location}}
                                                @endif
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div>
                                                <i class="fas fa-tv text-muted mr-2"></i> 0 Projects
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div>
                                                <i class="fas fa-clock text-muted mr-2"></i> Member since
                                                {{\Carbon\Carbon::parse($job->vendor->user->created_at)->diffForHumans()}}
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="text-md font-weight-normal mb-4">Vendor Verifications</h6>
                                    <ul class="nav">
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div><i aria-hidden="true" class="fa fa-envelope text-muted mr-2"></i>
                                                Email
                                            </div>
                                            <div>
                                                @if ($job->vendor->user->email_verified_at == NULL)
                                                <span>
                                                    Not Verified
                                                </span>
                                                @else
                                                <span class="text-success">
                                                    <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                    Verified
                                                </span>
                                                @endif
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div><i aria-hidden="true" class="fa fa-phone-alt text-muted mr-2"></i>
                                                Phone Number
                                            </div>
                                            <div>
                                                @if ($job->vendor->user->phone_number == NULL)
                                                <span>
                                                    Not Verified
                                                </span>
                                                @else
                                                <span class="text-success">
                                                    <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                    Verified
                                                </span>
                                                @endif
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3 text-sm">
                                            <div><i aria-hidden="true" class="fa fa-credit-card text-muted mr-2"></i>
                                                Payment Method
                                            </div>
                                            <div>
                                                <span class="text-success"><i aria-hidden="true"
                                                        class="fa fa-check-circle"></i>
                                                    Verified
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

    var milestone_count = parseInt("{{count($milestones)}}");
    const milestone_limit = 6;


    $('#milestone-1-amt').attr("value", $('#amount').val() * (5/100));
    $('#milestone-2-amt').attr("value", $('#amount').val() * (95/100) );
    $('#milestone-1-amt').attr("disabled", true);
    $('#milestone-2-amt').attr("disabled", true);

    $('#amount').on('change', () => {
        
        $('#milestone-1-amt').attr("value", $('#amount').val() * (5/100) );//should be 5%  of the total amount
        $('#milestone-2-amt').attr("value", $('#amount').val() * (95/100) );//should be 5%  of the total amount

    });

    $('#milestone-1-amt').on('change', () => {
        $("#milestone-1-amt").attr("value", $('#amount').val() * (5/100));
        $('#milestone-1-amt').attr("disabled", true);
    })

    $('#milestone-2-amt').on('change', () => {
        $("#milestone-2-amt").attr("value", $('#amount').val() * (95/100));
        $('#milestone-2-amt').attr("disabled", true);
    })

    jQuery('document').ready(function() {
        jQuery('#bidForm').validate({
            rules: {
                amount: 'required',
                duration: 'required',
                proposal: 'required'
            },
            messages: {
                amount: {
                    required: 'Bid amount is required!'
                },
                duration: {
                    required: 'Bid duration required!'
                },
                proposal: {
                    required: 'Bid description is required!'
                },
            }
        })
    });
</script>
@endpush
@endsection