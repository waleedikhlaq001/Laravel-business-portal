@extends('pages.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css"
    integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
</svg> -->
@push('scripts')
<script>
    document.title = "{{$job->name}}";
</script>
@endpush
@push('css')
<style>
    .modal-backdrop.show {
        width: 100%;
        height: 100%;
    }

    .form-group label {
        font-size: 15px !important;
        color: #6f3c96;
    }

    #video-preview {
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

    .proposal {
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

    .milestone-container {
        display: flex !important;
    }

    /* vWallet Section */
    .balance-card {
        background: #cce9a8;
        color: #476423;
        border-radius: 10px;
        padding: 24px 40px;
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .balance-card p {
        margin-bottom: 0;
        font-weight: 400;
        color: #476423;
    }

    .balance-card .amt-due {
        font-size: 20px;
        font-weight: 700;
    }

    .balance-card.milestones {
        background: #d5e3c4;
    }

    .wallet .balance-card {
        height: calc(100% - 20px);
        background: #d5e3c4;
    }

    .percent-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .p-row-item {
        border: 1px solid #476423;
        border-radius: 50%;
        padding: 5px;
        min-width: 40px;
    }

    .marked .p-row-item {
        background: #476423;
        cursor: not-allowed;
    }

    .marked .p-row-item p {
        color: #fff;
    }

    .marked .p-row-item:active>p {
        font-size: 12px;
    }

    .p-row-item:hover {
        background: #476423;
    }

    .p-row-item:hover>p {
        color: #fff;
    }

    .p-row-item:active>p {
        font-size: 10px;
    }

    .p-row-item p {
        font-size: 12px;
    }

    .milestone-header {
        font-weight: 600;
        font-size: 20px;
        border-bottom: 1px solid #47642b54 !important;
    }

    .milestone-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 25px;
        margin-top: 10px;
        background: #dbebc6;
        border-radius: 10px;
    }

    .milestone-item.done {
        background: #cce9a8;
    }

    .milestone-item .amt {
        font-weight: 600;
        font-size: 20px;
    }

    .milestone-item small {
        font-size: 11px;
        font-weight: 400;
    }

    .btn-milestone {
        background: #476423;
        display: inline-block;
        padding: 3px 15px;
        color: #fff;
        font-weight: 300;
    }

    .btn-milestone:hover {
        background: #2f4217;
        color: #fff;
    }

    .btn-milestone:active {
        font-size: 0.835rem;
    }

    .balance-card.total-amt-due {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .check-mark {
        font-size: 20px;
        padding-top: 16px;
    }

    .introjs-nextbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745 !important;
        color: #fff;
        text-shadow: none;
    }

    .introjs-prevbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745;
        color: #fff;
        text-shadow: none;
    }

    .introjs-skipbutton {
        box-sizing: content-box;
        margin-right: 5px;
        color: #fff;
        background: #6f3a97;
        text-shadow: none;
    }

    .introjs-skipbutton.introjs-donebutton {
        color: #fff;
        background: #44255b !important;
        text-shadow: none;
    }

    .dot {
        width: 9px;
        height: 9px;
        background: #00d331;
        border-radius: 50%;
        display: inline-block;
    }

    #vicomma-chat-btn.side-btn:before {
        width: 9px;
        height: 9px;
        background: #00d331;
        border-radius: 50%;
        display: inline-block;
        content: "";
        margin-right: 3px;
    }

    .text-center a.side-btn {
        border-radius: 5px;
        border: 1px solid #00d33133;
        display: inline-block;
        color: #939f9e !important;
    }

    .side-btn {
        border-radius: 5px;
        border: 1px solid #00d33133;
        display: inline-block;
        color: #939f9e !important;
    }

    .border-top-purple {
        border-top: 4px solid #6f3a97;
    }

    .not-allowed {
        background-color: #e9ecef;
        cursor: not-allowed;
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
@include('includes.rating.rate-creative')
@include('includes.rating.rate-vendor')
@if($job->isAwarded && auth::user()->hasRole('vendor'))
@include('includes.confirm-deposit')
@endif
@if ($pay)
@include('includes.confirmation')
@endif
<div class="container-fluid">
    <div class="contactFreelancersContainer" style="height: auto">
        <div class="row g-2">
            <div class="col-sm-12 col-md-12 col-lg-9">
                <h6><span id="main-job-name">{{ $job->name }} <span class="tip" style="margin-bottom: -5px;"
                            data-content="{{$job->description}}">
                            <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large"></ion-icon>
                        </span></span>
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
                <div class="d-flex justify-content-sm-start justify-content-lg-endp">
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
                <li class="nav-item tip" role="presentation" data-show="no"
                    data-content=" This is where any useful files for this project are posted.">
                    <a class="nav-link navCUST" href="#" id="pills-files-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-files" type="button" role="tab" aria-controls="pills-files"
                        aria-selected="false">Files</a>
                </li>
                @endif
                @if ($job->vendor->user->id === Auth::user()->id || $job->influencer_id === Auth::user()->id)
                <li class="nav-item tip" role="presentation" data-show="no"
                    data-content="This is where the content from the Creative will be posted.">
                    <a class="nav-link navCUST" href="#" id="pills-content-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-content" type="button" role="tab" aria-controls="pills-content"
                        aria-selected="false">Contents</a>
                </li>
                @endif
                @if ($job->vendor->user->id === Auth::user()->id && $job->isAwarded || $job->influencer_id ===
                Auth::user()->id && $job->isAwarded)
                <li class="nav-item tip" role="presentation" data-show="no"
                    data-content="This is where payment for this project will be processed.">
                    <a class="nav-link navCUST" href="#" id="pills-vwallet-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-vwallet" type="button" role="tab" aria-controls="pills-vwallet"
                        aria-selected="false">vWallet</a>
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
                                            <div class="d-flex justify-content-between" style="width: 100%">
                                                <h6 class="text-snd font-weight-normal text-lg">Product Delivery Method
                                                </h6>
                                                <h6 class="text-snd font-weight-normal text-lg">Content Type
                                                </h6>
                                            </div>
                                        </div>
                                        <?php 
                                            $content_type = json_decode($job->content_type);
                                        ?>
                                        <div class="card-body">
                                            <div class="jbDetailsSection d-flex justify-content-between"
                                                style="width: 100%;">
                                                <p>
                                                    {{$job->product_delivery_method}}
                                                </p>
                                                <p>
                                                    @foreach($content_type as $key=>$type)
                                                    @if($key == 0)
                                                    <span class="text-sm"
                                                        style="font-family: 'Poppins'; color: gray;">{{$type}}</span>
                                                    @else
                                                    <span class="text-sm" style="font-family: 'Poppins'; color: gray;">,
                                                        &nbsp;{{$type}}</span>
                                                    @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!$job->isAwarded && Auth::user()->hasRole('Creative') && !$hasBid &&
                                    $job->vendor->user_id !== Auth::user()->id)
                                    <div class="card p-2 shadow">
                                        <div class="card-header">
                                            <h6 class="text-snd font-weight-normal">Place a Bid on this project</h6>
                                        </div>
                                        @if (Auth::user()->country_id == '' || Auth::user()->email_verified_at == '' ||
                                        Auth::user()->isPhoneVerified != '1')
                                        {{ Auth::user()->country_id}}/ {{ Auth::user()->email_verified_at }}
                                        {{ Auth::user()->isPhoneVerified}}
                                        <div class="alert alert-dark m-3">
                                            <p class="text-white mb-0 float-left"
                                                style="font-size: 14px; line-height: 38px;">
                                                <i class="fa fa-exclamation-circle mr-2" aria-hidden="true"></i> |
                                                {{ Auth::user()->country_id == '' ? '  Update your Country |' : '' }}
                                                {{ Auth::user()->email_verified_at == '' ? '  Verify your Email |' : '' }}
                                                {{ Auth::user()->isPhoneVerified != '1' ? '  Update and Verify your Phone Number |' : '' }}
                                            </p>

                                            <a class="btn btn-outline-light text-decoration-none btn-sm float-right update-t"
                                                href="/settings" target="_blank" role="button">Update</a>
                                        </div>
                                        @else
                                        <div class="card-body">
                                            <p>You will be able to edit your bid until the job is awarded to
                                                someone</p>
                                            <form action="{{ route('user.jobs.bid') }}" method="POST" id="bidForm"
                                                onsubmit="$('#bidbtn').attr('disabled', true)">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                <h6 class="font-weight-normal">Bid Details</h6>
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="amount" class="font-weight-normal">Bid
                                                                Amount</label>
                                                            <span
                                                                style="position: absolute; left: 18px; bottom: 28px;">{{$job->currency->symbol}}</span>

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
                                                            <label for="duration" class="font-weight-normal">This job
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
                                                    <textarea name="proposal" id="" cols="30" rows="5"
                                                        class="form-control @error('proposal') is-invalid @enderror"
                                                        placeholder="What makes you the best candidate for this job">{{ old('proposal') }}</textarea>
                                                    @error('proposal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button type="submit" id="bidbtn"
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

                            <all-bids :job-prop="{{ $job->id }}" :role-prop="{{Auth::user()->role}}"
                                :user-prop="{{Auth::user()->id}}"></all-bids>

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
                                @if ($job->video && is_null($job->video->view_at) && Auth::user()->hasRole('vendor') &&
                                !$video->isApproved && $job->payment_milestone && $token->verified_at)
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
                                    $job_milestone = $job->payment_milestone;
                                    @endphp
                                    @endif
                                    <h1>
                                    </h1>
                                    @if ($job->video)
                                    {{-- @if ($job->payment_milestone === 0 && Auth::user()->hasRole('vendor')) --}}
                                    @if ($pay && $pay->name == 'Video Uploaded' && Auth::user()->hasRole('vendor'))
                                    <div class="d-flex justify-content-center">
                                        <div class="text-center">
                                            <div>Pay Creative for Milestone Completed</div>
                                            {{-- <a id="deposit-initial"
                                                    href="{{ route('user.vendors.milestones.pay') }}?id={{ $job->unique_id }}&creative={{ $bid->influencer_id }}">
                                            <button class="btn btn-success mt-2">Make Deposit</button>
                                            </a> --}}
                                            <a href="javascript:void(0);" data-bs-target="#payCreative"
                                                data-bs-toggle="modal">
                                                <button class="btn btn-success btn-block mt-2">Pay
                                                    {{$wallet->currency->symbol}}{{$pay->amt_due}}</button>
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
                                    $amount_due;
                                    $uuid;
                                    $milestone_completed;
                                    foreach ($milestones as $key => $milestone) {
                                    if($milestone->name === 'Video Watched') {
                                    $amount_due = $milestone->amt_due;
                                    $uuid = $milestone->uid;
                                    $milestone_completed = $milestone->completed;
                                    }
                                    }
                                    @endphp
                                    <div id="video-module" job='{{ $job->id }}' video='{{ $video->file }}'
                                        videoId="{{ $video->id }}" watched="{{ $watched }}" role="{{ $role }}"
                                        milestone="{{ $job_milestone }}" approved="{{ $approved }}"
                                        walletBal="{{$wallet->balance}}" amountDue="{{$amount_due}}" uuid="{{$uuid}}"
                                        jobCompleted="{{$milestone_video->paid}}">
                                    </div>
                                    @elseif(Auth::user()->hasRole('creative'))
                                    <div id="video-module" job='{{ $job->id }}' video='{{ $video->file }}'
                                        watched="{{ $watched }}" role="{{ $role }}"></div>
                                    @else
                                    <div class="text-center d-flex justify-content-center">
                                        <div>
                                            <svg width="134" height="153" viewBox="0 0 134 153" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M67 0C60.3957 0 49.3599 2.53406 38.9749 5.355C28.3506 8.22375 17.6402 11.6184 11.3422 13.6744C8.709 14.5431 6.37453 16.1364 4.60694 18.2711C2.83935 20.4058 1.71034 22.9953 1.34962 25.7422C-4.35495 68.5536 8.88233 100.282 24.9432 121.272C31.754 130.25 39.8749 138.157 49.0344 144.728C52.729 147.339 56.1556 149.338 59.0653 150.705C61.7453 151.967 64.6263 153 67 153C69.3737 153 72.2451 151.967 74.9347 150.705C78.4425 149.002 81.7983 147.002 84.9656 144.728C94.1253 138.158 102.246 130.251 109.057 121.272C125.118 100.282 138.355 68.5536 132.65 25.7422C132.29 22.994 131.162 20.4029 129.394 18.2666C127.627 16.1303 125.292 14.5353 122.658 13.6648C113.515 10.67 104.302 7.89603 95.0251 5.34544C84.6401 2.54363 73.6043 0 67 0ZM67 47.8125C70.3906 47.8075 73.6735 49.0014 76.2674 51.1829C78.8613 53.3644 80.5987 56.3927 81.1719 59.7313C81.7451 63.07 81.1171 66.5036 79.3991 69.424C77.6812 72.3444 74.9842 74.5631 71.7857 75.6872L75.4707 94.7166C75.6048 95.4087 75.584 96.1219 75.4098 96.805C75.2357 97.4882 74.9125 98.1244 74.4634 98.6682C74.0142 99.2119 73.4503 99.6497 72.812 99.9502C72.1737 100.251 71.4768 100.406 70.7711 100.406H63.2289C62.524 100.405 61.8282 100.248 61.1911 99.9471C60.5539 99.646 59.9912 99.2081 59.5432 98.6645C59.0951 98.1209 58.7727 97.4852 58.5991 96.8027C58.4255 96.1203 58.4049 95.4079 58.5389 94.7166L62.2143 75.6872C59.0158 74.5631 56.3188 72.3444 54.6009 69.424C52.8829 66.5036 52.2549 63.07 52.8281 59.7313C53.4013 56.3927 55.1387 53.3644 57.7326 51.1829C60.3265 49.0014 63.6094 47.8075 67 47.8125V47.8125Z"
                                                    fill="#6F3C96" />
                                            </svg>
                                            <div class="mt-2">Check Your Email For Your Video Token
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

                                    @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id
                                    && $video != null && $milestone_video->paid === '1' && $milestone_video->completed
                                    === '1')
                                    <div class="d-flex justify-content-center mt-4">
                                        @if(!$rated_creative)
                                        <button class="btn btn-primary me-2" data-bs-target="#rateCreative"
                                            data-bs-toggle="modal"> <i class="fas fa-star "></i> Rate
                                            Creative</button>
                                        @endif
                                        <button class="btn btn-secondary me-2"> <i class="fas fa-shopping-bag"></i>
                                            Boost my sales</button>
                                    </div>
                                    @endif
                                    @if ($video != null)
                                    @if (auth::user()->hasRole('creative') && $job->influencer_id === Auth::user()->id
                                    && $video->isApproved)
                                    <div class="d-flex justify-content-center mt-4">
                                        <button class="btn btn-primary me-2"> <i class="fas fa-star "></i> Rate
                                            Vendor</button>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($job->vendor->user->id === Auth::user()->id && $job->isAwarded || $job->influencer_id ===
                        Auth::user()->id && $job->isAwarded)

                        <div class="tab-pane fade" id="pills-vwallet" role="tabpanel">
                            @if($wallet)
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="col-md-12 px-0">
                                        @if(auth::user()->hasRole('Creative'))
                                        <div class="balance-card">
                                            {{$wallet->currency->symbol}}{{$wallet->budget ?? '0'}}
                                            <p><small>(Current Job Budget)</small></p>
                                        </div>
                                        @endif


                                        @if(auth::user()->hasRole('vendor'))
                                        <div class="balance-card row d-flex align-items-center">
                                            <div class="col-6">
                                                {{$wallet->currency->symbol}}{{$pay->amt_due ?? '0'}}
                                                <p><small>(Total Amount Due)</small></p>
                                            </div>
                                            <div class="col-6 text-right">
                                                @if ($pay)
                                                <a href="javascript:void(0);" class="btn-sm btn-milestone"
                                                    data-bs-target="#payCreative" data-bs-toggle="modal">
                                                    Pay
                                                </a>
                                                @else
                                                <span></span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @if(auth::user()->hasRole('vendor'))
                                    <div class="col-md-12 px-0" id="test">
                                        <div class="balance-card total-amt-due" data-step="3"
                                            data-intro="This the amount which will be deducted from your account and credited to your vWallet balance. The more you add the closer you will be to your content completion.">
                                            <p>Job Budget: <span
                                                    class="amt-due">{{$wallet->currency->symbol}}{{$wallet->budget ?? '0'}}</span>
                                            </p>
                                            <p>Amount Paid: <span
                                                    class="amt-due">{{$wallet->currency->symbol}}{{$paid_m ?? '0'}}</span>
                                            </p>

                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-5 wallet" data-step="2"
                                    data-intro="@if(auth()->user()->hasRole('vendor')) This is the current amount which you have in escrow out of the total Job Budget. @else This is the current amount which will be available for you to deduct as payment. @endif">
                                    <div class="balance-card">
                                        {{$wallet->currency->symbol}}<span
                                            class="thebalance">{{$wallet->balance ?? '0'}}</span>
                                        <p><small>(Job Wallet Balance)</small></p>
                                        @if(auth::user()->hasRole('vendor'))
                                        <div class="p-row-header mt-4">
                                            <p style="font-weight: 500">
                                                <small><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                                    Credit Job wallet
                                                </small>
                                            </p>
                                        </div>
                                        <div class="percentage">
                                            <div class="percent-row">
                                                <a class="{{ $twenty_five == '1' ? 'marked' : '' }} percBtn"
                                                    data-perc="25" id="twenty_five" href="javascript:void(0);"
                                                    data-bs-target="{{ $twenty_five == '1' ? '' : '#creditWallet' }}"
                                                    data-bs-toggle="modal">
                                                    <div class="p-row-item text-center">
                                                        <p>25%</p>
                                                    </div>
                                                </a>
                                                <a class="{{ $fifty == '1' ? 'marked' : '' }} percBtn" data-perc="50"
                                                    id="fifty" href="javascript:void(0);"
                                                    data-bs-target="{{ $fifty == '1' ? '' : '#creditWallet' }}"
                                                    data-bs-toggle="modal">
                                                    <div class="p-row-item text-center">
                                                        <p>50%</p>
                                                    </div>
                                                </a>
                                                <a class="{{ $seventy_five == '1' ? 'marked' : '' }} percBtn"
                                                    data-perc="75" id="seventy_five" href="javascript:void(0);"
                                                    data-bs-target="{{ $seventy_five == '1' ? '' : '#creditWallet' }}"
                                                    data-bs-toggle="modal">
                                                    <div class="p-row-item text-center">
                                                        <p>75%</p>
                                                    </div>
                                                </a>
                                                <a class="{{ $hundred == '1' ? 'marked' : '' }} percBtn" data-perc="100"
                                                    id="hundred" href="javascript:void(0);"
                                                    data-bs-target="{{ $hundred == '1' ? '' : '#creditWallet' }}"
                                                    data-bs-toggle="modal">
                                                    <div class="p-row-item text-center">
                                                        <p>100%</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" data-step="1"
                                    data-intro="@if(auth()->user()->hasRole('vendor')) These are the 2 milestone payments for the Job; each payment you make will determine the state of your Job completion and delivery to you. Click 'Next' to credit your vWallet now. @else These are the 2 milestone payments for the Job; the Vendor will credit the vWallet before each Milestone. @endif">
                                    <div class="balance-card milestones">
                                        <p class="milestone-header">Milestones</p>
                                        <ul class="milestone-list">
                                            @if($milestones)
                                            @foreach ($milestones as $milestone)
                                            <li class="milestone-item {{ $milestone->completed == '1' ? 'done' : '' }}">
                                                <div>
                                                    <small>(Milestone)</small>
                                                    <p>{{$milestone->name == 'Video Watched' ? 'Content Provided' : $milestone->name}}
                                                    </p>
                                                </div>
                                                @if ($milestone->completed == '1')
                                                <div class="check-mark">
                                                    @if ($milestone->paid == '1')
                                                    <i class="fas fa-check-double"></i>
                                                    @else
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                                @endif

                                                <div>
                                                    <small>(Amount)</small>
                                                    <p class="amt">{{$wallet->currency->symbol}}{{$milestone->amt_due}}
                                                    </p>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="balance-card total-amt-due"
                                        data-intro="You Have to Create a Wallet for this Job, Payment for the job will be processed from the wallet.">
                                        <p>This Job does not have a wallet yet</p>
                                        @if(auth::user()->hasRole('vendor'))
                                        <a class="btn-sm btn-milestone"
                                            href="{{route('wallet.create', $job->unique_id)}}" role="button">Create</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if ($job->isAwarded)
                    <div class="shadow p-2 mt-4 text-center border-top-purple">
                        <!-- <a class="btn-sm mx-1 btn-default my-1 side-btn" href="#" role="button">
                                <span class="dot"></span>&nbsp;
                                Chat
                            </a> -->
                        <chat-btn :award-prop="true" :bid-prop="{{$job->bid_id}}" :user-prop="{{Auth::user()->id}}">
                        </chat-btn>

                        @if($pay && auth::user()->hasRole('vendor'))
                        <a class="btn-sm mx-1 btn-default my-1 side-btn {{$wallet->balance < $pay->amt_due ? 'not-allowed' : ''}}"
                            href="javascript:void(0);" @if($wallet->balance >= $pay->amt_due)
                            data-bs-target="#payCreative" data-bs-toggle="modal" @endif>
                            <i class="fa fa-money" aria-hidden="true"></i> &nbsp;
                            Pay <b>{{$wallet->currency->symbol}}{{$pay->amt_due}}</b>
                        </a>
                        @if($wallet->balance < $pay->amt_due)
                            <a class="btn-sm mx-1 btn-default my-1 side-btn open-vwallet" href="javascript:void(0);">
                                <i class="fa fa-credit-card" aria-hidden="true"></i> &nbsp;
                                Credit Wallet
                            </a>
                            @endif
                            @endif
                            @if($job->isCompleted == '1')
                            @if(auth::user()->hasRole('creative'))
                            @if($rated_vendor)
                            <a class="btn-sm mx-1 btn-default my-1 side-btn not-allowed" role="button" disabled>
                                <i class="fa fa-star" aria-hidden="true" style="color: orange;"></i> &nbsp;
                                Rate Vendor
                            </a>
                            @else
                            <a class="btn-sm mx-1 btn-default my-1 side-btn" href="javascript:void(0);"
                                data-bs-target="#rateVendor" data-bs-toggle="modal" role="button" role="button">
                                <i class="fa fa-star-o" aria-hidden="true"></i> &nbsp;
                                Rate Vendor
                            </a>
                            @endif
                            @endif
                            @if(auth::user()->hasRole('vendor'))
                            @if($rated_creative)
                            <a class="btn-sm mx-1 btn-default my-1 side-btn not-allowed" role="button" disabled>
                                <i class="fa fa-star" aria-hidden="true" style="color: orange;"></i> &nbsp;
                                Rate Creative
                            </a>
                            @else
                            <a class="btn-sm mx-1 btn-default my-1 side-btn" href="javascript:void(0);"
                                data-bs-target="#rateCreative" data-bs-toggle="modal" role="button">
                                <i class="fa fa-star-o" aria-hidden="true"></i> &nbsp;
                                Rate Creative
                            </a>
                            @endif
                            <a class="btn-sm mx-1 btn-default my-1 side-btn" href="#" role="button">
                                <i class="fas fa-chart-line"></i> &nbsp;
                                Boost sales
                            </a>
                            @endif
                            @endif
                    </div>
                    @endif
                    @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id &&
                    $video && $token && $token->verified_at == null)
                    <div class="mt-4" id="video-action" job='{{ $job }}'></div>
                    @endif

                    @if ($video)
                    @if (auth::user()->hasRole('vendor') && $job->vendor->user_id === Auth::user()->id
                    && $milestone_video->paid === '1' && $milestone_video->completed
                    === '1')
                    <div class="shadow p-4 mt-4">
                        <a href="{{ route('user.job.video.download', $job->id) }}">
                            <div class="text-center d-flex justify-content-center" style="cursor: pointer">
                                <div class="d-flex justify-content-center align-items-center p-3 rounded-lg"
                                    style="background: #6f3c96; width: 60px; height: 60px;">
                                    <svg width="75" height="64" viewBox="0 0 75 64" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="75" height="64" fill="url(#pattern0)" />
                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0_623_3" transform="scale(0.0133333 0.015625)" />
                                            </pattern>
                                            <image id="image0_623_3" width="75" height="64"
                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEsAAABACAYAAABSiYopAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAABARpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IlhNUCBDb3JlIDUuNC4wIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgICAgICAgICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iPgogICAgICAgICA8eG1wOk1vZGlmeURhdGU+MjAyMi0wMS0yOVQwODo1OTowOTwveG1wOk1vZGlmeURhdGU+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIDIyLjUgKE1hY2ludG9zaCk8L3htcDpDcmVhdG9yVG9vbD4KICAgICAgICAgPHRpZmY6T3JpZW50YXRpb24+MTwvdGlmZjpPcmllbnRhdGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+NzI8L3RpZmY6WVJlc29sdXRpb24+CiAgICAgICAgIDx0aWZmOkNvbXByZXNzaW9uPjE8L3RpZmY6Q29tcHJlc3Npb24+CiAgICAgICAgIDx0aWZmOlJlc29sdXRpb25Vbml0PjI8L3RpZmY6UmVzb2x1dGlvblVuaXQ+CiAgICAgICAgIDx0aWZmOlBob3RvbWV0cmljSW50ZXJwcmV0YXRpb24+MjwvdGlmZjpQaG90b21ldHJpY0ludGVycHJldGF0aW9uPgogICAgICAgICA8dGlmZjpYUmVzb2x1dGlvbj43MjwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPGV4aWY6UGl4ZWxYRGltZW5zaW9uPjc1PC9leGlmOlBpeGVsWERpbWVuc2lvbj4KICAgICAgICAgPGV4aWY6Q29sb3JTcGFjZT4xPC9leGlmOkNvbG9yU3BhY2U+CiAgICAgICAgIDxleGlmOlBpeGVsWURpbWVuc2lvbj42NDwvZXhpZjpQaXhlbFlEaW1lbnNpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgqe3hzHAAADU0lEQVR4Ae2ZzXHbQAyFpUwOOeSgEliC0wFdgZUO2EGcCshU4KQCOZVIrsDqgOnAmskhR+U9hcusoaUcxFxyJQIz0O6CEAF8BH9EzWaJyX6/v4WuoVViqaWVDgAVUF+SAvYmLVyzTOQj12LzsMvUYA1bvTKawVIAM1gGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBBSu1lkGS0FA4WqdZbAUBM7VFS/ft/4LeK5TqsVOQ8XRMFgGS0FA4WqdZbAUBBSu1llaWLhF59CKo+K7F+8KHgto1haKxRXUl2W7ceAJkkjmOQu5kMtTA6bGuOBpWAgmN2I91eUdCl80xWcYl4TlDI3dhg4CmV3gO8iEzAYrRKXDFhUWL4rUjti9moeIFQ0Wki9Ao4byjlJhjCbY/y12Hj1WNFhIvoS6ripjAWv269+5GMvF7fUAxYQlE2YRVZ/ZN/vjQRlEYsL6EqigN2AnQFXz+XwXiP1qUzRYSPgrsqsCGb4a2AugQgcpkIbeFA0WUwEwJl5xLuS/gY0FivlHhcUAfQIbE9QgsPoCNjaowWC9FlgKoFjDW34MJTwlUTjDVSJm2diFeTZLBdQhMSRzD/VldZRxzwYEK/2A3vynN+f0l1i7ZfRnKwRau2DNWEW/wIc4n7jovxf+78SaSz5HRXs8CMRrTaPAYvQTwNrkApPRQDGX0WAxuBLYqKBGh6UANjqoJGD9A7AkQDHPw61ZXPUfDxtG+EAepcgl+l2vq0zkUYtcCsIqhPGpawdD2Jt8VhyHiBeKgdh8wyslJyz+PyYlD+1kKjbAkA1EPn/ez2Hi/kykkbKeCphQnai/JgRP/vKAsfI2uGke2tGl21D8JwfAG4u2bhh5jsruqmHLWqcJTFAvL0lHHI5Kh1Oou2rYJwEMdeZQCQqmjhsNNjxya0BK2C4SGuriWXUHDcnK76q5v4A3gfBixlEK/wTYQB+gW+g5C+9sGfQGegXlWgprvMZPsp3b8AwWjS8Ac9+79HGDAj/6oFjw0Q9pOPyA/QP0O3SK8g0MriUogjjqLJ8Ouowtyn97c99+ofMN6voMSDz9gnISlvtGc2ouseY5voAS4jnLDslTt9AH6H2ok2B/Jr8BBnkcXsyAnt8AAAAASUVORK5CYII=" />
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 text-center text-snd">
                                Download Content
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
                                xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#uploadVideo">
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
                            @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id &&
                            $job->influencer == null)
                            <small class="mb-3">Award Job to see Creative Details</small>
                            @else
                            <ul class="nav mb-4">
                                <li
                                    class="nav-item text-tiny d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                                    <div>
                                        <div><i class="fas fa-map-marker-alt text-muted mr-2"></i> Country</div>
                                    </div>
                                    <div>
                                        @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id ==
                                        Auth::user()->id)
                                        @if ($job->influencer !== null)
                                        @if ($job->influencer->country_id)
                                        <div class="text-snd">
                                            {{ $job->influencer->country->name }}</div>
                                        @else
                                        <div class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                            Verified</div>
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
                                        <div class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                            Verified</div>
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
                                        @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id ==
                                        Auth::user()->id)
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

                            @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id &&
                            $job->influencer == null)
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
                                    <div><i aria-hidden="true" class="fa fa-phone text-muted mr-2"></i>
                                        Phone Number
                                    </div>
                                    @if (Auth::user()->hasRole('vendor') && $job->vendor->user_id == Auth::user()->id)
                                    <div>
                                        @if ($job->influencer !== null)
                                        @if (!$job->influencer->isPhoneVerified)
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
                                        @if (!$job->influencer->flutterwaveSubaccount)
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
@if(Auth::user()->hasRole("vendor"))
<div class="modal fade" id="newContent" tabindex="-1" role="dialog" aria-labelledby="newContent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="new">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    New Content!
                </h6>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>The Creative has just uploaded your content. Reloading...</p>

            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->hasRole("creative"))
