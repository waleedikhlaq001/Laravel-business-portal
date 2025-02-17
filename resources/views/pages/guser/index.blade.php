<?php
use App\Models\VideoContentView;
?>
@extends('pages.app')
@push('scripts')
<script>
    document.title = "Home";
</script>
@endpush
@push('css')
<style>
    .add-status {
        position: absolute;
        top: 0;
        margin-top: 44%;
        left: 0;
        margin-left: 37%;
        padding: 0.3rem 0.6rem;
        background-color: #94CA52;
    }

    aside {
        position: absolute !important;
    }

    .g-menu {
        font-size: 13px;
    }

    .guser-menu-icon {
        padding-right: 12px;
    }

    .g-menu .dropdown-item {
        color: #78747a !important;
    }

</style>
@endpush

@section('content')
{{-- vendor video carousel --}}
{{-- {{dd(Auth::user()->timezone)}} --}}
<div class="row">
    <div id="partner-carousel" class="partner-carousel owl-carousel owl-theme owl-loaded">

        @if (count($creatives) > 0)
        @foreach ($creatives as $creative)
        <div class="partner-item">
            <img src="{{ $creative->user->image }}" onclick="creativeDetails({{ $creative->user->id }})"
                data-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" title="Influencer Skills"
                data-bs-content="{{$creative->influencer_skills}}" class="partner-image shadow">
            <div class="row text-black pt-2">
                <span class="partner-image-text p-0">
                    {{ Str::limit(ucfirst(strtolower($creative->user->last_name)), 8, '..') }}
                </span>
            </div>
        </div>
        @endforeach
        @endif

    </div>
</div>
{{-- /end vendor video carousel --}}

{{-- video hero session --}}
<section class="row">
    <div class="px-2 px-lg-4">
        <div class="row p-3">
            <div class="col-md-8 mvpr mb-3 pl-0">
                <div class="row px-2 pr-lg-3">
                    <div class="embed-responsive embed-responsive-16by9 shadow main-vid">
                        <img class="vicom-icon" src="{{ asset('images/group-2623.svg') }}">
                        <video class="embed-responsive-item" poster="{{$featured_video->video_thumb ?? '' }} " autoplay
                            loop controls muted>
                            <source src="{{ $featured_video->file ?? '' }}" type="video/mp4">
                        </video>
                    </div>
                </div>

            </div>
            {{-- products aside video --}}
            <div class="col-md-4 p-3 vid-products shadow">
                <div class="row">
                    <span class="w-100" style="color: #6F3C96; font-family: 'poppins';font-size: 20px;">Top
                        Selling</span>
                    <span class="w-100" style="height: 30px; margin-top: -6px;">
                        <hr style="float:left;width:100%;border: 1px solid rgb(145 197 81);" />
                    </span>
                </div>

                <?php
                    // $directory = 'product_images/';
                    // $files = Storage::disk('public')->allFiles($directory);
                    // $randomFile = $files[rand(0, count($files) - 1)];
                    if($featured_product->description){
                        $description = $featured_product->description;
                    }else{
                        $description = "";
                    }
                    if (json_decode($featured_product->image, true) && is_array(json_decode($featured_product->image, true)) && count(json_decode($featured_product->image, true)) > 0) {
                        $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".trim(json_decode($featured_product->image, true)[0], '"');
                    } else {
                        $image = '/img/no-image.png';
                    }
                    ?>

                <div class="overflow-vid-sidebar fine-scrollbar">
                    <div class="row my-vid-sidebar pb-3 w-100">
                        @if ($featured_product)
                        <div class="col-md-5 col-5">
                            <div class="img-div">
                                <img src="{{ $image }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-7 col-7 pl-0 m-auto">
                            <h4><a class="text-dark" href="/mall/show/{{ $featured_product->id ?? '' }}"
                                    target="_blank"><small
                                        class="small-font">{{ucwords($featured_product->name) ?? '' }}</small></a></h4>
                            <div class="row">
                                <div class="col-4 p-2 pt-3 prod-price">
                                    {{$geo['currency_symbol']}}{{ number_format(($featured_product->price * $geo['exchange_rate'])) ?? '' }}
                                </div>
                                <div class="col-8 p-2 text-center">
                                    <a href="/mall/show/{{ $featured_product->id }}" class="btn-bag-it "
                                        style="border-radius: 20px;display: flex; align-items: center; justify-content: center;color:white !important"
                                        ii="{{ $featured_product->id }}">Shop Now</a>
                                    <!-- <button class="btn-bag-it"
                                                id="{{ $featured_product->id ?? '' }}">Bag
                                                It</button> -->
                                </div>
                            </div>
                        </div>
                        @else
                        <h3><small>No Featured Product found</small></h3>
                        @endif
                    </div>

                    @if ($related_products)
                    @foreach ($related_products as $product)
                    <?php
                                // $directory = 'product_images/';
                                // $files = Storage::disk('public')->allFiles($directory);
                                // $randomFile = $files[rand(0, count($files) - 1)];
                                // //dd($randomFile);
                                if($product->description){
                                    $description = $product->description;
                                }else{
                                    $description = "";
                                }
                                if (json_decode($product->image, true) && is_array(json_decode($product->image, true)) && count(json_decode($product->image, true)) > 0) {
                                    $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($product->image, true)[0];
                                } else {
                                    $image = '/img/no-image.png';
                                }
                                ?>
                    <div class="row my-vid-sidebar pb-3 w-100">
                        <div class="col-lg-5 col-5">
                            <div class="img-div">
                                <img src="{{ $image }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-7 col-7 m-auto">
                            <h4><a class="text-dark" href="/mall/show/{{ $product->id }}" target="_blank"><small
                                        class="small-font">{{ucwords($product->name)}}</small></a></h4>
                            <div class="row">
                                <div class="col-4 p-2 pt-3 prod-price">
                                    {{$geo['currency_symbol']}}{{ number_format(($product->price * $geo['exchange_rate'])) }}
                                </div>
                                <div class="col-8 p-2 text-center">
                                    <a href="/mall/products/{{ $product->id }}" class="btn-bag-it"
                                        style="border-radius: 20px;display: flex; align-items: center; justify-content: center; color: white !important;"
                                        ii="{{ $product->id }}">Shop Now</a>
                                    <!-- <button class="btn-bag-it"
                                                    id="{{ $product->id }}">Bag
                                                    It</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <small>No Related products found</small>
                    @endif

                </div>
            </div>
            {{-- /end of products aside video --}}
        </div>
    </div>
