@extends('pages.app')
<link rel="stylesheet" href="https://themejunction.net/html/gerold/demo/assets/css/main.css">
<style>
    .content-slider .sliding {
        display: none;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .content-slider .sliding.active {
        display: flex;
        opacity: 1;
    }

    /* .typing {
        overflow: hidden;
        white-space: nowrap;
        animation: blink-caret .75s step-end infinite;
    } */
    .img_area img {
        width: 80% !important;
    }

    .img_area2 img {
        width: 100% !important;
    }


    .hero-title {
        /* font-size: 40px; */
        /* background: var(--tj-theme-primary); */
        /* background: -webkit-gradient(linear, left top, right top, from(var(--tj-theme-primary)), to(var(--tj-white))); */
        /* background: -o-linear-gradient(left, var(--tj-theme-primary) 0%, var(--tj-white) 100%); */
        /* background: linear-gradient(to right, var(--tj-theme-primary) 0%, var(--tj-white) 100%); */
        -webkit-background-clip: text;
        -webkit-text-fill-color: #6f3c96;
        font-weight: bold;
    }

    .hero-sub-title {
        font-size: 36px;
        font-weight: 700;
        display: block;
        margin-bottom: 10px;
    }

    .hero-content-box .lead {
        max-width: 550px;
        width: 100%;
        margin-bottom: 0;
        font-weight: bold;
        font-size: 17px !important;
    }

    .hero-image-box {
        position: relative;
        margin-top: 10px;
    }

    .color {
        color: #6f3c96;
    }

    .hero-image-box img {
        border-radius: 38px;
        -webkit-transform: rotate(4.29deg);
        -ms-transform: rotate(4.29deg);
        transform: rotate(4.29deg);
        position: relative;
        border: 2px solid #2a1454;
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }

    .hero-image-box img:hover {
        border: 2px solid #8750f7;
        -webkit-transform: rotate(0);
        -ms-transform: rotate(0);
        transform: rotate(0);
    }

    .hero-image-box video {
        border-radius: 38px;
        -webkit-transform: rotate(4.29deg);
        -ms-transform: rotate(4.29deg);
        transform: rotate(4.29deg);
        position: relative;
        border: 2px solid #2a1454;
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        object-fit: fill !important;
        max-width: 50%;
        height: auto;
    }

    .hero-image-box video:hover {
        border: 2px solid #8750f7;
        -webkit-transform: rotate(0);
        -ms-transform: rotate(0);
        transform: rotate(0);
    }

    .testimonial_carousel .testimonial_item .icon {

        width: 12%;
    }

    .green-icon {
        opacity: 0;
    }

    .testimonial_carousel .testimonial_item:hover .green-icon {
        opacity: 1;
    }

    .step_section .step4_img {
        position: relative;
        top: -54px;
        left: 0px !important;
    }

    .testimonial_carousel .testimonial_item:hover .blue-icon {
        opacity: 0;
    }

    /* .owl-stage .active:nth-of-type(3) .item .testimonial_item {
        background: #6f3c96;
        border-color: #6f3c96;
        color: white;
    } */

    /* .owl-stage .active:nth-of-type(3) .item .testimonial_item .text1 {

        color: white;
    }

    .owl-stage .active:nth-of-type(3) .item .testimonial_item .icon {

        color: #94ca52;
    } */

    @keyframes blink-caret {

        from,
        to {
            border-color: transparent;
        }

        50% {
            border-color: black;
        }
    }

    #video_mt {
        position: relative;
        background-color: black;
        height: 100vh;
        min-height: 45rem;
        width: 100%;
        overflow: hidden;
    }

    #video_mt video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        -ms-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }

    #background {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: black;
        opacity: 0.5;
        z-index: 0;
    }

    .container-fluid {
        padding-left: 50px !important;
        padding-right: 50px !important;
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .img_area img {
            width: 100% !important;
        }
    }

    .fader {
        width: 100%;
        height: 100vh;
        /* Adjust the height as needed */
        position: relative;
    }

    .slide {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        background-size: contain;
        /* background-repeat: no-repeat; */
        background-position: left;
        animation: fade 12s infinite;
        /* Adjust the animation duration as needed */
    }

    #slide1 {
        background-image: url('/images/bg1.jpeg');
        animation-delay: 0s;
        /* Delay for the first slide */
    }

    #slide2 {
        background-image: url('/images/bg2.jpeg');
        animation-delay: 3s;
        /* Delay for the second slide */
    }

    #slide3 {
        background-image: url('/images/bg3.jpeg');
        animation-delay: 6s;
        /* Delay for the third slide */
    }

    #slide4 {
        background-image: url('/images/bg4.jpeg');
        animation-delay: 9s;
        /* Delay for the fourth slide */
    }

    @keyframes fade {

        0%,
        100% {
            opacity: 0;
        }

        20%,
        80% {
            opacity: 1;
        }
    }

    .home-slider {
        margin-top: 100px;
    }

    .nav-item .link-color {
        color: rgba(0, 0, 0, 0.62) !important;
    }

