@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<style>
    .TpYPE,
    .flwOWS,
    .ConENT,
    .PSERev,
    .SKills,
    .cHarge,
    .turARND,
    .Curr,
    .Clients,
    .skills {
        display: none;
    }

    .form-group {
        transition: .5s;
    }

    .error {
        color: red;
        display: block;
        margin-top: .5rem;
    }


    .tab-pane {
        display: none;
        animation-fill-mode: forwards;
        /* Ensures the element remains in the state set by the final keyframe */
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Existing styles */
    .error {
        font-weight: 400 !important;
        font-size: 12px;
        color: red;
    }

    .big-font {
        font-size: 16px;
        font-weight: 500;
    }

    .product-label {
        font-size: 14px !important;
        font-weight: 500 !important;
    }

    /* Stepper Wrapper Styles */
    .stepper-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }

    .stepper-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-counter {
        width: 30px;
        height: 30px;
        border: 2px solid #6F3C96;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
        background-color: #fff;
        z-index: 2;
    }

    .stepper-item.completed .step-counter {
        background-color: #6F3C96;
        color: white;
    }

    .progress-bar-line,
    .progress-bar-active {
        position: absolute;
        top: 14px;
        height: 5px;
        width: 90%;
        left: 57px;
        /* Adjusted for full width */
        z-index: 1;
    }

    .progress-bar-line {
        background-color: #ccc;
    }

    .progress-bar-active {
        background-color: #6F3C96;
        transition: width 0.5s ease;
        /* Smooth transition for the progress bar */
    }

    .form-control {
        border: 0 !important;
        border-bottom: 2px solid #dee2e6 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        padding: 0px !important;
        font-size: 15px !important;
    }

    .form-select {
        height: 48px !important;
        border: 0 !important;
        border-bottom: 2px solid #dee2e6 !important;
        padding: 0 !important;
        font-size: 15px !important;
    }

    .form-control:focus {
        border-bottom-color: #007bff;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .generalPostContainer {
        padding: 2rem !important;
        height: auto !important;
        min-height: 143px !important;
        background: var(--snd-color);
        padding-top: 3rem !important;
    }

    .bg-color {
        background: #6f3c96;
        padding: 10px 0 0 0;
        height: 33px;
        width: 33px;
        text-align: center;
        cursor: pointer;
    }

    .arrow-btn {
        float: right;
        margin-top: 100px;
    }

