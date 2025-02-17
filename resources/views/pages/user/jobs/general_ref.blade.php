@extends('pages.app')

@push('css')
    <style>
        .error {
            font-weight: 400 !important;
            font-size: 12px;
            color: red;
        }

        .big-font{
            font-size: 16px;font-weight: 500;
        }

        .product-label{
            font-size: 14px !important;
            font-weight: 500 !important;
        }
    </style>
@endpush

@section('content')
@include('includes.messages')

    <div class="generalPostContainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h6><strong>Give some more details about your Job.  </strong></h6>
                <p class="mt-4">
                Let the Creative know everything you can about your product/service/brand and how you want them to let the world know about it.
            </div>
          
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <form action="{{route('user.general.jobs.create')}}" id="jobForm" name="mf" method="POST" --}}
            <form action="#" id="jobForm" name="mf" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="jbcontainerGeneral bg-white p-4">
                        <p> All fields with (<span class="required">*</span>) are required and must be filled </p>
                        <div class="card px-4">
                            <div class="form-group mt-4">
                                <h6 class="mb-0">Add a Product</h6>
                                <small class="d-block mb-2">Pick a name for your Vendor Station and add a Product or Service to get started. </small>
                                <!-- <div class="form-check">
                                  <label class="form-check-label big-font">
                                    <input type="checkbox" class="form-check-input" name="" id="st_checkbox" value="1">
                                    I already have a store on Vicomma
                                  </label>
                                </div> -->
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group" id="store-name">
                                            <label class="product-label" for="name">Store Name <span class="required">*</span></label>
                                            <input type="text" name="st_name" id="st_name" class="form-control @error('st_name') is-invalid @enderror"
                                                value="{{old('st_name')}}" maxlength="30">
                                            @error('st_name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="product-label" for="name">Product Name <span class="required">*</span></label>
                                            <input type="text" name="p_name" id="p_name" class="form-control @error('p_name') is-invalid @enderror"
                                                value="{{old('p_name')}}" maxlength="30">
                                            @error('p_name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="product-label" for="description">Product Description <span class="required">*</span></label>
                                            <textarea name="p_description" id="p_description" class="form-control @error('p_description') is-invalid @enderror"
                                                id="content" cols="20" rows="2" maxlength="191">{{old('p_description')}}</textarea>
                                            @error('p_description')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-2 justify-content-center imgContainer"></div>
                                    <div class="col-md-4">
                                        <label class="product-label" for="category_id">Select product category <span class="required">*</span></label>
                                        <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror" style="height:48px">
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
                                    <div class="col-md-4">
                                        <label class="product-label" for="price">Product price ($) <span class="required">*</span></label>
                                        <input type="text" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="product-label" for="images">Product Image <span class="required">*</span></label>
                                            <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" id="images" multiple
                                                accept="image/jpeg, image/png, image/jpg">
                                            @error('images')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6>Choose a name for your project <span class="required">*</span></h6>
                        <div class="mt-2 mb-4">
                            <div class="form-group">
                                <input type="text" class="form-control cFFormControl title @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="e.g. I need video for my cosmetics" value="{{old('title')}}"  maxlength="50">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <h6 class="mb-0">Tell us more about your project <span class="required">*</span></h6>
                        <small>Start with a bit about yourself or your business, and include an overview of what you need done. <br> <b>(*Please enter at least 30 characters*)</b></small>
                        <div class="mt-2 mb-2">
                            <div class="form-group">
                                {{-- <input type="text" class="form-control cFFormControl" placeholder="Describe your project here.."> --}}
                                <textarea name="description" id="description" cols="30" rows="3"
                                    class="form-control desc @error('description') is-invalid @enderror"
                                    placeholder="Describe your project here.." maxlength="8000">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <h6>I want my content to be ( choose up to 1 options ): <span class="required">*</span></h6>
                        <div class="mt-2 mb-4">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]" id="educational" value="Educational"> Educational
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]" id="comedic" value="Comedic"> Comedic/Funny
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]" id="informational" value="Informational"> Informational
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label big-font">
                                        <input class="form-check-input mt-1" type="checkbox" name="content_type[]" id="advertisement" value="Advertisement"> Just an Advert
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    <p id="content_type-error"></p>
                                </div>
                            </div>
                        </div>
                        <!-- upload files -->
                        <h6 class="mb-0">Upload files Describing your Job</h6>
                        <small>Drag & drop any images or documents that might be helpful in explaining your brief here <br> <b>(Max file size: 25 MB).</b> </small>
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
                                            <rect x="1" y="1" width="62" height="62" rx="14" stroke="#6F3C96" stroke-width="2"
                                                stroke-miterlimit="3.86874" stroke-dasharray="12 12" />
                                        </svg>
                                        <h6 class="ml-3 mt-1">Upload file</h6>
                                        <input type="file" name="documents[]" id="file"
                                            accept=".doc, .docx, .pdf, image/jpeg, image/png, image/jpg" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-9 mt-2">
                                <div class="flRMVDOC text-danger" style="margin-top: -.8rem">
                                    <i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                        title="Remove files"></i>
                                </div>
                                <div class="multiple_container row justify-content-center fl">
                                </div>
                            </div>
                            {{-- <small class="text-muted mt-2 mb-0 text-sm">
                                Select multiple files
                            </small> --}}
                        </div>

                        <h6>How do you want to pay?</h6>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-xl-6 mt-2 f">
                                <div class="pSSContainer" id="fixed">
                                    <div class="selected f">
                                        <i class="fas fa-check text-success text-center" aria-hidden="true"></i>
                                    </div>
                                    <svg width="68" height="48" viewBox="0 0 68 48" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.6503 18.0881C6.20147 18.0881 6.64838 17.6412 6.64838 17.0901V4.8482C6.64838 3.28632 7.919 2.01557 9.48101 2.01557H58.5223C60.0842 2.01557 61.3549 3.28619 61.3549 4.8482V12.2995C61.3549 12.8507 61.8017 13.2976 62.353 13.2976C62.9043 13.2976 63.3511 12.8507 63.3511 12.2995V4.8482C63.3511 2.18557 61.1849 0.0195312 58.5224 0.0195312H9.48101C6.81838 0.0195312 4.65234 2.1857 4.65234 4.8482V17.0901C4.65234 17.6414 5.09912 18.0881 5.6503 18.0881Z"
                                            fill="white" />
                                        <path
                                            d="M67.0019 40.1593H63.3493V16.2918C63.3493 15.7407 62.9024 15.2938 62.3512 15.2938C61.8 15.2938 61.3531 15.7407 61.3531 16.2918V40.1593H58.8727V33.9677C58.8727 33.4165 58.4258 32.9696 57.8746 32.9696C57.3235 32.9696 56.8766 33.4165 56.8766 33.9677V40.1593H40.1276C39.5764 40.1593 39.1295 40.6062 39.1295 41.1574V41.9252C39.1295 42.1168 38.9736 42.2727 38.7819 42.2727H26.5444C26.3528 42.2727 26.1969 42.1168 26.1969 41.9252V41.1574C26.1969 40.6062 25.75 40.1593 25.1988 40.1593H11.1232V6.49227H56.8767V29.9755C56.8767 30.5267 57.3236 30.9736 57.8748 30.9736C58.4259 30.9736 58.8729 30.5267 58.8729 29.9755V5.49418C58.8729 4.94301 58.4259 4.49609 57.8748 4.49609H10.1252C9.57405 4.49609 9.12714 4.94287 9.12714 5.49418V40.1593H6.64673V21.0824C6.64673 20.5312 6.19982 20.0843 5.64865 20.0843C5.09748 20.0843 4.65056 20.5312 4.65056 21.0824V40.1593H0.998086C0.446914 40.1593 0 40.6062 0 41.1574V44.1928C0 46.2824 1.69987 47.9822 3.78941 47.9822H64.2105C66.3 47.9822 67.9999 46.2822 67.9999 44.1928V41.1574C68 40.6061 67.5531 40.1593 67.0019 40.1593ZM66.004 44.1928C66.004 45.1817 65.1995 45.9862 64.2106 45.9862H3.78941C2.80048 45.9862 1.99604 45.1817 1.99604 44.1928V42.1555H24.2122C24.3283 43.34 25.33 44.2688 26.5447 44.2688H38.7822C39.9967 44.2688 40.9986 43.34 41.1146 42.1555H66.004V44.1928Z"
                                            fill="white" />
                                        <path
                                            d="M27.7227 32.2407C27.4479 32.7173 27.6115 33.3265 28.0881 33.6013C29.8781 34.6334 31.9222 35.1787 33.9994 35.1787C40.5341 35.1787 45.8504 29.8623 45.8504 23.3277C45.8504 16.793 40.5341 11.4766 33.9994 11.4766C27.4648 11.4766 22.1484 16.7929 22.1484 23.3277C22.1484 26.0325 23.0837 28.678 24.782 30.777C25.128 31.2047 25.7552 31.2708 26.1829 30.9248C26.6105 30.5788 26.6768 29.9516 26.3307 29.5239C24.8979 27.7531 24.1406 25.6105 24.1406 23.3277C24.1406 17.8915 28.5633 13.4688 33.9994 13.4688C39.4356 13.4688 43.8582 17.8914 43.8582 23.3277C43.8582 28.7638 39.4356 33.1865 33.9994 33.1865C32.271 33.1865 30.5709 32.7331 29.0831 31.8752C28.6067 31.6007 27.9976 31.7641 27.7227 32.2407Z"
                                            fill="white" />
                                        <path
                                            d="M31.7342 29.1174C31.9429 29.1174 32.1503 29.0519 32.3247 28.9235L38.8393 24.1294C39.0943 23.9418 39.2451 23.6439 39.2451 23.3273C39.2451 23.0105 39.0944 22.7126 38.8393 22.5249L32.3247 17.7309C32.0222 17.5083 31.6202 17.4747 31.2848 17.6443C30.9496 17.8138 30.7383 18.1575 30.7383 18.5332V28.1211C30.7383 28.4969 30.9496 28.8406 31.2848 29.01C31.4269 29.0819 31.5808 29.1174 31.7342 29.1174ZM32.7305 20.5031L36.5684 23.3274L32.7305 26.1516V20.5031Z"
                                            fill="white" />
                                    </svg>
                                    <h4 class="mt-2 mb-0">Pay fixed price</h4>
                                    <p class="mt-3">
                                        Agree on a price and release payment when the job is done. Best for
                                        one-off tasks.
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-xl-6 mt-2 r">
                                <div class="pSSContainer" id="residule">
                                    <svg width="46" height="48" viewBox="0 0 46 54" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M27.5961 16.1203L20.8461 12.7453C20.7175 12.681 20.5745 12.6506 20.4309 12.6571C20.2872 12.6636 20.1475 12.7066 20.0252 12.7822C19.9028 12.8579 19.8019 12.9635 19.7318 13.0891C19.6618 13.2147 19.625 13.3561 19.625 13.5V20.25C19.625 20.3938 19.6618 20.5352 19.7318 20.6608C19.8019 20.7865 19.9028 20.8921 20.0252 20.9677C20.1475 21.0433 20.2872 21.0864 20.4309 21.0928C20.5745 21.0993 20.7175 21.0689 20.8461 21.0046L27.5961 17.6296C27.7362 17.5595 27.8541 17.4518 27.9365 17.3185C28.0188 17.1852 28.0624 17.0316 28.0624 16.875C28.0624 16.7183 28.0188 16.5647 27.9365 16.4314C27.8541 16.2981 27.7362 16.1904 27.5961 16.1203ZM21.3125 18.8848V14.8652L25.332 16.875L21.3125 18.8848Z"
                                            fill="white" />
                                        <path
                                            d="M30.5938 10.125H15.4062C14.7352 10.1258 14.0918 10.3927 13.6172 10.8672C13.1427 11.3418 12.8758 11.9852 12.875 12.6562V21.0938C12.8758 21.7648 13.1427 22.4082 13.6172 22.8828C14.0918 23.3573 14.7352 23.6242 15.4062 23.625H30.5938C31.2648 23.6242 31.9082 23.3573 32.3827 22.8828C32.8573 22.4082 33.1242 21.7648 33.125 21.0938V12.6562C33.1242 11.9852 32.8573 11.3418 32.3827 10.8672C31.9082 10.3927 31.2648 10.1258 30.5938 10.125ZM31.4375 21.0938C31.4372 21.3174 31.3483 21.5319 31.1901 21.6901C31.0319 21.8483 30.8174 21.9372 30.5938 21.9375H15.4062C15.1826 21.9372 14.9681 21.8483 14.8099 21.6901C14.6517 21.5319 14.5628 21.3174 14.5625 21.0938V12.6562C14.5628 12.4326 14.6517 12.2181 14.8099 12.0599C14.9681 11.9017 15.1826 11.8128 15.4062 11.8125H30.5938C30.8174 11.8128 31.0319 11.9017 31.1901 12.0599C31.3483 12.2181 31.4372 12.4326 31.4375 12.6562V21.0938Z"
                                            fill="white" />
                                        <path
                                            d="M43.8828 7.59375H37.3438V1.6875C37.3438 1.46372 37.2549 1.24911 37.0966 1.09088C36.9384 0.932645 36.7238 0.84375 36.5 0.84375H9.5C9.27622 0.84375 9.06161 0.932645 8.90338 1.09088C8.74514 1.24911 8.65625 1.46372 8.65625 1.6875V7.59375H2.11719C1.61381 7.59414 1.13116 7.79428 0.775221 8.15022C0.41928 8.50616 0.219141 8.98881 0.21875 9.49219V16.875C0.221067 18.8883 1.02186 20.8184 2.44547 22.242C3.86907 23.6656 5.79922 24.4664 7.8125 24.4688H8.65625V25.3125C8.65857 27.3258 9.45936 29.2559 10.883 30.6795C12.3066 32.1031 14.2367 32.9039 16.25 32.9062H17.0938V34.5938C17.0938 34.8175 17.1826 35.0321 17.3409 35.1904C17.4991 35.3486 17.7137 35.4375 17.9375 35.4375H19.625V44.7188H17.9375C17.7137 44.7188 17.4991 44.8076 17.3409 44.9659C17.1826 45.1241 17.0938 45.3387 17.0938 45.5625V47.25H12.9615C12.8179 47.2499 12.6767 47.2865 12.5512 47.3563C12.4257 47.426 12.32 47.5267 12.2443 47.6487L9.62656 51.8674C9.54721 51.9952 9.50347 52.1419 9.49987 52.2923C9.49627 52.4427 9.53294 52.5913 9.60609 52.7228C9.67924 52.8542 9.7862 52.9637 9.9159 53.0399C10.0456 53.1162 10.1933 53.1563 10.3438 53.1562H35.6562C35.8067 53.1563 35.9544 53.1162 36.0841 53.0399C36.2138 52.9637 36.3208 52.8542 36.3939 52.7228C36.4671 52.5913 36.5037 52.4427 36.5001 52.2923C36.4965 52.1419 36.4528 51.9952 36.3734 51.8674L33.7557 47.6487C33.68 47.5267 33.5743 47.426 33.4488 47.3563C33.3233 47.2865 33.1821 47.2499 33.0385 47.25H28.9062V45.5625C28.9062 45.3387 28.8174 45.1241 28.6591 44.9659C28.5009 44.8076 28.2863 44.7188 28.0625 44.7188H26.375V35.4375H28.0625C28.2863 35.4375 28.5009 35.3486 28.6591 35.1904C28.8174 35.0321 28.9062 34.8175 28.9062 34.5938V32.9062H29.75C31.7633 32.9039 33.6934 32.1031 35.117 30.6795C36.5406 29.2559 37.3414 27.3258 37.3438 25.3125V24.4688H38.1875C40.2008 24.4664 42.1309 23.6656 43.5545 22.242C44.9781 20.8184 45.7789 18.8883 45.7812 16.875V9.49219C45.7809 8.98881 45.5807 8.50616 45.2248 8.15022C44.8688 7.79428 44.3862 7.59414 43.8828 7.59375ZM8.65625 22.7812H7.8125C6.2466 22.7795 4.74532 22.1567 3.63806 21.0494C2.5308 19.9422 1.90798 18.4409 1.90625 16.875V9.49219C1.90642 9.43629 1.92869 9.38274 1.96822 9.34322C2.00774 9.30369 2.06129 9.28142 2.11719 9.28125H8.65625V22.7812ZM32.5692 48.9375L34.1396 51.4688H11.8604L13.4308 48.9375H32.5692ZM27.2188 46.4062V47.25H18.7812V46.4062H27.2188ZM21.3125 44.7188V35.4375H24.6875V44.7188H21.3125ZM27.2188 33.75H18.7812V32.9062H27.2188V33.75ZM35.6562 25.3125C35.6545 26.8784 35.0317 28.3797 33.9244 29.4869C32.8172 30.5942 31.3159 31.217 29.75 31.2188H16.25C14.6841 31.217 13.1828 30.5942 12.0756 29.4869C10.9683 28.3797 10.3455 26.8784 10.3438 25.3125V2.53125H35.6562V25.3125ZM44.0938 16.875C44.092 18.4409 43.4692 19.9422 42.3619 21.0494C41.2547 22.1567 39.7534 22.7795 38.1875 22.7812H37.3438V9.28125H43.8828C43.9387 9.28142 43.9923 9.30369 44.0318 9.34322C44.0713 9.38274 44.0936 9.43629 44.0938 9.49219V16.875Z"
                                            fill="white" />
                                        <path
                                            d="M17.9375 4.21875C17.9375 3.99497 17.8486 3.78036 17.6904 3.62213C17.5321 3.4639 17.3175 3.375 17.0938 3.375H12.0312C11.8075 3.375 11.5929 3.4639 11.4346 3.62213C11.2764 3.78036 11.1875 3.99497 11.1875 4.21875C11.1875 4.44253 11.2764 4.65714 11.4346 4.81537C11.5929 4.97361 11.8075 5.0625 12.0312 5.0625H17.0938C17.3175 5.0625 17.5321 4.97361 17.6904 4.81537C17.8486 4.65714 17.9375 4.44253 17.9375 4.21875Z"
                                            fill="white" />
                                        <path
                                            d="M19.625 5.0625H20.4688C20.6925 5.0625 20.9071 4.97361 21.0654 4.81537C21.2236 4.65714 21.3125 4.44253 21.3125 4.21875C21.3125 3.99497 21.2236 3.78036 21.0654 3.62213C20.9071 3.4639 20.6925 3.375 20.4688 3.375H19.625C19.4012 3.375 19.1866 3.4639 19.0284 3.62213C18.8701 3.78036 18.7812 3.99497 18.7812 4.21875C18.7812 4.44253 18.8701 4.65714 19.0284 4.81537C19.1866 4.97361 19.4012 5.0625 19.625 5.0625Z"
                                            fill="white" />
                                    </svg>
                                    <h4 class="mt-2 mb-0">Pay by Residual (Coming soon)</h4>
                                    <p class="mt-3">
                                        Pay by percentage of every sale made through the creative's page
                                    </p>
                                </div>
                            </div>
                        </div>

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
                                        <option value="{{$currency->id}}" @if(old('currency')==$currency->id) {{'selected'}}
                                            @endif>{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div> --}}
                                <div class="col-md-6">
                                    <h6>What is your estimated budget for this Project ($)? <span class="required">*</span></h6>
                                    <select name="budget" id="budget"
                                        class="form-select bg-transparent bd @error('budget') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option selected disabled>Select your budget</option>
                                        @foreach ($budgets as $budget)
                                        @if($budget->min < 1000)
                                        <option value="{{$budget->id}}" @if(old('budget')==$budget->id) {{'selected'}}
                                            @endif>{{$budget->name}} ( {{number_format($budget->min)}} -
                                            {{number_format($budget->max)}} )</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <small class="d-block mt-0 mb-2 mt-2"><b>Note:</b>for budgets above $998.00, contact us as <a href="mailto:sales@vicomma.com">sales@vicomma.com</a> for more information about your request.
                                    </small>
                                    @error('budget')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <h6>When do you want your Job delivered? <span class="required">*</span></h6>
                                    <select name="job_duration" id="job_duration"
                                        class="form-select bg-transparent bd @error('job_duration') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option selected disabled>Select project duration</option>
                                        <option value="1 - 3 days" > 1 - 3 days </option>
                                        <option value="3 - 7 days " > 3 - 7 days </option>
                                        <option value="1 - 3 weeks" > 1 - 3 weeks </option>
                                        <option value="3 - 7 weeks" > 3 - 7 weeks </option>
                                        <option value="1 - 3 months" > 1 - 3 months </option>
                                        <option value="3 - 7 months" > 3 - 7 months </option>
                                    </select>
                                    @error('job_duration')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <h6>Select your Job Type? <span class="required">*</span></h6>
                                    <select name="type" id="type"
                                        class="form-select bg-transparent bd @error('type') is-invalid @enderror"
                                        aria-label="Default select example" required>
                                        <option selected disabled>Select project type</option>
                                        <option value="One-off" >  My project will be simple and quick</option>
                                        <option value="Ongoing" > My project will have many parts </option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <h6>Select Experience Level required <span class="required">*</span></h6>
                                    <select name="experience_level" id="experience_level"
                                        class="form-select bg-transparent bd @error('experience_level') is-invalid @enderror"
                                        aria-label="Default select example" required>
                                        <option selected disabled>Select Experience Level</option>
                                        <option value="beginner" > Beginner</option>
                                        <option value="intermediate" > Intermediate </option>
                                        <option value="expert" > Expert </option>
                                    </select>
                                    @error('experience_level')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-4">
                                    <h6>Does your PHYSICAL product need to appear in the video content? <span class="required">*</span></h6>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_in_vid" id="prod_in_vid_yes" value="Yes"> Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label big-font">
                                            <input class="form-check-input mt-1" type="radio" name="prod_in_vid" id="prod_in_vid_no" value="No"> No
                                        </label>
                                    </div>
                                    <div class="invalid-feedback">
                                        <p id="prod_in_vid-error"></p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 d-none" id="delivery_sect">
                                    <h6>Method of Product Delivery <span class="required">*</span></h6>
                                    <small class="d-block mt-0 mb-2"><b>Note:</b> the following options are at the discretion
                                        of the Vendor and the Vendor is fully liable for the
                                        transaction of his/her Product(s). Vicomma takes no
                                        responsibility for the procurement, retrieval, loss,
                                        damage, etc. of any and all Vendor products. Please
                                        refer to our Terms and Conditions.
                                    </small>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label big-font">
                                                <input class="form-check-input mt-1" type="radio" name="prod_delivery" id="" value="I will send the Creative a sample of my Product to include in the video">
                                                I will send the Creative a sample of my Product to include in the video
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label big-font">
                                                <input class="form-check-input mt-1" type="radio" name="prod_delivery" id="" value="I will send a courier to deliver a sample of my Product to include in the video.">
                                                I will send a courier to deliver a sample of my Product to include in the video.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label big-font">
                                                <input class="form-check-input mt-1" type="radio" name="prod_delivery" id="" value="I will pay for the Creative to come and get a sample of my Product to include in the video.">
                                                I will pay for the Creative to come and get a sample of my Product to include in the video.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label big-font">
                                                <input class="form-check-input mt-1" type="radio" name="prod_delivery" id="" value="My product can be purchased at a shop location that I will provide to the Creative.">
                                                My product can be purchased at a shop location that I will provide to the Creative.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label big-font">
                                                <input class="form-check-input mt-1" type="radio" name="prod_delivery" id="" value="I only want an image of my Product to appear in the video.">
                                                I only want an image of my Product to appear in the video.
                                            </label>
                                        </div>
                                    </div>
                                    {{-- <select name="prod_delivery" id="prod_delivery"
                                        class="form-select bg-transparent bd @error('prod_delivery') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option selected disabled>Select delivery method</option>
                                        <option value="1 - 3 days" >I will send the Creative a sample of my Product to include in the video</option>
                                        <option value="3 - 7 days " >I will send a courier to deliver a sample of my Product to include in the video.</option>
                                        <option value="1 - 3 weeks" >I will pay for the Creative to come and get a sample of my Product to include in the video.</option>
                                        <option value="3 - 7 weeks" >My product can be purchased at a shop location that I will provide to the Creative.</option>
                                        <option value="1 - 3 months" >I only want an image of my Product to appear in the video.</option>
                                    </select> --}}
                                    @error('prod_delivery')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-secondary ml-auto" id="submitJob">Yes, I’m ready to go!</button>
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
                            <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close" style="z-index: 9999"></button>
                        </div>

                        <form action="" method="post" id="register-form" class="mt-3">
                            <div class="modal-body">
                                <div class="row info-row hide">
                                    <div class="col-md-12" id="user-info"></div>
                                </div>
                                <div class="cover pt-3 hide" id="loading">
                                    <div class="loader-md center-align"></div>
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
                                            class="form-control form-input-control @error('fname') is-invalid @enderror" value="{{old('fname')}}">
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
                                            class="form-control form-input-control @error('lname') is-invalid @enderror" value="{{old('lname')}}">
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
                                            class="form-control form-input-control @error('email') is-invalid @enderror" value="{{old('email')}}">
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
                                            class="form-control form-input-control @error('password') is-invalid @enderror" value="{{old('password')}}">
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
                                <input type="text" name="ref_code"
                                    id="ref"
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


                                    <p class="mb-0 mt-3"><small> Already have an account? <a href="#!" style="color: #6f3c96;" id="login">Log in</a></small></p>
                                </div>
                                {{-- Social buttons --}}
                            </div>

                            <div class="px-3 d-flex">
                                {{-- <button type="button" class="btn btn-secondary footer-btn" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-primary ml-auto footer-btn" id="submit-register">Join Vicomma</button>
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
                            <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close" style="z-index: 9999"></button>
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
                                            class="form-control form-input-control @error('l-email') is-invalid @enderror" value="{{old('l-email')}}">
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
                                            class="form-control form-input-control pass-input @error('l-password') is-invalid @enderror" value="{{old('l-password')}}">
                                            <i class="fa fa-eye-slash toggle-pass text-secondary" style="align-self: center;margin-right: 15px;font-size: 25px!important;"></i><br>
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
                                <p class="mb-4 mt-3"><small> Don't have an account? <a href="#!" style="color: #6f3c96;" id="register-btn">Sign Up</a></small></p>

                                <div class="d-flex">
                                    {{-- <button type="button" class="btn btn-secondary footer-btn" data-bs-dismiss="modal">Close</button> --}}
                                    <button type="submit" class="btn btn-primary ml-auto footer-btn" id="submit-login">Login</button>
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
                st_name: {
                    required: 'Store name is required!'
                },
                p_name: {
                    required: 'Product name is required!'
                },
                p_description: {
                    required: 'Product description is required!'
                },

                category_id: {
                    required: 'Product category is required!'
                },
                price: {
                    required: 'Product price is required!'
                },
                "images[]": {
                    required: 'Product Image is required!'
                },
                title: {
                    required: 'Job title is required!',
                    maxlength: 'Job title must not be greater than 50 Characters'
                },
                description: {
                    required: 'Job description is required!'
                },
                product_id: {
                    required: 'Product is required!'
                },
                currency: {
                    required: 'Currency is required!'
                },
                budget: {
                    required: 'Job budget is required!'
                },
                job_duration: {
                    required: 'Job Duration is required!'
                },
                prod_in_vid: {
                    required: 'Product Delivery Method is required!'
                },
                'content_type[]': {
                    required: 'Content Type is required!',
                    minlength: 'Please select at least 1 item'
                }
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

        $('#jobForm').submit(function(event){
            event.preventDefault();
            if($('#jobForm').valid()){
                $('#signUpModal').modal('show');
            }
        });

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

        $('#register-form').validate({
            rules: {
                fname: 'required',
                lname: 'required',
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                }
            },
            messages: {
                fname: {
                    required: 'First name is required!'
                },
                lname: {
                    required: 'Last name is required!'
                },
                email: {
                    required: 'Email is required!',
                    email: 'Please enter a valid email address'
                },
                password: {
                    required: 'Password is required!',
                    minlength: 'Password must be at least 6 characters'
                },
            }
        });

        $('#register-form').submit(function(event){
            event.preventDefault();
            if($('#register-form').valid()){
                $('.info-row').addClass('hide');
                $('#user-info').html('');
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
                    fname: $('#fname').val(),
                    lname: $('#lname').val(),
                    email: $('#email').val(),
                    ref_code: $('#ref').val(),
                    password: $('#password').val(),
                    "g-recaptcha-response": $("[name='g-recaptcha-response']").val(),
                }
                // console.log(jobData);
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
                                $('.form-input-control').prop('disabled', true);
                                loginUser();
                            }else if (key == 'error'){
                                $('.info-row').removeClass('hide');
                                $('#user-info').html('<div class="alert alert-danger">'+value+'</div>');
                                $('.form-input-control').prop('disabled', false);
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
                    ref: "{{$user->id}}",
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