</style>
@section('content')
@include('includes.messages')
@include('includes.home-popup')
<div class="w-100 " style="margin-top: 100px; position: relative;">
    <video autoplay muted loop class="w-100">
        <source
            src="https://mainhomepagevideos.s3.amazonaws.com/Comp+1_1_compressed++Flash+banner+for+new+vicomma+homepage.mp4"
            type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <a href="signup" style="position: absolute;
        width: 24%;
        height: 21%;
        bottom: 7%;
        left: 7%;
        cursor: pointer;"></a>
</div>
{{-- <img src="{{asset('img/mainbanner.png')}}" alt="" > --}}

{{-- <div class=" container-fluid content-slider" style="margin-top: 120px; margin-bottom: 50px"> --}}

{{-- <div class="row align-items-center sliding active">
        <div class="col-md-6">
            <div class="hero-content-box">
                <h1 class="hero-title ">Find YOUR content creatives <span style="color:green">here.</span>
                </h1>
                <div style="margin-top:20px">
                    <h2 class="fw-bold">CUSTOM CONTENT CREATIVES</h2>
                    <p class="stepContent">Hire creatives who won't break your bank</p>
                </div>
                <div style="margin-top:20px">
                    <h2 class="fw-bold">WE VET. YOU CHOOSE</h2>
                    <p class="stepContent">Creatives who will take your brand, products, and service out of this world!
                    </p>
                </div>

            </div>
        </div>
        <div class="col-md-6 mt-1">
            <div class="hero-image-box text-center">
                <video autoplay muted loop>
                    <source src="{{ asset('videos/weddingshoot.mp4') }}" type="video/mp4">
Your browser does not support the video tag.
</video>

</div>
</div>


</div>

<div class="row align-items-center sliding">
    <div class="col-md-6">
        <div class="hero-content-box">
            <h1 class="hero-title ">Watch, Buy, Enjoy & Repeat
            </h1>
            <div style="margin-top:20px">
                <h2 class="fw-bold">WANT CONTENT? WE GOT YOU</h2>
                <p class="stepContent">Only the latest content, no frilles include</p>
            </div>
            <div style="margin-top:20px">
                <h2 class="fw-bold">WANT STUFF? WE GOT YOU TOO</h2>
                <p class="stepContent">See something you like; then buy it.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class="hero-image-box text-center">
            <video autoplay muted loop>
                <source src="{{ asset('videos/jboy speaker submission 2024.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div>

<div class="row align-items-center sliding">
    <div class="col-md-6">
        <div class="hero-content-box">
            <h1 class="hero-title ">Yeah making content does pay.
            </h1>
            <div style="margin-top:20px">
                <h2 class="fw-bold">CREATIVITY DOES PAY</h2>
                <p class="stepContent">We have brands, products, and services that need your creativity.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="hero-image-box text-center">
            <video autoplay muted loop>
                <source src="{{ asset('videos/Makeup transformation contestant.mov') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div>
<div class="row align-items-center sliding">
    <div class="col-md-6">
        <div class="hero-content-box">
            <h1 class="hero-title ">A community where Vendors & Creatives meet to earn big.
            </h1>

        </div>
    </div>
    <div class="col-md-6">
        <div class="hero-image-box text-center">
            <video autoplay muted loop>
                <source src="{{ asset('videos/cata transition 2024.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div> --}}
{{-- </div> --}}

{{-- <section class="owl-carousel owl-theme home-slider">

    <div class="slider">
        <a href="https://vicomma.com/post/info"><img
                src="{{asset('/new/findyourcontentcreativesherebanner_16.jpeg')}}"></a>
</div>
<div class="slider">
    <a href="https://vicomma.com/register/creative"><img src="{{asset('/new/yeahmakingcontentbbanner_16.jpeg')}}"></a>
</div>
<div class="slider">

    <a href="https://vicomma.com/guser"><img src="{{asset('/new/watchbuyenjoyrepeatbanner_16.jpeg')}}"></a>
</div>
<div class="slider">

    <a href="#"><img src="{{asset('/new/acommunitywherevendors_16.jpeg')}}"></a>
</div>

<!-- <div class="slider">
            <a href="https://vicomma.com/register/creative"><img src="{{asset('/images/bg4.jpeg')}}"></a>
        </div>
        <div class="slider">
            <a href="https://vicomma.com/post/job">
                <img src="{{asset('/images/bg3.jpeg')}}">
            </a>
        </div>
        <div class="slider">
            <a href="https://vicomma.com/guser">
                <img src="{{asset('/images/bg2.jpeg')}}">
            </a>
        </div> -->
</section> --}}
{{-- Why Vicomma section --}}
<section class="sectionPT sectionPB sectionBg3 why_section">
    <div class="container-fluid posRelative">
        <img alt="" class="shape1" src="img/shape1.png" loading="lazy">
        <div class="col-md-8 col_center">
            @php
            $text = $why_vicomma->hire_creative;
            $newText = explode(" ", $text)
            @endphp
            <h2 class="section_heading">Why <span>vicomma</span> is for you </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 dFlex">
                <div class="single_why box-shadow-only-hover hover-top">
                    <img alt="" class="icon" src="img/search_icon2.png" loading="lazy">
                    <h6 class="title"> {{$why_vicomma->hire_creative}} </h6>
                    <p class="text">
                        {{$why_vicomma->hire_creative_description}}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 dFlex">
                <div class="single_why box-shadow-only-hover hover-top">
                    <img alt="" class="icon" src="img/money_icon2.png" loading="lazy">
                    <h6 class="title"> {{$why_vicomma->earm_money}} </h6>
                    <p class="text">
                        {{$why_vicomma->earm_money_description}}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 dFlex">
                <div class="single_why box-shadow-only-hover hover-top">
                    <img alt="" class="icon" src="img/watch_icon2.png" loading="lazy">
                    <h6 class="title"> {{$why_vicomma->watch_buy}} </h6>
                    <p class="text">
                        {{$why_vicomma->watch_buy_description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./ Why Vicomma section --}}

{{-- Video Sharing section --}}
<section class="sectionPT videoSharing">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="img_area">
                    <img alt="" src="img/imagegraphic3.png" loading="lazy">
                </div>
            </div>
            <div class="col-md-7 boxVcenter">
                <div class="content">
                    <h2 class="section_heading">Not just another video sharing <span>platform.</span></h2>
                    <p class="stepContent">
                        vicomma, pronounced vee-coma began as a video sharing platform but we said, why not give our
                        users a better video experience? We decided to combine the viewing sharing experience with
                        e-commerce. Now, our online platform host a community of content creators, vendors, brands, and
                        viewers who create, promote, sell, and engage in tons of unique content all in one place.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./ Video Sharing section --}}

