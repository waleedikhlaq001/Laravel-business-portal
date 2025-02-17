@extends('pages.app')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="no-video" width="166" height="152" viewBox="0 0 166 152" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M113.72 120.921C116.679 117.767 118.574 113.765 119.136 109.477L151.402 123.815C152.982 124.519 154.712 124.817 156.436 124.682C158.159 124.547 159.822 123.983 161.273 123.042C162.723 122.1 163.915 120.812 164.741 119.293C165.566 117.773 165.999 116.072 166 114.343V36.9246C165.998 35.1969 165.566 33.497 164.74 31.979C163.915 30.4611 162.724 29.1732 161.275 28.2323C159.826 27.2914 158.165 26.7272 156.443 26.591C154.721 26.4548 152.992 26.7508 151.413 27.4522L119.136 41.7905C118.477 36.801 116.027 32.2212 112.242 28.904C108.457 25.5867 103.595 23.7582 98.5625 23.7587H44.322L51.7298 34.1337H98.5625C101.314 34.1337 103.953 35.2268 105.899 37.1725C107.844 39.1182 108.938 41.7571 108.938 44.5087V106.759C108.939 108.653 108.423 110.512 107.443 112.133L113.72 120.921ZM14.8155 36.0012C13.4444 36.9563 12.3245 38.2288 11.5513 39.7101C10.7781 41.1914 10.3746 42.8378 10.375 44.5087V106.759C10.375 109.51 11.4681 112.149 13.4138 114.095C15.3595 116.041 17.9984 117.134 20.75 117.134H72.7702L80.178 127.509H20.75C15.2468 127.509 9.96891 125.323 6.07753 121.431C2.18615 117.54 0 112.262 0 106.759V44.5087C0 37.5056 3.46525 31.3117 8.78763 27.556L14.8051 36.0012H14.8155ZM155.625 114.332L119.312 98.1994V53.0681L155.625 36.9246V114.343V114.332ZM109.902 151.267L6.15237 6.0175L14.5976 0L118.348 145.25L109.902 151.267Z"
            fill="#6F3C96" />
    </symbol>
</svg>
@push('css')
    <style>

        .form-group label{
            font-size: 15px !important;
            color: #6f3c96;
        }

        #video-preview{
            width: 100%;
            height: 175px;
            background-color: black;
        }

        .text-tiny {
            font-size: 12px !important;
        }

        .error {
            font-weight: 400 !important;
            font-size: 12px;
            color: red;
        }

        .nav-pills .nav-link {
            color: #fff !important;
        }

        .bdImage {
            width: 70px;
            height: 70px;
            border-radius: 100%
        }

        .bdImage img {
            border-radius: 100%;
        }

        .proposal{
            font-size: 14px;
            line-height: 1.5;
            color: #78747b;
        }

        .proposal .more-text {
            display: none;
        }

        .table thead tr th {
            font-weight: 500;
            font-size: .9rem;
        }

        .table tbody tr td {
            font-weight: 400;
            font-size: .9rem;
        }

        .table td,
        .table th {
            padding: 1rem !important;
        }

        .table tbody tr td {
            align-items: center;
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgb(0 0 0 / 0%) !important;
        }

        .progress {
            position: relative;
            width: 100%;
        }

        .bar {
            background-color: #00ff00;
            width: 0%;
            height: 20px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            left: 50%;
            color: #040608;
        }

        .milestone-container {
            display: flex !important;
        }
        .tippy-box {
  background-color: #198754;
  color: #fff;
}
    </style>
@endpush

<!-- <script>
    var authEndpoint = '{{ route('pusher.auth') }}';

    //local
    var actor = "{{ Auth::user()->id }}";
    var tkon = "{{ csrf_token() }}";
    var mx_id = "{{ $job->id }}";
</script>
<script src="{{ asset('client/chat/index.js') }}" defer></script> -->

