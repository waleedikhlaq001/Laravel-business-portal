@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/mall-navigation.css')}}">
<link rel="stylesheet" href="{{asset('/ecommerce/css/tailwind.min.css')}}">
<style>
.css-jue3ft-MuiRating-root.Mui-disabled {
    opacity: 1 !important;
}

.mantine-uwf73j {
    background-color: #94CA52;
}

#mall-cta{
    color: #fff!important;
}

</style>
@section('content')
<div class="">
    @include('includes.mall-navigation')

    <div>
        <div class="owl-carousel owl-theme owl-banner">
            <div class="item">
                <div class="mall-bg d-flex justify-content-center align-items-center" id="mall-bg-1" style="">
                    {{-- <img data-src="{{asset('/img/mall-bg1.jpg')}}" alt="" class="owl-lazy"> --}}
                    <div class="container text-center">
                        <small class="text-uppercase text-sm text-muted">We give provide the best!!</small>
                        <h2 class="text-uppercase text-snd font-weight-normal mt-4">
                            Mall
                            <br>
                            <span>at</span>
                            <br>
                            Vicomma
                        </h2>
                        <a class="btn btn-secondary text-light btn-md mt-3 text-uppercase" id="mall-cta"
                            href="{{ route('mall.products') }}">Shop Now!</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="mall-bg d-flex justify-content-center align-items-center" id="mall-bg-2">
                    {{-- <img data-src="{{asset('/img/mall-bg2.jpg')}}" alt="" class="owl-lazy"> --}}
                    <div class="container">
                        <small class="text-uppercase text-sm text-muted">We give provide the best!!</small>
                        <h2 class="text-snd font-weight-normal mt-4">
                            Summer Sale
                        </h2>
                        <h1 class="font-weight-bold text-uppercase" style="font-size: 80px;">70% off</h1>
                        <a class="btn btn-secondary btn-sm mt-3 text-uppercase" id="mall-sale-cta">Shop
                            Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row g-2">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-snd text-lg mr-3">
                        <i class="fas fa-money-bill" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-snd font-weight-bold mb-1">Refund Option</h6>
                        <small class="text-muted">100% Money Back Gaurantee</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-snd text-lg mr-3">
                        <i class="fas fa-headset" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-snd font-weight-bold mb-1">Online Support</h6>
                        <small class="text-muted">Live support available</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="aUTHDivDer mt-5">
            <div>
                <h6 class="text-uppercase pl-2 pr-2 mt-1">Featured Products</h6>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-5 mt-4">
        <div id="featuredMallDisplay" class="" style="display: flex;
    justify-content: flex-start;
    flex-direction: row;
    align-content: space-between;">

        </div>
    </div>

    {{-- News Arrivals --}}
    <div class="bg-white pt-4 pb-4">
        <div class="container-fluid">
            <div class="aUTHDivDer">
                <div>
                    <h6 class="text-uppercase pl-2 pr-2 mt-1">New Arrivals</h6>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div id="newMallDisplay" class="" style="display: flex;
    justify-content: flex-start;
    flex-direction: row;
    align-content: space-between;">

            </div>
        </div>
    </div>
    {{-- ./News Arrivals --}}
    <div class="faSHSECTION d-flex justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center text-white font-weight-bold text-uppercase">
                Top Fashion
                <br>Deals
            </h2>
        </div>
    </div>

    {{-- top sales --}}
    <div class="container-fluid mt-5 pb-5">
        <div class="row g-2">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Featured Selling</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Best Selling</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Lastest Products</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Top Rated Products</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ./ top sales --}}

</div>
@push('scripts')
<script src="{{ asset('client/mall/index.js')}}"></script>
<script>
jQuery('.owl-banner').owlCarousel({
    loop: false,
    margin: 5,
    nav: true,
    dots: false,
    lazyLoad: true,
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

jQuery('.featured').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 5
        }
    }
})

jQuery('.arrivals').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 5
        }
    }

})
</script>
@endpush
@endsection