</section>
{{-- /end video hero session --}}
{{-- start latest video category filters --}}
<section class="section row">
    <h2 class="p-3 guser-heading">Latest</h2>
    <div class="row px-3">
        @if (count($videos) > 0)
        @foreach ($videos as $vid)
        <?php
                    // $views = VideoContentView::where('video_content_id', $vid->id)->get('views');
                    // $vl = [0];
                    // if (count($views) > 0) {
                    //     foreach ($views as $v) {
                    //         $vl[] = $v->views;
                    //     }
                    // }
                    // $vc = array_sum($vl);
                    ?>
        <div class="col-md-3 mb-4">
            <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                <video playsinline muted id="vid{{ $vid->id }}" class="embed-responsive-item theVideo{{ $vid->id }}"
                    poster="{{$vid->video_thumb ?? '' }}">
                    <data-src src="{{ $vid->file }}" type="video/mp4"></data-src>
                </video>

                <div class="overlay" onclick="loadVideo('{{ $vid->id }}')">
                    <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                </div>
            </div>
            <div class="row vid-detail pt-2 px-2">
                <div class="col-10 video-name">{{ ucfirst($vid->name)}}</div>
                <div class="col-2 text-right" style="color:#BDBDBD; font-size: 15px;">
                    <div class="btn-group dropleft">
                        <span style="width: 10px; cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('images/3_dots.svg') }}" class="icon " height="15">
                        </span>
                        <div class="dropdown-menu g-menu">
                            <a class="dropdown-item" href="/video/{{$vid->id}}">
                                <span class="guser-menu-icon"><i class="fa fa-external-link" aria-hidden="true"></i>
                                </span>
                                Open
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                                Copy Link
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-download" aria-hidden="true"></i></span>
                                Download
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-share" aria-hidden="true"></i></span>
                                Share
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/mall/show/{{ $vid->job->product->id  ?? ''}}">
                                <span class="guser-menu-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                                View Product
                            </a>
                            <a class="dropdown-item"
                                href="{{route('mall.vendor', Str::slug($vid->job->vendor->vendor_station))}}">
                                <span class="guser-menu-icon"><i class="fas fa-store"></i></span>
                                Visit Store
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-ban" aria-hidden="true"></i></span>
                                Block Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-2 pt-1" style="font-size: 13px; color:#BDBDBD;">
                <img src="{{ asset('images/visibility.svg') }}" class="icon" height="15">
                <span class="pr-3">
                    {{ $vid->view_count }} Views
                </span>
                <img src="{{ asset('images/comment.svg') }}" class="icon" height="15">
                <span>
                    {{ count($vid->comments) }} Comments
                </span>
            </div>
        </div>
        @endforeach
        @else
        <h3><small>No Videos Yet</small></h3>
        <hr>
        @endif

    </div>
</section>

