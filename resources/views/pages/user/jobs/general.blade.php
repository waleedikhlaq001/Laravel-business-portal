@extends('pages.app')

@push('css')
<style>
    .tooltip2[title]:hover::after {
        content: attr(title);
        position: absolute;
        top: -100%;
        left: 0;
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
        width: 95%;
        left: 40px;
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
        border: 0;
        border-bottom: 2px solid #dee2e6;
        border-radius: 0;
        box-shadow: none;
        outline: none;
        padding: 0px;
        font-size: 15px;
    }

    .form-control:focus {
        border-bottom-color: #007bff;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .generalPostContainer {
        padding: 2rem;
        height: auto;
        min-height: 143px;
        background: var(--snd-color);
        padding-top: 3rem;
    }

    .bg-color {
        background: #6f3c96;
        padding: 2px;
        height: 33px;
        width: 33px;
        text-align: center;
        cursor: pointer;
    }

    .arrow-btn {
        float: right;
        margin-top: 100px;
    }

    .tooltipT {
        position: relative;
        display: inline-block;
        /* If you want dots under the hoverable text */
    }

    /* Tooltip text */
    .tooltipT .tooltiptext {
        bottom: 112%;
        left: -321%;
        margin-left: -60px;
        visibility: hidden;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 10px 10px;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        width: 300px;
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooltipT:hover .tooltiptext {
        visibility: visible;
    }

    .tooltipT .tooltiptext::after {
        content: " ";
        position: absolute;
        top: 100%;
        /* At the bottom of the tooltip */
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }

</style>
@endpush

@section('content')
@include('includes.messages')

<div class="generalPostContainer mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 style="color: #fff"><strong>Hire a Content Creator. </strong></h2 style="color: #fff">

        </div>

    </div>
</div>
<div class="row justify-content-center mb-5">

    <div class="col-md-8">
        <form action="#" id="jobForm" name="mf" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mt-5">
                <div class="stepper-wrapper mb-5">
                    <div class="stepper-item completed" id="step1Indicator">
                        <div class="step-counter">1</div>
                        <div>Product Details</div>
                    </div>
                    <div class="stepper-item" id="step2Indicator">
                        <div class="step-counter">2</div>
                        <div>Project Information </div>
                    </div>
                    <div class="stepper-item" id="step3Indicator">
                        <div class="step-counter">3</div>
                        <div>Payment and Budget</div>
                    </div>
                    <div class="stepper-item" id="step4Indicator">
                        <div class="step-counter">4</div>
                        <div>Project Requirements</div>
                    </div>
                    <div class="stepper-item" id="step5Indicator">
                        <div class="step-counter">5</div>
                        <div>Submit</div>
                    </div>
                    <div class="progress-bar-line"></div>
                    <div class="progress-bar-active" style="width: 0%;" id="progressBar"></div>

                </div>
                <div class="row justify-content-center bg-white">
                    <!-- Step Contents -->
                    <div class="p-5 col-md-10">
                        <div id="step1" class="tab-pane">
                            <h3>Add Product|Service</h3>
                            <p>You will create your vendor brand account and add your product or service details.</p>
                            <div class="form-group mt-5 mb-5" id="store-name">
                                <label class="product-label mb-0" for="st_name">Vendor Brand Name <span
                                        class="required">*</span></label>
                                <input type="text" name="st_name" id="st_name" class="form-control" required>
                                <div class="error-message invalid-feedback" id="st_name_error"></div>
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label mb-0" for="p_name">Product | Service Name <span
                                        class="required">*</span></label>
                                <input type="text" name="p_name" id="p_name" class="form-control" required>
                                <div class="error-message invalid-feedback" id="p_name_error"></div>
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label mb-0" for="p_description">Product|Service Description <span
                                        class="required">*</span></label>
                                <textarea name="p_description" id="p_description" class="form-control"
                                    required></textarea>
                                <div class="error-message invalid-feedback" id="p_description_error"></div>
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label" for="category_id">Select Product | Service category <span
                                        class="required">*</span></label>
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" style="height:48px; border: 0;
                                border-bottom: 2px solid #dee2e6; padding:0">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if (old('category_id')==$category->id)
                                        {{'selected'}}@endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label mb-0" for="price">Product | Service price ($) <span
                                        class="required">*</span></label>
                                <input type="text" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label class="product-label" for="images">Product | Service Image <span
                                        class="required">*</span></label>
                                <input type="file" name="images[]" id="images"
                                    class="form-control @error('images') is-invalid @enderror" id="images" multiple
                                    accept="image/jpeg, image/png, image/jpg">
                                @error('images')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-secondary" onclick="nextStep(2, 'next')" type="button">Continue
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
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
                            <h3>Project Information</h3>
                            <p>Tell your content creator what it is you actually need.</p>
                            <div class="form-group mb-5">
                                <label class="product-label mt-3 mb-0" for="title">Choose a name of your project <span
                                        class="required">*</span></label>
                                <input type="text" class="form-control cFFormControl title" name="title" id="title"
                                    placeholder="e.g. I need video for my cosmetics" value="{{old('title')}}"
                                    maxlength="50" required>
                                <div class="error-message invalid-feedback" id="title_error"></div>
                                <!-- Error message placeholder -->
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label mb-0" for="description">Tell us more about your project
                                    <span class="required">*</span>

                                    <span class="tooltipT">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                style="height: 24px;">
                                                <path
                                                    d="M15.07,11.25L14.17,12.17C13.45,12.89 13,13.5 13,15H11V14.5C11,13.39 11.45,12.39 12.17,11.67L13.41,10.41C13.78,10.05 14,9.55 14,9C14,7.89 13.1,7 12,7A2,2 0 0,0 10,9H8A4,4 0 0,1 12,5A4,4 0 0,1 16,9C16,9.88 15.64,10.67 15.07,11.25M13,19H11V17H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
                                            </svg>
                                        </span>
                                        <span class="tooltiptext">Your content creator needs as much detail as possible
                                            to provide what you need. Be very descriptive about what you want in your
                                            content and what you want your content to accomplish.</span>
                                    </span>
                                </label>
                                <textarea name="description" id="description" cols="30" rows="3"
                                    class="form-control desc" placeholder="Describe your project here.."
                                    maxlength="8000" required>{{old('description')}}</textarea>
                                <div class="error-message invalid-feedback" id="description_error"></div>
                                <!-- Error message placeholder -->
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label  mb-3" for="images">Choose at least one option.<span
                                        class="required">*</span></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]"
                                            id="educational" value="Educational"> Educational
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]"
                                            id="comedic" value="Comedic"> Comedic/Funny
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]"
                                            id="informational" value="Informational"> Informational
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]"
                                            id="advertisement" value="Advertisement"> Just an Advert
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    <div class="error-message" id="content_type_error"></div>
                                    <!-- Error message placeholder -->
                                </div>
                            </div>

                            <h6 class="mb-0">Upload any additional files for your project.(optional)</h6>
                            <small>Drag & drop any images or documents that might be helpful in explaining your brief
                                here
                                <br>
                                <b>(Max file size: 25 MB).</b> </small>
                            <div class="cFFilesContainer mt-2 mb-4 mx-1 row">
                                <div class="fileField col-sm-12 col-md-12 col-lg-3 mt-2">
                                    <div class="d-flex w-100">
                                        <div class="btn btn-primary fileBtnUpload d-flex w-100 justify-content-center">
                                            <svg width="30" height="40" viewBox="0 0 64 64" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M50.9679 31.3258C50.3248 31.3258 49.8102 31.8403 49.8102 32.4835V43.0139C49.8102 45.8781 47.4778 48.202 44.6222 48.202H19.2221C16.358 48.202 14.0341 45.8695 14.0341 43.0139V32.312C14.0341 31.6688 13.5196 31.1543 12.8764 31.1543C12.2333 31.1543 11.7188 31.6688 11.7188 32.312V43.0139C11.7188 47.1558 15.0888 50.5173 19.2221 50.5173H44.6222C48.7641 50.5173 52.1256 47.1472 52.1256 43.0139V32.4835C52.1256 31.8489 51.6111 31.3258 50.9679 31.3258Z"
                                                    fill="#6F3C96" />
                                                <path
                                                    d="M25.3764 22.4088L30.7617 17.0235V40.5113C30.7617 41.1544 31.2762 41.6689 31.9194 41.6689C32.5625 41.6689 33.077 41.1544 33.077 40.5113V17.0235L38.4623 22.4088C38.6853 22.6318 38.9854 22.7518 39.277 22.7518C39.5771 22.7518 39.8687 22.6404 40.0916 22.4088C40.5461 21.9543 40.5461 21.2254 40.0916 20.7709L32.734 13.4133C32.5197 13.1989 32.2195 13.0703 31.9194 13.0703C31.6107 13.0703 31.3191 13.1904 31.1047 13.4133L23.7471 20.7709C23.2926 21.2254 23.2926 21.9543 23.7471 22.4088C24.193 22.8547 24.9305 22.8547 25.3764 22.4088Z"
                                                    fill="#6F3C96" />
                                                <rect x="1" y="1" width="62" height="62" rx="14" stroke="#6F3C96"
                                                    stroke-width="2" stroke-miterlimit="3.86874"
                                                    stroke-dasharray="12 12" />
                                            </svg>
                                            <h6 class="ml-3 mt-1">Upload file</h6>
                                            <input type="file" name="documents[]" id="file"
                                                accept=".doc, .docx, .pdf, image/jpeg, image/png, image/jpg" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="error-message" id="file_error"></div> <!-- Error message placeholder -->

                                <div class="col-sm-12 col-md-12 col-lg-9 mt-2">
                                    <div class="flRMVDOC text-danger" style="margin-top: -.8rem">
                                        <i class="fa fa-times" aria-hidden="true" data-toggle="tooltip"
                                            data-placement="top" title="Remove files"></i>
                                    </div>
                                    <div class="multiple_container row justify-content-center fl">
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button class="btn btn-secondary" onclick="nextStep(3, 'next')" type="button">Continue
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
                            <h3>Payment and Budget</h3>
                            <p>Let us know about your payment preferences and budget</p>
                            <div class="row mb-5 mt-5">
                                <label class="product-label  mb-3" for="images">I want my content to be ( choose up to 1
                                    options ) * <span class="required">*</span></label>
                                <br>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input mt-1" type="checkbox" name="payment" id="fixed"
                                            value="fixed" checked>
                                        <div style="display: grid; ">
                                            <label for="fixed" class="form-check-label big-font">
                                                Pay fixed price
                                            </label>
                                            <span>Agree on a price and release payment when the job is done. Best for
                                                one-off
                                                tasks.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input mt-1" type="checkbox" name="payment" id="fixed"
                                            value="fixed" disabled>
                                        <div style="display: grid; ">
                                            <label for="fixed" class="form-check-label big-font">
                                                Pay by Residual (Coming soon)
                                            </label>
                                            <span>Pay by percentage of every sale made through the creative's page
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label" for="images">What is your estimated budget for this Project
                                    ($)? <span class="required">*</span></label>
                                <select name="budget" id="budget" required
                                    class="form-select bg-transparent bd @error('budget') is-invalid @enderror"
                                    aria-label="Default select example"
                                    style="height:48px; border: 0; border-bottom: 2px solid #dee2e6; padding:0">
                                    <option selected disabled value="">Select your budget</option>
                                    @foreach ($budgets as $budget)
                                    @if($budget->min < 1000) <option value="{{$budget->id}}"
                                        @if(old('budget')==$budget->id)
                                        {{'selected'}} @endif>{{$budget->name}} ( {{number_format($budget->min)}} -
                                        {{number_format($budget->max)}} )</option>
                                        @endif
                                        @endforeach
                                </select>
                                <div class="error-message" id="budget_error">@error('budget') {{$message}} @enderror
                                </div>
                                <small class="d-block mt-0 mb-2 mt-2"><b>Note:</b>for budgets above $998.00, contact us
                                    as
                                    <a href="mailto:sales@vicomma.com">sales@vicomma.com</a> for more information about
                                    your
                                    request.</small>
                                @error('budget')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label class="product-label" for="images">When do you want your Job delivered? <span
                                        class="required">*</span></label>
                                <select name="job_duration" required id="job_duration"
                                    class="form-select bg-transparent bd @error('job_duration') is-invalid @enderror"
                                    aria-label="Default select example"
                                    style="height:48px; border: 0; border-bottom: 2px solid #dee2e6; padding:0">
                                    <option selected disabled value="">Select project duration</option>
                                    <option value="1 - 3 days"> 1 - 3 days </option>
                                    <option value="3 - 7 days "> 3 - 7 days </option>
                                    <option value="1 - 3 weeks"> 1 - 3 weeks </option>
                                    <option value="3 - 7 weeks"> 3 - 7 weeks </option>
                                    <option value="1 - 3 months"> 1 - 3 months </option>
                                    <option value="3 - 7 months"> 3 - 7 months </option>
                                </select>
                                <div class="error-message" id="job_duration_error">@error('job_duration') {{$message}}
                                    @enderror</div>
                                @error('job_duration')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-secondary" onclick="nextStep(4, 'next')" type="button">Continue
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
                                            fill="white" />
                                    </svg>
                                </button>
                                <div class="d-flex arrow-btn">
                                    <div class="mr-1 bg-color" onclick="nextStep(2, 'prev')">
                                        <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.7"
                                                d="M2.36723 11.5264C1.27836 12.6727 -0.445679 10.8577 0.733928 9.71131L8.62822 1.30468C9.08191 0.827029 9.89857 0.827029 10.3523 1.30468L18.3373 9.71131C19.4262 10.8577 17.7021 12.6727 16.6133 11.5264L9.53561 4.07505L2.36723 11.5264Z"
                                                fill="white" />
                                        </svg>

                                    </div>
                                    <div class="bg-color" onclick="nextStep(4, 'next')">
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
                        <div id="step4" class="tab-pane" style="display:none;">
                            <h3>Payment and Budget</h3>
                            <p>Let us know about your payment preferences and budget</p>

                            <div class="form-group mb-5 mt-3">
                                <label class="product-label" for="images">Select your Job Type? <span
                                        class="required">*</span></label>
                                <select name="type" id="type"
                                    class="form-select bg-transparent bd @error('type') is-invalid @enderror"
                                    aria-label="Default select example" style="height:48px; border: 0;
                                border-bottom: 2px solid #dee2e6; padding:0" required>
                                    <option selected disabled value="">Select project</option>
                                    <option value="One-off"> My project will be simple and quick</option>
                                    <option value="Ongoing"> My project will have many parts </option>
                                </select>
                                <div class="error-message invalid-feedback" id="type_error"></div>
                                @error('type')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label class="product-label" for="images">Select the experience level you need from your
                                    Content Creator.<span class="required">*</span></label>
                                <select name="experience_level" id="experience_level"
                                    class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                                    aria-label="Default select example" style="height:48px; border: 0;
                                border-bottom: 2px solid #dee2e6; padding:0" required>
                                    <option selected disabled value="">Select Experience Level</option>
                                    <option value="beginner"> Beginner</option>
                                    <option value="intermediate"> Intermediate </option>
                                    <option value="expert"> Expert </option>
                                </select>
                                <div class="error-message invalid-feedback" id="experience_level_error"></div>
                                @error('experience_level')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label class="product-label" for="images">Does your PHYSICAL product need to appear in
                                    the
                                    video content? <span class="required">*</span></label>
                                <div class="d-flex">
                                    <div class="form-check mr-5">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_in_vid"
                                                id="prod_in_vid_yes" value="Yes"> Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_in_vid"
                                                id="prod_in_vid_no" value="No" checked> No
                                        </label>
                                    </div>
                                    <div class="error-message invalid-feedback" id="type_error"></div>
                                </div>
                                <div class="invalid-feedback">
                                    <p id="prod_in_vid-error"></p>
                                </div>
                            </div>

                            <div class="mt-4 d-none mb-5" id="delivery_sect">
                                <label class="product-label" for="images">Method of Product Delivery <span
                                        class="required">*</span></label>
                                <small class="d-block mt-0 mb-2"><b>Note:</b> the following options are at the
                                    discretion
                                    of the Vendor and the Vendor is fully liable for the
                                    transaction of his/her Product(s). Vicomma takes no
                                    responsibility for the procurement, retrieval, loss,
                                    damage, etc. of any and all Vendor products. Please
                                    refer to our Terms and Conditions.
                                </small>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_delivery" id=""
                                                value="I will send the Creative a sample of my Product to include in the video">
                                            I will send the Creative a sample of my Product to include in the video
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_delivery" id=""
                                                value="I will send a courier to deliver a sample of my Product to include in the video.">
                                            I will send a courier to deliver a sample of my Product to include in the
                                            video.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_delivery" id=""
                                                value="I will pay for the Creative to come and get a sample of my Product to include in the video.">
                                            I will pay for the Creative to come and get a sample of my Product to
                                            include in
                                            the video.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_delivery" id=""
                                                value="My product can be purchased at a shop location that I will provide to the Creative.">
                                            My product can be purchased at a shop location that I will provide to the
                                            Creative.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_delivery" id=""
                                                value="I only want an image of my Product to appear in the video.">
                                            I only want an image of my Product to appear in the video.
                                        </label>
                                    </div>
                                </div>

                                @error('prod_delivery')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-secondary" onclick="nextStep(5, 'next')" type="button">Continue
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
                                            fill="white" />
                                    </svg>
                                </button>
                                <div class="d-flex arrow-btn">
                                    <div class="mr-1 bg-color" onclick="nextStep(3, 'prev')">
                                        <svg width="19" height="12" viewBox="0 0 19 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.7"
                                                d="M2.36723 11.5264C1.27836 12.6727 -0.445679 10.8577 0.733928 9.71131L8.62822 1.30468C9.08191 0.827029 9.89857 0.827029 10.3523 1.30468L18.3373 9.71131C19.4262 10.8577 17.7021 12.6727 16.6133 11.5264L9.53561 4.07505L2.36723 11.5264Z"
                                                fill="white" />
                                        </svg>

                                    </div>
                                    <div class="bg-color" onclick="nextStep(5, 'next')">
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
                        <div id="step5" class="tab-pane" style="display:none;">
                            <div class="text-center">
                                <svg width="158" height="144" viewBox="0 0 158 144" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="14.4922" y="0.353027" width="51.5427" height="51.5427"
                                        rx="10" fill="#9E96FF" />
                                    <rect opacity="0.5" x="128.443" y="33.2231" width="29.3594" height="29.3594" rx="10"
                                        fill="#9E96FF" />
                                    <rect opacity="0.5" x="0.443359" y="75.2231" width="31.5329" height="31.5329" rx="8"
                                        fill="#DEDBFF" />
                                    <rect opacity="0.5" x="114.73" y="107.174" width="36.5935" height="36.5935" rx="8"
                                        fill="#DEDBFF" />
                                    <circle cx="83.9199" cy="78.7285" r="60" fill="#6F3C96" />
                                    <g filter="url(#filter0_d_50_124)">
                                        <path d="M61.2031 81.9732L74.1836 94.9537L106.635 62.5024" stroke="white"
                                            stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_50_124" x="27.2031" y="32.5024" width="113.432"
                                            height="100.451" filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="15" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0.290196 0 0 0 0 0.227451 0 0 0 0 1 0 0 0 0.3 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_50_124" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_50_124"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                                <h5 class="mb-3 mt-3">Submit</h5>
                                <span class="mb-3">Double-check your information before submitting. Once you're ready,
                                    click
                                    submit.</span>
                                <br>
                                <button type="submit" class="btn btn-secondary mt-5" id="submitJob">Submit <svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0096 11H5.99963V13H14.0096V16L17.9996 12L14.0096 8.00003V11Z"
                                            fill="white" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- <form action="{{route('user.general.jobs.create')}}" id="jobForm" name="mf" method="POST" --}}
        <form action="#" id="jobForm" name="mf" method="POST" enctype="multipart/form-data" style="display: none">
            @csrf
            <div class="container">
                <div class="">
                    <p> All fields with (<span class="required">*</span>) are required and must be filled </p>
                    <div class="card px-4">
                        <div class="form-group mt-4">
                            <h6 class="mb-0">Add a Product</h6>
                            <small class="d-block mb-2">Pick a name for your Vendor Station and add a Product or Service
                                to get started. </small>
                            <!-- <div class="form-check">
                                  <label class="form-check-label big-font">
                                    <input type="checkbox" class="form-check-input" name="" id="st_checkbox" value="1">
                                    I already have a store on Vicomma
                                  </label>
                                </div> -->

                        </div>
                    </div>
                    <h6>Choose a name for your project <span class="required">*</span></h6>
                    <div class="mt-2 mb-4">

                    </div>
                    <h6 class="mb-0">Tell us more about yourddd project <span class="required">*</span></h6>
                    <small>Start with a bit about yourself or your business, and include an overview of what you need
                        done. <br> <b>(*Please enter at least 30 characters*)</b></small>
                    <div class="mt-2 mb-2">

                    </div>
                    <h6>I want my content to be ( choose up to 1 options ): <span class="required">*</span></h6>
                    <div class="mt-2 mb-4">

                    </div>
                    <!-- upload files -->

                    <h6>How do you want to pay?</h6>

                    <input type="hidden" name="payment" class="payment" value="fixed">
                    <!-- ../ Project Payment Section -->

                    <!-- Project Estimated budget-->
                    <div class="pmt"></div>
                    <div class="mt-5 pcategory p-4 shadow-sm" id="fx">

                        <div class="row">
                            {{-- <div class="col-md-6 mb-2">
                                    <select name="currency" id="currency"
                                        class="form-select bg-transparent cur @error('currency') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option disabled selected>Select Currency</option>
                                        @foreach ($currencies as $currency)
                                        <option value="{{$currency->id}}" @if(old('currency')==$currency->id)
                            {{'selected'}}
                            @endif>{{$currency->name}}</option>
                            @endforeach
                            </select>
                            @error('currency')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div> --}}





                    </div>
                </div>
                <div class="cover pt-3 hide" id="loading">
                    <div class="loader-md center-align"></div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-secondary ml-auto" id="submitJob">Yes, I’m ready to
                        go!</button>
                </div>


            </div>
    </div>
    </form>
    <!--Register Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <img alt="" src="/img/path1.png" class="p1">
                <img alt="" src="/img/path2.png" class="p2">
                <div class="d-flex p-3">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close"
                        style="z-index: 9999"></button>
                </div>

                <form action="" method="post" id="" class="mt-3">
                    <div class="modal-body">
                        <div class="row info-row hide">
                            <div class="col-md-12" id="user-info"></div>
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <label for="fname">First Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-user text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fname" id="fname" placeholder="Enter First name"
                                        class="form-control form-input-control @error('fname') is-invalid @enderror"
                                        value="{{old('fname')}}">
                                </div>
                                @error('fname')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lname">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-user text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="lname" id="lname" placeholder="Enter Last name"
                                        class="form-control form-input-control @error('lname') is-invalid @enderror"
                                        value="{{old('lname')}}">
                                </div>
                                @error('lname')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-lock text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" placeholder="Email Address"
                                        class="form-control form-input-control @error('email') is-invalid @enderror"
                                        value="{{old('email')}}">
                                </div>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-lock text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" placeholder="Your Password"
                                        class="form-control form-input-control @error('password') is-invalid @enderror"
                                        value="{{old('password')}}">
                                </div>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-floating d-flex stf mt-3 rounded">
                                    <span class="input-group-text bg-transparent" style="border: 0;">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" name="ref_code" id="ref"
                                        class="form-control rounded-0 border-0 st-input @error('email') is-invalid @enderror"
                                        placeholder="Referral Code" value="{{old('email')}}">
                                    <label for="ref_code" style="margin-left: 37px">AUC Code (Optional)</label>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text px-3">
                                                <i class="fa fa-lock text-secondary" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="form-group mb-0">
                                            {{-- CAPTCHA --}}
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                    </div>
                                    @error('g-recaptcha-response')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>


                                <p class="mb-0 mt-3"><small> Already have an account? <a href="#!"
                                            style="color: #6f3c96;" id="login">Log in</a></small></p>
                            </div>
                            {{-- Social buttons --}}
                        </div>

                        <div class="px-3 d-flex">
                            {{-- <button type="button" class="btn btn-secondary footer-btn" data-bs-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary ml-auto footer-btn" id="submit-register">Join
                                Vicomma</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!--Register Modal End-->

    <!--Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <img alt="" src="/img/path1.png" class="p1">
                <img alt="" src="/img/path2.png" class="p2">
                <div class="d-flex p-3">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Hi, Welcome Back</h5>
                    <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close"
                        style="z-index: 9999"></button>
                </div>

                <form action="" method="post" id="login-form" class="mt-5">
                    <div class="modal-body mb-0 pb-0">
                        <div class="cover pt-3 hide" id="loading2">
                            <div class="loader-md center-align"></div>
                        </div>
                        <div class="row info-row2 hide">
                            <div class="col-md-12" id="user-info2"></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label for="l-email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-lock text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="l-email" id="l-email" placeholder="Email Address"
                                        class="form-control form-input-control @error('l-email') is-invalid @enderror"
                                        value="{{old('l-email')}}">
                                </div>
                                @error('l-email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="l-password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3">
                                            <i class="fa fa-lock text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="l-password" id="l-password" placeholder="Your Password"
                                        class="form-control form-input-control pass-input @error('l-password') is-invalid @enderror"
                                        value="{{old('l-password')}}">
                                    <i class="fa fa-eye-slash toggle-pass text-secondary"
                                        style="align-self: center;margin-right: 15px;font-size: 25px!important;"></i><br>
                                </div>
                                @error('l-password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    {{-- Social buttons --}}
                    <p class="mb-4 mt-3"><small> Don't have an account? <a href="#!" style="color: #6f3c96;"
                                id="register-btn">Sign Up</a></small></p>

                    <div class="d-flex">
                        {{-- <button type="button" class="btn btn-secondary footer-btn" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary ml-auto footer-btn"
                            id="submit-login">Login</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Login Modal End-->
</div>
</div>
@push('scripts')
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

    // Reset animation by temporarily removing the animation style
    nextStepEl.style.animation = 'none';
    nextStepEl.offsetHeight; // Trigger reflow
    nextStepEl.style.animation = '';

    // Apply the appropriate animation based on the direction
    if (direction === 'next') {
        nextStepEl.style.animation = 'slideInUp 0.5s forwards';
    } else if (direction === 'prev') {
        nextStepEl.style.animation = 'slideInDown 0.5s forwards';
    }

    // Scroll to the top of the page
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Optional: for smooth scrolling effect
    });

    // Update the progress bar and indicators
    updateProgressBar(step);
    updateIndicators(step);
}

    
    function updateProgressBar(step) {
        const progressBar = document.getElementById('progressBar');
        // Assuming 5 steps, adjust the percentage calculation as needed
        const percentage = ((step - 1) / (5 - 1)) * 95; // Corrected to fill up to 100%
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
</script>



<script>
    var doc = document.querySelector('#images');
    var filesContainer = document.querySelector('.imgContainer');

    jQuery('document').ready(function() {

        // Multiple images preview in browser
        $('#images').on('change', function() {
            imagesPreview(this);
        });
            var imagesPreview = function(input) {

                if (input.files) {
                var filesAmount = input.files.length;
                $(".imgContainer").html("")
                    for (i = 0; i < filesAmount; i++) {
                        var reader=new FileReader();
                        reader.onload = function(event) {
                            // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            var img = event.target.result;
                            // console.log(e.target.result);
                            filesContainer.insertAdjacentHTML('afterbegin', `
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <img src="${img}" class="img-fluid" alt="">
                                </div>
                            `);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
    });

</script>
<script>
    $().ready(function(){
        $('#st_checkbox').click(function(){
            var check_val = $(this).prop('checked');

            if(check_val == true){
                $('#store-name').addClass('d-none');
                console.log(check_val)
            }else if(check_val == false){
                $('#store-name').removeClass('d-none');
            }
        });

        $('#prod_in_vid_yes').click(function(){
            var check_val = $(this).prop('checked');

            if(check_val == true){
                $('#delivery_sect').removeClass('d-none');
            }
        });

        $('#prod_in_vid_no').click(function(){
            var check_val = $(this).prop('checked');

            if(check_val == true){
                $('#delivery_sect').addClass('d-none');
            }
        });
    });
</script>
<script>
    $().ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
        var doc = document.querySelector('#file');
        var filesContainer = document.querySelector('.fl');


        $('#jobForm').validate({
            rules: {
                st_name: 'required',
                p_name: 'required',
                p_description: 'required',
                category_id: 'required',
                price: 'required',
                "images[]": 'required',
                title: {
                    required: true,
                    maxlength: 50
                },
                description: 'required',
                product_id: 'required',
                currency: 'required',
                budget: 'required',
                job_duration: 'required',
                prod_in_vid: 'required',
                'content_type[]': {
                    required : true,
                    minlength : 1
                }
            },
            messages: {
                // st_name: {
                //     required: 'Store name is required!'
                // },
                // p_name: {
                //     required: 'Product name is required!'
                // },
                // p_description: {
                //     required: 'Product description is required!'
                // },

                // category_id: {
                //     required: 'Product category is required!'
                // },
                // price: {
                //     required: 'Product price is required!'
                // },
                // "images[]": {
                //     required: 'Product Image is required!'
                // },
                // title: {
                //     required: 'Job title is required!',
                //     maxlength: 'Job title must not be greater than 50 Characters'
                // },
                // description: {
                //     required: 'Job description is required!'
                // },
                // product_id: {
                //     required: 'Product is required!'
                // },
                // currency: {
                //     required: 'Currency is required!'
                // },
                // budget: {
                //     required: 'Job budget is required!'
                // },
                // job_duration: {
                //     required: 'Job Duration is required!'
                // },
                // prod_in_vid: {
                //     required: 'Product Delivery Method is required!'
                // },
                // 'content_type[]': {
                //     required: 'Content Type is required!',
                //     minlength: 'Please select at least 1 item'
                // }
            },
            errorPlacement: function(error, element) {
                var prod_error = $('#prod_in_vid-error');
                var content_error = $('#content_type-error');
                if ( element.attr('name') == 'prod_in_vid') {
                    error.insertAfter(prod_error);
                    prod_error.parent().css('display', 'block');
                    console.log(element);
                }else if ( element.attr('name') == 'content_type[]') {
                    error.insertAfter(content_error);
                    content_error.parent().css('display', 'block');
                    console.log(element);
                }
                else { // This is the default behavior of the script
                    error.insertAfter( element );
                }
            }
        });

        // $('#jobForm').submit(function(event){
        //     event.preventDefault();
        //     if($('#jobForm').valid()){
        //         $('#signUpModal').modal('show');
        //     }
        // });

        var arr = [];
        jQuery('#file').change(function() {
            // console.log(doc.files);

            for(var i = 0; i<=doc.files.length - 1; i++) {
                jQuery('.flRMVDOC').show();
                // var k = doc.files
                // console.log(doc.files.item(i));
                arr.push(doc.files.item(i))
                var nm = doc.files.item(i).name;
                var sz = doc.files.item(i).size;
                filesContainer.insertAdjacentHTML('beforeend', `
                    <div class="col-sm-12 col-md-12 col-lg-4 mt-2 text-wrap" id="">
                        <div class="lfContainer d-flex justify-content-between text-wrap">
                            <div class="flName text-break">${nm}</div>
                            <span class="text-muted flRM">
                                ${sz}(B)
                            </span>
                        </div>
                    </div>
                `);
            }
            // var rm = document.querySelector('.flRMVDOC');
            jQuery('.flRMVDOC').on('click', 'i', function(e) {
                // console.log(e.target);
                jQuery('.fl').empty();
                jQuery('.flRMVDOC').hide();
                jQuery('#file').val('');
                arr.length = 0;
            });

            if(jQuery('#file') != '') {
                jQuery('.ppm').show();
            }

        });

        // $('#register-form').validate({
        //     rules: {
        //         fname: 'required',
        //         lname: 'required',
        //         email: {
        //             required: true,
        //             email: true,
        //         },
        //         password: {
        //             required: true,
        //             minlength: 6,
        //         }
        //     },
        //     messages: {
        //         fname: {
        //             required: 'First name is required!'
        //         },
        //         lname: {
        //             required: 'Last name is required!'
        //         },
        //         email: {
        //             required: 'Email is required!',
        //             email: 'Please enter a valid email address'
        //         },
        //         password: {
        //             required: 'Password is required!',
        //             minlength: 'Password must be at least 6 characters'
        //         },
        //     }
        // });

        $('#jobForm').submit(function(event){
            event.preventDefault();
            if($('#jobForm').valid()){
                // $('.info-row').addClass('hide');
                // $('#user-info').html('');
                var content_type = [];
                $.each($("input[name='content_type[]']:checked"), function(){
                    content_type.push($(this).val());
                });
                var jobData = {
                    st_name: $('#st_name').val(),
                    p_name: $('#p_name').val(),
                    p_description: $('#p_description').val(),
                    category_id: $('#category_id').val(),
                    price: $('#price').val(),
                    images: $('#images').val(),
                    title: $('#title').val(),
                    description: $('#description').val(),
                    file: $('#file').val(),
                    direct: "yes",
                    currency: $('#currency').val(),
                    job_duration: $('#job_duration').val(),
                    budget: $('#budget').val(),
                    prod_delivery: $('input[name="prod_delivery"]:checked').val(),
                    content_type: content_type,
                }
                console.log(jobData);
                $.ajax({
                    url:"{{route('post.job.register')}}",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type: "POST",
                    data: jobData,
                    dataType : 'json',
                    beforeSend: function(){
                        $('#loading').removeClass('hide');
                        $('.footer-btn').prop('disabled', true);
                    },
                    success: function(result){
                        console.log({result});
                        $.each(result,function(key,value){
                            if(key == 'success'){
                                $('.info-row').removeClass('hide');
                                $('#user-info').html('<div class="alert alert-success">'+value+'</div>');
                                $('#submitJob').prop('disabled', true);
                                window.location.href = "{{route('user.dashboard')}}";
                            }else if (key == 'error'){
                                $('.info-row').removeClass('hide');
                                $('#user-info').html('<div class="alert alert-danger">'+value+'</div>');
                                $('#submitJob').prop('disabled', false);
                                $('.footer-btn').prop('disabled', false);
                            }
                        });
                        // console.log(result.error);
                    },
                    error: function(request, status, errorThrown) {
                        console.log(request)
                        console.log(status)
                        console.log(errorThrown)
                        console.log(request.responseJSON.errors)
                            $('.info-row').removeClass('hide');
                            if(request.responseJSON.errors?.email?.[0] || request.responseJSON.errors?.["g-recaptcha-response"]?.[0]){
                                $('#user-info').html('<div class="alert alert-danger">'
                                    + (request.responseJSON.errors?.email?.[0])
                                    + '<br>' 
                                    + (request.responseJSON.errors?.["g-recaptcha-response"]?.[0])
                                    +'</div>');
                            }
                            $('.form-input-control').prop('disabled', false);
                            $('.footer-btn').prop('disabled', false);
                    },
                    complete: function(){
                        $('#loading').addClass('hide');
                    }
                });
            }
        });

        $("#signUpModal").on("hidden.bs.modal", function () {
            $('.form-input-control').prop('disabled', false);
            $('.footer-btn').prop('disabled', false);
        });

        $("#loginModal").on("hidden.bs.modal", function () {
            $('.form-input-control').prop('disabled', false);
            $('.footer-btn').prop('disabled', false);
        });

        $('#login').on('click', function(){
            $('#signUpModal').modal('hide');
            $('#loginModal').modal('show');
            $('.form-input-control').prop('disabled', false);
            $('.footer-btn').prop('disabled', false);
        });

        $('#register-btn').on('click', function(){
            $('#loginModal').modal('hide');
            $('#signUpModal').modal('show');
            $('.form-input-control').prop('disabled', false);
            $('.footer-btn').prop('disabled', false);
        });

        $('#login-form').validate({
            rules: {
                "l-email": {
                    required: true,
                    email: true,
                },
                "l-password": {
                    required: true,
                    minlength: 6,
                }
            },
            messages: {
                "l-email": {
                    required: 'Email is required!',
                    email: 'Please enter a valid email address'
                },
                "l-password": {
                    required: 'Password is required!',
                    minlength: 'Password must be at least 6 characters'
                },
            }
        });

        $('#login-form').submit(function(event){
            event.preventDefault();
            if($('#login-form').valid()){
                $('.info-row2').addClass('hide');
                $('#user-info2').html('');
                var content_type = [];
                $.each($("input[name='content_type[]']:checked"), function(){
                    content_type.push($(this).val());
                });
                var jobData = {
                    st_name: $('#st_name').val(),
                    p_name: $('#p_name').val(),
                    p_description: $('#p_description').val(),
                    category_id: $('#category_id').val(),
                    price: $('#price').val(),
                    images: $('#images').val(),
                    title: $('#title').val(),
                    description: $('#description').val(),
                    file: $('#file').val(),
                    direct: "yes",
                    currency: $('#currency').val(),
                    job_duration: $('#job_duration').val(),
                    budget: $('#budget').val(),
                    prod_delivery: $('input[name="prod_delivery"]:checked').val(),
                    content_type: content_type,
                    email: $('#l-email').val(),
                    password: $('#l-password').val(),
                    ref_code: $("#ref_code").val()
                }
                console.log(jobData);
                $.ajax({
                    url:"{{route('post.oldUser.job')}}",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type: "POST",
                    data: jobData,
                    dataType : 'json',
                    beforeSend: function(){
                        $('#loading2').removeClass('hide');
                        $('.footer-btn').prop('disabled', true);
                        $('#user-info2').html('<div class="alert alert-info">Attempting Submit...</div>');
                    },
                    success: function(result){
                        
                        $.each(result,function(key,value){
                            if(key == 'success'){
                                $('.info-row2').removeClass('hide');
                                $('#user-info2').html('<div class="alert alert-success">'+value+'</div>');
                                $('.form-input-control').prop('disabled', true);
                                // loginOldUser();
                            }else if (key == 'error'){
                                $('.info-row2').removeClass('hide');
                                $('#user-info2').html('<div class="alert alert-danger">'+value+'</div>');
                                $('.form-input-control').prop('disabled', false);
                                $('.footer-btn').prop('disabled', false);
                            }
                        });

                        // console.log(result.error);
                    },
                    complete: function(){
                        $('#loading2').addClass('hide');
                    }
                });
            }
        });

        function loginUser(){
            var userData = {
                fname: $('#fname').val(),
                lname: $('#lname').val(),
                email: $('#email').val(),
                password: $('#password').val()
            }

            $.ajax({
                    url:"{{route('post.job.login')}}",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type: "POST",
                    data: userData,
                    dataType : 'json',
                    beforeSend: function(){
                        $('#loading').removeClass('hide');
                        $('.info-row').removeClass('hide');
                        $('#user-info').html('<div class="alert alert-info">Attemting Login...</div>');
                    },
                    success: function(result){
              
                       
                        $.each(result,function(key,value){
                         
                            if(key == 'success'){
                                $('.info-row').removeClass('hide');
                                $('#user-info').html('<div class="alert alert-success">'+value+'</div>');

                                function redirect(){
                                    $('#user-info').html('<div class="alert alert-info">Redirecting to Dashboard...</div>');
                                    location.href = '/dashboard';
                                };
                                window.setTimeout( redirect, 500 );

                            }else if (key == 'error'){
                                $('.info-row').removeClass('hide');
                                $('#user-info').html('<div class="alert alert-danger">'+value+'</div>');
                            }
                        });
                    },
                    complete: function(){
                        // $('#loading').addClass('hide');
                    }
                });
        }

        function loginOldUser(){
            var userData = {
                email: $('#l-email').val(),
                password: $('#l-password').val()
            }

            $.ajax({
                    url:"{{route('post.job.login')}}",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type: "POST",
                    data: userData,
                    dataType : 'json',
                    beforeSend: function(){
                        $('#loading2').removeClass('hide');
                        $('.info-row2').removeClass('hide');
                        $('#user-info2').html('<div class="alert alert-info">Attemting Login...</div>');
                    },
                    success: function(result){
                        console.log(result);
                        $.each(result,function(key,value){
                            if(key == 'success'){
                                $('.info-row2').removeClass('hide');
                                $('#user-info2').html('<div class="alert alert-success">'+value+'</div>');

                                function redirect(){
                                    $('#user-info2').html('<div class="alert alert-info">Redirecting to Dashboard...</div>');
                                    location.href = '/jobs/my-jobs';
                                };
                                window.setTimeout( redirect, 500 );

                            }else if (key == 'error'){
                                $('.info-row2').removeClass('hide');
                                $('#user-info2').html('<div class="alert alert-danger">'+value+'</div>');
                            }
                        });
                    },
                    complete: function(){
                        // $('#loading').addClass('hide');
                    }
                });
        }

    })
</script>
@endpush
@endsection