<!DOCTYPE html>
<html lang="en" style="height: 100%;">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{--<title>{{env('APP_NAME')}}</title>--}}
        <title> vicomma: Connects Vendors and Content Creatives to meet and earn big.</title>
        <link rel="stylesheet" href="{{asset('/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style.css?v=1237')}}">
        <link rel="stylesheet" href="{{asset('/css/custom.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/rtop.videoPlayer.1.0.1.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/owl.theme.default.min.css')}}">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"> --}}
        <link rel="stylesheet" href="{{asset('/css/jquery.rateyo.min.css')}}">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"
            integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" /> --}}
        @if (Route::is('user.view.profile'))
        <link rel="stylesheet" href="{{asset('/css/cropper.css')}}">
        @endif
        <link rel="stylesheet" href="{{asset('/css/guser.css')}}">
        <link rel="icon" href="{{asset('/images/favicon2.ico')}}" type="image/x-icon">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script type='text/javascript' src='https://widget.freshworks.com/widgets/70000002324.js' async defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        {{-- <script type="text/javascript">
            document.documentElement.className = "js"
        </script> --}}
        @if (Route::is('user.guser.show'))
        <?php
            if (count(json_decode($featured_product->image, true)) > 0) {
                $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($featured_product->image, true)[0];
            } else {
                $image = 'https://vicomma-stagingrevamp.herokuapp.com/img/no-image.png';
            }
            ?>
        <meta name="description"
            content="Finally, a platform that connects brand owners, merchants, marketpros aka Vendors with talented content creators such as musicians, comedians, chefs, movie makers, dancers, models, etc. aka Creatives in one community. A platform that facilitates mutually beneficial partnerships, enabling brand owners to tap into the creative prowess of content creators for content creators to earn substantial rewards and level up vendors. Join this thriving community while you can and witness the power of unified collaboration.">
        <meta name="keywords" content="keyword1, keyword2, keyword3">
        <meta name="author" content="Vicomma">
        <!-- twitter card starts from here, if you don't need remove this section -->
        <meta name="twitter:card" content="summary" />
        <!--<meta name="twitter:site" content="@yourtwitterusername"/>-->
        <!--<meta name="twitter:creator" content="@yourtwitterusername"/>-->
        <meta name="twitter:url" content="http://twitter.com/" />
        <meta name="twitter:title" content="{{$featured_product->name}} | Vicomma" /> <!-- maximum 140 char -->
        <meta name="twitter:description" content="{{substr($featured_product->description,0,55)}}" />
        <!-- maximum 140 char -->
        <meta name="twitter:image" content="{{$image}}" />
        <!-- when you post this page url in twitter , this image will be shown -->
        <!-- twitter card ends here -->

        <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
        <meta property="og:title" content="{{$featured_product->name}} | Vicomma" />
        <meta property="og:url" content="https://vicomma.com/mall/show/{{ $featured_product->id }}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:site_name" content="{{$featured_product->name}} | Vicomma" />
        <!--meta property="fb:admins" content="" /-->
        <!-- use this if you have  -->
        <meta property="og:type" content="website" /> <!-- 'article' for single page  -->
        <meta property="og:image" content="{{$image}}" />
        <!-- when you post this page url in facebook , this image will be shown -->
        <!-- facebook open graph ends here -->
        @endif

        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-YHMV75KPTY"></script>
        <script>
            window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-YHMV75KPTY'); 
        </script>

    </head>
    <style>
        .container-fluid {
            padding-left: 50px !important;
            padding-right: 50px !important;
        }

        .input-green {
            background-color: #ebf1e4 !important;
            border: 1px solid #66972b !important;
            color: #719b3d !important;
            font-family: 'Poppins';
            font-size: 17px;
            font-weight: 300;
            text-align: center;
        }

        #input_withdrawal {
            font-family: 'Poppins';
            font-size: 17px;
            font-weight: 300;
            text-align: center;
        }

        .nCNAVGSM {
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .swal-text {
            text-align: center !important;
        }

        .swal-footer {
            display: flex !important;
            justify-content: center !important;
        }

        .cart-table-content table thead {
            padding: 15px;
            background: #94CA52;
            box-shadow: 0 0 0 6px solid #ececec;
            border-radius: 20px;
        }

        .content-wrapper {
            background-color: white;
        }

        .required {
            color: #ff2a2a;
            font-weight: 700;
        }

        .tippy-box {
            background-color: #6f3c96;
            color: #fff;
        }

        a {
            text-decoration: none;
        }

        h4,
        h5 {
            line-height: 1em;
            margin: 0;
        }

        #tobe-notification-bell {
            font-size: 1.2em;
        }

        .inputGroup {
            /* background-color: #fff; */
            display: block;
            margin: 10px 0;
            padding-top: 5px;
            position: relative;
        }

        .nav-item.active {
            border-bottom: 4px solid #6f3a97;
        }

        .loader {
            --d: 22px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            color: #6f3c96;
            box-shadow:
                calc(1*var(--d)) calc(0*var(--d)) 0 0,
                calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
                calc(0*var(--d)) calc(1*var(--d)) 0 2px,
                calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
                calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
                calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
                calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
            animation: l27 1s infinite steps(8);
        }

        @keyframes l27 {
            100% {
                transform: rotate(1turn)
            }
        }

        .inputGroup label {
            border: solid 1px #6f3c96;
            padding: 10px 10px;
            width: 100%;
            display: block;
            text-align: left;
            color: #6f3c96;
            cursor: pointer;
            position: relative;
            z-index: 2;
            transition: color 200ms ease-in;
            overflow: hidden;
        }

        #video-creative {
            max-width: 100%;
            height: auto !important;
            margin: 0 auto;
            display: table;
        }

        .inputGroup label:before {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            content: "";
            background-color: #6f3c96;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale3d(1, 1, 1);
            transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            z-index: -1;
        }

        .inputGroup label:after {
            width: 25px;
            height: 25px;
            content: "";
            border: 2px solid #94ca52;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
            background-repeat: no-repeat;
            background-position: -1px 0px;
            border-radius: 50%;
            z-index: 2;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            transition: all 200ms ease-in;
        }

        .inputGroup input:checked~label {
            color: #fff;
        }

        .inputGroup input:checked~label:before {
            transform: translate(-50%, -50%) scale3d(56, 56, 1);
            opacity: 1;
        }

        .inputGroup input:checked~label:after {
            background-color: #94ca52;
            border-color: #94ca52;
        }

        .inputGroup input {
            width: 25px;
            height: 25px;
            order: 1;
            z-index: 2;
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            visibility: hidden;
        }

        @media screen and (max-width: 700px) {
            #individual-chat {
                left: calc(100vw - 395px) !important;
            }
        }

        .auth-name {
            margin-bottom: 0px;
            font-size: 16px;
            font-weight: 500;
        }

        .auth-email {
            margin-bottom: 0px;
            font-size: 12px;
            margin-top: -10px;
            font-weight: 200;
        }

        .cookie-message {
            /* font-family: "Century Gothic", CenturyGothic, Geneva, AppleGothic, sans-serif; */
            font-family: "Poppins", sans-serif;
            border-radius: 20px;
            padding: 15px 0;
            background: #6f3a97;
            border: 1px solid rgba(0, 0, 0, .15);
            box-shadow: 0 0 16px 2px rgba(0, 0, 0, .05), 0 10px 10px 2px rgba(0, 0, 0, .05);
            font-size: 12px;
            line-height: 40px;
            /* border-top: 1px solid #67972b; */
            position: fixed;
            z-index: 100;
            bottom: 5%;
            left: 2%;
            margin: auto;
            max-width: 540px;
            display: -ms-flexbox;
            display: flex;
        }

        .cookie-message img {
            height: 50px;
            width: 50px;
            margin: 0 15px;
            -ms-flex-item-align: center;
            -ms-grid-row-align: center;
            align-self: center;
        }

        .cookie-message span {
            display: inline-block;
            line-height: 1.5;
            padding-right: 16px;
            color: #fff;
            border-right: 1px solid rgba(0, 0, 0, .1);
        }

        .cookie-message a.close {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            border: none;
            font-size: 24px;
            padding: 0 20px 0 16px;
            position: relative;
            -ms-flex-item-align: center;
            -ms-grid-row-align: center;
            align-self: center;
            color: #fff;
            transition: color 0.2s;
        }

        .cookie-message a.close:hover {
            color: #795548;
        }

        .cookie-message a {
            display: inline-block;
            color: #67972b;
            text-decoration: none;
            border-bottom: 1px solid rgba(0, 0, 0, .1);
        }

        .btn-design {
            background: transparent;
            border-radius: 30px;
            border: 1px solid rgba(148, 202, 82, 1);

        }

        /* styles.css */

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 10px 10px 50px;
            /* Adjust padding for the left icon */
            border: 1px solid #ccc;
            border-radius: 24px;
            outline: none;
            box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.078);
        }

        .search-icon {
            position: absolute;
            left: 10px;
            /* Positioning based on the provided styles */
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: rgba(148, 202, 82, 1) !important;
            cursor: pointer;

            /* Prevents icon from blocking input clicks */
        }

    </style>

    @if(Route::is('public.index'))
    <style>
        .link-color {
            color: #fff !important;
        }

    </style>
    @else
    <style>
        .link-color {
            color: rgb(0 0 0 / 62%) !important;
        }

    </style>
    @endif

    @stack('css')

    <body class="hold-transition sidebar-mini"> {{-- <body class="hold-transition sidebar-mini"
        style="background: {{ request()->segment(1) == 'signup' ? '#6f3a97': '#f3f6f9' }};"> --}}
        {{-- {{ dd(request()->segment(1) ) }} --}}


        <div class="page-overlay">
            <div class="new-content">
                <div class="loader"></div>
                {{-- <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div> --}}
                <!-- <video playsinline autoplay loop >
                    <source src="{{asset('videos/loading_animation.mp4')}}" type="video/mp4">
                </video> -->
            </div>

        </div>
        <div id="app">
            @if(Route::is('public.newmall') || Route::is('public.newproducts') ||
            Route::is('mall.cart') || Route::is('mall.checkout') || Route::is('mall.show*') ||
            Route::is('public.success') ||
            Route::is('public.newproducts.single'))
            <div class="wrapper" style="background: white">
                <nav class="main-header navbar navbar-expand navbar-white navbar-light lgNavBar mt-4 mb-5"
                    style="background: white; box-shadow: none!important;border-bottom: none;">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" id="push"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                    <!-- SEARCH FORM -->
                    <form action="" style="margin-bottom: 0px;">
                        <div class="search-container">

                            <span class="input-group-text bg-transparent search-icon" onclick="runSearch()"
                                style="border: 0;"><i class="fa fa-search" aria-hidden="true"></i></span>

                            <input type="text" id="sq" value="search" class="search-input" placeholder="Search...">
                        </div>
                        {{-- <div class="input-group ig-border ml-1" style="border-radius: 100px;">
                            <input type="text" class="form-control" id="sq" placeholder="search"
                                style="border-radius: 100px; border: 0; background: white;">
                            <span class="input-group-text bg-transparent" style="border: 0;" ><i
                                    class="fa fa-search" aria-hidden="true"></i></span>
                        </div> --}}
                    </form>
                    @guest

                    @endguest
                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto mr-lg-5">

                        @auth
                        @if(auth()->user()->email_verified_at !== null)

                        @else
                        <li class="nav-item">
                            <a href="{{route('auth.logout')}}" class="logout nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form2').submit();" style="color: #6f3c96;"
                                title="Logout">
                                <i class="fa fa-power-off" aria-hidden="true" style="font-size: 25px !important;"></i>
                            </a>
                            <form id="logout-form2" action="{{ route('auth.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endif
                        @endauth

                        <li class="nav-item">
                            <button class="btn-design mr-3">
                                <a href="{{ route('mall.cart') }}" class="nav-link uSREICON"
                                    style="color: rgba(148, 202, 82, 1);">
                                    <svg width="22" height="22" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M25.013 6.25969C24.923 6.1491 24.8096 6.05995 24.6809 5.99872C24.5522 5.93748 24.4115 5.9057 24.269 5.90569H6.89895L6.82796 5.25169V5.23069C6.6596 3.9727 6.04097 2.81837 5.08669 1.98158C4.13241 1.14479 2.90716 0.68226 1.63796 0.679688C1.38361 0.679688 1.13969 0.780725 0.95984 0.960572C0.779992 1.14042 0.678955 1.38434 0.678955 1.63869C0.678955 1.89303 0.779992 2.13696 0.95984 2.3168C1.13969 2.49665 1.38361 2.59769 1.63796 2.59769C2.43999 2.59968 3.21425 2.89159 3.81797 3.41959C4.42168 3.94759 4.81414 4.67607 4.92296 5.47069L6.06295 15.9427C5.55905 16.171 5.13154 16.5396 4.83149 17.0044C4.53145 17.4691 4.37157 18.0105 4.37095 18.5637C4.37095 18.5717 4.37095 18.5797 4.37095 18.5877C4.37095 18.5957 4.37095 18.6037 4.37095 18.6117C4.37175 19.3745 4.67512 20.1058 5.21449 20.6452C5.75386 21.1845 6.48517 21.4879 7.24795 21.4887H7.63796C7.49324 21.9144 7.4521 22.3685 7.51795 22.8134C7.5838 23.2582 7.75473 23.6809 8.01658 24.0465C8.27843 24.412 8.62365 24.7099 9.02362 24.9154C9.42359 25.1209 9.86678 25.2281 10.3165 25.2281C10.7661 25.2281 11.2093 25.1209 11.6093 24.9154C12.0093 24.7099 12.3545 24.412 12.6163 24.0465C12.8782 23.6809 13.0491 23.2582 13.115 22.8134C13.1808 22.3685 13.1397 21.9144 12.995 21.4887H17.132C16.939 22.0559 16.9312 22.6697 17.1094 23.2416C17.2877 23.8136 17.643 24.3141 18.124 24.6712C18.6051 25.0283 19.1871 25.2235 19.7861 25.2286C20.3852 25.2337 20.9704 25.0485 21.4575 24.6996C21.9446 24.3508 22.3083 23.8564 22.4963 23.2875C22.6843 22.7187 22.6869 22.1049 22.5037 21.5345C22.3205 20.9641 21.9609 20.4666 21.4768 20.1137C20.9927 19.7607 20.409 19.5706 19.81 19.5707H7.24795C6.99369 19.5704 6.74992 19.4693 6.57013 19.2895C6.39034 19.1097 6.28922 18.8659 6.28896 18.6117C6.28896 18.6037 6.28896 18.5957 6.28896 18.5877C6.28896 18.5797 6.28896 18.5717 6.28896 18.5637C6.28922 18.3094 6.39034 18.0657 6.57013 17.8859C6.74992 17.7061 6.99369 17.605 7.24795 17.6047H19.49C20.3422 17.592 21.1723 17.3316 21.879 16.8551C22.5857 16.3787 23.1385 15.7069 23.47 14.9217C23.5227 14.8061 23.5519 14.6811 23.556 14.5541C23.56 14.4271 23.5387 14.3005 23.4934 14.1818C23.4481 14.063 23.3797 13.9545 23.292 13.8624C23.2044 13.7704 23.0994 13.6967 22.983 13.6456C22.8666 13.5945 22.7413 13.567 22.6142 13.5648C22.4871 13.5626 22.3609 13.5857 22.2428 13.6327C22.1247 13.6797 22.0172 13.7497 21.9264 13.8386C21.8356 13.9275 21.7634 14.0336 21.714 14.1507C21.5287 14.5924 21.2208 14.9719 20.8267 15.2441C20.4325 15.5163 19.9687 15.6699 19.49 15.6867H7.96395L7.10795 7.82369H23.089L22.62 10.0727C22.591 10.1971 22.5872 10.3261 22.6087 10.4521C22.6303 10.578 22.6768 10.6984 22.7456 10.8061C22.8143 10.9138 22.9039 11.0067 23.0091 11.0793C23.1142 11.152 23.2328 11.2028 23.3579 11.2289C23.483 11.2551 23.612 11.2559 23.7375 11.2315C23.8629 11.207 23.9822 11.1577 24.0883 11.0865C24.1944 11.0154 24.2852 10.9237 24.3554 10.8169C24.4256 10.7101 24.4737 10.5903 24.497 10.4647L25.207 7.06469C25.2368 6.92454 25.2349 6.77948 25.2013 6.64017C25.1677 6.50086 25.1034 6.37085 25.013 6.25969ZM19.813 21.4887C19.9931 21.4887 20.1693 21.5421 20.3191 21.6422C20.4689 21.7423 20.5857 21.8846 20.6546 22.0511C20.7236 22.2175 20.7416 22.4007 20.7065 22.5774C20.6713 22.7541 20.5845 22.9165 20.4571 23.0439C20.3297 23.1713 20.1674 23.258 19.9907 23.2932C19.814 23.3283 19.6308 23.3103 19.4643 23.2413C19.2979 23.1724 19.1556 23.0556 19.0555 22.9058C18.9554 22.756 18.902 22.5799 18.902 22.3997C18.9022 22.1587 18.9979 21.9276 19.168 21.7569C19.3382 21.5862 19.5689 21.4897 19.81 21.4887H19.813ZM10.32 21.4887C10.5001 21.4887 10.6763 21.5421 10.8261 21.6422C10.9759 21.7423 11.0927 21.8846 11.1616 22.0511C11.2306 22.2175 11.2486 22.4007 11.2135 22.5774C11.1783 22.7541 11.0915 22.9165 10.9641 23.0439C10.8367 23.1713 10.6744 23.258 10.4977 23.2932C10.321 23.3283 10.1378 23.3103 9.97133 23.2413C9.80487 23.1724 9.66259 23.0556 9.56249 22.9058C9.46238 22.756 9.40895 22.5799 9.40895 22.3997C9.40921 22.1588 9.50473 21.9279 9.67466 21.7572C9.84458 21.5865 10.0751 21.49 10.316 21.4887H10.32Z"
                                            fill="#94CA52" />
                                    </svg>

                                    <span id="vicomma-cart-cta">0</span>
                                    <span>Item</span>
                                </a>
                            </button>
                        </li>
                        <li class="nav-item ml-2">

                            <button class="btn-design" style="background: rgba(148, 202, 82, 1);">
                                <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON"
                                    style="color: rgb(255, 255, 255);">
                                    <svg width="22" height="22" viewBox="0 0 26 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23 1H3C1.89543 1 1 1.89543 1 3V19C1 20.1046 1.89543 21 3 21H23C24.1046 21 25 20.1046 25 19V3C25 1.89543 24.1046 1 23 1Z"
                                            stroke="white" stroke-width="2" />
                                        <path
                                            d="M17.3059 9.21919C17.2685 9.19581 17.2268 9.18004 17.1833 9.17276C17.1398 9.16549 17.0952 9.16686 17.0522 9.1768C17.0092 9.18673 16.9686 9.20504 16.9327 9.23067C16.8968 9.2563 16.8663 9.28876 16.8429 9.32619C16.8195 9.36361 16.8037 9.40528 16.7965 9.4488C16.7892 9.49232 16.7906 9.53685 16.8005 9.57985C16.8104 9.62284 16.8288 9.66346 16.8544 9.69937C16.88 9.73529 16.9125 9.76581 16.9499 9.78919C17.1289 9.90088 17.2765 10.0563 17.3788 10.2408C17.4811 10.4252 17.5348 10.6327 17.5348 10.8437C17.5348 11.0546 17.4811 11.2621 17.3788 11.4466C17.2765 11.6311 17.1289 11.7865 16.9499 11.8982L11.4419 15.3342C11.2538 15.4513 11.0378 15.516 10.8162 15.5216C10.5947 15.5272 10.3757 15.4735 10.1819 15.366C9.98814 15.2585 9.82662 15.1011 9.71409 14.9102C9.60156 14.7193 9.54211 14.5018 9.5419 14.2802V7.40819C9.54211 7.18658 9.60156 6.96907 9.71409 6.77816C9.82662 6.58726 9.98814 6.42991 10.1819 6.32241C10.3757 6.21491 10.5947 6.16117 10.8162 6.16676C11.0378 6.17235 11.2538 6.23706 11.4419 6.35419L14.6499 8.35419C14.6873 8.37756 14.729 8.39334 14.7725 8.40061C14.816 8.40788 14.8606 8.40651 14.9036 8.39658C14.9466 8.38664 14.9872 8.36833 15.0231 8.3427C15.059 8.31707 15.0895 8.28461 15.1129 8.24719C15.1363 8.20976 15.152 8.1681 15.1593 8.12457C15.1666 8.08105 15.1652 8.03652 15.1553 7.99353C15.1454 7.95053 15.127 7.90992 15.1014 7.874C15.0758 7.83808 15.0433 7.80756 15.0059 7.78419L11.7979 5.78419C11.5081 5.60343 11.1753 5.50351 10.8339 5.49477C10.4925 5.48603 10.1549 5.5688 9.8563 5.73449C9.55767 5.90018 9.30881 6.14276 9.13553 6.43706C8.96226 6.73136 8.87089 7.06667 8.8709 7.40819V14.2802C8.86844 14.6223 8.95884 14.9587 9.13248 15.2535C9.30612 15.5483 9.55649 15.7905 9.8569 15.9542C10.1548 16.1224 10.4927 16.2068 10.8347 16.1981C11.1767 16.1895 11.5099 16.0883 11.7989 15.9052L17.3089 12.4692C17.5848 12.2973 17.8124 12.0579 17.9702 11.7737C18.128 11.4895 18.2108 11.1698 18.2108 10.8447C18.2108 10.5196 18.128 10.1999 17.9702 9.91566C17.8124 9.63144 17.5848 9.39209 17.3089 9.22019L17.3059 9.21919Z"
                                            fill="white" stroke="white" />
                                    </svg>
                                    <span>Post A Video</span>
                                </a>
                            </button>
                        </li>
                    </ul>
                    @auth
                    <noti-alert :user-prop="{{Auth::user()->id}}" :user-role="{{Auth::user()->role}}" />
                    @endauth
                </nav>
                <!-- /.navbar -->


                <!-- Navbar for Mobile screens -->
                <nav class="navbar navbar-expand navbar-white navbar-light smNavbar mb-4"
                    style="background: #f3f6f9; box-shadow: none!important;justify-content: space-between;border-bottom: none;">
                    <div>
                        <a class="" href="{{route('user.dashboard')}}">
                            <img src="{{asset('/img/sidebarlogo.png')}}" alt="" width="30" height="24">
                        </a>
                    </div>


                    <!-- SEARCH FORM -->
                    <!-- Right navbar links -->
                    <ul class="navbar-nav sm-nav-bar">

                        @auth
                        @if(auth()->user()->email_verified_at !== null)

                        @else
                        <li class="nav-item">
                            <a href="{{route('auth.logout')}}" class="logout nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form3').submit();" style="color: #6f3c96;"
                                title="Logout">
                                <i class="fa fa-power-off" aria-hidden="true"
                                    style="ffont-size: 1.2rem !important;"></i>
                            </a>
                            <form id="logout-form3" action="{{ route('auth.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endif
                        @endauth

                        <li class="nav-item">
                            <button class="btn-design mr-3">
                                <a href="{{ route('mall.cart') }}" class="nav-link uSREICON" style="color: rgba(148, 202, 82, 1);padding: 0px;
                                width: 115px;">

                                    <span id="vicomma-cart-cta">0</span>
                                    <span>Item</span>
                                </a>
                            </button>
                        </li>
                        <li class="nav-item ml-2">

                            <button class="btn-design" style="background: rgba(148, 202, 82, 1);">
                                <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON" style="color: rgb(255, 255, 255);padding: 0px;
                                width: 115px;">

                                    <span>Post A Video</span>
                                </a>
                            </button>
                        </li>
                    </ul>


                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" id="push"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->


                @include('pages.partials.sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">

                    <!-- Main content -->
                    <div class="content">
                        <div class="pb-4">

                            @include('includes.search-modal')
                            @yield('content')
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>

                @elseif (Route::is('user*'))
                <div class="wrapper" style="background: white">
                    <!-- Navbar for large screens -->

                    <nav class="main-header navbar navbar-expand navbar-white navbar-light lgNavBar"
                        style="background: white; box-shadow: none!important;">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" id="push"><i
                                        class="fas fa-bars"></i></a>
                            </li>
                        </ul>
                        <!-- SEARCH FORM -->
                        <form action="" style="margin-bottom: 0px;">
                            <div class="input-group ig-border ml-1" style="border-radius: 100px;">
                                <input type="text" class="form-control" id="sq" placeholder="search"
                                    style="border-radius: 100px; border: 0; background: white;">
                                <span class="input-group-text bg-transparent" style="border: 0;"
                                    onclick="runSearch()"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </form>
                        @guest
                        <ul class="navbar-nav m-auto" style="padding-left: 85px;">
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/signup" class="nav-link">Sign Up</a>
                            </li>
                        </ul>
                        @endguest
                        <!-- Right navbar links -->
                        <ul class="navbar-nav ml-auto mr-lg-5">

                            @auth
                            @if(auth()->user()->email_verified_at !== null)
                            <li class="nav-item dropdown p-icon">
                                <a class="nav-link uSREICON" data-toggle="dropdown" href="javascript:void(0);"
                                    aria-expanded="true">
                                    <i class="far fa-user" style="font-size: 1.45rem;"></i>
                                </a>
                                <div class="dropdown-menu" style="left: -50px;min-width: 15rem;">
                                    <div class="p-2" style="display: flex;gap:10px;">
                                        <div style="font-size: 25px;
    background: #ededed;
    padding: 10px;
    border-radius: 50%;
    color: #703d96;    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;">
                                            <i class="bi bi-person-workspace"></i>
                                        </div>
                                        <div>
                                            <p class="text-dark small auth-name"
                                                style="margin-bottom: 0px; font-size: 15px;">
                                                {{auth()->user()->first_name}}
                                                {{auth()->user()->last_name}}</p>
                                            <p class="text-dark small auth-email"
                                                style="margin-bottom: 0px; font-size: 12px;">{{auth()->user()->email}}
                                            </p>
                                        </div>
                                    </div>
                                    @if(auth()->user()->isRole("vendor") && auth()->user()->isRole("creative"))
                                    <div class="dropdown-item swt">
                                        <p class="text-dark small" style="margin-bottom: 0px;">Current Role</p>
                                        <div class="inputGroup">
                                            <input id="radio3" name="role" type="radio" />
                                            <label for="radio3">Vendor</label>
                                        </div>
                                        <div class="inputGroup">
                                            <input id="radio4" name="role" type="radio" />
                                            <label for="radio4">Creative</label>
                                        </div>
                                    </div>
                                    @endif
                                    <a href="{{route('user.view.profile')}}" class="dropdown-item usredwn">
                                        {{-- <i class="far fa-user mr-2"></i> --}}
                                        Profile
                                    </a>
                                    <a href="{{route('user.profile')}}" class="dropdown-item usredwn">

                                        Settings
                                    </a>
                                    @if (Auth::user()->hasRole('creative'))
                                    <a href="{{route('user.jobs.bids.insight')}}" class="dropdown-item usredwn">
                                        Bids Insight
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('creative'))
                                    <a href="{{route('user.profile.referrals')}}" class="dropdown-item usredwn">
                                        Referrals
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('vendor'))
                                    <a href="{{route('user.jobs.my-jobs')}}" class="dropdown-item usredwn">
                                        My Jobs
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('vendor'))
                                    <a href="{{route('user.jobs.deleted-jobs')}}" class="dropdown-item usredwn">
                                        Deleted Jobs
                                    </a>
                                    @endif
                                    <a href="{{route('user.mall.orders')}}" class="dropdown-item usredwn">
                                        My Orders
                                    </a>
                                    <a href="{{route('user.gwallet.index')}}" class="dropdown-item usredwn">
                                        Wallet
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('auth.logout')}}" class="logout dropdown-item usredwn" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <notification-icon :user-prop="{{Auth::user()->id}}" />
                            </li>
                            @else
                            <li class="nav-item">
                                <a href="{{route('auth.logout')}}" class="logout nav-link" onclick="event.preventDefault();
                                            document.getElementById('logout-form2').submit();" style="color: #6f3c96;"
                                    title="Logout">
                                    <i class="fa fa-power-off" aria-hidden="true"
                                        style="font-size: 25px !important;"></i>
                                </a>
                                <form id="logout-form2" action="{{ route('auth.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endif
                            @endauth

                            <li class="nav-item">
                                <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON">
                                    {{-- <i class="fas fa-shopping-cart text-lg" aria-hidden="true" style="color: var(--snd-color)"></i> --}}
                                    <svg width="22" height="22" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M25.0127 6.25969C24.9228 6.1491 24.8094 6.05995 24.6807 5.99872C24.552 5.93748 24.4112 5.9057 24.2687 5.90569H6.89871L6.82771 5.25169V5.23069C6.65936 3.9727 6.04073 2.81837 5.08644 1.98158C4.13216 1.14479 2.90691 0.68226 1.63771 0.679688C1.38337 0.679688 1.13944 0.780725 0.959596 0.960572C0.779748 1.14042 0.678711 1.38434 0.678711 1.63869C0.678711 1.89303 0.779748 2.13696 0.959596 2.3168C1.13944 2.49665 1.38337 2.59769 1.63771 2.59769C2.43974 2.59968 3.21401 2.89159 3.81772 3.41959C4.42144 3.94759 4.81389 4.67607 4.92271 5.47069L6.06271 15.9427C5.55881 16.171 5.13129 16.5396 4.83125 17.0044C4.53121 17.4691 4.37133 18.0105 4.37071 18.5637C4.37071 18.5717 4.37071 18.5797 4.37071 18.5877C4.37071 18.5957 4.37071 18.6037 4.37071 18.6117C4.37151 19.3745 4.67487 20.1058 5.21424 20.6452C5.75361 21.1845 6.48493 21.4879 7.24771 21.4887H7.63771C7.493 21.9144 7.45186 22.3685 7.51771 22.8134C7.58355 23.2582 7.75449 23.6809 8.01634 24.0465C8.27819 24.412 8.62341 24.7099 9.02338 24.9154C9.42335 25.1209 9.86654 25.2281 10.3162 25.2281C10.7659 25.2281 11.2091 25.1209 11.609 24.9154C12.009 24.7099 12.3542 24.412 12.6161 24.0465C12.8779 23.6809 13.0489 23.2582 13.1147 22.8134C13.1806 22.3685 13.1394 21.9144 12.9947 21.4887H17.1317C16.9388 22.0559 16.9309 22.6697 17.1092 23.2416C17.2875 23.8136 17.6428 24.3141 18.1238 24.6712C18.6048 25.0283 19.1868 25.2235 19.7859 25.2286C20.385 25.2337 20.9702 25.0485 21.4573 24.6996C21.9443 24.3508 22.3081 23.8564 22.4961 23.2875C22.6841 22.7187 22.6867 22.1049 22.5035 21.5345C22.3202 20.9641 21.9607 20.4666 21.4766 20.1137C20.9925 19.7607 20.4088 19.5706 19.8097 19.5707H7.24771C6.99345 19.5704 6.74968 19.4693 6.56989 19.2895C6.3901 19.1097 6.28898 18.8659 6.28871 18.6117C6.28871 18.6037 6.28871 18.5957 6.28871 18.5877C6.28871 18.5797 6.28871 18.5717 6.28871 18.5637C6.28898 18.3094 6.3901 18.0657 6.56989 17.8859C6.74968 17.7061 6.99345 17.605 7.24771 17.6047H19.4897C20.3419 17.592 21.172 17.3316 21.8788 16.8551C22.5855 16.3787 23.1383 15.7069 23.4697 14.9217C23.5225 14.8061 23.5517 14.6811 23.5557 14.5541C23.5598 14.4271 23.5385 14.3005 23.4932 14.1818C23.4479 14.063 23.3794 13.9545 23.2918 13.8624C23.2042 13.7704 23.0991 13.6967 22.9827 13.6456C22.8664 13.5945 22.741 13.567 22.614 13.5648C22.4869 13.5626 22.3606 13.5857 22.2426 13.6327C22.1245 13.6797 22.0169 13.7497 21.9261 13.8386C21.8353 13.9275 21.7631 14.0336 21.7137 14.1507C21.5285 14.5924 21.2206 14.9719 20.8264 15.2441C20.4323 15.5163 19.9684 15.6699 19.4897 15.6867H7.96371L7.10771 7.82369H23.0887L22.6197 10.0727C22.5907 10.1971 22.5869 10.3261 22.6085 10.4521C22.6301 10.578 22.6766 10.6984 22.7453 10.8061C22.8141 10.9138 22.9037 11.0067 23.0088 11.0793C23.114 11.152 23.2326 11.2028 23.3577 11.2289C23.4828 11.2551 23.6118 11.2559 23.7372 11.2315C23.8627 11.207 23.9819 11.1577 24.088 11.0865C24.1942 11.0154 24.285 10.9237 24.3552 10.8169C24.4253 10.7101 24.4735 10.5903 24.4967 10.4647L25.2067 7.06469C25.2366 6.92454 25.2346 6.77948 25.2011 6.64017C25.1675 6.50086 25.1031 6.37085 25.0127 6.25969ZM19.8127 21.4887C19.9929 21.4887 20.169 21.5421 20.3188 21.6422C20.4686 21.7423 20.5854 21.8846 20.6544 22.0511C20.7233 22.2175 20.7414 22.4007 20.7062 22.5774C20.6711 22.7541 20.5843 22.9165 20.4569 23.0439C20.3295 23.1713 20.1672 23.258 19.9904 23.2932C19.8137 23.3283 19.6306 23.3103 19.4641 23.2413C19.2976 23.1724 19.1553 23.0556 19.0552 22.9058C18.9551 22.756 18.9017 22.5799 18.9017 22.3997C18.902 22.1587 18.9976 21.9276 19.1678 21.7569C19.3379 21.5862 19.5687 21.4897 19.8097 21.4887H19.8127ZM10.3197 21.4887C10.4999 21.4887 10.676 21.5421 10.8258 21.6422C10.9756 21.7423 11.0924 21.8846 11.1614 22.0511C11.2303 22.2175 11.2484 22.4007 11.2132 22.5774C11.1781 22.7541 11.0913 22.9165 10.9639 23.0439C10.8365 23.1713 10.6742 23.258 10.4974 23.2932C10.3207 23.3283 10.1376 23.3103 9.97109 23.2413C9.80462 23.1724 9.66234 23.0556 9.56224 22.9058C9.46214 22.756 9.40871 22.5799 9.40871 22.3997C9.40897 22.1588 9.50449 21.9279 9.67441 21.7572C9.84434 21.5865 10.0749 21.49 10.3157 21.4887H10.3197Z"
                                            fill="#6F3C96" />
                                    </svg>
                                    <span id="vicomma-cart-cta" class="badge badge-warning navbar-badge">0</span>
                                </a>
                            </li>
                            <li class="nav-item ml-2">
                                <a href="/guser" class="nav-link">
                                    {{-- <img alt="" class="icon" src="{{asset('/img/video2.png')}}"> --}}
                                    <svg width="26" height="22" viewBox="0 0 26 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23 1H3C1.89543 1 1 1.89543 1 3V19C1 20.1046 1.89543 21 3 21H23C24.1046 21 25 20.1046 25 19V3C25 1.89543 24.1046 1 23 1Z"
                                            stroke="#6F3C96" stroke-width="2" />
                                        <path
                                            d="M17.3061 9.22114C17.2687 9.19776 17.2271 9.18199 17.1835 9.17472C17.14 9.16744 17.0955 9.16881 17.0525 9.17875C17.0095 9.18869 16.9689 9.20699 16.933 9.23262C16.897 9.25826 16.8665 9.29071 16.8431 9.32814C16.8198 9.36557 16.804 9.40723 16.7967 9.45075C16.7894 9.49428 16.7908 9.53881 16.8008 9.5818C16.8107 9.62479 16.829 9.66541 16.8546 9.70133C16.8803 9.73725 16.9127 9.76776 16.9501 9.79114C17.1291 9.90283 17.2767 10.0582 17.379 10.2427C17.4814 10.4272 17.5351 10.6347 17.5351 10.8456C17.5351 11.0566 17.4814 11.2641 17.379 11.4486C17.2767 11.633 17.1291 11.7885 16.9501 11.9001L11.4421 15.3361C11.254 15.4533 11.038 15.518 10.8165 15.5236C10.5949 15.5292 10.376 15.4754 10.1822 15.3679C9.98839 15.2604 9.82686 15.1031 9.71433 14.9122C9.6018 14.7213 9.54235 14.5037 9.54214 14.2821V7.41014C9.54235 7.18854 9.6018 6.97102 9.71433 6.78012C9.82686 6.58921 9.98839 6.43186 10.1822 6.32436C10.376 6.21686 10.5949 6.16313 10.8165 6.16871C11.038 6.1743 11.254 6.23901 11.4421 6.35614L14.6501 8.35614C14.6876 8.37952 14.7292 8.39529 14.7728 8.40256C14.8163 8.40984 14.8608 8.40847 14.9038 8.39853C14.9468 8.38859 14.9874 8.37029 15.0233 8.34466C15.0592 8.31902 15.0898 8.28657 15.1131 8.24914C15.1365 8.21171 15.1523 8.17005 15.1596 8.12653C15.1668 8.083 15.1655 8.03847 15.1555 7.99548C15.1456 7.95249 15.1273 7.91187 15.1017 7.87595C15.076 7.84003 15.0436 7.80951 15.0061 7.78614L11.7981 5.78614C11.5084 5.60539 11.1755 5.50546 10.8341 5.49672C10.4927 5.48798 10.1552 5.57075 9.85654 5.73644C9.55791 5.90214 9.30905 6.14472 9.13578 6.43902C8.96251 6.73332 8.87113 7.06862 8.87114 7.41014V14.2821C8.86868 14.6243 8.95909 14.9606 9.13273 15.2554C9.30637 15.5502 9.55673 15.7924 9.85714 15.9561C10.155 16.1244 10.4929 16.2087 10.8349 16.2001C11.1769 16.1914 11.5101 16.0902 11.7991 15.9071L17.3091 12.4711C17.5851 12.2992 17.8126 12.0599 17.9704 11.7757C18.1282 11.4914 18.211 11.1717 18.211 10.8466C18.211 10.5216 18.1282 10.2018 17.9704 9.91761C17.8126 9.63339 17.5851 9.39404 17.3091 9.22214L17.3061 9.22114Z"
                                            fill="white" stroke="#6F3C96" />
                                    </svg>
                                    {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                                </a>
                            </li>
                        </ul>
                        @auth
                        <noti-alert :user-prop="{{Auth::user()->id}}" :user-role="{{Auth::user()->role}}" />
                        @endauth
                    </nav>
                    <!-- /.navbar -->


                    <!-- Navbar for Mobile screens -->
                    <nav class="main-header navbar navbar-expand navbar-white navbar-light smNavbar"
                        style="background: #f3f6f9; box-shadow: none!important;">
                        <div class="container">
                            <a class="" href="{{route('user.dashboard')}}">
                                <img src="{{asset('/img/sidebarlogo.png')}}" alt="" width="30" height="24">
                            </a>
                        </div>


                        <!-- SEARCH FORM -->
                        <!-- Right navbar links -->
                        <ul class="navbar-nav sm-nav-bar">

                            @auth
                            @if(auth()->user()->email_verified_at !== null)
                            <li class="nav-item">
                                <notification-icon :user-prop="{{Auth::user()->id}}" />
                            </li>
                            <li class="nav-item dropdown p-icon">
                                <a class="nav-link uSREICON " data-toggle="dropdown" href="#" aria-expanded="true">
                                    <i class="far fa-user" style="font-size: 1.2rem; margin-top: 3px;"></i>
                                </a>
                                <div class="dropdown-menu" style="left: -80px;min-width: 15rem;">
                                    @if(auth()->user()->isRole("vendor") && auth()->user()->isRole("creative"))
                                    <div class="dropdown-item swt">
                                        <p class="text-dark small">Current Role</p>
                                        <div class="inputGroup">
                                            <input id="radio1" name="role" type="radio" />
                                            <label for="radio1">Vendor</label>
                                        </div>
                                        <div class="inputGroup">
                                            <input id="radio2" name="role" type="radio" />
                                            <label for="radio2">Creative</label>
                                        </div>
                                    </div>
                                    @endif
                                    <a href="{{route('user.view.profile')}}" class="dropdown-item usredwn">
                                        {{-- <i class="far fa-user mr-2"></i> --}}
                                        View Profile
                                    </a>
                                    <a href="{{route('user.profile')}}" class="dropdown-item usredwn">
                                        {{-- <span> --}}

                                        {{-- <svg class="mr-1" width="20" height="20" viewBox="0 0 21 21" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M6.61418 20C6.12621 19.9971 5.6524 19.8357 5.26419 19.54L3.19419 18C2.7165 17.6276 2.39954 17.0863 2.30841 16.4875C2.21729 15.8887 2.35891 15.2777 2.70419 14.78C2.88687 14.5102 3.00298 14.201 3.04296 13.8777C3.08294 13.5543 3.04566 13.2261 2.93419 12.92L2.87419 12.76C2.79656 12.4829 2.65469 12.228 2.46009 12.0161C2.26549 11.8041 2.02364 11.641 1.75419 11.54H1.59419C1.01006 11.3436 0.526995 10.9247 0.249894 10.3742C-0.0272063 9.82374 -0.0759726 9.1862 0.114185 8.6L0.934185 6C1.00967 5.69876 1.14864 5.41713 1.3418 5.17396C1.53496 4.93078 1.77784 4.73169 2.05419 4.59C2.31154 4.4574 2.59312 4.3784 2.88188 4.35777C3.17065 4.33715 3.4606 4.37533 3.73419 4.47C4.03207 4.57025 4.34993 4.59624 4.66014 4.5457C4.97035 4.49516 5.26353 4.36962 5.51419 4.18L5.64419 4.08C5.87108 3.89895 6.05446 3.6693 6.1808 3.40796C6.30714 3.14663 6.37322 2.86027 6.37419 2.57V2.33C6.3715 1.71813 6.61064 1.12997 7.03953 0.693583C7.46843 0.257192 8.05236 0.00790627 8.66419 0H11.2142C11.5119 0.000802192 11.8064 0.0604042 12.081 0.175383C12.3556 0.290362 12.6048 0.458452 12.8142 0.67C13.2545 1.11779 13.4991 1.72202 13.4942 2.35V2.63C13.4891 2.90575 13.5489 3.17884 13.6688 3.42723C13.7886 3.67562 13.9652 3.89237 14.1842 4.06L14.2942 4.14C14.5186 4.3083 14.7804 4.41984 15.0573 4.46511C15.3341 4.51038 15.6178 4.48805 15.8842 4.4L16.2242 4.29C16.5122 4.19451 16.8166 4.15802 17.1191 4.1827C17.4215 4.20737 17.7159 4.29272 17.9847 4.43364C18.2535 4.57456 18.4911 4.76817 18.6835 5.00292C18.8758 5.23767 19.0189 5.50876 19.1042 5.8L19.8942 8.32C20.077 8.90239 20.027 9.53296 19.7548 10.0793C19.4825 10.6256 19.0092 11.0452 18.4342 11.25L18.2342 11.32C17.94 11.4163 17.674 11.5834 17.4596 11.8066C17.2451 12.0298 17.0887 12.3022 17.0042 12.6C16.9246 12.8768 16.9057 13.1675 16.9489 13.4523C16.992 13.7371 17.0962 14.0092 17.2542 14.25L17.5142 14.63C17.859 15.1304 17.9993 15.7438 17.9063 16.3444C17.8133 16.945 17.4942 17.4872 17.0142 17.86L15.0042 19.41C14.7614 19.5957 14.4831 19.7297 14.1865 19.8039C13.8899 19.878 13.5813 19.8906 13.2796 19.8409C12.978 19.7913 12.6897 19.6804 12.4325 19.5152C12.1753 19.3499 11.9547 19.1337 11.7842 18.88L11.6642 18.71C11.5004 18.4639 11.2769 18.2632 11.0146 18.1268C10.7523 17.9904 10.4597 17.9227 10.1642 17.93C9.88216 17.9373 9.6058 18.0108 9.3574 18.1445C9.10901 18.2783 8.89553 18.4686 8.73419 18.7L8.50419 19.03C8.33363 19.2855 8.11255 19.5034 7.85457 19.6702C7.5966 19.8371 7.30719 19.9493 7.00419 20C6.8745 20.0127 6.74387 20.0127 6.61418 20ZM2.40419 9.62C2.96888 9.82136 3.47841 10.1525 3.89178 10.5867C4.30516 11.0209 4.61082 11.5461 4.78419 12.12V12.24C5.00012 12.8366 5.07102 13.4761 4.99104 14.1055C4.91105 14.735 4.68248 15.3363 4.32419 15.86C4.26094 15.9299 4.22592 16.0208 4.22592 16.115C4.22592 16.2092 4.26094 16.3001 4.32419 16.37L6.47419 18C6.50224 18.022 6.53468 18.0378 6.56933 18.0463C6.60398 18.0547 6.64004 18.0557 6.67508 18.049C6.71013 18.0424 6.74335 18.0284 6.77252 18.0078C6.80169 17.9873 6.82612 17.9608 6.84419 17.93L7.07418 17.6C7.42107 17.0988 7.88433 16.6891 8.42424 16.4062C8.96416 16.1232 9.56463 15.9754 10.1742 15.9754C10.7837 15.9754 11.3842 16.1232 11.9241 16.4062C12.464 16.6891 12.9273 17.0988 13.2742 17.6L13.3942 17.78C13.4372 17.841 13.5013 17.8838 13.5742 17.9C13.6076 17.9049 13.6416 17.903 13.6743 17.8944C13.707 17.8859 13.7375 17.8707 13.7642 17.85L15.8242 16.29C15.8963 16.2328 15.9437 16.1501 15.9568 16.0589C15.9698 15.9678 15.9474 15.8751 15.8942 15.8L15.6342 15.42C15.2954 14.926 15.0719 14.3622 14.9802 13.7703C14.8884 13.1783 14.9308 12.5734 15.1042 12C15.2799 11.3974 15.5978 10.8458 16.0311 10.3916C16.4644 9.93738 17.0005 9.59389 17.5942 9.39L17.7942 9.32C17.8775 9.28661 17.9443 9.2216 17.9799 9.13917C18.0155 9.05674 18.017 8.96357 17.9842 8.88L17.2042 6.39C17.1855 6.34643 17.1581 6.30713 17.1237 6.27446C17.0893 6.2418 17.0487 6.21647 17.0042 6.2C16.9747 6.18507 16.9422 6.17728 16.9092 6.17728C16.8762 6.17728 16.8436 6.18507 16.8142 6.2L16.4742 6.31C15.899 6.49982 15.2864 6.54712 14.6889 6.44783C14.0914 6.34855 13.527 6.10564 13.0442 5.74L13.0042 5.65C12.5409 5.29912 12.1652 4.84561 11.9067 4.32509C11.6481 3.80456 11.5138 3.23119 11.5142 2.65V2.34C11.516 2.24362 11.4801 2.15033 11.4142 2.08C11.3567 2.02801 11.2817 1.99946 11.2042 2H8.66419C8.62345 2.00254 8.58361 2.01311 8.54696 2.03109C8.51032 2.04906 8.47758 2.0741 8.45064 2.10476C8.42369 2.13542 8.40307 2.1711 8.38995 2.20976C8.37683 2.24841 8.37147 2.28927 8.37419 2.33V2.58C8.37425 3.17704 8.23723 3.76612 7.9737 4.30185C7.71017 4.83758 7.32716 5.30565 6.85419 5.67L6.72419 5.77C6.21391 6.15851 5.61591 6.41553 4.98288 6.51842C4.34985 6.62131 3.70123 6.5669 3.09419 6.36C3.04876 6.34476 2.99961 6.34476 2.95419 6.36C2.89775 6.39429 2.85525 6.44741 2.83419 6.51L2.00419 9.12C1.97525 9.20889 1.98203 9.30555 2.02309 9.38953C2.06415 9.47352 2.13627 9.53824 2.22418 9.57L2.40419 9.62Z"
                                                                            fill="#6F3C96" />
                                                                        <path
                                                                            d="M10.0042 13.5C9.31195 13.5 8.63526 13.2947 8.05969 12.9101C7.48411 12.5256 7.03551 11.9789 6.7706 11.3394C6.5057 10.6999 6.43639 9.99612 6.57143 9.31719C6.70648 8.63825 7.03983 8.01461 7.52931 7.52513C8.01879 7.03564 8.64243 6.7023 9.32137 6.56725C10.0003 6.4322 10.704 6.50152 11.3436 6.76642C11.9831 7.03133 12.5297 7.47993 12.9143 8.05551C13.2989 8.63108 13.5042 9.30777 13.5042 10C13.5042 10.9283 13.1354 11.8185 12.4791 12.4749C11.8227 13.1313 10.9324 13.5 10.0042 13.5ZM10.0042 8.5C9.70751 8.5 9.4175 8.58798 9.17083 8.7528C8.92415 8.91762 8.73189 9.15189 8.61836 9.42598C8.50483 9.70007 8.47513 10.0017 8.533 10.2926C8.59088 10.5836 8.73374 10.8509 8.94352 11.0607C9.1533 11.2704 9.42058 11.4133 9.71155 11.4712C10.0025 11.5291 10.3041 11.4994 10.5782 11.3858C10.8523 11.2723 11.0866 11.08 11.2514 10.8334C11.4162 10.5867 11.5042 10.2967 11.5042 10C11.5042 9.60218 11.3461 9.22065 11.0648 8.93934C10.7835 8.65804 10.402 8.5 10.0042 8.5Z"
                                                                            fill="#6F3C96" />
                                                                    </svg> --}}
                                        {{-- </span> --}}
                                        Settings
                                    </a>
                                    @if (Auth::user()->hasRole('creative'))
                                    <a href="{{route('user.jobs.bids.insight')}}" class="dropdown-item usredwn">
                                        Bids Insight
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('creative'))
                                    <a href="{{route('user.profile.referrals')}}" class="dropdown-item usredwn">
                                        Referrals
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('vendor'))
                                    <a href="{{route('user.jobs.my-jobs')}}" class="dropdown-item usredwn">
                                        My Jobs
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('vendor'))
                                    <a href="{{route('user.jobs.deleted-jobs')}}" class="dropdown-item usredwn">
                                        Deleted Jobs
                                    </a>
                                    @endif
                                    <a href="{{route('user.mall.orders')}}" class="dropdown-item usredwn">
                                        My Orders
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    {{-- <a href="#" class="dropdown-item dropdown-footer"> --}}
                                    <a href="{{route('auth.logout')}}" class="logout dropdown-item usredwn" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                        {{-- <svg class="mr-1" width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 13V14C11 14.7956 10.6839 15.5587 10.1213 16.1213C9.55871 16.6839 8.79565 17 8 17H4C3.20435 17 2.44129 16.6839 1.87868 16.1213C1.31607 15.5587 1 14.7956 1 14V4C1 3.20435 1.31607 2.44129 1.87868 1.87868C2.44129 1.31607 3.20435 1 4 1H8C8.79565 1 9.55871 1.31607 10.1213 1.87868C10.6839 2.44129 11 3.20435 11 4V5M15 13L19 9L15 13ZM19 9L15 5L19 9ZM19 9H5H19Z"
                                                                            stroke="#6F3C96" stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg> --}}
                                        Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    {{-- </a> --}}
                                </div>
                            </li>
                            @else
                            <li class="nav-item">
                                <a href="{{route('auth.logout')}}" class="logout nav-link" onclick="event.preventDefault();
                                            document.getElementById('logout-form3').submit();" style="color: #6f3c96;"
                                    title="Logout">
                                    <i class="fa fa-power-off" aria-hidden="true"
                                        style="ffont-size: 1.2rem !important;"></i>
                                </a>
                                <form id="logout-form3" action="{{ route('auth.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endif
                            @endauth
                            <li class="nav-item">
                                <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON">
                                    {{-- <i class="fas fa-shopping-cart text-lg" aria-hidden="true" style="color: var(--snd-color)"></i> --}}
                                    <svg width="20" height="20" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M25.0127 6.25969C24.9228 6.1491 24.8094 6.05995 24.6807 5.99872C24.552 5.93748 24.4112 5.9057 24.2687 5.90569H6.89871L6.82771 5.25169V5.23069C6.65936 3.9727 6.04073 2.81837 5.08644 1.98158C4.13216 1.14479 2.90691 0.68226 1.63771 0.679688C1.38337 0.679688 1.13944 0.780725 0.959596 0.960572C0.779748 1.14042 0.678711 1.38434 0.678711 1.63869C0.678711 1.89303 0.779748 2.13696 0.959596 2.3168C1.13944 2.49665 1.38337 2.59769 1.63771 2.59769C2.43974 2.59968 3.21401 2.89159 3.81772 3.41959C4.42144 3.94759 4.81389 4.67607 4.92271 5.47069L6.06271 15.9427C5.55881 16.171 5.13129 16.5396 4.83125 17.0044C4.53121 17.4691 4.37133 18.0105 4.37071 18.5637C4.37071 18.5717 4.37071 18.5797 4.37071 18.5877C4.37071 18.5957 4.37071 18.6037 4.37071 18.6117C4.37151 19.3745 4.67487 20.1058 5.21424 20.6452C5.75361 21.1845 6.48493 21.4879 7.24771 21.4887H7.63771C7.493 21.9144 7.45186 22.3685 7.51771 22.8134C7.58355 23.2582 7.75449 23.6809 8.01634 24.0465C8.27819 24.412 8.62341 24.7099 9.02338 24.9154C9.42335 25.1209 9.86654 25.2281 10.3162 25.2281C10.7659 25.2281 11.2091 25.1209 11.609 24.9154C12.009 24.7099 12.3542 24.412 12.6161 24.0465C12.8779 23.6809 13.0489 23.2582 13.1147 22.8134C13.1806 22.3685 13.1394 21.9144 12.9947 21.4887H17.1317C16.9388 22.0559 16.9309 22.6697 17.1092 23.2416C17.2875 23.8136 17.6428 24.3141 18.1238 24.6712C18.6048 25.0283 19.1868 25.2235 19.7859 25.2286C20.385 25.2337 20.9702 25.0485 21.4573 24.6996C21.9443 24.3508 22.3081 23.8564 22.4961 23.2875C22.6841 22.7187 22.6867 22.1049 22.5035 21.5345C22.3202 20.9641 21.9607 20.4666 21.4766 20.1137C20.9925 19.7607 20.4088 19.5706 19.8097 19.5707H7.24771C6.99345 19.5704 6.74968 19.4693 6.56989 19.2895C6.3901 19.1097 6.28898 18.8659 6.28871 18.6117C6.28871 18.6037 6.28871 18.5957 6.28871 18.5877C6.28871 18.5797 6.28871 18.5717 6.28871 18.5637C6.28898 18.3094 6.3901 18.0657 6.56989 17.8859C6.74968 17.7061 6.99345 17.605 7.24771 17.6047H19.4897C20.3419 17.592 21.172 17.3316 21.8788 16.8551C22.5855 16.3787 23.1383 15.7069 23.4697 14.9217C23.5225 14.8061 23.5517 14.6811 23.5557 14.5541C23.5598 14.4271 23.5385 14.3005 23.4932 14.1818C23.4479 14.063 23.3794 13.9545 23.2918 13.8624C23.2042 13.7704 23.0991 13.6967 22.9827 13.6456C22.8664 13.5945 22.741 13.567 22.614 13.5648C22.4869 13.5626 22.3606 13.5857 22.2426 13.6327C22.1245 13.6797 22.0169 13.7497 21.9261 13.8386C21.8353 13.9275 21.7631 14.0336 21.7137 14.1507C21.5285 14.5924 21.2206 14.9719 20.8264 15.2441C20.4323 15.5163 19.9684 15.6699 19.4897 15.6867H7.96371L7.10771 7.82369H23.0887L22.6197 10.0727C22.5907 10.1971 22.5869 10.3261 22.6085 10.4521C22.6301 10.578 22.6766 10.6984 22.7453 10.8061C22.8141 10.9138 22.9037 11.0067 23.0088 11.0793C23.114 11.152 23.2326 11.2028 23.3577 11.2289C23.4828 11.2551 23.6118 11.2559 23.7372 11.2315C23.8627 11.207 23.9819 11.1577 24.088 11.0865C24.1942 11.0154 24.285 10.9237 24.3552 10.8169C24.4253 10.7101 24.4735 10.5903 24.4967 10.4647L25.2067 7.06469C25.2366 6.92454 25.2346 6.77948 25.2011 6.64017C25.1675 6.50086 25.1031 6.37085 25.0127 6.25969ZM19.8127 21.4887C19.9929 21.4887 20.169 21.5421 20.3188 21.6422C20.4686 21.7423 20.5854 21.8846 20.6544 22.0511C20.7233 22.2175 20.7414 22.4007 20.7062 22.5774C20.6711 22.7541 20.5843 22.9165 20.4569 23.0439C20.3295 23.1713 20.1672 23.258 19.9904 23.2932C19.8137 23.3283 19.6306 23.3103 19.4641 23.2413C19.2976 23.1724 19.1553 23.0556 19.0552 22.9058C18.9551 22.756 18.9017 22.5799 18.9017 22.3997C18.902 22.1587 18.9976 21.9276 19.1678 21.7569C19.3379 21.5862 19.5687 21.4897 19.8097 21.4887H19.8127ZM10.3197 21.4887C10.4999 21.4887 10.676 21.5421 10.8258 21.6422C10.9756 21.7423 11.0924 21.8846 11.1614 22.0511C11.2303 22.2175 11.2484 22.4007 11.2132 22.5774C11.1781 22.7541 11.0913 22.9165 10.9639 23.0439C10.8365 23.1713 10.6742 23.258 10.4974 23.2932C10.3207 23.3283 10.1376 23.3103 9.97109 23.2413C9.80462 23.1724 9.66234 23.0556 9.56224 22.9058C9.46214 22.756 9.40871 22.5799 9.40871 22.3997C9.40897 22.1588 9.50449 21.9279 9.67441 21.7572C9.84434 21.5865 10.0749 21.49 10.3157 21.4887H10.3197Z"
                                            fill="#6F3C96" />
                                    </svg>
                                    <span id="vicomma-cart-cta" class="badge badge-warning navbar-badge">0</span>
                                </a>
                            </li>
                            <li class="nav-item ml-2 d-none">
                                <a href="/guser" class="nav-link">
                                    {{-- <img alt="" class="icon" src="{{asset('/img/video2.png')}}"> --}}
                                    <svg width="26" height="22" viewBox="0 0 26 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23 1H3C1.89543 1 1 1.89543 1 3V19C1 20.1046 1.89543 21 3 21H23C24.1046 21 25 20.1046 25 19V3C25 1.89543 24.1046 1 23 1Z"
                                            stroke="#6F3C96" stroke-width="2" />
                                        <path
                                            d="M17.3061 9.22114C17.2687 9.19776 17.2271 9.18199 17.1835 9.17472C17.14 9.16744 17.0955 9.16881 17.0525 9.17875C17.0095 9.18869 16.9689 9.20699 16.933 9.23262C16.897 9.25826 16.8665 9.29071 16.8431 9.32814C16.8198 9.36557 16.804 9.40723 16.7967 9.45075C16.7894 9.49428 16.7908 9.53881 16.8008 9.5818C16.8107 9.62479 16.829 9.66541 16.8546 9.70133C16.8803 9.73725 16.9127 9.76776 16.9501 9.79114C17.1291 9.90283 17.2767 10.0582 17.379 10.2427C17.4814 10.4272 17.5351 10.6347 17.5351 10.8456C17.5351 11.0566 17.4814 11.2641 17.379 11.4486C17.2767 11.633 17.1291 11.7885 16.9501 11.9001L11.4421 15.3361C11.254 15.4533 11.038 15.518 10.8165 15.5236C10.5949 15.5292 10.376 15.4754 10.1822 15.3679C9.98839 15.2604 9.82686 15.1031 9.71433 14.9122C9.6018 14.7213 9.54235 14.5037 9.54214 14.2821V7.41014C9.54235 7.18854 9.6018 6.97102 9.71433 6.78012C9.82686 6.58921 9.98839 6.43186 10.1822 6.32436C10.376 6.21686 10.5949 6.16313 10.8165 6.16871C11.038 6.1743 11.254 6.23901 11.4421 6.35614L14.6501 8.35614C14.6876 8.37952 14.7292 8.39529 14.7728 8.40256C14.8163 8.40984 14.8608 8.40847 14.9038 8.39853C14.9468 8.38859 14.9874 8.37029 15.0233 8.34466C15.0592 8.31902 15.0898 8.28657 15.1131 8.24914C15.1365 8.21171 15.1523 8.17005 15.1596 8.12653C15.1668 8.083 15.1655 8.03847 15.1555 7.99548C15.1456 7.95249 15.1273 7.91187 15.1017 7.87595C15.076 7.84003 15.0436 7.80951 15.0061 7.78614L11.7981 5.78614C11.5084 5.60539 11.1755 5.50546 10.8341 5.49672C10.4927 5.48798 10.1552 5.57075 9.85654 5.73644C9.55791 5.90214 9.30905 6.14472 9.13578 6.43902C8.96251 6.73332 8.87113 7.06862 8.87114 7.41014V14.2821C8.86868 14.6243 8.95909 14.9606 9.13273 15.2554C9.30637 15.5502 9.55673 15.7924 9.85714 15.9561C10.155 16.1244 10.4929 16.2087 10.8349 16.2001C11.1769 16.1914 11.5101 16.0902 11.7991 15.9071L17.3091 12.4711C17.5851 12.2992 17.8126 12.0599 17.9704 11.7757C18.1282 11.4914 18.211 11.1717 18.211 10.8466C18.211 10.5216 18.1282 10.2018 17.9704 9.91761C17.8126 9.63339 17.5851 9.39404 17.3091 9.22214L17.3061 9.22114Z"
                                            fill="white" stroke="#6F3C96" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" id="push"><i
                                        class="fas fa-bars"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.navbar -->


                    @include('pages.partials.sidebar')
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">

                        <!-- Main content -->
                        <div class="content">
                            <div class="px-2 px-lg-4 pb-4">
                                @auth
                                @if (Route::is('user.guser*'))
                                @else
                                <section class="content-header">
                                    <div class="container-fluid">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                {{-- <h1>
                            Navbar &amp; Tabs
                            <small>new</small>
                            </h1> --}}
                                            </div>
                                            <div class="col-sm-8">
                                                <ol class="breadcrumb float-sm-right">
                                                    <li class="breadcrumb-item">
                                                        <a href="{{route('user.dashboard')}}">Dashboard</a>
                                                    </li>
                                                    @if (auth()->user() && auth()->user()->email_verified_at)
                                                    @if (Auth::user()->hasRole('Creative'))
                                                    <li class="breadcrumb-item">
                                                        <a href="{{route('user.jobs.index')}}">Jobs</a>
                                                    </li>
                                                    @endif
                                                    @if (Auth::user()->hasRole('vendor'))
                                                    <li class="breadcrumb-item">
                                                        <a href="{{route('user.vendors.index')}}">My Store</a>
                                                    </li>
                                                    @endif
                                                    <!-- <li class="breadcrumb-item"><a href="#">Order</a></li>
                                                    <li class="breadcrumb-item"><a href="#">Download</a></li>
                                                    <li class="breadcrumb-item"><a href="#">Address</a></li> -->
                                                    <!-- <li class="breadcrumb-item"><a href="{{  route('user.payment.methods') }}">Payment Method</a></li> -->
                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('user.support.ticket')}}">Support Tickets</a>
                                                    </li>
                                                    @endif
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.container-fluid -->
                                </section>
                                @endif
                                @endauth
                                @include('includes.search-modal')
                                @yield('content')
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content -->
                    </div>

                    @else
                    @if(request()->segment(1) != 'signup' && !Route::is('public.newmall') &&
                    !Route::is('public.newproducts') &&
                    !Route::is('mall.cart') && !Route::is('mall.checkout') && !Route::is('public.success') &&
                    !Route::is('mall.show*')
                    &&
                    !Route::is('public.newproducts.single'))
                    <header>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navigation-bar">
                            <div class="container-fluid">
                                @if(!Route::is('public.newmall') &&
                                !Route::is('public.newproducts') &&
                                !Route::is('mall.cart') && !Route::is('mall.checkout') && !Route::is('public.success')
                                &&
                                !Route::is('public.newproducts.single'))
                                <a class="navbar-brand" href="{{route('public.index')}}"><img alt=""
                                        src="{{asset('/img/logo-text.png')}}"></a>

                                @elseif (Route::is('public.newmall') || Route::is('public.newproducts') ||
                                Route::is('mall.cart') || Route::is('mall.checkout') || Route::is('public.success') ||
                                Route::is('public.newproducts.single'))
                                <div class="search-container">
                                    <svg class="search-icon" width="16" height="17" viewBox="0 0 16 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.037 15.2505L11.361 11.5745C12.4585 10.3119 13.023 8.67249 12.9354 7.00183C12.8478 5.33117 12.115 3.75977 10.8915 2.61883C9.66795 1.47789 8.04925 0.856544 6.37655 0.885751C4.70385 0.914957 3.10782 1.59244 1.92487 2.77539C0.741911 3.95835 0.0644324 5.55438 0.0352256 7.22707C0.0060189 8.89977 0.627365 10.5185 1.7683 11.742C2.90924 12.9655 4.48064 13.6983 6.1513 13.7859C7.82196 13.8735 9.46137 13.309 10.724 12.2115L14.395 15.8885C14.4796 15.9734 14.5942 16.0215 14.714 16.0225C14.7734 16.0228 14.8323 16.0111 14.8871 15.988C14.942 15.965 14.9916 15.9312 15.033 15.8885C15.1177 15.8042 15.1656 15.6898 15.1664 15.5703C15.1671 15.4508 15.1206 15.3359 15.037 15.2505ZM0.94699 7.34551C0.948374 6.24948 1.2746 5.17846 1.88445 4.26776C2.49429 3.35706 3.36039 2.64756 4.37332 2.2289C5.38624 1.81025 6.50053 1.70122 7.57539 1.9156C8.65025 2.12999 9.63744 2.65816 10.4122 3.43338C11.187 4.2086 11.7147 5.19608 11.9285 6.27106C12.1423 7.34603 12.0327 8.46026 11.6135 9.47296C11.1943 10.4857 10.4843 11.3514 9.57325 11.9607C8.66222 12.5701 7.59102 12.8957 6.49499 12.8965C5.02321 12.896 3.61191 12.3109 2.57149 11.2699C1.53106 10.2289 0.946725 8.81729 0.94699 7.34551Z"
                                            fill="#94CA52" />
                                    </svg>

                                    <input type="text" class="search-input" placeholder="Search...">
                                </div>
                                @endif
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </button>

                                <div class="collapse navbar-collapse" style="justify-content: end;"
                                    id="navbarSupportedContent">
                                    @if(!Route::is('public.newmall') &&
                                    !Route::is('public.newproducts') &&
                                    !Route::is('mall.cart') && !Route::is('mall.checkout') &&
                                    !Route::is('public.success')
                                    &&
                                    !Route::is('public.newproducts.single'))
                                    <ul class="navbar-nav ml-auto">
                                        @if (!Auth::user())
                                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                                            <a class="nav-link navigation-link link-color"
                                                href="{{ route('auth.login') }}">Log In</a>
                                        </li>
                                        <li class="nav-item {{ Request::is('signup') ? 'active' : '' }}">
                                            <a class="nav-link navigation-link link-color"
                                                href="{{ route('auth.welcome') }}">Sign Up</a>
                                        </li>
                                        @else
                                        <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
                                            <a class="nav-link navigation-link link-color"
                                                href="{{ route('user.dashboard') }}">Dashboard</a>
                                        </li>
                                        @endif
                                        <li class="nav-item {{ Request::is('affiliatehub') ? 'active' : '' }}">
                                            <a class="nav-link navigation-link link-color"
                                                href="https://vicomma.com/affiliatehub">Affiliate Hub</a>
                                        </li>
                                        <li
                                            class="nav-item {{ Request::is('online-video-submission') ? 'active' : '' }}">
                                            <a class="nav-link navigation-link link-color"
                                                href="https://landing.vicomma.com/giveaways-contest">Contests</a>
                                        </li>
                                    </ul>
                                    @elseif (Route::is('public.newmall') || Route::is('public.newproducts') ||
                                    Route::is('mall.cart') || Route::is('mall.checkout') || Route::is('public.success')
                                    ||
                                    Route::is('public.newproducts.single'))
                                    <div>
                                        <button class="btn-design mr-3">
                                            <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON"
                                                style="color: rgba(148, 202, 82, 1);">
                                                <svg width="22" height="22" viewBox="0 0 26 26" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M25.013 6.25969C24.923 6.1491 24.8096 6.05995 24.6809 5.99872C24.5522 5.93748 24.4115 5.9057 24.269 5.90569H6.89895L6.82796 5.25169V5.23069C6.6596 3.9727 6.04097 2.81837 5.08669 1.98158C4.13241 1.14479 2.90716 0.68226 1.63796 0.679688C1.38361 0.679688 1.13969 0.780725 0.95984 0.960572C0.779992 1.14042 0.678955 1.38434 0.678955 1.63869C0.678955 1.89303 0.779992 2.13696 0.95984 2.3168C1.13969 2.49665 1.38361 2.59769 1.63796 2.59769C2.43999 2.59968 3.21425 2.89159 3.81797 3.41959C4.42168 3.94759 4.81414 4.67607 4.92296 5.47069L6.06295 15.9427C5.55905 16.171 5.13154 16.5396 4.83149 17.0044C4.53145 17.4691 4.37157 18.0105 4.37095 18.5637C4.37095 18.5717 4.37095 18.5797 4.37095 18.5877C4.37095 18.5957 4.37095 18.6037 4.37095 18.6117C4.37175 19.3745 4.67512 20.1058 5.21449 20.6452C5.75386 21.1845 6.48517 21.4879 7.24795 21.4887H7.63796C7.49324 21.9144 7.4521 22.3685 7.51795 22.8134C7.5838 23.2582 7.75473 23.6809 8.01658 24.0465C8.27843 24.412 8.62365 24.7099 9.02362 24.9154C9.42359 25.1209 9.86678 25.2281 10.3165 25.2281C10.7661 25.2281 11.2093 25.1209 11.6093 24.9154C12.0093 24.7099 12.3545 24.412 12.6163 24.0465C12.8782 23.6809 13.0491 23.2582 13.115 22.8134C13.1808 22.3685 13.1397 21.9144 12.995 21.4887H17.132C16.939 22.0559 16.9312 22.6697 17.1094 23.2416C17.2877 23.8136 17.643 24.3141 18.124 24.6712C18.6051 25.0283 19.1871 25.2235 19.7861 25.2286C20.3852 25.2337 20.9704 25.0485 21.4575 24.6996C21.9446 24.3508 22.3083 23.8564 22.4963 23.2875C22.6843 22.7187 22.6869 22.1049 22.5037 21.5345C22.3205 20.9641 21.9609 20.4666 21.4768 20.1137C20.9927 19.7607 20.409 19.5706 19.81 19.5707H7.24795C6.99369 19.5704 6.74992 19.4693 6.57013 19.2895C6.39034 19.1097 6.28922 18.8659 6.28896 18.6117C6.28896 18.6037 6.28896 18.5957 6.28896 18.5877C6.28896 18.5797 6.28896 18.5717 6.28896 18.5637C6.28922 18.3094 6.39034 18.0657 6.57013 17.8859C6.74992 17.7061 6.99369 17.605 7.24795 17.6047H19.49C20.3422 17.592 21.1723 17.3316 21.879 16.8551C22.5857 16.3787 23.1385 15.7069 23.47 14.9217C23.5227 14.8061 23.5519 14.6811 23.556 14.5541C23.56 14.4271 23.5387 14.3005 23.4934 14.1818C23.4481 14.063 23.3797 13.9545 23.292 13.8624C23.2044 13.7704 23.0994 13.6967 22.983 13.6456C22.8666 13.5945 22.7413 13.567 22.6142 13.5648C22.4871 13.5626 22.3609 13.5857 22.2428 13.6327C22.1247 13.6797 22.0172 13.7497 21.9264 13.8386C21.8356 13.9275 21.7634 14.0336 21.714 14.1507C21.5287 14.5924 21.2208 14.9719 20.8267 15.2441C20.4325 15.5163 19.9687 15.6699 19.49 15.6867H7.96395L7.10795 7.82369H23.089L22.62 10.0727C22.591 10.1971 22.5872 10.3261 22.6087 10.4521C22.6303 10.578 22.6768 10.6984 22.7456 10.8061C22.8143 10.9138 22.9039 11.0067 23.0091 11.0793C23.1142 11.152 23.2328 11.2028 23.3579 11.2289C23.483 11.2551 23.612 11.2559 23.7375 11.2315C23.8629 11.207 23.9822 11.1577 24.0883 11.0865C24.1944 11.0154 24.2852 10.9237 24.3554 10.8169C24.4256 10.7101 24.4737 10.5903 24.497 10.4647L25.207 7.06469C25.2368 6.92454 25.2349 6.77948 25.2013 6.64017C25.1677 6.50086 25.1034 6.37085 25.013 6.25969ZM19.813 21.4887C19.9931 21.4887 20.1693 21.5421 20.3191 21.6422C20.4689 21.7423 20.5857 21.8846 20.6546 22.0511C20.7236 22.2175 20.7416 22.4007 20.7065 22.5774C20.6713 22.7541 20.5845 22.9165 20.4571 23.0439C20.3297 23.1713 20.1674 23.258 19.9907 23.2932C19.814 23.3283 19.6308 23.3103 19.4643 23.2413C19.2979 23.1724 19.1556 23.0556 19.0555 22.9058C18.9554 22.756 18.902 22.5799 18.902 22.3997C18.9022 22.1587 18.9979 21.9276 19.168 21.7569C19.3382 21.5862 19.5689 21.4897 19.81 21.4887H19.813ZM10.32 21.4887C10.5001 21.4887 10.6763 21.5421 10.8261 21.6422C10.9759 21.7423 11.0927 21.8846 11.1616 22.0511C11.2306 22.2175 11.2486 22.4007 11.2135 22.5774C11.1783 22.7541 11.0915 22.9165 10.9641 23.0439C10.8367 23.1713 10.6744 23.258 10.4977 23.2932C10.321 23.3283 10.1378 23.3103 9.97133 23.2413C9.80487 23.1724 9.66259 23.0556 9.56249 22.9058C9.46238 22.756 9.40895 22.5799 9.40895 22.3997C9.40921 22.1588 9.50473 21.9279 9.67466 21.7572C9.84458 21.5865 10.0751 21.49 10.316 21.4887H10.32Z"
                                                        fill="#94CA52" />
                                                </svg>

                                                <span id="vicomma-cart-cta">0</span>
                                                <span>Item</span>
                                            </a>
                                        </button>
                                        <button class="btn-design" style="background: rgba(148, 202, 82, 1);">
                                            <a href="{{ route('mall.checkout') }}" class="nav-link uSREICON"
                                                style="color: rgb(255, 255, 255);">
                                                <svg width="22" height="22" viewBox="0 0 26 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M23 1H3C1.89543 1 1 1.89543 1 3V19C1 20.1046 1.89543 21 3 21H23C24.1046 21 25 20.1046 25 19V3C25 1.89543 24.1046 1 23 1Z"
                                                        stroke="white" stroke-width="2" />
                                                    <path
                                                        d="M17.3059 9.21919C17.2685 9.19581 17.2268 9.18004 17.1833 9.17276C17.1398 9.16549 17.0952 9.16686 17.0522 9.1768C17.0092 9.18673 16.9686 9.20504 16.9327 9.23067C16.8968 9.2563 16.8663 9.28876 16.8429 9.32619C16.8195 9.36361 16.8037 9.40528 16.7965 9.4488C16.7892 9.49232 16.7906 9.53685 16.8005 9.57985C16.8104 9.62284 16.8288 9.66346 16.8544 9.69937C16.88 9.73529 16.9125 9.76581 16.9499 9.78919C17.1289 9.90088 17.2765 10.0563 17.3788 10.2408C17.4811 10.4252 17.5348 10.6327 17.5348 10.8437C17.5348 11.0546 17.4811 11.2621 17.3788 11.4466C17.2765 11.6311 17.1289 11.7865 16.9499 11.8982L11.4419 15.3342C11.2538 15.4513 11.0378 15.516 10.8162 15.5216C10.5947 15.5272 10.3757 15.4735 10.1819 15.366C9.98814 15.2585 9.82662 15.1011 9.71409 14.9102C9.60156 14.7193 9.54211 14.5018 9.5419 14.2802V7.40819C9.54211 7.18658 9.60156 6.96907 9.71409 6.77816C9.82662 6.58726 9.98814 6.42991 10.1819 6.32241C10.3757 6.21491 10.5947 6.16117 10.8162 6.16676C11.0378 6.17235 11.2538 6.23706 11.4419 6.35419L14.6499 8.35419C14.6873 8.37756 14.729 8.39334 14.7725 8.40061C14.816 8.40788 14.8606 8.40651 14.9036 8.39658C14.9466 8.38664 14.9872 8.36833 15.0231 8.3427C15.059 8.31707 15.0895 8.28461 15.1129 8.24719C15.1363 8.20976 15.152 8.1681 15.1593 8.12457C15.1666 8.08105 15.1652 8.03652 15.1553 7.99353C15.1454 7.95053 15.127 7.90992 15.1014 7.874C15.0758 7.83808 15.0433 7.80756 15.0059 7.78419L11.7979 5.78419C11.5081 5.60343 11.1753 5.50351 10.8339 5.49477C10.4925 5.48603 10.1549 5.5688 9.8563 5.73449C9.55767 5.90018 9.30881 6.14276 9.13553 6.43706C8.96226 6.73136 8.87089 7.06667 8.8709 7.40819V14.2802C8.86844 14.6223 8.95884 14.9587 9.13248 15.2535C9.30612 15.5483 9.55649 15.7905 9.8569 15.9542C10.1548 16.1224 10.4927 16.2068 10.8347 16.1981C11.1767 16.1895 11.5099 16.0883 11.7989 15.9052L17.3089 12.4692C17.5848 12.2973 17.8124 12.0579 17.9702 11.7737C18.128 11.4895 18.2108 11.1698 18.2108 10.8447C18.2108 10.5196 18.128 10.1999 17.9702 9.91566C17.8124 9.63144 17.5848 9.39209 17.3089 9.22019L17.3059 9.21919Z"
                                                        fill="white" stroke="white" />
                                                </svg>
                                                <span>Post A Video</span>
                                            </a>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </nav>
                    </header>
                    @endif


                    @include('includes.search-modal')
                    @if(Route::is('public.index'))
                    @yield('content')
                    @else
                    <div class="{{request()->segment(1) != 'signup' ? 'other-page-content': '' }}">
                        @yield('content')
                    </div>
                    @endif
                    @endif
                    @if (Route::is('user.guser*'))
                    @include('pages.partials.footer')
                    @endif
                    @if(Auth::user())
                    @if(Route::is('user*') && !Route::is('user.guser*'))
                    <chat :user-prop="{{Auth::user()->id}}"></chat>
                    @endif
                    @endif
                </div>
                @if(Auth::user())
                <message :user-prop="{{Auth::user()->id}}"></message>
                <notifications :user-prop="{{Auth::user()->id}}" />
                @endif

            </div>
            <div class="cookie-message" id="cookieNotice">
                <img src="/cookie.png">
                <span>We use cookies to provide you the best possible experience. But don't panic - we won't share any
                    of
                    your data. You can find more informations about our cookies <a href="/privacy">here</a>.</span>
                <a class="close" href="#" onclick="$('#cookieNotice').hide()"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        <script>
            @if(auth()->user() && auth()->user()->hasRole("vendor"))
            $("#radio1").prop("checked", true);
            $("#radio3").prop("checked", true);
            @endif
            @if(auth()->user() && auth()->user()->hasRole("creative"))
            $("#radio2").prop("checked", true);
            $("#radio4").prop("checked", true);
            @endif

            $("#radio1").click(() => location.href="/set-role?role=vendor");
            $("#radio2").click(() => location.href="/set-role?role=creative");
            $("#radio3").click(() => location.href="/set-role?role=vendor");
            $("#radio4").click(() => location.href="/set-role?role=creative");
            $(".dropdown-menu").click((e) => e.stopPropagation());
                var authEndpoint = '{{ route("pusher.auth") }}';
    var aje = '{{ route("approve.video") }}';
    //local
    var actor = @if(Auth::user()) "{{ Auth::user()->id }}" @else "" @endif;
    var tkon = "{{ csrf_token() }}";
    var auth_id = actor,
        url = "/chatify",
        defaultMessengerColor = $("meta[name=messenger-color]").attr("content"),
        access_token = tkon;
    var getMessengerType = "user";
    var messagesContainer = $(".messages-container");
        </script>
        <script src="{{ asset('client/chat/index.js') }}"></script>
        <script src="{{asset('/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script> --}}
        <script src="{{asset('/js/jquery.validate.min.js')}}"></script>
        {{-- <script src="{{asset('/js/')}}"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundsle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> --}}
        {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> --}}
        {{-- <script src="{{asset('/js/jquery.min.js')}}"></script> --}}
        {{-- <script src="{{asset('/js/popper.min.js')}}"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}
        {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
        {{-- <script src="{{asset('/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
        @if (Route::is('user.view.profile'))
        <script src="{{asset('/js/cropper.js')}}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
            integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script> --}}
        @endif
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/js/jquery.syotimer.min.js')}}"></script>
        <script src="{{asset('/js/rtop.videoPlayer.1.0.1.js')}}"></script>
        <script src="{{asset('/js/jquery.syotimer.min.js')}}"></script>
        <script src="{{asset('/js/script.js')}}"></script>
        <script src="{{asset('/js/guser.js')}}"></script>
        <script src="{{asset('/js/custom.min.js')}}"></script>
        <script src="{{asset('/js/moment.js')}}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script> --}}
        <script src="{{asset('/js/jquery.rateyo.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.lazy/1.7.5/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.lazy/1.7.5/plugins/jquery.lazy.av.min.js">
        </script>





        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    $(document).ready(function() {
        $('body').addClass('sidebar-collapse');
        $(".overlay")
            .mouseenter(function() {
                var video = $(this).prev();
                $(video).get(0).play();
            })
            .mouseleave(function() {
                var video = $(this).prev();
                $(video).get(0).pause();
            });
    });
    function loadVideo(vid) {
        // $('#vid'+vid).click(function(event) {
        //     $('#theVideo'+vid).get(0).play();
        //     setTimeout(function() {
        //         $('#theVideo'+vid).get(0).pause();
        //         $('#theVideo'+vid).get(0).currentTime = 0;
        //     }, 7000);
        // });
        location.assign("/video/" + vid);
    }
    //cart functions
    function addToCart(pid) {
        //@param pid = product id
        var url = '/api/carts/' + pid;
        var data = {
            product: pid
        };
        $.post(url, function(data, status) {
            swal("success", "Added to cart", "success");
        });
    }
        </script>
        <script>
            var maincart = JSON.parse(localStorage.getItem("cart"));
                               if(maincart && Array.isArray(maincart)){
                               $(".cart-count").text(maincart.length)
                               }
                               var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        $(document).ready(function() {
            $('body').addClass('sidebar-collapse');
            $(".overlay")
                .mouseenter(function() {
                    var video = $(this).prev();
                    $(video).get(0).play();
                })
                .mouseleave(function() {
                    var video = $(this).prev();
                    $(video).get(0).pause();
                });
        });
        </script>
        <script>
            function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function deleteCookie(cname) {
            const d = new Date();
            d.setTime(d.getTime() + (24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=;" + expires + ";path=/";
        }
            function acceptCookieConsent(){
            deleteCookie('user_cookie_consent');
            setCookie('user_cookie_consent', 1, 30);
            // document.getElementById("cookieNotice").style.display = "none";
        }


        //search function
        function runSearch() {
            var query = $("#sq").val();
            if (query.length == 0) {
                //do nothing
                swal("info", "Search field cannot be empty!", "info");
            } else {
                $("#search-modal").modal('show');
                $("#search-results").html("<i>loading results...please wait</i>");
                //make a get request to controller
                $.get("/search/" + query, function(data, status) {
                    var resp = data;
                    $("#search-results").html(resp);
                    //console.log(resp);
                });
            }
        }

        $(document).ready(function() {
            if ($('body').hasClass('sidebar-collapse')) {
                $('.brand-image').attr('src', "/img/sidebarlogo.png")
            }
            $('#push').on('click', function() {
                if ($('body').hasClass('sidebar-collapse')) {
                    $('.brand-image').attr('src', "/img/logo-text.png")
                } else {
                    $('.brand-image').attr('src', "/img/sidebarlogo.png")
                }
            })
            // $('body').on('change', function() {
            // })
            $(".page-overlay").delay(1000).fadeOut("slow");
            $('#tobe-notifications').slideToggle(300, 'swing');
            // $('.noticover').on('click', function(){
            //     $('#tobe-notifications').slideUp(300, 'swing');
            // })
            $('.tobe-notification-bell').on('click', function(e){
                e.preventDefault();
                $('#tobe-notifications').slideToggle(300, 'swing');
            });
            $('#individual-chat').fadeOut('fast');
            $('.chat').slideUp(300, 'swing');
            $('.chat-message-counter').fadeIn(300, 'swing');
            $('.chat-close').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('close');
                $('.chat').slideToggle(300, 'swing');
                $('.chat-message-counter').fadeToggle(300, 'swing');
            });
            $('.individual-chat-close').on('click', function(e) {
                e.preventDefault();
                $('#individual-chat').fadeOut('fast');
            });
            $('.chat-message').on('click', function(){
                // do ajax to get messages and populate message div
                $('#individual-chat').fadeIn('fast');
                var pos = $('.individual-chat-history').offset().top + 10000000;
                $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
            })

            //Change class when I scroll more than 500px
            $(window).scroll(function() {
                if ($(this).scrollTop() > 500) {
                    $('.navigation-link').removeClass('link-color');
                    $('.navigation-link').css('color' , 'rgb(0 0 0 / 62%)');
                } else {
                    $('.navigation-link').addClass('link-color');
                    $('.navigation-link').css('color' , '');
                }
            });

            //hide #tobe-notifications when click outside of it and on .tobe-notification-bell
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#tobe-notifications').length && !$(e.target).closest('.tobe-notification-bell').length) {
                    $('#tobe-notifications').slideUp(300, 'swing');
                }
            });

            $('button.close').click(function(){
                $('.modal').modal('hide');
            })
        })
        </script>

        <script>
            //TODO : check if the user is logged in or not
        // axios.get(`${window.location.origin}/cartsession`).then(function(response) {
        //     // console.log(response.data)
        //     const {
        //         message,
        //         cart,
        //         cart_ids,
        //         cart_count
        //     } = response.data;
        //     console.log(cart);
        //     localStorage.setItem("cart", JSON.stringify(cart));
        //     sessionStorage.setItem("cart", JSON.stringify(cart));
        //     sessionStorage.setItem("cartIdStore", JSON.stringify(cart_ids))
        //     console.log(localStorage.getItem("cart"));
        //     const laCartSymbol = document.querySelectorAll('#vicomma-cart-cta');

        //     if (laCartSymbol.length > 0) {
        //         for (let t = 0; t < laCartSymbol.length; t++) {
        //             laCartSymbol[t].innerHTML = cart_count;
        //         }
        //     }
        //     // document.querySelector('#vicomma-cart-cta').innerHTML = cart_count;
        // })
        </script>


        <script>
            function initFreshChat() {
            window.fcWidget.init({
                token: "74b43a10-e9c7-447e-bdcb-eaf5bf792036",
                host: "https://wchat.freshchat.com"
            });
        }
        function initialize(i, t) {
            var e;
            i.getElementById(t) ? initFreshChat() : ((e = i.createElement("script")).id = t, e.async = !0, e.src =
                "https://wchat.freshchat.com/js/widget.js", e.onload = initFreshChat, i.head.appendChild(e))
        }
        function initiateCall() {
            initialize(document, "Freshdesk Messaging-js-sdk")
        }
        window.addEventListener ? window.addEventListener("load", initiateCall, !1) : window.attachEvent("load",
            initiateCall, !1);
        </script>

        <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
            function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