<section class="section row">
    <h2 class="p-3 guser-heading">Trending</h2>
    <div class="row px-3">
        @if (count($trending_videos) > 0)
        @foreach ($trending_videos as $vid)
        <?php
                    // $views = VideoContentView::where('video_content_id', $vid->id)->get('views');
                    // $vl = [0];
                    // if (count($views) > 0) {
                    //     foreach ($views as $v) {
                    //         $vl[] = $v->views;
                    //     }
                    // }
                    // $vc = array_sum($vl);
                    ?>
        <div class="col-md-3 mb-4">

            <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                <video playsinline muted id="vid{{ $vid->id }}"
                    class="embed-responsive-item gVideo theVideo{{ $vid->id }}" poster="{{$vid->video_thumb ?? '' }}">
                    {{-- <data-src src="{{ $vid->file }}" type="video/mp4"></data-src> --}}
                </video>
                <div class="overlay" onclick="loadVideo('{{ $vid->id }}')">
                    <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                </div>
            </div>
            <div class="row vid-detail pt-2 px-2">
                <div class="col-10 video-name">{{ ucfirst($vid->name) }}</div>
                <div class="col-2 text-right" style="color:#BDBDBD; font-size: 15px;">
                    <div class="btn-group dropleft">
                        <span style="width: 10px; cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('images/3_dots.svg') }}" class="icon " height="15">
                        </span>
                        <div class="dropdown-menu g-menu">
                            <a class="dropdown-item" href="/video/{{$vid->id}}">
                                <span class="guser-menu-icon"><i class="fa fa-external-link" aria-hidden="true"></i>
                                </span>
                                Open
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                                Copy Link
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-download" aria-hidden="true"></i></span>
                                Download
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-share" aria-hidden="true"></i></span>
                                Share
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/mall/show/{{ $vid->job->product->id ?? ''}}">
                                <span class="guser-menu-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                                View Product
                            </a>
                            <a class="dropdown-item"
                                href="{{route('mall.vendor', Str::slug($vid->job->vendor->vendor_station))}}">
                                <span class="guser-menu-icon"><i class="fas fa-store"></i></span>
                                Visit Store
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="guser-menu-icon"><i class="fa fa-ban" aria-hidden="true"></i></span>
                                Block Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-2 pt-1" style="font-size: 13px; color:#BDBDBD;">
                <img src="{{ asset('images/visibility.svg') }}" class="icon" height="15">
                <span class="pr-3">
                    {{ $vid->view_count }} Views
                </span>
                <img src="{{ asset('images/comment.svg') }}" class="icon" height="15">
                <span>
                    {{ count($vid->comments) }} Comments
                </span>
            </div>
        </div>
        @endforeach
        @else
        <h3><small>No Videos Yet</small></h3>
        @endif
    </div>
</section>

{{-- /end video category filters --}}

<div class="modal fade" id="creative-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="creativeData">
                ...loading <i class="fa fa-spinner"></i>
            </div>
        </div>
    </div>
</div>

@auth
{{-- @include('pages.partials.footer') --}}
@endauth
@endsection
@push('scripts')
{{-- <script type="text/javascript">
        jQuery(function($) {
            $("video").lazy();
        });
    </script> --}}
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
        function creativeDetails(cid) {
            $("#creativeData").html('...loading <i class="fa fa-spinner"></i>');
            $("#creative-details-modal").modal('show');
            $.get("/guser/fetchDetails/" + cid, function(data, status) {
                var resp = JSON.parse(data);
                console.log(resp);
                $("#creativeData").html(`<div class="row">
                <div class="col-lg-4 text-center">
                    <img src="${resp.user.image}" class="img-fluid shadow-sm" style="border-radius:50%;">
                    <p>Ratings</p>
                    <div class="text-muted text-sm">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-lg-8">
                    <p><b>Full Name:</b> ${resp.user.first_name}&nbsp;${resp.user.last_name}</p>
                    <p><b>Member Since:</b> ${moment(resp.user.created_at,"YYYYMMDD").fromNow()}</p>
                    <p><b>Jobs Awarded:</b> ${resp.all_jobs}</p>
                    <p><b>Jobs Delivered:</b> ${resp.jobs_delivered}</p>
                </div>
                <div class="row text-center">
                    <a href="${resp.url}" target="_blank"><button class="btn btn-info">View Portfolio</button></a>
                </div>
                </div>`);
            });
        }
        function loadCreatives() {
            $("#partner-carousel").html('<p>... <i class="fa fa-spinner"></i></p>');
            $.get("/guser/loadcreatives/", function(data, status) {
                $("#partner-carousel").html(data);
            });
        }
        //setTimeout(loadCreatives,3000);
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
        $(document).ready(function() {
            $('#partner-carousel').owlCarousel({
                margin: 10,
                autoplay: false,
                smartSpeed: 800,
                itemsScaleUp: false,
                nav: false,
                dots: false,
                loop: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 5
                    },
                    768: {
                        items: 7
                    },
                    1000: {
                        items: 12
                    }
                }
            });
        });
        
</script>
@endpush