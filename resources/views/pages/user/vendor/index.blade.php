@extends('pages.app')

<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        margin-top: -3.5rem;
    }

    .inputfile+label {
        border-radius: 5px;
        padding: .4rem;
        width: 100%;
        text-align: center;
        cursor: pointer;
    }

    .svBanner {
        position: absolute;
        margin-top: 1rem;
    }

    /* .svBtn {
        display: none;
    } */

</style>

@section('content')
@include('includes.messages')

@if(Auth::user()->isPhoneVerified != "1")
    <div class="col-8 m-auto">
        <div class="card d-flex position-relative" style="min-height: 150px; margin-top: 120px; box-shadow: 2px 3px 12px 8px rgba(0, 0, 0, 0.11); border-radius: 30px;">
            <div class="position-absolute top-0 start-50 translate-middle">
                <div class="position-relative d-flex" style="background: #94CA52; height: 120px; width:120px; border-radius: 50%;">
                    <i class="fa fa-exclamation-circle fs-5 position-absolute" style="top: 10%; right:20%;color: #fff; width:20px; height:20px;" aria-hidden="true"></i>
                    <img class="m-auto mt-2" src="{{ asset('img/phonexxs.png') }}" style="width: 50%; height: 50%" alt="">
                </div>
            </div>
            
            <p class="p-5 text-center" style="margin-top: 70px;  color:#fff;">
                <a class="btn btn-outline-light text-decoration-none btn-sm update-t px-4 py-2" href="/settings" role="button"
                style="background-color: #6f3c96; color: white !important;"
                >Verify Your Phone Number</a>
            </p>
        </div>
    </div>
