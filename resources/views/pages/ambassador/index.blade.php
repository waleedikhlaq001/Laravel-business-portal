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

    .other-page-content {
    margin-top: 0px!important;
}

.nav-item {
    display: none!important;
}
#fc_widget{
    display: none;
}
</style>
@section('content')
@include('includes.messages')
@include('includes.home-popup')
{{--  --}}
<section class="">
    <section id="video_mt">
        <video playsinline autoplay loop muted id="background">
        <source src="{{asset('/vicomma background video for landing_Awoyemi_15Sept2020.mp4')}}" type="video/mp4">
            <!-- <source src="{{asset('/img/vicomma_bg_vidoe.mp4')}}" type="video/mp4"> -->
        </video>
        <div class="coverItem">
            <div class="container">
                <div class="col-md-11 col-12 col_center">
                    <h2 class="coverTitle" style="color: #fff">Ambassador Challenge</h2>
                    <p class="cover_sub" style="color: #fff">
                    Challenge your way to becoming a premier vicomma ambassador
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>
{{-- form section --}}

<section class="pt-5 pb-5 form_section mt-sm-5 mt-lg-0" style="margin-top: -256px !important;">
    <div class="container-fluid">
        <div class="row">
         
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mx-auto">
                <a href="https://ambassador.vicomma.com/register" class="btx btn btn-primary mt-2 tip wd100per icon-btn rounded-btn" data-show="no" data-content="Get Started" role="button">
                    <img alt="" class="icon" src="img/money_icon.png">
                    Click to Register
                </a>
            </div>
<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mx-auto">
<a href="https://ambassador.vicomma.com/login" class="btx btn btn-primary mt-2 wd100per icon-btn rounded-btn">
<img alt="" class="icon" src="img/money_icon.png" />
click to Login
</a>
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