<div class="modal fade" id="BidPlaced" tabindex="-1" role="dialog" aria-labelledby="newContent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="new">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Your Bid Was Accepted!
                </h6>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>The Vendor For this Job has awarded you the job. Please Wait...</p>

            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->hasRole("creative"))
<div class="modal fade" id="WalletUpdate" tabindex="-1" role="dialog" aria-labelledby="newContent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="new">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Wallet Update!
                </h6>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>The Vendor For this Job has Credited the job wallet. Please Wait...</p>

            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->hasRole("creative"))
<div class="modal fade" id="WalletUpdate2" tabindex="-1" role="dialog" aria-labelledby="newContent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="new">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Milestone Payment!
                </h6>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>The Vendor For this Job has Paid a Milestone. Please Wait...</p>

            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->hasRole("creative"))
<div class="modal fade" id="milestone1" tabindex="-1" role="dialog" aria-labelledby="milestone1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="new">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Milestone Payment!
                </h6>
                <button type="button" class="close" data-dismsiss="modal" onclick="location.reload()"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 3rem;">
                <center>
                    <img src="/confirmed.svg" style="width: 200px; margin-bottom: 20px;margin-top: 20px;" />
                    <p>You have been credited <b>
                            @if($milestones){{$wallet->currency->symbol}}{{$milestones[0]->amt_due}} @endif</b> for The
                        Milestone: <b>VIDEO UPLOADED</b> , check your email for further instructions</p>
                </center>
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