</style>
@section('content')
@include('includes.messages')
<div id="scrl" style="height: 95vh; overflow: auto;">
    <div class="generalPostContainer mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 style="color: #fff"><strong>Become a Creative. </strong></h2 style="color: #fff">

            </div>

        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="container mt-5">
                        <div class="stepper-wrapper mb-5">
                            <div class="stepper-item completed" id="step1Indicator">
                                <div class="step-counter">1</div>
                                <div>Creative Experience</div>
                            </div>
                            <div class="stepper-item" id="step2Indicator">
                                <div class="step-counter">2</div>
                                <div>Content Details </div>
                            </div>
                            <div class="stepper-item" id="step3Indicator">
                                <div class="step-counter">3</div>
                                <div>Social Media Handles and Rates</div>
                            </div>
                            <div class="stepper-item" id="step4Indicator">
                                <div class="step-counter">4</div>
                                <div>Submit</div>
                            </div>
                            <div class="progress-bar-line"></div>
                            <div class="progress-bar-active" style="width: 0%;" id="progressBar"></div>

                        </div>
                        <div class="row justify-content-center bg-white">


                            <!-- Step Contents -->
                            <div class="p-5 col-md-10">
                                <form id="iform" action="{{route('store.creative')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1" class="tab-pane">
                                        <h3>Creative Experience</h3>
                                        <p>Tell us about your experience as a creative.</p>
                                        <div class="form-group mb-5">
                                            <label class="product-label" for="">I've been a creative for?</label>
                                            <select name="influencer_years_experience"
                                                class="form-select @error('influencer_years_experience') is-invalid @enderror">
                                                <option value="less than a year">less than 1 year</option>
                                                <option value="1-5">1-5 years</option>
                                                <option value="5-15">5-15 years</option>
                                                <option value="15 plus">15+ years</option>
                                            </select>
                                            @error('influencer_years_experience')
                                            <div class="error-message invalid-feedback"
                                                id="influencer_years_experience_error"></div>
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-5">
                                            <label class="product-label" for="">I have this many followers?</label>
                                            <select name="influencer_followers"
                                                class="form-select @error('influencer_followers') is-invalid @enderror">
                                                <option value="Nano Influencers">Nano-creative (1k-10k followers)
                                                </option>
                                                <option value="Micro Influencers">Micro-creative (10k-50k followers)
                                                </option>
                                                <option value="Mid tier-influencer">Mid tier-creative (50k-500k
                                                    followers)
                                                </option>
                                                <option value="Macro Influencers">Macro-creative (500k-1M followers)
                                                </option>
                                                <option value="Mega Influencers">Mega-creative (1M+ followers)</option>
                                            </select>
                                            @error('influencer_followers')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <div class="form-group mb-5">
                                                <label class="product-label" for="">I've created brand content before
                                                    for
                                                    the following:</label>
                                                <select name="influencer_previous_job"
                                                    class="form-select @error('influencer_previous_job') is-invalid @enderror">
                                                    <option value="an Individual">an Individual</option>
                                                    <option value="Yourself">Yourself</option>
                                                    <option value="Business">Business</option>
                                                    <option value="All of the above">All of the above</option>
                                                    <option value="None of the above">None of the above</option>
                                                </select>
                                                @error('influencer_previous_job')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="nextStep(2, 'next')">Continue
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
                                                        fill="white" />
                                                </svg></button>
                                            <div class="d-flex arrow-btn">
                                                <div class="mr-1 bg-color">
                                                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.7"
                                                            d="M2.36723 11.5264C1.27836 12.6727 -0.445679 10.8577 0.733928 9.71131L8.62822 1.30468C9.08191 0.827029 9.89857 0.827029 10.3523 1.30468L18.3373 9.71131C19.4262 10.8577 17.7021 12.6727 16.6133 11.5264L9.53561 4.07505L2.36723 11.5264Z"
                                                            fill="white" />
                                                    </svg>

                                                </div>
                                                <div class="bg-color" onclick="nextStep(2, 'next')">
                                                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.95"
                                                            d="M16.5173 1.30953C17.6062 0.163171 19.3302 1.97824 18.1506 3.1246L10.2563 11.5312C9.80261 12.0089 8.98596 12.0089 8.53226 11.5312L0.54723 3.1246C-0.541639 1.97824 1.1824 0.163171 2.27127 1.30953L9.34891 8.76086L16.5173 1.30953Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step2" class="tab-pane" style="display:none;">
                                        <h3>Content Details</h3>
                                        <p>Provide information about the content you create..</p>
                                        <div class="form-group mb-5">
                                            <label class="product-label" for="">What's an average fee you charge for
                                                making
                                                your content?</label>
                                            <select name="influencer_charges"
                                                class="form-select @error('influencer_charges') is-invalid @enderror">
                                                <option value="10-100">$10-$100</option>
                                                <option value="101-1000">$101-$1000</option>
                                                <option value="1001-2500">$1001-$2500</option>
                                                <option value="2501-5000">$2501-$5000</option>
                                                <option value="5001-10000">$5001-$10000</option>
                                                <option value="10001-50000">$10001-$50000</option>
                                                <option value="50001-100000">$50001-$100000</option>
                                                <option value="100001-1000000">$100001-$1000000</option>
                                                <option value="1000001 and above">1M+</option>
                                            </select>
                                            @error('influencer_charges')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group mb-5">
                                            <label for="" class="product-label">Where do you find clients who request
                                                your
                                                service?</label>
                                            <select name="influencer_clients"
                                                class="form-select @error('influencer_clients') is-invalid @enderror">
                                                <option value="Instagram">Instagram</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Facebook">Facebook</option>
                                            </select>
                                            @error('influencer_clients')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                    </div>
                                    @enderror
                            </div> --}}
                            <div class="form-group mb-5">
                                <label for="" class="product-label">What type of Products/Services do you
                                    produce content
                                    for?</label>
                                <select name="inflencer_services_provided" id="ct"
                                    class="form-select @error('inflencer_services_provided') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->name}}" @if (old('category_id')==$category->id)
                                        {{'selected'}}@endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('inflencer_services_provided')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group mb-5">
                                            <label for="" class="product-label">What is your turn-around time for making
                                                content?</label>
                                            <select name="influencer_turnaround_time"
                                                class="form-select @error('influencer_turnaround_time') is-invalid @enderror">
                                                <option value="Few hours">Few hours</option>
                                                <option value="Few days">Few days</option>
                                                <option value="Few weeks">Few weeks</option>
                                            </select>
                                            @error('influencer_turnaround_time')
                                            <div class="invalid-feedback">
                                                {{$message}}
                        </div>
                        @enderror
                    </div> --}}
                    <div>
                        <button type="button" class="btn btn-secondary" onclick="nextStep(3, 'next')">Continue
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
                                    fill="white" />
                            </svg></button>
                        <div class="d-flex arrow-btn">
                            <div class="mr-1 bg-color" onclick="nextStep(1, 'prev')">
                                <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.7"
                                        d="M2.36723 11.5264C1.27836 12.6727 -0.445679 10.8577 0.733928 9.71131L8.62822 1.30468C9.08191 0.827029 9.89857 0.827029 10.3523 1.30468L18.3373 9.71131C19.4262 10.8577 17.7021 12.6727 16.6133 11.5264L9.53561 4.07505L2.36723 11.5264Z"
                                        fill="white" />
                                </svg>

                            </div>
                            <div class="bg-color" onclick="nextStep(3, 'next')">
                                <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.95"
                                        d="M16.5173 1.30953C17.6062 0.163171 19.3302 1.97824 18.1506 3.1246L10.2563 11.5312C9.80261 12.0089 8.98596 12.0089 8.53226 11.5312L0.54723 3.1246C-0.541639 1.97824 1.1824 0.163171 2.27127 1.30953L9.34891 8.76086L16.5173 1.30953Z"
                                        fill="white" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step3" class="tab-pane" style="display:none;">
                    <h3>Project Information</h3>
                    <p>Tell your content creator what it is you actually need.</p>
                    <div class="form-group mt-5 mb-5">
                        <label for="instagram_handle" class="product-label">What is your Instagram
                            Handle <span class="required">*</span></label>
                        <input type="text" name="instagram_handle" id="instagram_handle" class="form-control" required>
                        <div class="error-message invalid-feedback" id="instagram_handle_error">
                        </div>
                        @error('instagram_handle')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group mb-5">
                        <label for="twitter_handle" class="product-label">What is your Twitter
                            Username?</label>
                        <input type="text" name="twitter_handle" class="form-control">
                        @error('twitter_handle')
                        <div class="invalid-feedback">
                            {{$message}}
                </div>
                @enderror
            </div> --}}
            <div class="form-group mb-5">
                {{-- <label for="tiktok_handle" class="product-label">What is your Tiktok
                            Handle</label>
                        <input type="text" name="tiktok_handle" class="form-control">
                        @error('tiktok_handle')
                        <div class="invalid-feedback">
                            {{$message}}
            </div>
            @enderror --}}

            <div class="form-group mb-5 mt-5">
                <label class="product-label">Select Your Experience Level <span class=" required">*</span></label>
                <select name="experience_level" id="experience_level"
                    class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                    aria-label="Default select example" required>
                    <option selected disabled>Select Experience Level</option>
                    <option value="beginner"> I’m a beginner but I’m ready to bid
                    </option>
                    <option value="intermediate"> I kind of know how this works, so
                        let’s get going.
                    </option>
                    <option value="expert"> I’m an expert so, show me the jobs
                    </option>
                </select>
                @error('experience_level')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group mb-5">
                <label class="product-label">Your Charge Per Hour in USD($) <span class=" required">*</span></label>
                <select name="charge_per_hour" id="charge_per_hour"
                    class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                    aria-label="Default select example" required>
                    <option selected disabled>Select Charge Per Hour</option>
                    <option value="$10/hour to $50/hour">$10/hour to $50/hour
                    </option>
                    <option value="$10/hour to $250/hour"> $10/hour to $250/hour
                    </option>
                    <option value="$10/hour to $500/hour"> $10/hour to $500/hour
                    </option>
                </select>
                @error('charge_per_hour')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

        </div>
        <div>
            <button type="button" class="btn btn-secondary" onclick="nextStep(4, 'next')">Continue
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z" fill="white" />
                </svg>
            </button>
            <div class="d-flex arrow-btn">
                <div class="mr-1 bg-color" onclick="nextStep(2, 'prev')">
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.7"
                            d="M2.36723 11.5264C1.27836 12.6727 -0.445679 10.8577 0.733928 9.71131L8.62822 1.30468C9.08191 0.827029 9.89857 0.827029 10.3523 1.30468L18.3373 9.71131C19.4262 10.8577 17.7021 12.6727 16.6133 11.5264L9.53561 4.07505L2.36723 11.5264Z"
                            fill="white" />
                    </svg>

                </div>
                <div class="bg-color" onclick="nextStep(4, 'next')">
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.95"
                            d="M16.5173 1.30953C17.6062 0.163171 19.3302 1.97824 18.1506 3.1246L10.2563 11.5312C9.80261 12.0089 8.98596 12.0089 8.53226 11.5312L0.54723 3.1246C-0.541639 1.97824 1.1824 0.163171 2.27127 1.30953L9.34891 8.76086L16.5173 1.30953Z"
                            fill="white" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div id="step4" class="tab-pane" style="display:none;">
        <div class="text-center">
            <svg width="158" height="144" viewBox="0 0 158 144" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="14.4922" y="0.353027" width="51.5427" height="51.5427" rx="10" fill="#9E96FF" />
                <rect opacity="0.5" x="128.443" y="33.2231" width="29.3594" height="29.3594" rx="10" fill="#9E96FF" />
                <rect opacity="0.5" x="0.443359" y="75.2231" width="31.5329" height="31.5329" rx="8" fill="#DEDBFF" />
                <rect opacity="0.5" x="114.73" y="107.174" width="36.5935" height="36.5935" rx="8" fill="#DEDBFF" />
                <circle cx="83.9199" cy="78.7285" r="60" fill="#6F3C96" />
                <g filter="url(#filter0_d_50_124)">
                    <path d="M61.2031 81.9732L74.1836 94.9537L106.635 62.5024" stroke="white" stroke-width="8"
                        stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <filter id="filter0_d_50_124" x="27.2031" y="32.5024" width="113.432" height="100.451"
                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                            result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="15" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0.290196 0 0 0 0 0.227451 0 0 0 0 1 0 0 0 0.3 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_50_124" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_50_124" result="shape" />
                    </filter>
                </defs>
            </svg>
            <h5 class="mb-3 mt-3">Submit</h5>
            <span class="mb-3">Double-check your information before submitting. Once
                you're
                ready,
                click
                submit.</span>
            <br>
            <button type="submit" class="btn btn-secondary mt-5" id="submitJob">Submit
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z" fill="white" />
                </svg>
            </button>
        </div>
    </div>
    </form>