let cookie_consent = getCookie("user_cookie_consent");
if(cookie_consent != ""){
    document.getElementById("cookieNotice").style.display = "none";
}else{
    document.getElementById("cookieNotice").style.display = "flex";
    acceptCookieConsent()
}
$( ".tip" ).each(function( index ) {
    tippy(this, {
  content: $(this).data("content"),
  placement: 'bottom',
  showOnCreate: $(this).data("show") && $(this).data("show") == "yes"? true : false,
});
});

var maincart = JSON.parse(localStorage.getItem("cart"));
                            if(maincart && Array.isArray(maincart)){
                            $("#vicomma-cart-cta").text(maincart.length)
                            }

$(".toggle-pass").click((data) => {
    var input = $(".pass-input");

    console.log(input.attr('type'))
    if($(".pass-input").attr('type') == "text"){
    $(".pass-input").attr("type", "password")
        console.log("text222")
    $(".toggle-pass").toggleClass("fa-eye")
    $(".toggle-pass").toggleClass("fa-eye-slash")
    }
    else if($(".pass-input").attr('type') == "password"){
        $(".pass-input").attr("type", "text")
    $(".toggle-pass").toggleClass("fa-eye")
    $(".toggle-pass").toggleClass("fa-eye-slash")
    }
    })

        </script>
        @stack('scripts')
    </body>

</html>

{{-- @extends('layouts.public.footer') --}}