{{-- Icon section --}}
<section class="sectionPT vcomIconSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 boxVcenter">
                <h2 class="section_heading">The <span>vcom</span> icon</h2>
                <p class="stepContent">
                    Notice this icon called the vcom icon, it is the cart icon in the upper left hand corner of videos
                    on the platform. This icon let’s your users know there is a product, merchandise, promotion,
                    service, or deal attached to your content.
                </p>
            </div>
            <div class="col-md-5 dFlex alignCenter">
                <div class="img_area">
                    <img alt="" src="img/dollar.png" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./ Icon section --}}

{{-- step section --}}
<section class="sectionPT step_section ">
    <div class="container-fluid">
        <div class="col-md-10 col_center">
            <h2 id="hiw" class="section_heading mb1">So, how does <span>vcomma work?</span></h2>
            <p class="stepContent">
                Content creators love making content which showcases their talents; vicomma has a home for them. Vendors
                and brands need more unique and creative ways to promote their products and services ; vicomma has a
                home for them. Finally, users want to build a deeper relationship with brands; viomma provides an
                experience that lets them do just that.
            </p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 padding">
                <div class="img_area">
                    <img alt="" class="border_right step1_img" src="img/imagegraphic1.png" loading="lazy">
                </div>
            </div>
            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 1</p>
                    <p class="stepTitle"> Sign Up </p>
                    <p class="stepContent">
                        Create a user account by signing up whether you are a vendor, content creator, or just here to
                        watch.
                    </p>
                    <a class="btn btn-primary rounded-btn" href="/signup" role="button">Sign up Now</a>
                </div>
            </div>

            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 2</p>
                    <p class="stepTitle"> Are you a Vendor, Creative, or Both? </p>
                    <p class="stepContent mb-0">
                        Choose which option suits you best for now; remember you can always have multiple roles. Whether
                        you need to hire a content creator to promote your stuff, or you’re looking to get hired as a
                        content creator; signing up is absolutely free.
                    </p>
                    <!-- <button class="btn btn-primary rounded-btn">Signup Now</button> -->
                </div>
            </div>

            <div class="col-md-6 padding" style="margin-bottom: 20px">
                <div class="img_area">
                    <img alt="" class="border_right step2_img" src="img/are you a vendor creative or.png">
                </div>
            </div>

            <div class="col-md-6 padding">
                <div class="img_area" style="text-align: center;width: 100%;">
                    <video class="border_right step2_img" style="width: 80%;
                    object-fit: cover !important;
                    height: 640px;
                " autoplay muted loop>
                        <source src="{{ asset('videos/angelin vicomma wrong 2024.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    {{-- <img alt="" class="border_left step3_img" src="img/step3.png"> --}}
                </div>
            </div>
            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 3</p>
                    <p class="stepTitle">Creatives</p>
                    <p class="stepContent">
                        Content creators, you can now find vendors, merchants, and brands that need your services. Sign
                        up, create your profile, and start bidding on projects. Create the content for your client(s),
                        promote it, and get paid.
                    </p>
                    <a class="btn btn-primary rounded-btn" href="/signup" role="button">Sign up Now</a>
                </div>
            </div>

            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 4</p>
                    <p class="stepTitle">Vendors | Merchants | Brands</p>
                    <p class="stepContent">
                        Need to get the word out about your products, merchandise, service, or brand? Vicomma along with
                        our pool of content creators are here in plenty. Just create an account, add a few images of
                        your products, services, or whatever you need content for and add it to your request. Creators
                        will be matched to you. It’s that easy. Got more questions? Check out our Frequently Asked
                        Questions page.
                    </p>
                    <a class="btn btn-primary rounded-btn" href="/signup" role="button">Sign up Now</a>
                </div>
            </div>

            <div class="col-md-6 padding">
                <div class="img_area mt-5">
                    <img alt="" class="border_right step4_img mt-5" src="img/imagegraphic6.png" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./step section --}}