@push('scripts')
@if ($job->isAwarded)
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

// $('.chat-message').on('click', function(){
//     // do ajax to get messages and populate message div
//     $('#individual-chat').fadeIn('fast');
//     var pos = $('.individual-chat-history').offset().top + 10000000;
//     $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
// })
</script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"
    integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var authEndpoint = '{{ route("pusher.auth") }}';
    var aje = '{{ route("approve.video") }}';
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
<!-- <script src="{{ asset('client/chat/index.js') }}"></script> -->
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
        if (/#pills-vwallet-tab/.test(window.location.href)){
            $('#pills-vwallet-tab').tab('show');
        }
        $('.open-vwallet').click(function() {
            $('#pills-vwallet-tab').tab('show');
        });
        $(".unawarded-bid").parent().css({"background-color": "#ededed", "padding-bottom":"5px"});
        $(".unawarded-bid").parent().removeClass(['bg-white', 'p-2', 'pb-3', 'shadow']);
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
            },
            invalidHandler: function(event, validator) {
            // 'this' refers to the form
            $("#bidbtn").attr("disabled", false);
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

<script>
    jQuery('document').ready(function() {
        
        // $('#twenty_five').on('click', function(){
        //     deposit('25');
        // });
        // function deposit (perc) {
        //     let px = FlutterwaveCheckout({
        //         public_key: "FLWPUBK_TEST-647f6289f74aba024f10cc12f71bd6a2-X",
        //         tx_ref: "VC-" + Date.now() + "-" + Math.random(),
        //         amount: 100, //remove  5 on test mode removal
        //         currency: "NGN",
        //         country: "US",
        //         payment_options:
        //             "card,ussd,qr,barter,mobilemoneyghana,mobilemoneyrwanda,banktransfer,paypal",
        //         // specified redirect URL
        //         subaccounts: [{ id: 2 }],
        //         meta: {
        //             consumer_id: 23,
        //             consumer_mac: "92a3-912ba-1192a",
        //         },
        //         customer: {
        //             email: "cornelius@gmail.com",
        //             phone_number: "08102909304",
        //             name: "Test Subject",
        //         },
        //         callback: function (data) {
        //             console.log(data);
        //             if (data.status === "successful") {
        //                 window.location.protocol = "https:";
        //                 window.location.href = `/jobs/details/${uniqueId}/?tx-ref=${data.tx_ref}`;
        //                 px.close();
        //             }
        //         },
        //         customizations: {
        //             title: `Payment for job #${jobId}`,
        //             description: description,
        //             logo: "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
        //         },
        //     });
        // }
    });
    window.Echo.private('new-bid')
    .listen('NewBid', (e) => {
        console.log(e);
        if("{{$job->id}}" == e.job.id){
            var id = e.job.id;

        }
    });
    @if(Auth::user()->hasRole("vendor"))
    window.Echo.private('new-content')
    .listen('ContentUploaded', (e) => {
        // console.log(e);
        if("{{$job->id}}" == e.job.id){
            var id = e.job.id;
            $('#pills-content-tab').tab('show');
            localStorage.setItem("openTab", "pills-content-tab");
            $('#newContent').modal('show');
            setTimeout(() => {
            location.reload();
            }, 3000);
        }
    });
    @endif
    @if(Auth::user()->hasRole("creative"))
    window.Echo.private('bid-accepted')
    .listen('BidAccepted', (e) => {
        // console.log(e);
        if("{{$job->id}}" == e.job.id){
            var id = e.job.id;

            // $('#pills-content-tab').tab('show');
            @if("{{$job->influencer_id}}" == "{{Auth::user()->id}}")
            $('#BidPlaced').modal('show');
            $('#pills-vwallet-tab').tab('show');
            localStorage.setItem("openTab", "pills-vwallet-tab");
            @endif
            setTimeout(() => {

            location.reload();
            }, 3000);
        }
    });
    @endif
    @if(Auth::user()->hasRole("creative"))
    window.Echo.private('wallet-updated')
    .listen('WalletUpdated', (e) => {
        console.log(e);
        if("{{$job->id}}" == e.wallet.job_id){
            var id = e.wallet.job_id;
            $('#WalletUpdate').modal('show');
            setTimeout(() => {

            location.reload();
            }, 3000);
            // $(".thebalance").text(e.wallet.balance)
            // $(".error").hide();
        }
    });
    @endif

    @if(Auth::user()->hasRole("creative"))
    window.Echo.private('first-milestone')
    .listen('Milestone1', (e) => {
        console.log(e);
        if("{{$job->id}}" == e.job.id){
            var id = e.job.id;
            $('#milestone1').modal('show');
            // setTimeout(() => {

            // location.reload();
            // }, 3000);
            // $(".thebalance").text(e.wallet.balance)
            // $(".error").hide();
        }
    });
    @endif
    @if(Auth::user()->hasRole("creative"))
    window.Echo.private('wallet-updated2')
    .listen('WalletUpdated2', (e) => {
        console.log(e);
        if("{{$job->id}}" == e.wallet.job_id){
            var id = e.wallet.job_id;
            $('#WalletUpdate2').modal('show');
            setTimeout(() => {

            location.reload();
            }, 3000);
            // $(".thebalance").text(e.wallet.balance)
            // $(".error").hide();
        }
    });
    @endif
    @if(!$wallet && auth()->user()->hasRole("Creative") && DB::table("bids")->where("influencer_id", auth()->user()->id)->count() < 1 && Auth::user()->country_id == '' || Auth::user()->flutterwaveSubaccount == '' || Auth::user()->email_verified_at == '')
    jQuery(document).ready(function() {
    setTimeout(() => {
        if(localStorage.getItem("tour_1") && localStorage.getItem("tour_1") == 'yes'){
        return false;
        }
        setTimeout(() => {
@if(auth()->user()->hasRole("creative"))
$('#pills-details-tab').tab('show');
             var intro4 = introJs();
             $('#pills-details-tab').tab('show');
    intro4.setOptions({
      doneLabel: 'Update My Info',
      steps: [
      {
        element: document.querySelector('.update-t'),
        intro: "Don't forget to Update your info before making a bid!!!",
        position: 'left'
      },
      ]
    });
    intro4.oncomplete(function() {
  window.location.href = 'setting';
});
       @endif

    intro4.start().oncomplete(function() {
        localStorage.setItem("tour_1", "yes");
    });
}, 500);
        }, 3000)
    })
    @endif
    @if($wallet)
    @if(auth::user()->hasRole('vendor') && DB::table('jobs')->where("vendor_id", $job->vendor->id)->count() < 3  && !$wallet->balance && $milestones && !$milestones[0]->paid)
    // $("#pills-vwallet-tab").tab('show')
    // alert('{{$job->payment_milestone}}')
    setTimeout(() => {
        $('#pills-vwallet-tab').tab('show');
        setTimeout(() => {
        introJs().start();
        }, 2000);
    }, 3000);
    @elseif(auth::user()->hasRole('creative') && DB::table('jobs')->where("influencer_id", $job->influencer->id)->count() < 3 && !$wallet->balance && $milestones && !$milestones[0]->paid)
    setTimeout(() => {
        $('#pills-vwallet-tab').tab('show');
        setTimeout(() => {
        introJs().start();
        }, 2000);
    }, 3000);

    @endif
    @endif
    // alert("test")
    const form = document.getElementById("payFormS");
    const payBtn = document.getElementById("payBtnS");


    form.addEventListener("submit", (e) => {
     payBtn.disabled = true;
     payBtn.innerHTML = 'Payment In Progress.....';
    })


    function delete_bid(){

    $.post('/jobs/remove-bid',{
          id: "{{auth()->user()->id}}",
          jobid: "{{$job->id}}",
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
    }
</script>

@endpush
@endsection