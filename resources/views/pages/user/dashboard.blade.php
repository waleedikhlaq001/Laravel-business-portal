@extends('pages.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css"
    integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@push('scripts')
<script>
    document.title = "Dashboard";
</script>
{{-- <script>
    var wBanner = localStorage.getItem('welcomeBanner');
        var b = document.querySelector('#welcomeAlert');
        b.style.display = 'none';
</script> --}}
@endpush
@push("css")
<style>
    .introjs-nextbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745 !important;
        color: #fff;
        text-shadow: none;
    }

    .product-img {
        overflow: hidden;
        border-radius: 15px;
        object-fit: cover;
        width: 100px;
        height: 90px;
        display: inline-block;
        vertical-align: middle;
    }

    .product-img img {
        border-radius: unset;
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .info .p_title a {
        font-weight: 700;
        color: #747474;
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

    .introjs-bullets {
        display: none;
    }

    .vertical-line-div {
        margin-right: -7.5%;
        margin-left: 4%;
    }

    .vertical-line {
        width: 2px;
        height: 100%;
        background: #8fd33da3;
        border-radius: 5px;
        margin-top: -5px;
    }

    .horizontal-line {
        width: 17%;
        height: 2px;
        margin-top: -25px;
        margin-left: 55px;
        background: #8fd33da3;
        border-radius: 5px;
        position: absolute;
    }

    .activity_img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e9e9e9;
        overflow: hidden;
    }

    .activity_img img {
        object-fit: cover;
        width: 100%;
    }

    .activity_img::before {
        width: 15px;
        height: 5px;
        background: white;
        content: "";
        position: absolute;
        margin-top: -5px;
        left: 44%;
    }

    .activity_img::after {
        width: 15px;
        height: 5px;
        background: white;
        content: "";
        position: absolute;
        margin-top: 50px;
        left: 44%;
    }

    .activities {
        width: 100%;
    }

    .activity_desc-div {
        border: 1px solid #66339969;
        border-radius: 5px;
    }

    .activity_desc {
        font-size: 12px;
        color: #555;
    }

    .activity_desc a {
        color: #94ca52;
    }

    .activity_name {
        font-weight: 500;
        color: #555;
    }

    .activity_time {
        font-size: 11px;
        background: #fff;
        color: #686565;
        margin-bottom: 5px;
        margin-top: -5px;
        max-width: 80px;
        margin-left: auto;
        margin-right: auto;
    }

    .actions a {
        color: #94ca52;
    }

    @media (max-width: 768px) {
        .activity_desc-div {
            background: #fff;
            margin-top: 8px;
        }

        .activity_desc-div::after {
            width: 95%;
            height: 6px;
            background: #fff;
            content: "";
            position: absolute;
            bottom: -7px;
            left: 2.5%;
        }

        .activity_desc-div::before {
            width: 95%;
            height: 6px;
            background: #fff;
            content: "";
            position: absolute;
            top: -7px;
            left: 2.5%;
        }

        .activity_img {
            display: none;
        }

        .vertical-line-div {
            margin-right: 0;
            margin-left: 0;
        }

        .vertical-line {
            position: absolute;
            left: 50%;
            height: 85%;
        }


    }

    #clear {
        font-size: 12px;
    }

    .delete_activity {
        width: 22px;
        height: 22px;
        background: #5555557d;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        right: 0px;
        top: 37%;
        padding-top: 1.3px;
        transition: all 1s;
        opacity: 0;
    }

    .activity_desc-div:hover .delete_activity {
        opacity: 1;
        right: 70px;
    }

    .delete_activity i {
        font-size: 15px !important;
    }

</style>
@endpush