{{-- Join Section --}}
<section class="sectionPT sectionPB join_section" style="background-image: url(img/joinvicoma.png);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    <h2 class="section_heading">Why join <span>vicomma?</span></h2>
                    <p class="stepContent">
                        vicomma caters to unique content creators and vendors brands who need their services. Vicomma
                        helps to drive more users to brands through unique video content on our platform. Vicomma host
                        unique product types alongside cool video content to keep visitors engaged. So, why not use
                        vicomma?
                    </p>
                </div>
            </div>
            <div class="col-md-6 boxVcenter all-users">
                <div class="  new-video" data-video="videos/all-users.mp4" data-poster="img/temp.png"
                    data-type='video/mp4'></div>
            </div>
        </div>
    </div>
</section>
{{-- ./Join Section --}}

{{-- Action Section --}}
<section class="sectionPB sectionPT action_section join_section">
    <div class="container-fluid">
        <div class="col-md-6 col_center">
            <h2 class="section_heading"><span>Vicomma</span> <br> Users in Action</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;">
                            <iframe style="width: 100%;height: 240px;"
                                src="https://mainhomepagevideos.s3.amazonaws.com/testimonial+from+Vanessafriend1_girl.mp4">
                            </iframe>
                        </div>
                    </div>
                    <p class="action_title">Vivianna</p>
                    <p class="text1">Vendor</p>
                </div>
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;">
                            <iframe style="width: 100%;height: 240px;"
                                src="https://mainhomepagevideos.s3.amazonaws.com/VIDEO-2020-07-21-11-02-20.mp4">
                            </iframe>
                        </div>
                    </div>
                    <p class="action_title">Prosper Ubique</p>
                    <p class="text1">Brand Owner</p>
                </div>
            </div>
            <div class="col-md-6 pt-lg-5 center-vid">
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;">
                            <video controls class="w-100" style="width: 100%;height: 400px;">
                                <source
                                    src="https://mainhomepagevideos.s3.amazonaws.com/Barbara+VERTICAL+for+Testimonial+on+Homepage.mov"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                        </div>
                    </div>
                    <p class="action_title">Barbara</p>
                    <p class="text1">Content Creator</p>

                </div>
            </div>
            <div class="col-md-3">
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;">
                            <iframe style="width: 100%;height: 240px;"
                                src="https://mainhomepagevideos.s3.amazonaws.com/Louis+VERTICAL+for+Testimonial+on+Homepage.mp4">
                            </iframe>
                        </div>
                    </div>
                    <p class="action_title">Louis</p>
                    <p class="text1">Content Creator</p>

                </div>
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;">
                            <iframe style="width: 100%;height: 240px;"
                                src="https://mainhomepagevideos.s3.amazonaws.com/VIDEO-2020-07-20-15-04-50.mp4">
                            </iframe>
                        </div>
                    </div>
                    <p class="action_title">David </p>
                    <p class="text1"> Regular User</p>

                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./Action Section --}}