</div>

</div>
</div>
<div class="jbcontainerGeneral bg-white p-4 d-none">
    <div class="card shadow">
        <div class="card-header text-uppercase text-snd">Become a Creative</div>
        <div class="card-body">

            @include('includes.creativevideo')
            <h6 class="fs-4">We have just a few questions to get you up and running</h6>
            {{-- <div class="row profile-div">
                                    <div class="form-group col-md-6">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}"
            placeholder="Enter your Email Address" required>
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <div class="info-row"></div>
            <button type="button" class="btn btn-success btn-snd mt-3 email-btn">Continue</button>
        </div>
        <input type="hidden" name="guser" value="1">
        <div class="form-group col-md-6">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" value="{{old('password')}}"
                placeholder="Enter your Password" required>
            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div> --}}




    {{-- <div class="form-group SKills">
                                    <label for="">What skills help you create your content?</label>
                                    <select name="influencer_skills[]"
                                        class="skills @error('influencer_skills') is-invalid @enderror">
                                        @foreach ($skills as $skill)
                                        <option value="{{$skill->skill}}">{{$skill->skill}}</option>
    @endforeach
    </select>
    @error('influencer_skills')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
    <button type="button" class="btn btn-primary btn-snd mt-2 SKills-btn">Continue</button>
</div> --}}


