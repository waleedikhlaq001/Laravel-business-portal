@extends('pages.app')
<style>
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

    .container-fluid{
        padding-left: 50px !important;
        padding-right: 50px !important;
    }

    @media (max-width: 768px) {
        .container-fluid{
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    }

.fader {
    width: 100%;
    height: 100vh; /* Adjust the height as needed */
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
    animation: fade 12s infinite; /* Adjust the animation duration as needed */
}

#slide1 {
    background-image: url('/images/bg1.jpeg');
    animation-delay: 0s; /* Delay for the first slide */
}

#slide2 {
    background-image: url('/images/bg2.jpeg');
    animation-delay: 3s; /* Delay for the second slide */
}

#slide3 {
    background-image: url('/images/bg3.jpeg');
    animation-delay: 6s; /* Delay for the third slide */
}

#slide4 {
    background-image: url('/images/bg4.jpeg');
    animation-delay: 9s; /* Delay for the fourth slide */
}

@keyframes fade {
    0%, 100% {
        opacity: 0;
    }
    20%, 80% {
        opacity: 1;
    }
}
</style>
@section('content')
@include('includes.messages')
@include('includes.home-popup')
{{--  --}}
<section class="">
<section class="fader">
        <div class="slide" id="slide1"></div>
        <div class="slide" id="slide2"></div>
        <div class="slide" id="slide3"></div>
        <div class="slide" id="slide4"></div>
    </section>
    <section id="video_mt2">

        <!-- <video playsinline autoplay loop muted id="background"> -->
        <!-- <source src="{{asset('/new/VICOMMA SLIDER 2023.mp4')}}" type="video/mp4"> -->
            <!-- <source src="{{asset('/img/vicomma_bg_vidoe.mp4')}}" type="video/mp4"> -->
        <!-- </video> -->
      
        <!-- <div class="coverItem">
            <div class="container">
                <div class="col-md-11 col-12 col_center">
                    <h2 class="coverTitle" style="color: #fff">{{$main_content->main_header}}</h2>
                    <p class="cover_sub" style="color: #fff">
                        {{$main_content->main_description}}
                    </p>
                </div>
            </div>
        </div> -->
    </section>
</section>
{{-- form section --}}