{{-- Use Section --}}
<section class="sectionPT sectionPB sectionBg3 use_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="img_area">
                    <img alt="" src="img/uses.png" loading="lazy">
                </div>
            </div>
            <div class="col-md-6">
                <div class="content">
                    <h2 id="ftc" class="section_heading ">Who uses <span>vicomma?</span> </h2>
                    <div class="row">
                        <ul class="col-md-6">
                            <li>• Podcasters</li>
                            <li>• Visual Artists</li>
                            <li>• Musicians</li>
                            <li>• Fashion Designers</li>
                            <li>• Beauty Consultants</li>
                        </ul>
                        <ul class="col-md-6">
                            <li>• Video Creators</li>
                            <li>• Foodies</li>
                            <li>• Comedians</li>
                            <li>• Gaming Creators</li>
                            <li>• Hair Stylists</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ./Use Section --}}

{{-- Works Vicomma Section --}}
<section class="sectionPT worksVicomma">
    <div class="col-md-8 col_center posRelative">
        <img alt="" class="shape1" src="img/shape1.png" loading="lazy">
        <h2 class="section_heading">Works with <span>vicomma</span></h2>

        <p class="stepContent mb-3">vicomma connects with other apps that help you promote and get the word to</p>
        <p class="stepContent">your users, followers, and fans easily about your video product content.</p>
    </div>
</section>
{{-- ./Works Vicomma Section --}}

{{-- Comments --}}
<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="col-md-8 col_center">
            <h2 class="section_heading">Look what users are <span>saying…</span></h2>
        </div>

        <div class="owl-carousel owl-theme testimonial_carousel">
            <div class="item">
                <div class="testimonial_item">
                    <img src="img/blue.png" class="icon blue-icon">
                    <img src="img/green.png" class="icon green-icon">
                    <p class="text1">Vicomma connects with other apps that help you promote and get the word to
                        your users, followers, and fans easily about your video product content. Other app
                        connections coming soon.</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <img src="img/blue.png" class="icon blue-icon">
                    <img src="img/green.png" class="icon green-icon">
                    <p class="text1">“I've seen some ecommerce sites especially the big names but for Vicomma to
                        put these two together on the same platform is just different. I'm going to become a
                        vendor and start selling stuff too</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <img src="img/blue.png" class="icon blue-icon">
                    <img src="img/green.png" class="icon green-icon">
                    <p class="text1">“ I haven't found a product that doesn't exists on Vicomma yet, I mean
                        real things I see in the videos. I'm a fashion hound so any latest fashion I'm always up
                        on and now to see it in video form? I really love Vicomma."</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <img src="img/blue.png" class="icon blue-icon">
                    <img src="img/green.png" class="icon green-icon">
                    <p class="text1">Vicomma connects with other apps that help you promote and get the word to
                        your users, followers, and fans easily about your video product content. Other app
                        connections coming soon.</p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- ./Comments--}}