<div class="row Handls" style="display: none;">
    <div class="form-group col-md-12">
        <label for="instagram_handle" class="product-label">What is your Instagram Handle <span
                class="required">*</span></label>
        <input type="text" name="instagram_handle" class="form-control" placeholder="Provide your Instagram handle"
            required>
        @error('instagram_handle')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="twitter_handle" class="product-label">What is your Twitter Username?</label>
        <input type="text" name="twitter_handle" class="form-control" placeholder="Provide your Twitter username">
        @error('twitter_handle')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="tiktok_handle" class="product-label">What is your Tiktok Handle</label>
        <input type="text" name="tiktok_handle" class="form-control" placeholder="Provide your Tiktok handle">
        @error('tiktok_handle')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror


        <div class="row my-3">
            <div class="col-md-6">
                <label>Select Your Experience Level <span class="required">*</span></label>
                <select name="experience_level" id="experience_level"
                    class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                    aria-label="Default select example" required>
                    <option selected disabled>Select Experience Level</option>
                    <option value="beginner"> I’m a beginner but I’m ready to bid </option>
                    <option value="intermediate"> I kind of know how this works, so let’s get going.
                    </option>
                    <option value="expert"> I’m an expert so, show me the jobs </option>
                </select>
                @error('experience_level')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="col-md-6">
                <label>Your Charge Per Hour in USD($) <span class="required">*</span></label>
                <select name="charge_per_hour" id="charge_per_hour"
                    class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                    aria-label="Default select example" required>
                    <option selected disabled>Select Charge Per Hour</option>
                    <option value="$10/hour to $50/hour">$10/hour to $50/hour</option>
                    <option value="$10/hour to $250/hour"> $10/hour to $250/hour </option>
                    <option value="$10/hour to $500/hour"> $10/hour to $500/hour </option>
                </select>
                @error('charge_per_hour')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <button type="button" class="btn btn-success btn-snd mt-2 handls-btn">Continue</button>

        </div>

    </div>
    <div class="row Curr" style="display: none;">
        <div class="form-group col-md-6">
            <label for="" class="product-label">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter First name"
                value="{{old('first_name')}}" required>
            @error('first_name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror

        </div>
        <div class="form-group col-md-6">
            <label for="" class="product-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter Last name"
                value="{{old('last_name')}}" required>
            @error('last_name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <div class="form-floating d-flex stf mt-3 rounded">
                <span class="input-group-text bg-transparent" style="border: 0;">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </span>
                <input type="text" name="ref_code"
                    class="form-control rounded-0 border-0 st-input @error('email') is-invalid @enderror"
                    placeholder="Referral Code" value="{{old('ref_code')}}">
                <label for="ref_code" style="margin-left: 37px">AUC Code (Optional)</label>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group mb-0">
                {{-- CAPTCHA --}}
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
            </div>
            @error('g-recaptcha-response')
            <div id="captchaValidation" class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="button" onclick="opn()" class="btn btn-success btn-snd mt-2">Finish</button>
    </div>
    <input type="hidden" name="direct" value="yes">
    </form>
    <div class="form-check pl-0">
        <label class="form-check-label">
            By clicking continue you agree to our <a href="{{route('public.terms')}}" class="text-main">terms and
                conditions</a>
        </label>
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
<script src="{{asset('/js/select2.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the form by showing the first step and attaching validation listeners
        showStep(1,null);
        attachValidationListeners();
    });
    
    function attachValidationListeners() {
        // Attach event listeners to all input fields for real-time validation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                validateField(input);
            });
        });
    }
    
    function validateField(field) {
        const errorDiv = document.getElementById(field.id + '_error');
        console.log(errorDiv);
        if (errorDiv) {
            if (!field.checkValidity()) {
                if (field.validity.valueMissing) {
                    errorDiv.textContent = 'This field is required.';
                } else if (field.validity.typeMismatch) {
                    errorDiv.textContent = 'Please enter a valid value.';
                } else {
                    errorDiv.textContent = 'This field is incorrectly filled.';
                }
                errorDiv.style.display = 'block';
            } else {
                errorDiv.textContent = '';
                errorDiv.style.display = 'none';
            }
        }
    
        updateContinueButtonState(field.closest('.tab-pane').id);
    }
    
    function updateContinueButtonState(stepId) {
        const step = document.getElementById(stepId);
        const isValid = Array.from(step.querySelectorAll('.form-control')).every(input => input.checkValidity());
        const continueButton = step.querySelector('.continue-btn');
        // continueButton.disabled = !isValid;
    }
    
    function showStep(step, direction) {
        // Hide all steps first
        const allSteps = document.querySelectorAll('.tab-pane');
        allSteps.forEach(tab => {
            tab.style.display = 'none'; // Ensure all steps are hidden
        });
    
        // Find the next step element
        const nextStepEl = document.getElementById('step' + step);
        nextStepEl.style.display = 'block'; // Show the next step
    
        // Apply the appropriate animation based on the direction
        if (direction === 'next') {
            nextStepEl.style.animation = 'slideInUp 0.5s forwards';
        } else if (direction === 'prev') {
            nextStepEl.style.animation = 'slideInDown 0.5s forwards';
        }
    
        // Update the progress bar and indicators
        updateProgressBar(step);
        updateIndicators(step);
    }
    
    function updateProgressBar(step) {
        const progressBar = document.getElementById('progressBar');
        // Assuming 5 steps, adjust the percentage calculation as needed
        const percentage = ((step - 1) / (4 - 1)) * 90; // Corrected to fill up to 100%
        progressBar.style.width = percentage + '%';
    }
    
    function updateIndicators(step) {
        document.querySelectorAll('.stepper-item').forEach((item, index) => {
            if (index < step - 1) {
                item.classList.add('completed');
            } else {
                // item.classList.remove('completed');
            }
        });
    }
    
    function nextStep(step, direction) {
        const currentStep = document.getElementById('step' + step);
        let nextStep;
        // if (direction === 'next') {
        //     nextStep = step + 1;
        // } else if (direction === 'prev') {
        //     nextStep = step - 1;
        // }
        if (direction === 'next' && !validateStep(step)) {
            return; // Prevent moving to the next step if current step is not valid
        }
    
        showStep(step, direction);
    }
    
    function validateStep(step) {
        let nextStep2;
        nextStep2 = step - 1;
        const inputs = document.getElementById('step' + nextStep2).querySelectorAll('.form-select, .form-control, .form-check-input');

        // const inputs = document.getElementById('step' + nextStep2).querySelectorAll('.form-control');
        console.log(inputs);
        let isValid = true;
      
    inputs.forEach(input => {
        if (input.classList.contains('form-select')) {
            // For select elements, manually check if an option is selected
            if (!input.value) {
                isValid = false;
                // You can add your custom error message handling here
                input.classList.add('is-invalid');
                // For displaying error messages, you can use the error-message divs associated with each select input
                const errorMessage = input.parentElement.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.textContent = 'Please select an option.';
                    errorMessage.classList.add('invalid-feedback');
                }
            } else {
                // If an option is selected, remove the invalid state and error message
                input.classList.remove('is-invalid');
                const errorMessage = input.parentElement.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.textContent = '';
                    errorMessage.classList.remove('invalid-feedback');
                }
            }
        } else {
            // For other input types, use the existing validateField function
            validateField(input);
            if (!input.checkValidity()) {
                isValid = false;
            }
        }
    });

    return isValid;
    }