<section class="pt-5 pb-5 form_section mt-sm-5 mt-lg-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">

                <a ref="#" class="btx btn btn-primary mt-2 tip wd100per icon-btn rounded-btn"  data-show="no" data-content="Need someone who can create conent for your brand or service? We have tons of them!" href="{{route('job.post')}}" role="button">
                    <img alt="" class="icon" src="img/search_icon.png">
                    Hire a Creative
                </a>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <a ref="#" class="btx btn btn-primary mt-2 tip wd100per icon-btn rounded-btn" data-show="no" data-content="Ok, you got great content, well we have tons of people who need you." href="{{route('register.creative')}}" role="button">
                    <img alt="" class="icon" src="img/money_icon.png">
                    Earn Money Creating
                </a>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <a class="btx" href="{{route('user.guser.index')}}"><button type="button" class="btn btn-primary mt-2 wd100per icon-btn rounded-btn tip" data-show="no" data-content="Ok, just watch all the great content and see some great stuff that comes with the content">
                    <!-- <i class="fas fa-cart-arrow-down icon"></i>  -->
                    <img alt="" class="icon" src="img/watch_icon.png">
                    Watch & Buy</button></a>
            </div>

            {{-- <div class="col-md-8 col_center">
                <div class="form_area1">
                    <form>
                        <label>
                            <!-- <i class="fas fa-search"></i> -->
                            <img alt="" class="icon" width="20" src="img/search_icon3.png">
                        </label>
                        <input class="form-control" placeholder="Find videos, creatives, products, categories…."
                            type="text" name="name">
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</section>
{{-- ./ form section --}}

{{-- Why Vicomma section --}}
<section class="sectionPT sectionPB sectionBg3 why_section">
    <div class="container-fluid posRelative">
        <img alt="" class="shape1" src="img/shape1.png">
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
                    <img alt="" class="icon" src="img/search_icon2.png">
                    <h6 class="title"> {{$why_vicomma->hire_creative}} </h6>
                    <p class="text">
                        {{$why_vicomma->hire_creative_description}}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 dFlex">
                <div class="single_why box-shadow-only-hover hover-top">
                    <img alt="" class="icon" src="img/money_icon2.png">
                    <h6 class="title"> {{$why_vicomma->earm_money}} </h6>
                    <p class="text">
                        {{$why_vicomma->earm_money_description}}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 dFlex">
                <div class="single_why box-shadow-only-hover hover-top">
                    <img alt="" class="icon" src="img/watch_icon2.png">
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
                    <img alt="" src="img/video.png">
                </div>
            </div>
            <div class="col-md-7 boxVcenter">
                <div class="content">
                    <h2 class="section_heading">{{$not_just_platform->not_just_another_platform}}</h2>
                    <p class="text1">
                        {{$not_just_platform->not_just_another_platform_description}}
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
                <h2 class="section_heading">{{$not_just_platform->vcomm_icon}}</h2>
                <p class="text1">
                    {{$not_just_platform->vcomm_icon_description}}
                </p>
            </div>
            <div class="col-md-5 dFlex alignCenter">
                <div class="img_area">
                    <img alt="" src="img/dollar.png">
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
            <h2 id="hiw" class="section_heading mb1">{{$how_vicomma_works->header}}</h2>
            <p class="text1">
                {{$how_vicomma_works->description}}
            </p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 padding">
                <div class="img_area">
                    <img alt="" class="border_right step1_img" src="img/step1.png">
                </div>
            </div>
            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 1</p>
                    <p class="stepTitle"> {{$how_vicomma_works->step1_header}} </p>
                    <p class="stepContent">
                        {{$how_vicomma_works->step1_description}}
                    </p>
                    <a class="btn btn-primary rounded-btn" href="/register" role="button">Sign up Now</a>
                </div>
            </div>

            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 2</p>
                    <p class="stepTitle"> {{$how_vicomma_works->step2_header}} </p>
                    <p class="stepContent mb-0">
                        {{$how_vicomma_works->step2_description}}
                    </p>
                    <!-- <button class="btn btn-primary rounded-btn">Signup Now</button> -->
                </div>
            </div>

            <div class="col-md-6 padding">
                <div class="img_area">
                    <img alt="" class="border_right step2_img" src="img/step2.png">
                </div>
            </div>

            <div class="col-md-6 padding">
                <div class="img_area">
                    <img alt="" class="border_left step3_img" src="img/step3.png">
                </div>
            </div>
            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 3</p>
                    <p class="stepTitle">{{$how_vicomma_works->step3_header}}</p>
                    <p class="stepContent mb-0">
                        {{$how_vicomma_works->step3_description}}
                    </p>
                    <!-- <button class="btn btn-primary rounded-btn">Signup Now</button> -->
                </div>
            </div>

            <div class="col-md-6 padding boxVcenter">
                <div class="step_info">
                    <p class="stepText">Step 4</p>
                    <p class="stepTitle">{{$how_vicomma_works->step4_header}}</p>
                    <p class="stepContent mb-0">
                        {{$how_vicomma_works->step4_description}}
                    </p>
                    <!-- <button class="btn-primary btn-primary rounded-btn">Signup Now</button> -->
                </div>
            </div>

            <div class="col-md-6 padding">
                <div class="img_area">
                    <img alt="" class="border_right step4_img" src="img/step2.png">
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
                    <h2 class="section_heading">{{$why_join_vicomma->why_join_vicomma_header}}</h2>
                    <p class="text1">
                        {{$why_join_vicomma->why_join_vicomma_description}}
                    </p>
                </div>
            </div>
            <div class="col-md-6 boxVcenter all-users">
                <div class="  new-video" data-video="videos/all-users.mp4"
                    data-poster="img/temp.png" data-type='video/mp4'></div>
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
                        <div class="shadow border new-video" style="border-radius: 5px;" data-video="videos/vivianna-testi.mp4"
                            data-poster="" data-type='video/mp4'></div>
                    </div>
                    <p class="action_title">Vivianna</p>
                    <p class="text1">Business Owner and Vendor</p>
                </div>
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;" data-video="videos/prosper-testi.mp4"
                            data-poster="" data-type='video/mp4'></div>
                    </div>
                    <p class="action_title">Prosper Ubique</p>
                    <p class="text1">Business Owner and Vendor</p>
                </div>
            </div>
            <div class="col-md-6 pt-lg-5 center-vid">
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;" data-video="videos/mudemi-testi.mp4"
                            data-poster="" data-type='video/mp4'></div>
                    </div>
                    <p class="action_title">Mudemi</p>
                    <p class="text1">Influencer</p>

                </div>
            </div>
            <div class="col-md-3">
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;" data-video="videos/timac-testi.mp4"
                            data-poster="" data-type='video/mp4'></div>
                    </div>
                    <p class="action_title">Timac</p>
                    <p class="text1">Business Owner and Vendor</p>

                </div>
                <div class="single_join">
                    <div class="boxVcenter">
                        <div class="shadow border new-video" style="border-radius: 5px;" data-video="videos/fumilola-testi.mp4"
                            data-poster="" data-type='video/mp4'></div>
                    </div>
                    <p class="action_title">Fumilola</p>
                    <p class="text1">Business Owner and Vendor</p>

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
                    <img alt="" src="img/uses.png">
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
        <img alt="" class="shape1" src="img/shape1.png">
        <h2 class="section_heading">Works with <span>vicomma</span></h2>

        <p class="text1">vicomma connects with other apps that help you promote and get the word to</p>
        <p class="text1">your users, followers, and fans easily about your video product content.</p>
    </div>
</section>
{{-- ./Works Vicomma Section --}}

{{-- Comments --}}
<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="col-md-8 col_center">
            <h2 class="section_heading">Look who's talking <span>about us...</span></h2>
        </div>

        <div class="owl-carousel owl-theme testimonial_carousel">
            <div class="item">
                <div class="testimonial_item">
                    <i class="fas fa-quote-left icon"></i>
                    <p class="text1">Vicomma connects with other apps that help you promote and get the word to
                        your users, followers, and fans easily about your video product content. Other app
                        connections coming soon.</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <i class="fas fa-quote-left icon"></i>
                    <p class="text1">“I've seen some ecommerce sites especially the big names but for Vicomma to
                        put these two together on the same platform is just different. I'm going to become a
                        vendor and start selling stuff too</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <i class="fas fa-quote-left icon"></i>
                    <p class="text1">“ I haven't found a product that doesn't exists on Vicomma yet, I mean
                        real things I see in the videos. I'm a fashion hound so any latest fashion I'm always up
                        on and now to see it in video form? I really love Vicomma."</p>
                </div>
            </div>
            <div class="item">
                <div class="testimonial_item">
                    <i class="fas fa-quote-left icon"></i>
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
                    <li class="img_area">
                        <img alt="" src="img/plateform.PNG">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- ./Platform Section --}}
<section>
    <div class="container-fluid">
        <div class="col-md-12 col_center">
            <h2 class="section_heading">POST, SELL, PROMOTE, YOUR BRAND THROUGH VIDEOS <br>
                Join thousands of users using the <span>vicomma</span> platform
            </h2>
            <a class="btn btn-primary rounded-btn thirdFont font800 home_getStarted" href="/register" role="button">Get Started</a>
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


        });
</script>
@endpush