@section('content')
@include('includes.messages')
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-8 aCTSiDFICOL">
        <h1 class="sectionHeading3 mb-4">My
            <b>{{Auth::user()->hasRole('creative') ? 'Creative' : (Auth::user()->hasRole('vendor') ? 'Vendor' : '')}}</b>
            Account
        </h1>
        {{-- <div class="alert alert-warning alert-dismissible fade show border-0" id="welcomeAlert" role="alert"
            style="background: transparent; ">
            <div class="img_area mb-5">
                <img alt="" src="img/myaccount.PNG">
            </div>
            <button type="button" class="close" id="welClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> --}}
        <div class="card shadow">
            <div class="card-header text-snd">Actions</div>
            <div class="card-body">
                <p class="text-snd">
                    @if (Auth::user()->hasRole('creative'))
                    From your account dashboard you can <b>View Jobs, Place bids </b>on Jobs, Change your profile and
                    Update settings.
                    @elseif (Auth::user()->hasRole('vendor'))
                    From your account dashboard you can <b>Create Jobs, Add Products</b>, Change your profile and Update
                    settings.
                    @endif
                </p>
                <div class="d-grid gap-2 d-md-block">
                    {{-- <button class="btn btn-secondary btn-sm d-block d-md-inline-block mr-2">Order items now</button> --}}
                    @if (Auth::user()->hasRole('Creative'))
                    <a href="{{route('user.jobs.index')}}"
                        class="btn btn-outline-secondary btn-sm d-block d-md-inline-block mr-2 jbb">
                        Jobs
                    </a>
                    @endif
                    @if (!Auth::user()->isRole('Creative'))
                    <a href="{{route('user.influencer.index')}}"
                        class="btn btn-secondary btn-sm d-block d-md-inline-block mr-2 tip" data-show="no"
                        data-content="Oh yeah, you can also become a creative, if you can be.">Become a
                        Creative
                    </a>
                    @endif
                    @if (Auth::user()->hasRole('vendor'))
                    <button class="btn btn-secondary btn-sm d-block d-md-inline-block mr-2 tip" data-show="no"
                        data-content="Extensively search for top creatives.">Search for a
                        Creative</button>
                    <a href="{{route('user.vendor.jobs.index')}}"
                        class="btn btn-outline-secondary btn-sm d-block d-md-inline-block mr-2 tip" data-show="no"
                        data-content="Get Started with a new job request.">
                        Post a Job
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card shadow mt-2">
            <div class="card-header text-snd d-flex">
                Recent Activities
                <div class="ml-auto d-flex align-items-center">
                    <a href="javascript:void(0);" id="clear">Clear All</a>
                    <div class="loader-sm ml-3" style="display: none;" id="activity_loading"></div>
                </div>
            </div>
            <div class="card-body" id="activity_card">
                {{-- <div class="row" id="no_activity" style="display: none;">You don't have any recent activities</div> --}}
                @if ($activities)
                <div class="d-flex">
                    <div class="vertical-line-div">
                        <div class="vertical-line"></div>
                    </div>
                    <div class="activities">
                        @foreach ($activities as $activity)
                        <div class="row all_activities" id="{{$activity->id}}"
                            style="{{!$loop->last ? 'margin-bottom:35px;' : ''}}">
                            <div class="col-md-2">
                                <div class="activity_time text-center">{{($activity->created_at)->diffForHumans()}}
                                </div>
                                <div class="activity_img m-auto text-center">
                                    <img src="{{$activity->image}}" alt="">
                                    {{-- <div class="horizontal-line"></div> --}}
                                </div>
                            </div>
                            <div class="col-md-10 activity_desc-div d-flex align-items-center shadow-sm p-3">
                                <div>
                                    <div class="activity_name">
                                        {{$activity->name}}
                                    </div>
                                    <div class="activity_desc">
                                        {!!$activity->description!!}
                                    </div>
                                </div>
                                @if ($activity->url)
                                <div class="actions align-self-baseline ml-auto">
                                    <a href="{{$activity->url}}" target="_blank">
                                        <i class="fas fa-link"></i>
                                    </a>
                                </div>
                                @endif

                                <a href="javascript:void(0);" class="delete_activity">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="row">You don't have any recent activities</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-12">
                <div class="card p-4 accStatus shadow">
                    <div class="card-header">
                        <h5>Welcome back!</h5>
                        <h6>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h6>
                    </div>
                    @if( $current_progress != 100)
                    <div class="card-body">
                        <h6 class="mb-3">Finish your account set up</h6>
                        <div class="progress rounded">
                            <div class="progress-bar" role="progressbar" style="width: {{ $current_progress }}%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $current_progress }}%</div>
                        </div>
                        <div class="d-flex mt-3 p-3 rounded bg-white">

                            <div>
                                <span class="text-snd text-lg"> <i class="{{ $suggested_action_icon }}"
                                        aria-hidden="true"></i>
                                </span>
                                <a href="{{$suggested_link}}" class="ml-4 text-snd">{{ $suggested_action }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-12">
                @if(!Auth::user()->isRole('vendor'))
                <div class="card shadow" id="vendorCard">
                    <div class="card-header text-snd text-lg">Start Selling</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <svg width="101" height="101" viewBox="0 0 101 101" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M76.1445 7.89062C68.0953 7.89062 61.5469 14.439 61.5469 22.4883C61.5469 26.6403 63.2923 30.3901 66.0846 33.0508C66.156 33.1301 66.2327 33.2053 66.3173 33.2728C68.913 35.6401 72.3629 37.0859 76.1445 37.0859C79.9261 37.0859 83.3761 35.6401 85.9719 33.2728C86.0565 33.2051 86.1332 33.1301 86.2047 33.0508C88.9967 30.3901 90.7422 26.6403 90.7422 22.4883C90.7422 14.439 84.1937 7.89062 76.1445 7.89062ZM76.1445 33.1406C73.8689 33.1406 71.7593 32.421 70.0265 31.2005C71.3427 29.1298 73.6173 27.8482 76.1445 27.8482C78.6717 27.8482 80.9464 29.13 82.2625 31.2005C80.5297 32.421 78.4202 33.1406 76.1445 33.1406ZM74.1143 21.8724V20.8717C74.1143 19.7522 75.025 18.8414 76.1445 18.8414C77.264 18.8414 78.1748 19.7522 78.1748 20.8717V21.8724C78.1748 22.9921 77.264 23.9029 76.1445 23.9029C75.025 23.9029 74.1143 22.9921 74.1143 21.8724ZM85.0595 28.3086C84.0225 26.9417 82.6939 25.8437 81.1787 25.0857C81.7737 24.1569 82.1201 23.0546 82.1201 21.8724V20.8717C82.1201 17.5767 79.4394 14.8961 76.1445 14.8961C72.8496 14.8961 70.169 17.5767 70.169 20.8717V21.8724C70.169 23.0548 70.5155 24.1569 71.1103 25.0857C69.5951 25.8437 68.2665 26.9415 67.2295 28.3086C66.1327 26.6342 65.4922 24.6351 65.4922 22.4883C65.4922 16.6145 70.2707 11.8359 76.1445 11.8359C82.0183 11.8359 86.7968 16.6145 86.7968 22.4883C86.7968 24.6351 86.1563 26.6342 85.0595 28.3086Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M98.8953 76.4423C96.2923 73.8394 92.2036 73.4668 89.1732 75.5568C89.1509 75.5722 89.129 75.588 89.1075 75.6041L78.0496 83.92C77.1789 84.5748 77.0039 85.8116 77.6586 86.6824C78.3134 87.5529 79.55 87.7283 80.4208 87.0731L91.4432 78.7839C92.9025 77.7979 94.8576 77.9837 96.1055 79.2318C96.7634 79.8897 97.099 80.7638 97.0504 81.6929C97.0019 82.622 96.5768 83.4565 95.8538 84.0422L85.7603 92.2172C81.9091 95.3366 77.0588 97.0546 72.1027 97.0546H42.9064C38.9428 97.0546 35.0556 95.9692 31.6654 93.9159L23.7214 89.1044V64.1379H38.9337C41.0413 64.1379 43.0228 64.9587 44.51 66.4459L55.0045 76.9895C56.4948 78.4799 58.4764 79.3007 60.5839 79.3007H68.3239C69.9533 79.3007 71.2787 80.6263 71.2787 82.2555C71.2787 83.8847 69.9531 85.2104 68.3239 85.2104H53.4589C52.0956 85.2104 50.7712 84.8176 49.6286 84.0743L43.2982 79.957L43.2751 79.942C42.3627 79.3468 41.1405 79.6033 40.5449 80.5156C39.9494 81.428 40.2062 82.6503 41.1186 83.2458L47.4774 87.3817C49.2617 88.5424 51.33 89.1557 53.4589 89.1557H68.3237C72.1285 89.1557 75.2238 86.0604 75.2238 82.2555C75.2238 78.4507 72.1283 75.3554 68.3237 75.3554H60.7092L77.1095 65.8866H97.0546C99.23 65.8866 101 64.1168 101 61.9413V3.94531C101 1.76987 99.23 0 97.0546 0H55.2343C53.0589 0 51.289 1.76987 51.289 3.94531V61.9413C51.289 64.1168 53.0589 65.8866 55.2343 65.8866H69.2188L56.7091 73.1091C56.7089 73.1091 56.7089 73.1093 56.7087 73.1093L47.3027 63.6591C45.0671 61.4235 42.0949 60.1924 38.9333 60.1924H23.7212V56.7138C23.7212 54.5384 21.9513 52.7685 19.7759 52.7685H1.97265C0.883157 52.7685 0 53.6518 0 54.7411V99.0272C0 100.117 0.883157 101 1.97265 101H19.7759C21.9513 101 23.7212 99.23 23.7212 97.0546V93.717L29.6214 97.2905C33.6282 99.7173 38.2219 101 42.9064 101H72.1027C77.9599 101 83.6922 98.9696 88.2435 95.2831L98.337 87.1081C99.9169 85.8282 100.884 83.9297 100.99 81.8993C101.097 79.8688 100.333 77.8798 98.8953 76.4423ZM55.2343 61.9413V3.94531H97.0546L97.0571 61.9411C97.0571 61.9411 97.0563 61.9413 97.0546 61.9413H55.2343ZM19.7759 97.0546H3.94531V56.7138H19.7759L19.7762 62.1585C19.7762 62.1607 19.7759 62.1629 19.7759 62.1652C19.7759 62.1676 19.7762 62.1696 19.7762 62.1719L19.778 90.1197C19.7757 90.1696 19.7766 90.2193 19.778 90.2688L19.7784 97.0544C19.7784 97.0544 19.7776 97.0546 19.7759 97.0546Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M46.1906 9.93491C45.6459 8.99139 44.4393 8.66808 43.4959 9.21292L25.7373 19.4658C23.8534 20.5537 23.2058 22.9714 24.2933 24.8551L41.5282 54.7069C41.8935 55.3397 42.5566 55.6936 43.2383 55.6936C43.5729 55.6936 43.9122 55.6082 44.2229 55.4289C45.1664 54.884 45.4897 53.6777 44.9449 52.7342L27.71 22.8824L45.4686 12.6296C46.4121 12.0849 46.7354 10.8784 46.1906 9.93491Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M88.375 41.8203H65.4922C64.4027 41.8203 63.5195 42.7035 63.5195 43.793C63.5195 44.8825 64.4027 45.7656 65.4922 45.7656H88.375C89.4645 45.7656 90.3476 44.8825 90.3476 43.793C90.3476 42.7035 89.4645 41.8203 88.375 41.8203Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M89.7697 51.078C89.4028 50.7111 88.8938 50.5 88.375 50.5C87.8562 50.5 87.3472 50.7109 86.9803 51.078C86.6134 51.4449 86.4023 51.9538 86.4023 52.4727C86.4023 52.9915 86.6134 53.5004 86.9803 53.8671C87.3472 54.234 87.8562 54.4453 88.375 54.4453C88.8938 54.4453 89.4028 54.2342 89.7697 53.8671C90.1366 53.5004 90.3477 52.9915 90.3477 52.4727C90.3477 51.9538 90.1366 51.4449 89.7697 51.078Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M80.1474 50.5H65.4922C64.4027 50.5 63.5195 51.3834 63.5195 52.4727C63.5195 53.562 64.4027 54.4453 65.4922 54.4453H80.1474C81.2369 54.4453 82.1201 53.562 82.1201 52.4727C82.1201 51.3834 81.2369 50.5 80.1474 50.5Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M11.8555 72.7031C10.766 72.7031 9.88281 73.5865 9.88281 74.6758V82.3928C9.88281 83.4821 10.766 84.3655 11.8555 84.3655C12.945 84.3655 13.8281 83.4821 13.8281 82.3928V74.6758C13.8281 73.5863 12.945 72.7031 11.8555 72.7031Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M13.2579 87.7879C12.8891 87.421 12.3821 87.21 11.8613 87.21C11.3425 87.21 10.8355 87.421 10.4666 87.7879C10.0997 88.1549 9.89062 88.6638 9.89062 89.1826C9.89062 89.7034 10.0997 90.2104 10.4666 90.5773C10.8336 90.944 11.3425 91.1553 11.8613 91.1553C12.3821 91.1553 12.8891 90.9442 13.2579 90.5773C13.6249 90.2104 13.834 89.7032 13.834 89.1826C13.834 88.6638 13.6249 88.1549 13.2579 87.7879Z"
                                    fill="#6F3C96" />
                            </svg>
                        </div>
                        <div data-show="no" class="tip"
                            data-content="Oh yeah, you can also become a Vendor, if you can be.">
                            <button class="btn btn-block btn-secondary mt-4" data-toggle="modal"
                                data-target="#vendorModal">Become a
                                Vendor</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        {{-- @if (!in_array(3,$roles)) --}}

        {{-- <div class="right_sidebar card shadow p-4">
            <p class="title">Top selling</p>
            <ul class="fine-scrollbar">
                @if ($random_products)
                @foreach ($random_products as $product)
                <?php

                        if ($product->image) {
                            $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".trim($product->image[0], '"');
                        } else {
                            $image = '/img/no-image.png';
                        }
                        ?>
                <li>
                    <div class="img_area product-img shadow-sm">
                        <img alt="{{$product->name}}" src="{{ $image }}">
    </div>
    <div class="info pr-4">
        <p class="p_title text-dark"><a href="/mall/products/{{ $product->id }}"
                target="_blank">{{ucwords($product->name)}}</a></p>
        <div class="bottom mt-3">
            <span class="price">${{ number_format($product->price) }}</span>
            <a href="/mall/products/{{ $product->id }}" class="btn btn-sm btn-secondary btn-rounded float-right"
                style="border-radius: 20px;display: flex; align-items: center; justify-content: center;"
                ii="{{ $product->id }}">Bag It</a>
        </div>
    </div>
    </li>
    @endforeach
    @else
    <small>No Top Selling Products found</small>
    @endif

    </ul>

</div> --}}
</div>
</div>
<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"> Vendor Station Name</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.register.vendor')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="station">Vendor Name</label>
                        <input type="text" name="station"
                            class="form-control station @error ('station') is-invalid @enderror">
                        <small class="text-muted">This will be your shop name</small>
                        @error('station')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="becomeAVendor">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"
    integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

    $('#clear').on('click', function() {
        // ajax call to clear activity log and update the page
        $.ajax({
            url: "{{route('user.clear.activity')}}",
            type: "GET",
            beforeSend: function(){
                $('#activity_loading').fadeIn(1000);
            },
            success: function(data) {
                var arr = data.activity_ids;

                $('.all_activities').each(function(){
                    var a_id = $(this).attr('id');
                    if($.inArray(a_id, data.activity_ids) !== -1) {
                        $(this).fadeOut(2000);

                        arr = $.grep(arr, function(v) {
                            return v == a_id;
                        });
                    }
                });

                if(arr == 0) {
                    //make inner html empty
                    $('#activity_card').html("<div class='row'>You don't have any recent activities</div>");
                }
            },
            complete: function(){
                $('#activity_loading').fadeOut(1000);
            }
        });

    });

    $('.delete_activity').on('click', function() {
        var activity_div = $(this).closest('.all_activities');
        var a_id = activity_div.attr('id');
        // ajax call to delete single activity and update the page
        $.ajax({
            url: "{{route('user.delete.activity')}}",
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            type: "POST",
            data: {
                a_id: a_id
            },
            dataType: "json",
            beforeSend: function(){
                $('#activity_loading').fadeIn(1000);
            },
            success: function(data) {
                var arr = data.all_activities;
                $('.all_activities').each(function(){
                    if(a_id == $(this).attr('id')) {
                        $(this).fadeOut(2000);

                        arr = $.grep(arr, function(v) {
                            return v != a_id;
                        });
                    }
                });

                if(arr == 0) {
                    //make inner html empty
                    $('#activity_card').html("<div class='row'>You don't have any recent activities</div>");
                }
            },
            complete: function(){
                $('#activity_loading').fadeOut(1000);
            }
        });

    });

//     @if(session()->get('new_job') && session()->get('new_job') == "yes")
// setTimeout(() => {
//    $("#verifyEmail").modal("hide")
//             var intro4 = introJs();
//     intro4.setOptions({
//       doneLabel: 'Got It',
//       steps: [
//       {
//         element: document.querySelector('.p-icon'),
//         intro: "Now return to My Jobs to see the job you just posted",
//         position: 'left'
//       },
//       ]
//     });
//     intro4.start().oncomplete(function() {

//     });
//         }, 4000)
// @endif

@if(session()->get('new_creative') && session()->get('new_creative') == "yes")
setTimeout(() => {
   $("#verifyEmail").modal("hide")
            var intro4 = introJs();
    intro4.setOptions({
      doneLabel: 'Got It',
      steps: [
      {
        element: document.querySelector('.jbb'),
        intro: "Now click on Jobs to make your first bid!",
        position: 'left'
      },
      ]
    });
    intro4.start().oncomplete(function() {

    });
        }, 4000)
@endif

    // jQuery('#welClose').on('click', function(){
    //     $('#welcomeAlert').alert('dispose');
    //     localStorage.setItem('welcomeBanner', 'close');
    // })
    // $modal = jQuery('#vendorModal');

    jQuery('#becomeAVendor').click(function(e) {
        e.preventDefault();
        $station = $('.station').val();
        console.log($station);
        // $modal.modal('hide');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('user.register.vendor')}}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'station': $station
            },
            success: function(data) {
                // $("#vendorModal").modal('hide');
                swal({
                    title: "Successful!!",
                    text: 'Your Vendor Station has been created',
                    icon: "success",
                });
                setTimeout(function() {
                    window.location.href = "{{route('user.vendors.index')}}";
                }, 3000)
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText
                $error = xhr.responseJSON.errors.station[0];
                swal({
                    title: "Error!!",
                    text: $error,
                    icon: "error",
                });
            }
        });
    })
})
</script>
<script>
    const addToCartBtns = document.querySelectorAll(".btn-bag-it");
    const guestCart = [];
    const handleAddToCart = (product) => {
        //if the product is already in the cart, update the quantity
        const {
            id
        } = product;
        if (!sessionStorage.getItem("cartIdStore")) {
            sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
            sessionStorage.setItem("cart", JSON.stringify([product]));
        } else {
            if (!JSON.parse(sessionStorage.getItem("cartIdStore")).includes(id)) {
                sessionStorage.setItem(
                    "cart",
                    JSON.stringify([
                        ...JSON.parse(sessionStorage.getItem("cart")),
                        product,
                    ])
                );
                sessionStorage.setItem(
                    "cartIdStore",
                    JSON.stringify([
                        ...JSON.parse(sessionStorage.getItem("cartIdStore")),
                        id,
                    ])
                );
            }
        }
    };
    for (let i = 0; i < addToCartBtns.length; i++) {
        addToCartBtns[i].addEventListener('click', function() {
            console.log(addToCartBtns[i].id)
            guestCart.push(addToCartBtns[i].id);
            //make a call to the server to add product to session
            axios.post(`${window.location.origin}/cartsession`, {
                product_id: addToCartBtns[i].id
            }).then(function(response) {
                console.log(response.data)
                const {
                    message,
                    product,
                    cart_count
                } = response.data;
                swal({
                    title: "Product Added Successfully!",
                    text: message,
                    icon: "success",
                });
                handleAddToCart(product)
                document.querySelector('#vicomma-cart-cta').innerHTML = cart_count;
            })
        })
    }
</script>
@endpush
@endsection