const opn = () => {
var form = document.getElementById('iform');
form.reportValidity();
if (form.checkValidity()) {
$('#uploadVideo').modal('show')
$("#ctt").html($("#ct").val())
// $('#video-file').prop('required', true);
// $('#video-desc').prop('required', true);
// $('#video-title').prop('required', true);
}

var video = document.getElementById("video-creative");

// Add a click event listener to the play button
if (video.paused) {
video.play(); // Play the video// Change the button text to "Pause"
} else {
video.pause(); // Pause the video// Change the button text back to "Play Video"
}

}

const close_modl = () => {
var video = document.getElementById("video-creative");
if (video.paused) {
video.play(); // Play the video// Change the button text to "Pause"
} else {
video.pause(); // Pause the video// Change the button text back to "Play Video"
}
$('#uploadVideo').modal('hide')
}
jQuery('document').ready(function() {
$('input[name$="email"]').on('keyup', function(){

// $.ajax({
// url:"{{route('creative.email.exists')}}",
// headers: {
// 'X-CSRF-TOKEN': '{{csrf_token()}}'
// },
// type: "POST",
// data: {
// email: $(this).val()
// },
// dataType : 'json',
// beforeSend: function(){
// $('.info-row').html('<div class="loader-sm"></div>');
// $('.email-btn').prop('disabled', true);
// },
// success: function(result){
// console.log(result);
// $.each(result,function(key,value){
// if(key == 'success'){
// $('.info-row').html('<div class="text-success small"><i class="fa fa-check-circle" aria-hidden="true"></i> '+value+'
// </div>');
// $('.email-btn').prop('disabled', false);
// }else if(key == 'error'){
// $('.info-row').html('<div class="text-danger small"><i class="fa fa-times-circle" aria-hidden="true"></i> '+value+'
// </div>');
// $('.email-btn').prop('disabled', true);
// }
// });
// },
// });
});
$('.skills').select2({
theme: 'bootstrap4'
})
// jQuery.validator.setDefaults({
// debug: true,
// success: "valid"
// });
jQuery('#iform').validate({
rules: {

influencer_years_experience: 'required',
influencer_description: 'required',
influencer_followers: 'required',
influencer_previous_job: 'required',
inflencer_services_provided: 'required',
influencer_skills: 'required',
influencer_charges: 'required',
influencer_clients: 'required',
influencer_turnaround_time: 'required',
// currency: 'required'
},

});
// var y = $('.years');

var e = $('input[name$="influencer_years_experience"]');
var t = $('input[name$="influencer_description"]');
var f = $('input[name$="influencer_IG_followers"]');
var pj = $('input[name$="influencer_previous_job"]');
var se = $('input[name$="inflencer_services_provided"]');
// var se = $('input[name$="influencer_skills"]');
var sk = $('input[name$="influencer_skills"]');
var ic = $('input[name$="influencer_charges"]');
var icl = $('input[name$="influencer_clients"]');
var itt = $('input[name$="influencer_turnaround_time"]');
var crr = $('input[name$="currency"]');

$( ".email-btn" ).click(function() {
if(email.valid() && password.valid()) {
$('.hWlNG').show()
$('.email-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
}

});
$( ".hWlNG-btn" ).click(function() {
// if(e.valid()) {
$('.TpYPE').show()
$('.hWlNG-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
});
$('.TpYPE-btn').click(function() {
// if(t.valid()) {
$('.ConENT').show()
$('.TpYPE-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
// $('.flwOWS-btn').click(function() {
// if(f.valid()) {
// $('.ConENT').show()
// $('.flwOWS-btn').hide()
// }
// })
$('.ConENT-btn').click(function() {
// if(t.valid()) {
$('.PSERev').show()
$('.ConENT-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
$('.PSERev-btn').click(function() {
// if(t.valid()) {
$('.cHarge').show()
$('.PSERev-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
// $('.SKills-btn').click(function() {
// // if(t.valid()) {
// $('.cHarge').show()
// $('.SKills-btn').hide()
// // }
// })
$('.cHarge-btn').click(function() {
// if(ic.valid()) {
console.log('charge')
$('.Clients').show()
$('.cHarge-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
$('.Clients-btn').click(function() {
// if(t.valid()) {
$('.turARND').show()
$('.Clients-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
$('.turARND-btn').click(function() {
// if(t.valid()) {
$('.Handls').show()
$('.turARND-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})

$('.handls-btn').click(function() {
// if(t.valid()) {
$('.Curr').show()
$('.handls-btn').hide()
var myDiv = document.getElementById("scrl");
myDiv.scrollTop = myDiv.scrollHeight;
// }
})
});


</script>
@endpush
@endsection