@else
<div class="container-fluid">
    <form action="{{route('user.vendors.save.banner')}}" method="POST" enctype="multipart/form-data">
        <div class="svBanner">
            <button type="submit" class="btn btn-primary btn-sm rounded-0 mb-2 svBtn d-none">Save</button>
        </div>
        <div class="vendorBannerContainer"
            style="background-image: url({{ ($vendor->banner != '') ? asset($vendor->banner) : '/img/vendorBG.jpg'}})!important;">
        </div>
        <div class="container-fluid vNSHOPDESRIP">
            <div class="row g-3">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    {{-- <form action="{{route('user.vendors.save.banner')}}" method="POST"
                    enctype="multipart/form-data"> --}}
                    @csrf
                    <div class="mb-1 bg-white rounded">
                        <input type="file" name="image" id="file" class="inputfile image"
                            accept="image/png, image/jpeg">
                        <label class="d-flex justify-content-center align-items-center font-weight-normal pb-3 pt-3"
                            for="file">
                            <i class="fas fa-camera text-snd mr-2" aria-hidden="true"></i> Upload Cover banner
                        </label>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary btn-sm rounded-0 mb-2 svBtn d-none">Save</button> --}}
    </form>
    <div class="card vEDNORCARD shadow">
        <div class="card-body">
            <div class="">
                {{-- <img src="{{asset('/img/logo-text.png')}}" class="img-fluid d-flex mx-auto" alt=""> --}}
                <h3 class="font-weight-normal text-snd mt-4">{{$vendor->vendor_station}}</h3>
                <div class="mt-4">
                    <h6 class="mb-1 font-weight-normal">
                        <span class="mr-2"><svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.54019 16.2703L6.41181 16.1338C6.10798 15.8105 4.61258 14.1963 3.19621 12.2457C2.48776 11.27 1.80702 10.221 1.30531 9.215C0.798209 8.19822 0.5 7.27601 0.5 6.54024C0.5 3.21011 3.21011 0.5 6.54019 0.5C9.87062 0.5 12.5807 3.21012 12.5804 6.5402V6.54024C12.5804 7.27602 12.2822 8.19826 11.7751 9.21509C11.2734 10.2211 10.5927 11.2702 9.88425 12.2459C8.46787 14.1966 6.97245 15.8108 6.66876 16.1336L6.54019 16.2703ZM3.33389 6.54047C3.33389 8.30879 4.77187 9.74677 6.54019 9.74677C8.30888 9.74677 9.74649 8.30881 9.74649 6.54047C9.74649 4.77219 8.30888 3.33417 6.54019 3.33417C4.77187 3.33417 3.33389 4.7721 3.33389 6.54047Z"
                                    stroke="#6F3C96"></path>
                            </svg>
                        </span>
                        @if ($vendor->user->country_id == '')
                        <a href="{{route('user.profile')}}" class="text-snd"> <i class="fa fa-plus"
                                aria-hidden="true"></i> Add Store Location</a>
                        @else
                        {{$vendor->user->country->name}}
                        @endif
                        {{-- <a href="" class="text-snd">
                                            <i aria-hidden="true" class="fa fa-plus"></i>
                                            Add Country
                                        </a> --}}
                    </h6>
                    <h6 class="mb-1 font-weight-normal mt-2">
                        <span class="mr-2">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.151766 15.85C0.233668 12.3752 3.15369 9.56943 6.73706 9.56943C10.3196 9.56943 13.2396 12.3751 13.3215 15.85H11.9998C11.9178 13.0972 9.58488 10.8907 6.73625 10.8907C3.88758 10.8907 1.55551 13.098 1.47347 15.85H0.151766Z"
                                    fill="#6F3C96" stroke="white" stroke-width="0.3"></path>
                                <path
                                    d="M2.44297 4.44625L2.44297 4.4462C2.44219 2.07778 4.36992 0.15 6.7384 0.15C9.10772 0.15 11.0355 2.077 11.0355 4.44625C11.0355 6.81549 9.10772 8.74249 6.7384 8.74249C4.37078 8.74249 2.44297 6.81394 2.44297 4.44625ZM6.7384 1.47124C5.09755 1.47124 3.7634 2.80539 3.7634 4.44625C3.7634 6.0871 5.09755 7.42125 6.7384 7.42125C8.38004 7.42125 9.71422 6.08713 9.71422 4.44625C9.71422 2.80531 8.37836 1.47124 6.7384 1.47124Z"
                                    fill="#6F3C96" stroke="white" stroke-width="0.3"></path>
                            </svg>
                        </span>
                        Joined {{\Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans()}}
                    </h6>
                </div>
                <div class="reviews mt-3 text-main">
                    <i aria-hidden="true" class="fa fa-star"></i>
                    <i aria-hidden="true" class="fa fa-star"></i>
                    <i aria-hidden="true" class="fa fa-star"></i>
                    <i aria-hidden="true" class="fa fa-star"></i>
                    <span class="text-muted">(Reviews)</span>
                </div>
                <a href="{{route('mall.vendor', Str::slug($vendor->vendor_station))}}"
                    class="btn btn-primary btn-block mt-4 pt-2 pb-2">
                    <i class="fa fa-eye" aria-hidden="true"></i> Preview store
                </a>
                <a href="{{route('user.vendor.orders')}}"
                    class="btn btn-primary btn-block mt-4 pt-2 pb-2">
                    <i class="fa fa-truck" aria-hidden="true"></i> View Orders
                </a>
                <a href="/my-store/products"
                    class="btn btn-primary btn-block mt-4 pt-2 pb-2">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> View My Products
                </a>
                <a href="/my-store/deleted-products"
                    class="btn btn-primary btn-block mt-4 pt-2 pb-2">
                    <i class="fa fa-trash" aria-hidden="true"></i> View Deleted Products
                </a>
                {{-- <hr class="border-0">
                            <h6 class="mb-1 font-weight-normal text-snd">Description</h6>
                            <p class="text-md">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima delectus nihil vitae
                                excepturi alias mollitia in voluptate
                            </p> --}}
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-9">
    <div class="card vEDNORCARD shadow">
        <div class="card-header d-flex">
            <h5 class="mb-4 font-weight-normal text-uppercase text-snd">Edit Your Store here <span class="tip" style="margin-bottom: -12px;" data-tippy-showOnInit="true" data-content="Manage the look and feel of your Online Store"><ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large"></ion-icon></span></h5>
            @if($vendor->vendorDigitalSignature)
            <a href="{{route('user.vendors.create')}}" class="btn btn-success btn-sm ml-auto d-flex align-items-center">
                <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                Add Product
            </a>
            @else
            <button class="btn btn-success btn-sm ml-auto d-flex align-items-center" id="digitalSignBtn">
                Add Products
            </button>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('user.vendors.custom')}}" class="mb-4" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="header">Header</label>
                        <input type="text" name="header" id="header" class="form-control" value="{{$vendor->header}}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="slogan">Slogan</label>
                        <input type="text" name="slogan" id="slogan" class="form-control" value="{{$vendor->slogan}}">
                    </div>
                </div>
                <small>These details will appear on your station</small>
                <div class="form-group mb-1 d-flex align-items-center">
                    <input type="color" class="" name="primary_color" id="color" value="{{$vendor->primary_color}}">
                    <label for="color" class="font-weight-normal ml-2 mt-1">Primary Color</label>
                </div>
                <div class="form-group mb-1 d-flex align-items-center">
                    <input type="color" class="" name="secondary_color" id="color" value="{{$vendor->secondary_color}}">
                    <label for="color" class="font-weight-normal ml-2 mt-1">Secondary Color</label>
                </div>
                <div class="form-group mb-1 d-flex align-items-center">
                    <input type="color" class="" name="button_color" id="color" value="{{$vendor->button_color}}">
                    <label for="color" class="font-weight-normal ml-2 mt-1">Button Color</label>
                </div>
                <button type="submit" class="btn btn-success btn-sm pl-4 pr-4 mt-4">Save</button>
            </form>
        </div>
    </div>