{{-- Platform Section --}}
<section class="platform_section sectionPT sectionPB">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="section_heading mb-2 text-center"><span>Vicomma</span> platform</h2>
                <h6 class="heading text-center">Connect with creatives and get it done; video commerce, done right.</h6>
                <ul class="row">
                    <div class="col-md-6">
                        <li>• Chat in real-time to your audience</li>
                        <li>• Make live videos and post to your audience</li>
                        <li>• Open to all vendors</li>
                        <li>• Entire sales cycle is completed on one platform</li>
                        <li>• Chat in real-time to your audience</li>
                        <li>• No restrictions or unattainable qualifications to begin using the platform</li>
                    </div>
                    <div class="col-md-6">
                        <li>• Connects to Twitter and Facebook so users know you have something to share with them right
                            away</li>
                        <li>• Make Live videos and post immediately</li>
                        <li>• Connects to Twitter and Facebook so users know you have something to share with them right
                            away</li>
                        <li>• Chat in real-time to your audience</li>
                        <li>• Join the community of users engaging in the new way of selling and promoting their brands
                            virally
                        </li>
                    </div>
                    {{-- <li class="img_area2">
                        <img alt="" src="img/plateform.PNG">
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- ./Platform Section --}}
<section>
    <div class="container-fluid">
        <div class="col-md-12 col_center">
            <img alt="" src="{{ asset('img/promote.png') }}">
            <a class="btn btn-primary rounded-btn thirdFont font800 home_getStarted" href="/signup" role="button">Get
                Started</a>
            <br>
            <ul class="social_list mt-5">
                <li><a href="https://facebook.com/vicomma/"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://twitter.com/officialvicomma/"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/officialvicomma/"><i class="fab fa-instagram"></i></a></li>
                {{-- <li><a href="#."><i class="fab fa-tiktok"></i></a></li> --}}
            </ul>
        </div>
    </div>
</section>
@include('pages.partials.footer')
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const slides = document.querySelectorAll('.sliding');
        let currentSlide = 0;
        
        function showNextSlide() {
            // Reset the current slide and stop its typing effect
            if (currentSlide > 0) { // Reset previous slide
                let prevSlideIndex = (currentSlide - 1 + slides.length) % slides.length;
                slides[prevSlideIndex].classList.remove('active');
                slides[prevSlideIndex].querySelector('.hero-title').textContent = ''; // Clear previous text
            }
    
            // Move to the next slide or loop back to the start
            currentSlide = currentSlide % slides.length;
    
            slides[currentSlide].classList.add('active');
            let currentTextElement = slides[currentSlide].querySelector('.hero-title');
            typeWriter(currentTextElement, currentTextElement.getAttribute('data-text'), 0, 150);
    
            // Increment to prepare for the next slide
            currentSlide++;
    
            // Wait for typing to finish plus an extra delay before showing the next slide
            setTimeout(showNextSlide, currentTextElement.getAttribute('data-text').length * 150 + 2000);
        }
    
        function typeWriter(element, text, i, speed) {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                setTimeout(function() {
                    typeWriter(element, text, i + 1, speed);
                }, speed);
            }
        }
    
        // Set up slides
        slides.forEach(slide => {
            let textElement = slide.querySelector('.hero-title');
            textElement.setAttribute('data-text', textElement.textContent); // Store original text
            textElement.textContent = ''; // Clear text initially
        });
    
        // Start the slideshow
        showNextSlide();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
            $('.owl-carousel.testimonial_carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 3
                    }
                }
            });
            $('.home-slider').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                dots: false,
                autoplay:true,
                autoplayTimeout:8000,
                autoplayHoverPause:false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });

        });
</script>
@endpush