@section('content')
    @include('includes.messages')
    @include('includes.uploadVideo')
    <div class="container-fluid">
        <div class="contactFreelancersContainer" style="height: auto">
            <div class="row g-2">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <h6><span id="main-job-name">{{ $job->name }} <span class="tip" style="margin-bottom: -5px;" data-content="{{$job->description}}"><ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large"></ion-icon></span></span>
                        @if ($job->isAwarded)
                            <span class="badge bg-primary text-danger bg-white font-weight-bold text-uppercase"
                                style="color:#d81b60 !important; font-size: 12px;"> Awarded</span>
                        @else
                            <span class="badge bg-primary text-success bg-white font-weight-bold text-uppercase"
                                style="color:#28a745 !important; font-size: 12px;"> Open</span>
                        @endif
                    </h6>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="d-flex justify-content-sm-start justify-content-lg-end">
                        {{-- <button class="btn btn-primary">Open</button> --}}
                    </div>
                </div>
            </div>
            <div class="bidNav mt-4">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        {{-- <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-details" type="button" role="tab"
                                            aria-controls="pills-details" aria-selected="true">Project Details</button> --}}
                        <a class="nav-link navCUST active" href="#" id="pills-details-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                            aria-selected="true">Project Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link navCUST" href="#" id="pills-bids-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-bids" type="button" role="tab" aria-controls="pills-bids"
                            aria-selected="false">Bids</a>
                    </li>
                    @if ($job->vendor->user->id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
                        <li class="nav-item tip" role="presentation" data-show="no" data-content=" This is where any useful files for your project are posted.">
                            <a class="nav-link navCUST" href="#" id="pills-files-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-files" type="button" role="tab" aria-controls="pills-files"
                                aria-selected="false">Files</a>
                        </li>
                    @endif
                    @if ($job->vendor->user->id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
                        <li class="nav-item tip" role="presentation" data-show="no" data-content="This is where the content from your Creative will be posted.">
                            <a class="nav-link navCUST" href="#" id="pills-content-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-content" type="button" role="tab" aria-controls="pills-content"
                                aria-selected="false">Contents</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="jbContainer mt-4">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
                                aria-labelledby="pills-details-tab">
                                <div class="row g-3 details">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="card jbCardContainer bg-white p-2 shadow">
                                            <div class="card-header d-flex justify-content-between">
                                                <div>
                                                    <h6 class="text-snd font-weight-normal text-lg">Project Details</h6>
                                                </div>
                                                <div class="ml-auto">
                                                    <h6>{{ $job->currency->symbol }}{{ number_format($job->budget->min) }} -
                                                        {{ $job->currency->symbol }}{{ number_format($job->budget->max) }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="jbDetailsSection">
                                                    <p>
                                                        {{ $job->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card jbCardContainer bg-white p-2 shadow">
                                            <div class="card-header d-flex justify-content-between">
                                                <div>
                                                    <h6 class="text-snd font-weight-normal text-lg">Product Delivery Method</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="jbDetailsSection">
                                                    <p>
                                                        {{$job->product_delivery_method}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!$job->isAwarded && Auth::user()->hasRole('Creative') && !$hasBid && $job->vendor->user_id !== Auth::user()->id)
                                            <div class="card p-2 shadow">
                                                <div class="card-header">
                                                    <h6 class="text-snd font-weight-normal">Place a Bid on this project</h6>
                                                </div>
                                                @if (Auth::user()->country_id == '')
                                                    <div class="alert alert-info">
                                                        <p class="text-white mb-0"><i class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i> Please update your Country to place
                                                            a bid on
                                                            this project</p>
                                                    </div>
                                                @elseif (Auth::user()->flutterwaveSubaccount == '')
                                                    <div class="alert alert-info">
                                                        <p class="text-white mb-0"><i class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i> Please update your Account
                                                            Information to
                                                            place a bid on this project</p>
                                                    </div>
                                                @elseif (Auth::user()->email_verified_at == '')
                                                    <div class="alert alert-info">
                                                        <p class="text-white mb-0"><i class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i> Please verify your Email to place a
                                                            bid on
                                                            this project</p>
                                                    </div>
                                                @else
                                                    <div class="card-body">
                                                        <p>You will be able to edit your bid until the job is awarded to
                                                            someone</p>
                                                        <form action="{{ route('user.jobs.bid') }}" method="POST"
                                                            id="bidForm">
                                                            @csrf
                                                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                            <h6 class="font-weight-normal">Bid Details</h6>
                                                            <div class="row g-2">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="amount" class="font-weight-normal">Bid
                                                                            Amount</label>
                                                                        {{-- <span
                                                                    style="position: absolute; left: 18px; bottom: 28px;">{{$job->currency->symbol}}</span> --}}
                                                                        <input type="text" name="amount" id="amount"
                                                                            class="form-control @error('amount') is-invalid @enderror"
                                                                            value="{{ $job->budget->min }}">
                                                                        @error('amount')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="duration"
                                                                            class="font-weight-normal">This job
                                                                            will be
                                                                            completed
                                                                            in days</label>
                                                                        <input type="number" name="duration" id="duration"
                                                                            class="form-control @error('duration') is-invalid @enderror"
                                                                            min="1" value="1">
                                                                        @error('duration')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="proposal" class="font-weight-normal">Describe
                                                                    your
                                                                    proposal</label>
                                                                <textarea name="proposal" id="" cols="30" rows="5" class="form-control @error('proposal') is-invalid @enderror"
                                                                    placeholder="What makes you the best candidate for this job">{{ old('proposal') }}</textarea>
                                                                @error('proposal')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-secondary float-right">Place a
                                                                bid</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-bids" role="tabpanel" aria-labelledby="pills-bids-tab">
                                @if (count($bids) > 0)
                                    <div class="row g-3 bids">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="card jbCardContainer p-1 bg-transparent">
                                                <div class="row justify-content-center g-2">
                                                    <div class="col-12 col-sm-12 col-md-4">
                                                        <div class="bg-white rounded-0 p-2 bid-header">
                                                            <h6>Budget:
                                                                <span>{{ $job->currency->symbol }}{{ number_format($job->budget->min) }}
                                                                    -
                                                                    {{ $job->currency->symbol }}{{ number_format($job->budget->max) }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4">
                                                        <div class="bg-white rounded-0 p-2 bid-header">
                                                            <h6>Bids:
                                                                <span>{{ count($bids) }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4">
                                                        <div class="bg-white rounded-0 p-2 bid-header">
                                                            <h6>Avg. Bid:
                                                                <span>{{ $job->currency->symbol }}{{ number_format($bidAverage) }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($bids as $bid)
                                                <div class="card shadow p-2 bg-white pb-3">
                                                    <div
                                                        class="card-header d-sm-block d-lg-flex justify-content-between border-bottom-0 pb-1">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bdImage">
                                                                @php
                                                                    $path = public_path('img/profile/') . $bid->influencer->image;
                                                                @endphp
                                                                @if (file_exists($path))
                                                                    <img id="influencer-profile-pic-{{ $loop->index + 1 }}"
                                                                        src="{{ asset('/img/profile/' . $bid->influencer->image) }}"
                                                                        class="img-fluid"
                                                                        alt="{{ $bid->influencer->last_name }}">
                                                                @else
                                                                    <img id="influencer-profile-pic-{{ $loop->index + 1 }}"
                                                                        src="{{ $bid->influencer->image }}"
                                                                        class="img-fluid"
                                                                        alt="{{ $bid->influencer->last_name }}">
                                                                @endif
                                                                <!-- <img src="{{ asset('/img/p-img.jpg') }}" class="img-fluid" alt=""> -->
                                                            </div>
                                                            <div class="ml-3">
                                                                <h6 class="font-weight-normal text-md mb-0"
                                                                    id="influ-firstname-{{ $loop->index + 1 }}">
                                                                    {{ $bid->influencer->first_name }}
                                                                </h6>
                                                                <span class="text-sm text-warning">
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </span>
                                                                <p class="proposal pt-2 mb-1">
                                                                    {{ $bid->proposal }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <h6 class="mb-0">
                                                                {{ $bid->job->currency->symbol }}{{ number_format($bid->amount) }}
                                                            </h6>
                                                            <span class="text-muted text-sm">
                                                                in <span>{{ $bid->duration }}</span> Days
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="jbDetailsSection ml-2 pl-5">
                                                            <!-- {{ $bid->job->vendor->user->id }} -->
                                                            <div class="d-sm-block d-lg-flex justify-content-end">
                                                                @if ((Auth::user()->id == $job->vendor->user->id && $job->influencer_id == $bid->influencer_id) || (Auth::user()->id == $job->influencer_id && $bid->influencer_id == $job->influencer_id) || (!$bid->chat_initiated && Auth::user()->id == $job->vendor->user->id) || ($bid->chat_initiated && Auth::user()->id == $bid->influencer_id))
                                                                    <!-- <form class="mb-0" action="{{ route('user.chat.register') }}">
                                                            <input type="hidden" id="influ-id-{{ $loop->index + 1 }}"
                                                                name="influencer_id" value="{{ $bid->influencer_id }}">
                                                            <input type="hidden" name="job_id" value="{{ $bid->job->id }}">
                                                            <input type="hidden" name="influencer_firstname"
                                                                value="{{ $bid->influencer->first_name }}" />
                                                            <input type="hidden" name="influencer_lastname"
                                                                value="{{ $bid->influencer->last_name }}" />
                                                            <input type="hidden" name="influencer_image"
                                                                value="{{ $bid->influencer->image }}" />
                                                            <input type="hidden" name="vendor_id"
                                                                value="{{ $job->vendor->user->id }}" />
                                                            <input type="hidden" name="projectName"
                                                                value="{{ $job->name }}" />
                                                            <button type="submit"
                                                                class="btn btn-outline-primary btn-sm rounded-pill mt-1 initiate-chat-{{ $loop->index + 1 }}"
                                                                id="initiate-chat"
                                                                value="{{ $loop->index + 1 }}">Chat</button>

                                                        </form> -->
                                                                    <!-- <div id="vicomma-chat-btn"></div> -->
                                                                    @if (Auth::user()->id == $job->vendor->user->id)
                                                                        <a id="chat-initiator"
                                                                            data-chatreceiver="{{ $bid->influencer->id }}">
                                                                            <button id="vicomma-chat-btn"
                                                                                class="btn btn-secondary mt-2 text-white me-3">Chat</button>
                                                                        </a>
                                                                        <div id="vicomma-chat-module"></div>
                                                                    @endif
                                                                    @if (Auth::user()->id == $bid->influencer_id || Auth::user()->hasRole('Creative'))
                                                                        <a id="chat-initiator"
                                                                            data-chatreceiver="{{ $job->vendor->user->id }}">
                                                                            <button id="vicomma-chat-btn"
                                                                                class="btn btn-secondary mt-2 text-white me-3">Chat</button>
                                                                        </a>
                                                                        <div id="vicomma-chat-module"></div>
                                                                    @endif
                                                                @endif
                                                                {{-- <button
                                                                                        class="btn btn-secondary btn-sm rounded-pill ml-sm-0 ml-lg-2 mt-1">Award</button> --}}
                                                                {{-- {{$bid->job->isAwarded}} --}}


                                                                @if (Auth::user()->hasRole('vendor') && $job->payment_milestone === 0)
                                                                    @if ($job->isAwarded && Auth::user()->id === $job->vendor->user->id && $job->influencer_id === $bid->influencer_id)
                                                                        <a id="deposit-initial"
                                                                            href="{{ route('user.vendors.milestones.pay') }}?id={{ $job->unique_id }}&creative={{ $bid->influencer_id }}">
                                                                            <button
                                                                                class="btn btn-success btn-block mt-2">Make
                                                                                Deposit</button>
                                                                        </a>
                                                                    @endif
                                                                @elseif(Auth::user()->hasRole('vendor') && $job->payment_milestone === 1 && $video && $video->viewed_at)
                                                                    <a
                                                                        href="{{ route('user.job.final.payment', $job->unique_id) }}">
                                                                        <button class="btn btn-success btn-block mt-2">
                                                                            Make Final
                                                                            Payment
                                                                        </button>
                                                                    </a>
                                                                @else
                                                                @endif

                                                                @if (!$bid->job->isAwarded && Auth::user()->id == $job->vendor->user->id)
                                                                    <form class="mb-0" id="awardForm"
                                                                        action="{{ route('user.jobs.bid.award') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            id="influ-id-{{ $loop->index + 1 }}"
                                                                            name="influencer_id"
                                                                            value="{{ $bid->influencer_id }}">
                                                                        <input type="hidden" name="job_id"
                                                                            value="{{ $bid->job->id }}">
                                                                        <button type="submit"
                                                                            class="btn btn-success ml-sm-0 ml-lg-2 mt-2 pl-4 pr-4">Award</button>
                                                                    </form>
                                                                @endif
                                                                {{-- @if (Auth::user()->id == $bid->influencer_id && !$job->isAwarded)
                                                    <a href="{{route('user.jobs.bid.edit', $bid->id)}}"
                                                    class="btn btn-secondary btn-sm rounded-pill ml-sm-0 ml-lg-2
                                                    mt-1">Edit</a>
                                                    @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <h6 class="mt-4 text-center font-weight-normal">No Bid at the moment</h6>
                                @endif

                            </div>
                            @if ($job->vendor->user->id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
                                <div class="tab-pane fade" id="pills-files" role="tabpanel">
                                    <div class="card rounded-0 border-0 jbCardContainer p-2 shadow mt-4">
                                        <div class="card-header pt-0 pb-2 pl-2 pr-2 d-flex justify-content-between">
                                            <h6 class="text-snd font-weight-normal text-md mb-1">Share Files</h6>
                                            {{-- <div class="d-flex justify-content-end"> --}}
                                            <button class="btn btn-success btn-sm ml-auto rounded-0" data-bs-toggle="modal"
                                                data-bs-target="#fileModal">Upload file</button>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-hover table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Size</th>
                                                        <th>Uploaded by</th>
                                                        <th>Uploaded</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($files as $file)
                                                        <tr>
                                                            <td class="align-middle"> <i class="fas fa-file text-gray"
                                                                    aria-hidden="true"></i>
                                                                {{ $file->name }}
                                                            </td>
                                                            <td class="align-middle">{{ number_format($file->size, 0) }}
                                                                KB</td>
                                                            <td class="align-middle">{{ $file->user }}</td>
                                                            <td class="align-middle">
                                                                {{ \Carbon\Carbon::parse($file->created_at)->diffForHumans() }}
                                                            </td>
                                                            <td class="d-flex justify-content-end">
                                                                <a href="{{ route('user.jobs.file.download', $file->link) }}"
                                                                    class="btn btn-light btn-sm">Download</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($job->vendor->user->id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
                                <div class="tab-pane fade" id="pills-content" role="tabpanel">
                                    <div class="card rounded-0 border-0 jbCardContainer p-2 shadow mt-4">
                                        @if ($job->video && is_null($job->video->view_at) && Auth::user()->hasRole('vendor') && !$video->isApproved && $job->payment_milestone && $token->verified_at)
                                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                                    aria-label="Primary:">
                                                    <use xlink:href="#info-fill" />
                                                </svg>
                                                <div>
                                                    Watch the video, Accept or open a dialogue.
                                                </div>
                                            </div>
                                        @endif
                                        @if (!is_null($job->video) && $job->video->isApproved)
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                                    aria-label="Primary:">
                                                    <use xlink:href="#check-circle-fill" />
                                                </svg>
                                                <div>
                                                    Video Approved
                                                </div>
                                            </div>
                                        @endif
                                        <div class="card-header pt-0 pb-2 pl-2 pr-2 d-flex justify-content-between">

                                            <h6 class="text-snd font-weight-normal text-md mb-1">Video content </h6>
                                        </div>
                                        <div class="card-body">
                                            @if ($job->video)
                                                @php
                                                    if ($video->viewed_at != null) {
                                                        $watched = 1;
                                                    } else {
                                                        $watched = 0;
                                                    }

                                                    if (Auth::user()->hasRole('vendor')) {
                                                        $role = 'vendor';
                                                    } else {
                                                        $role = 'creative';
                                                    }

                                                    $milestone = $job->payment_milestone;
                                                @endphp
                                            @endif
                                            <h1>
                                            </h1>
                                            @if ($job->video)
                                                @if ($job->payment_milestone === 0 && Auth::user()->hasRole('vendor'))
                                                    <div class="d-flex justify-content-center">
                                                        <div class="text-center">
                                                            <div>Make Initial deposit to view Video</div>
                                                            <a id="deposit-initial"
                                                                href="{{ route('user.vendors.milestones.pay') }}?id={{ $job->unique_id }}&creative={{ $bid->influencer_id }}">
                                                                <button class="btn btn-success mt-2">Make Deposit</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif($token && !is_null($token->verified_at) && Auth::user()->hasRole('vendor'))
                                                    @php
                                                        if ($video->isApproved == 0) {
                                                            $approved = 0;
                                                        } else {
                                                            $approved = 1;
                                                        }
                                                    @endphp
                                                    <div id="video-module" job='{{ $job->id }}'
                                                        video='{{ $video->file }}' videoId="{{ $video->id }}"
                                                        watched="{{ $watched }}" role="{{ $role }}"
                                                        milestone="{{ $milestone }}" approved="{{ $approved }}">
                                                    </div>
                                                @elseif(Auth::user()->hasRole('creative'))
                                                    <div id="video-module" job='{{ $job->id }}'
                                                        video='{{ $video->file }}' watched="{{ $watched }}"
                                                        role="{{ $role }}"></div>
                                                @else
                                                    <div class="text-center d-flex justify-content-center">
                                                        <div>
                                                            <svg width="134" height="153" viewBox="0 0 134 153" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M67 0C60.3957 0 49.3599 2.53406 38.9749 5.355C28.3506 8.22375 17.6402 11.6184 11.3422 13.6744C8.709 14.5431 6.37453 16.1364 4.60694 18.2711C2.83935 20.4058 1.71034 22.9953 1.34962 25.7422C-4.35495 68.5536 8.88233 100.282 24.9432 121.272C31.754 130.25 39.8749 138.157 49.0344 144.728C52.729 147.339 56.1556 149.338 59.0653 150.705C61.7453 151.967 64.6263 153 67 153C69.3737 153 72.2451 151.967 74.9347 150.705C78.4425 149.002 81.7983 147.002 84.9656 144.728C94.1253 138.158 102.246 130.251 109.057 121.272C125.118 100.282 138.355 68.5536 132.65 25.7422C132.29 22.994 131.162 20.4029 129.394 18.2666C127.627 16.1303 125.292 14.5353 122.658 13.6648C113.515 10.67 104.302 7.89603 95.0251 5.34544C84.6401 2.54363 73.6043 0 67 0ZM67 47.8125C70.3906 47.8075 73.6735 49.0014 76.2674 51.1829C78.8613 53.3644 80.5987 56.3927 81.1719 59.7313C81.7451 63.07 81.1171 66.5036 79.3991 69.424C77.6812 72.3444 74.9842 74.5631 71.7857 75.6872L75.4707 94.7166C75.6048 95.4087 75.584 96.1219 75.4098 96.805C75.2357 97.4882 74.9125 98.1244 74.4634 98.6682C74.0142 99.2119 73.4503 99.6497 72.812 99.9502C72.1737 100.251 71.4768 100.406 70.7711 100.406H63.2289C62.524 100.405 61.8282 100.248 61.1911 99.9471C60.5539 99.646 59.9912 99.2081 59.5432 98.6645C59.0951 98.1209 58.7727 97.4852 58.5991 96.8027C58.4255 96.1203 58.4049 95.4079 58.5389 94.7166L62.2143 75.6872C59.0158 74.5631 56.3188 72.3444 54.6009 69.424C52.8829 66.5036 52.2549 63.07 52.8281 59.7313C53.4013 56.3927 55.1387 53.3644 57.7326 51.1829C60.3265 49.0014 63.6094 47.8075 67 47.8125V47.8125Z"
                                                                    fill="#6F3C96" />
                                                            </svg>
                                                            <div class="mt-2">Verify your token to watch video
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="text-center d-flex justify-content-center">
                                                    <div>
                                                        <svg id="no-video" width="166" height="152" viewBox="0 0 166 152"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M113.72 120.921C116.679 117.767 118.574 113.765 119.136 109.477L151.402 123.815C152.982 124.519 154.712 124.817 156.436 124.682C158.159 124.547 159.822 123.983 161.273 123.042C162.723 122.1 163.915 120.812 164.741 119.293C165.566 117.773 165.999 116.072 166 114.343V36.9246C165.998 35.1969 165.566 33.497 164.74 31.979C163.915 30.4611 162.724 29.1732 161.275 28.2323C159.826 27.2914 158.165 26.7272 156.443 26.591C154.721 26.4548 152.992 26.7508 151.413 27.4522L119.136 41.7905C118.477 36.801 116.027 32.2212 112.242 28.904C108.457 25.5867 103.595 23.7582 98.5625 23.7587H44.322L51.7298 34.1337H98.5625C101.314 34.1337 103.953 35.2268 105.899 37.1725C107.844 39.1182 108.938 41.7571 108.938 44.5087V106.759C108.939 108.653 108.423 110.512 107.443 112.133L113.72 120.921ZM14.8155 36.0012C13.4444 36.9563 12.3245 38.2288 11.5513 39.7101C10.7781 41.1914 10.3746 42.8378 10.375 44.5087V106.759C10.375 109.51 11.4681 112.149 13.4138 114.095C15.3595 116.041 17.9984 117.134 20.75 117.134H72.7702L80.178 127.509H20.75C15.2468 127.509 9.96891 125.323 6.07753 121.431C2.18615 117.54 0 112.262 0 106.759V44.5087C0 37.5056 3.46525 31.3117 8.78763 27.556L14.8051 36.0012H14.8155ZM155.625 114.332L119.312 98.1994V53.0681L155.625 36.9246V114.343V114.332ZM109.902 151.267L6.15237 6.0175L14.5976 0L118.348 145.25L109.902 151.267Z"
                                                                fill="#6F3C96" />
                                                        </svg>
                                                        <div class="mt-2">No video upload from creative yet.
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($video != null && $video->isApproved)
                                                @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id && $video->isApproved)
                                                    <div class="d-flex justify-content-center mt-4">
                                                        <button class="btn btn-primary me-2"> <i
                                                                class="fas fa-star "></i> Rate
                                                            Creative</button>
                                                        <button class="btn btn-secondary me-2"> <i
                                                                class="fas fa-shopping-bag"></i>
                                                            Boost my sales</button>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($video != null)
                                                @if (auth::user()->hasRole('creative') && $job->influencer_id === Auth::user()->id && $video->isApproved)
                                                    <div class="d-flex justify-content-center mt-4">
                                                        <button class="btn btn-primary me-2"> <i
                                                                class="fas fa-star "></i> Rate
                                                            Vendor</button>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id && $job->payment_milestone != 0 && $token && $token->verified_at == null)
                            <div class="mt-4" id="video-action" job='{{ $job }}'></div>
                        @endif

                        @if ($video)
                            @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id && $video->isApproved)
                                <div class="shadow p-4 mt-4">
                                    <a href="{{ route('user.job.video.download', $job->id) }}">
                                        <div class="text-center d-flex justify-content-center" style="cursor: pointer">
                                            <div class="d-flex justify-content-center align-items-center p-3 rounded-lg"
                                                style="background: #6f3c96; width: 60px; height: 60px;">
                                                <svg width="75" height="64" viewBox="0 0 75 64" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect width="75" height="64" fill="url(#pattern0)" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                            width="1" height="1">
                                                            <use xlink:href="#image0_623_3"
                                                                transform="scale(0.0133333 0.015625)" />
                                                        </pattern>
                                                        <image id="image0_623_3" width="75" height="64"
                                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEsAAABACAYAAABSiYopAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAABARpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IlhNUCBDb3JlIDUuNC4wIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgICAgICAgICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iPgogICAgICAgICA8eG1wOk1vZGlmeURhdGU+MjAyMi0wMS0yOVQwODo1OTowOTwveG1wOk1vZGlmeURhdGU+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIDIyLjUgKE1hY2ludG9zaCk8L3htcDpDcmVhdG9yVG9vbD4KICAgICAgICAgPHRpZmY6T3JpZW50YXRpb24+MTwvdGlmZjpPcmllbnRhdGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+NzI8L3RpZmY6WVJlc29sdXRpb24+CiAgICAgICAgIDx0aWZmOkNvbXByZXNzaW9uPjE8L3RpZmY6Q29tcHJlc3Npb24+CiAgICAgICAgIDx0aWZmOlJlc29sdXRpb25Vbml0PjI8L3RpZmY6UmVzb2x1dGlvblVuaXQ+CiAgICAgICAgIDx0aWZmOlBob3RvbWV0cmljSW50ZXJwcmV0YXRpb24+MjwvdGlmZjpQaG90b21ldHJpY0ludGVycHJldGF0aW9uPgogICAgICAgICA8dGlmZjpYUmVzb2x1dGlvbj43MjwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPGV4aWY6UGl4ZWxYRGltZW5zaW9uPjc1PC9leGlmOlBpeGVsWERpbWVuc2lvbj4KICAgICAgICAgPGV4aWY6Q29sb3JTcGFjZT4xPC9leGlmOkNvbG9yU3BhY2U+CiAgICAgICAgIDxleGlmOlBpeGVsWURpbWVuc2lvbj42NDwvZXhpZjpQaXhlbFlEaW1lbnNpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgqe3hzHAAADU0lEQVR4Ae2ZzXHbQAyFpUwOOeSgEliC0wFdgZUO2EGcCshU4KQCOZVIrsDqgOnAmskhR+U9hcusoaUcxFxyJQIz0O6CEAF8BH9EzWaJyX6/v4WuoVViqaWVDgAVUF+SAvYmLVyzTOQj12LzsMvUYA1bvTKawVIAM1gGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBM7VFS/ft/4LeK5TqsVOQ8XRMFgGS0FA4WqdZbAUBBSu1llaWLhF59CKo+K7F+8KHgto1haKxRXUl2W7ceAJkkjmOQu5kMtTA6bGuOBpWAgmN2I91eUdCl80xWcYl4TlDI3dhg4CmV3gO8iEzAYrRKXDFhUWL4rUjti9moeIFQ0Wki9Ao4byjlJhjCbY/y12Hj1WNFhIvoS6ripjAWv269+5GMvF7fUAxYQlE2YRVZ/ZN/vjQRlEYsL6EqigN2AnQFXz+XwXiP1qUzRYSPgrsqsCGb4a2AugQgcpkIbeFA0WUwEwJl5xLuS/gY0FivlHhcUAfQIbE9QgsPoCNjaowWC9FlgKoFjDW34MJTwlUTjDVSJm2diFeTZLBdQhMSRzD/VldZRxzwYEK/2A3vynN+f0l1i7ZfRnKwRau2DNWEW/wIc4n7jovxf+78SaSz5HRXs8CMRrTaPAYvQTwNrkApPRQDGX0WAxuBLYqKBGh6UANjqoJGD9A7AkQDHPw61ZXPUfDxtG+EAepcgl+l2vq0zkUYtcCsIqhPGpawdD2Jt8VhyHiBeKgdh8wyslJyz+PyYlD+1kKjbAkA1EPn/ez2Hi/kykkbKeCphQnai/JgRP/vKAsfI2uGke2tGl21D8JwfAG4u2bhh5jsruqmHLWqcJTFAvL0lHHI5Kh1Oou2rYJwEMdeZQCQqmjhsNNjxya0BK2C4SGuriWXUHDcnK76q5v4A3gfBixlEK/wTYQB+gW+g5C+9sGfQGegXlWgprvMZPsp3b8AwWjS8Ac9+79HGDAj/6oFjw0Q9pOPyA/QP0O3SK8g0MriUogjjqLJ8Ouowtyn97c99+ofMN6voMSDz9gnISlvtGc2ouseY5voAS4jnLDslTt9AH6H2ok2B/Jr8BBnkcXsyAnt8AAAAASUVORK5CYII=" />
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center text-snd">
                                            Download file
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endif

                        {{-- Creative section to upload video --}}
                        @if ($job->influencer_id === Auth::user()->id && Auth::user()->hasRole('Creative') && !$video)
                            <div class="d-flex justify-content-center shadow p-4 mt-4">
                                <div class="text-center" data-bs-toggle="modal" data-bs-target="#uploadVideo"
                                    style="cursor: pointer">
                                    <svg width="60" height="60" viewBox="0 0 133 137" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal"
                                        data-bs-target="#uploadVideo">
                                        <rect width="133" height="137" rx="12" fill="#6F3C96" />
                                        <path
                                            d="M101.331 67.8084C100.153 67.8084 99.2101 68.751 99.2101 69.9293V89.2225C99.2101 94.4699 94.9367 98.7276 89.705 98.7276H43.169C37.9215 98.7276 33.6638 94.4542 33.6638 89.2225V69.6151C33.6638 68.4368 32.7212 67.4941 31.5429 67.4941C30.3645 67.4941 29.4219 68.4368 29.4219 69.6151V89.2225C29.4219 96.8109 35.5963 102.97 43.169 102.97H89.705C97.2934 102.97 103.452 96.7952 103.452 89.2225V69.9293C103.452 68.7667 102.509 67.8084 101.331 67.8084Z"
                                            fill="white" />
                                        <path
                                            d="M54.4494 51.4689L64.316 41.6024V84.6348C64.316 85.8131 65.2586 86.7558 66.4369 86.7558C67.6153 86.7558 68.5579 85.8131 68.5579 84.6348V41.6024L78.4244 51.4689C78.8329 51.8774 79.3828 52.0973 79.917 52.0973C80.4669 52.0973 81.001 51.8931 81.4095 51.4689C82.2422 50.6362 82.2422 49.3008 81.4095 48.4681L67.9295 34.9881C67.5367 34.5953 66.9868 34.3596 66.4369 34.3596C65.8713 34.3596 65.3372 34.5796 64.9444 34.9881L51.4644 48.4681C50.6317 49.3008 50.6317 50.6362 51.4644 51.4689C52.2813 52.2859 53.6325 52.2859 54.4494 51.4689Z"
                                            fill="white" />
                                    </svg>
                                    <div class="mt-3">Upload video</div>
                                </div>
                                {{-- <button class="btn btn-success btn-sm ml-auto rounded-0" data-bs-toggle="modal" data-bs-target="#videoModal">Upload
                                video</button> --}}
                            </div>
                        @endif
                        <div class="card rounded-0 border-0 jbCardContainer p-2 shadow mt-4">
                            <div class="card-header pb-3">
                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                    <h6 class="text-snd font-weight-normal text-md mb-0">Creative Details</h6>
                                @else
                                    <h6 class="text-snd font-weight-normal text-md mb-0">Vendor Details</h6>
                                @endif
                            </div>
                            <div class="card-body">
                                {{-- <h6 class="text-md font-weight-normal mb-4">Vendor Details</h6> --}}
                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id && $job->influencer == null)
                                    <small class="mb-3">Award Job to see Creative Details</small>
                                @else
                                    <ul class="nav mb-4">
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div>
                                                <div><i class="fas fa-map-marker-alt text-muted mr-2"></i> Country</div>
                                            </div>
                                            <div>
                                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                                    @if ($job->influencer !== null)
                                                        @if ($job->influencer->country_id)
                                                            <div class="text-snd">
                                                                {{ $job->influencer->country->name }}</div>
                                                        @else
                                                            <div class="text-danger"><i class="fa fa-times-circle"
                                                                    aria-hidden="true"></i> Verified</div>
                                                        @endif
                                                    @else
                                                        No Creative yet
                                                    @endif
                                                @elseif (Auth::user()->hasRole('creative'))
                                                    @if ($job->vendor->user->country_id)
                                                        <div class="text-snd">
                                                            {{ $job->vendor->user->country->name }}
                                                        </div>
                                                    @else
                                                        <div class="text-danger"><i class="fa fa-times-circle"
                                                                aria-hidden="true"></i> Verified</div>
                                                    @endif
                                                @endif
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div>
                                                <i class="fas fa-tv text-muted mr-2"></i> Projects
                                            </div>
                                            <div class="text-snd">
                                                0
                                            </div>
                                        </li>
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div>
                                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                                    @if ($job->influencer !== null)
                                                        <i class="fas fa-clock text-muted mr-2"></i> Member since
                                                        {{ \Carbon\Carbon::parse($job->influencer->created_at)->diffForHumans() }}
                                                    @endif
                                                @else
                                                    <i class="fas fa-clock text-muted mr-2"></i> Member since
                                                    {{ \Carbon\Carbon::parse($job->vendor->user->created_at)->diffForHumans() }}
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                @endif

                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                    <h6 class="text-md text-snd font-weight-normal mt-3 mb-4">Creative Verifications</h6>
                                @else
                                    <h6 class="text-md text-snd font-weight-normal mb-4">Vendor Verifications</h6>
                                @endif
                                <hr>

                                @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id && $job->influencer == null)
                                    <small>Award Job to see Creative Verifications</small>
                                @else
                                    <ul class="nav">
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div><i aria-hidden="true" class="fa fa-envelope text-muted mr-2"></i>
                                                Email
                                            </div>
                                            @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                                <div>
                                                    @if ($job->influencer !== null)
                                                        @if ($job->influencer->email_verified_at == null)
                                                            <span class="text-danger">
                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                Verified
                                                            </span>
                                                        @else
                                                            <span class="text-success">
                                                                <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                                Verified
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <div>
                                                    @if ($job->vendor->user->email_verified_at == null)
                                                        <span class="text-danger">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i> Verified
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                            Verified
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div><i aria-hidden="true" class="fa fa-phone-alt text-muted mr-2"></i>
                                                Phone Number
                                            </div>
                                            @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                                <div>
                                                    @if ($job->influencer !== null)
                                                        @if (!$job->vendor->user->isPhoneVerified)
                                                            <span class="text-danger">
                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                Verified
                                                            </span>
                                                        @else
                                                            <span class="text-success">
                                                                <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                                Verified
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <div>
                                                    @if (!$job->vendor->user->isPhoneVerified)
                                                        <span class="text-danger">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i> Verified
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                            Verified
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                        <li
                                            class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                            <div><i aria-hidden="true" class="fa fa-credit-card text-muted mr-2"></i>
                                                Payment Method
                                            </div>
                                            @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                                <div>
                                                    @if ($job->influencer !== null)
                                                        @if (!$job->vendor->user->flutterwaveSubaccount)
                                                            <span class="text-danger">
                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                Verified
                                                            </span>
                                                        @else
                                                            <span class="text-success">
                                                                <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                                Verified
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <div>
                                                    @if (!$job->vendor->user->flutterwaveSubaccount)
                                                        <span class="text-danger">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i> Verified
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <i aria-hidden="true" class="fa fa-check-circle"></i>
                                                            Verified
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                    </ul>
                                @endif
                                @if (Auth::user()->hasRole('vendor') && $job->payment_milestone === 0)
                                    @if ($job->isAwarded && Auth::user()->id === $job->vendor->user->id && $job->influencer_id === $bid->influencer_id)
                                        <a id="deposit-initial"
                                            href="{{ route('user.vendors.milestones.pay') }}?id={{ $job->unique_id }}&creative={{ $bid->influencer_id }}">
                                            <button class="btn btn-success btn-block mt-2">Make Deposit</button>
                                        </a>
                                    @endif
                                @elseif(Auth::user()->hasRole('vendor') && $job->payment_milestone === 1 && $video && $video->viewed_at)
                                    <a href="{{ route('user.job.final.payment', $job->unique_id) }}"
                                        class="btn btn-success btn-block mt-2">Make Final Payment</a>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @if ($job->vendor->user_id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mb-0" action="{{ route('user.jobs.file.upload') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <div class="form-group">
                                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file"
                                    id="file">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-success btn-sm ml-auto btn-block" type="submit" value="submit">Upload
                                file</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($job->influencer_id === Auth::user()->id)
        {{-- <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mb-0" action="{{route('user.jobs.file.upload')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <div class="form-group">
                            <input class="form-control @error('video') is-invalid @enderror" type="file" name="file" id="file">
                            @error('video')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            <small>Share your video content with the vendor</small>
                        </div>
                        <button class="btn btn-success btn-sm ml-auto btn-block" type="submit" value="submit">Upload
                            video</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <jobvideo :job_id="{{ $job->id }}"></jobvideo> --}}
    @endif
    @if ($job->isAwarded)
        @push('scripts')
            <script src="{{ asset('client/video/action.js') }}"></script>
            <script src="{{ asset('client/video/index.js') }}"></script>
            <script>
                async function postData(url = '', data = {}) {
                    // Default options are marked with *
                    const headers = {
                        'Content-Type': 'application/json',
                    }

                    return axios.post(url, data, {
                        'Access-Control-Allow-Origin': '*',
                        headers: headers
                    })
                }
            </script>
        @endpush
    @endif


    @push('scripts')
        <script>
            var authEndpoint = '{{ route('pusher.auth') }}';
            //local
            var actor = "{{ Auth::user()->id }}";
            var tkon = "{{ csrf_token() }}";
            var mx_id = "{{ $job->id }}";
            var auth_id = actor,
                url = "/chatify",
                defaultMessengerColor = $("meta[name=messenger-color]").attr("content"),
                access_token = tkon;
            var getMessengerType = "user";
            var messagesContainer = $(".messages-container");
        </script>
        <script src="{{ asset('client/chat/index.js') }}"></script>
        <script>
            // function getVideoCode() {
            //     axios.get('/job/video/code/' + 1)
            //     .then(response => {
            //         console.log(response.data);
            //     }).catch(error => {
            //         console.log(error);
            //     })
            // }

            // const params = new URLSearchParams(window.location.search);
            // if (params.has('tx-ref')) {
            //     jQuery(document).ready(function() {
            //         swal({
            //             title: "Successful!",
            //             text: "Payment successful",
            //             icon: "success",
            //         });
            //     })
            // }


            var milestone_count = 1;
            const milestone_limit = 6;

            $('#milestone-1-amt').attr("value", $('#amount').val() * (5 / 100));
            $('#milestone-2-amt').attr("value", $('#amount').val() * (95 / 100));
            $('#milestone-1-amt').attr("disabled", true);
            $('#milestone-2-amt').attr("disabled", true);

            $('#amount').on('change', () => {

                $('#milestone-1-amt').attr("value", $('#amount').val() * (5 / 100)); //should be 5%  of the total amount
                $('#milestone-2-amt').attr("value", $('#amount').val() * (95 /
                100)); //should be 5%  of the total amount

            })

            $('#milestone-1-amt').on('change', () => {
                $("#milestone-1-amt").attr("value", $('#amount').val() * (5 / 100));
                $('#milestone-1-amt').attr("disabled", true);
            })

            $('#milestone-2-amt').on('change', () => {
                $("#milestone-2-amt").attr("value", $('#amount').val() * (95 / 100));
                $('#milestone-2-amt').attr("disabled", true);
            })
            jQuery('document').ready(function() {
                // getVideoCode()
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

                var maxLength = 300;
                jQuery(".proposal").each(function() {
                    var myStr = $(this).text();
                    if ($.trim(myStr).length > maxLength) {
                        var newStr = myStr.substring(0, maxLength);
                        var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                        jQuery(this).empty().html(newStr);
                        jQuery(this).append(
                            ' <a href="javascript:void(0);" class="text-snd read-more">read more...</a>');
                        jQuery(this).append('<span class="more-text">' + removedStr + '</span>');
                    }
                });


                jQuery(".read-more").click(function() {
                    jQuery(this).siblings(".more-text").contents().unwrap();
                    jQuery(this).remove();
                });
                $('#videoElement').bind('contextmenu', function() {
                    return false;
                });

                $('a[data-bs-toggle="pill"]').on('show.bs.tab', function(e) {
                    localStorage.setItem('openTab', $(e.target).attr('id'));
                });
                var activeTab = localStorage.getItem('openTab');
                if (activeTab) {
                    $('#' + activeTab).tab('show')
                }
            });
        </script>
    @endpush
@endsection