</div>
<!--Digital Sign Modal -->
<div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <img alt="" src="/img/path1.png" class="p1">
            <img alt="" src="/img/path2.png" class="p2">
            <div class="d-flex p-3">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Disclaimer</h5>
                <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close" style="z-index: 9999"></button>
            </div>
            <div class="px-3 mb-2">
                <p>Products offered for sale on vicomma must be authentic. The sale or promotion of counterfeit products/services is strictly prohibited on the platform including our mobile app. Failure to abide by this policy may result in loss of selling privileges and/or funds being withheld. The sale, trafficking, and or promotion of counterfeit products/services may also result in referral to law enforcement/criminal prosecution as well as civil action. It is each seller’s and supplier’s responsibility to source, sell, and fulfill only authentic products. Prohibited products include bootlegs, fakes, or pirated copies of products or content; products that have been illegally replicated, reproduced, or manufactured; and products that infringe another party’s intellectual property rights. You must agree to these terms to sell and/or promote on vicomma by your digital signature. To learn more please visit our <a href="/terms">Terms & Conditions Page</a></p>
                <div class="mb-3 form-check">
                    <input id="agreeSign" type="checkbox" class="form-check-input mt-0" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">By checking this box, I agree to comply with vicomma's stated policies.</label>
                </div>
            </div>
            <button id="signContinue" class="btn btn-primary m-auto footer-btn my-3" disabled>Continue</button>
        </div>
    </div>
</div>
<!--Digital Sign Modal End-->
@endif
</div>
</div>
</div>
@push('scripts')

<script>
    jQuery('document').ready(function() {
        var image = document.querySelector('.image');
        var preview = document.querySelector('.preview');
        var vbanner = document.querySelector('.vendorBannerContainer');
        var btn = document.querySelector('.svBtn');

        image.onchange = evt => {
            const [file] = image.files;
            jQuery('.svBtn').removeClass('d-none');
            if (file) {
                var i = URL.createObjectURL(file);
                jQuery('.vendorBannerContainer').css('background-image', `url(${i})`);
            }
        }
    })

    $("#agreeSign").on('change', (e) => {
        e.preventDefault();
        if(e.target.checked){
            $("#signContinue").removeAttr("disabled");
        } else{
            $("#signContinue").attr("disabled", "disabled");
        }
    })
    $("#signContinue").on('click', (e)=> {
        e.preventDefault();
        if($("#agreeSign").is(":checked")){
            $.ajax({
                url:"{{route('user.vendors.digitalSign')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                'type': 'POST',
                'data': {
                    "signature": true
                },
                success: function(result){
                    console.log(result)
                    if(result.status == 'success'){
                        window.location.replace("/my-store/create");
                    }
                }
            })
        }
    })

    $('#digitalSignBtn').on('click', (e) => {
        e.preventDefault();
        $('#signModal').modal('show');
        // console.log("Lets sign this shit")
    })
</script>

@endpush
@endsection
