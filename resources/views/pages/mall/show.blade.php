@extends('pages.app')
<link rel="stylesheet" href="{{ asset('/css/mall-navigation.css') }}">
@push('scripts')
<script>
    document.title = "{{$product->name}}";
</script>
@endpush
@section('content')
{{-- @include('pages.partials.sidebar') --}}

<div class="p-2 p-lg-5 my-5 pb-5">
    <div class="row g-2 mb-5" style="width: 100%; margin:auto">
        <div class="col-md-8">
            <div class="row pr-4">
                <div class="col-md-6">
                    <h5 class="mb-4" style="color: rgba(111, 60, 150, 1); font-size: 27px;
                    ">The Mall at vicomma / {{ $product->category->name}}</h5>
                    <div class="carousel_container">
                        <div class="thumb">
                            @if (count($images) > 0)
                            @foreach ($images as $image)
                            <div class="img_area" data-index=1>
                                <img alt=""
                                    src="{{'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image}}">
                            </div>
                            @endforeach
                            @else
                            <div class="img_area" data-index=1>
                                <img alt="" src="/img/product3.png">
                            </div>
                            @endif
                        </div>
                        <div class="carousel_wrapper">
                            <div class="owl-carousel owl-theme product-carousel">
                                @if (count($images) > 0)
                                @foreach ($images as $image)
                                <div class="item">
                                    <div class="img_area">
                                        <img alt="" class="mIGMPro"
                                            src="{{'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image}}">
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="item">
                                    <div class="img_area" data-index=1>
                                        <img alt="" src="/img/product3.png">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{-- <a href="{{ route('mall.vendor', $product->vendor->vendor_station) }}"
                    class="text-uppercase text-snd font-weight-normal mb-3">
                    <i class="fas fa-store-alt mr-1"></i>
                    {{ $product->vendor->vendor_station }}
                    </a> --}}
                    <div class="ta-rate mt-5">
                        <span class="tag text-uppercase ">{{ $product->category->name }}</span>
                        <div class="rating_area">
                            <ul class="rating">
                                <li class="active"><i class="fas fa-star"></i></li>
                                <li class="active"><i class="fas fa-star"></i></li>
                                <li class="active"><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                            <span class="rating-txt">(Reviews 9)</span>
                        </div>
                    </div>
                    <h4 class="product_name" style="color: rgba(0, 0, 0, 1);font-weight: 600;">{{ $product->name }}</h4>

                    <div class="price_area mb-3 mt-3">
                        {{-- <del class="price">$45.00</del> --}}
                        <span class="price" style="color: rgba(111, 60, 150, 1);font-weight: 500;
                        ">${{$product->price}}.00</span>
                    </div>

                    <div class="color_area">
                        <p class="st">COLORS:</p>
                        @if ($colors)
                        @foreach ($colors as $color)
                        <label class="color_radio">
                            <input type="radio" name="color">
                            <span class="checkmark" style="background-color: {{ $color }};"></span>
                        </label>
                        @endforeach
                        @else
                        <small class="text-secondary">No Colours were added</small>
                        @endif
                    </div>

                    <div class="size_area">
                        <p class="st">SIZE:</p>
                        <label class="size_radio">
                            <input type="checkbox" checked="checked" name="radio">
                            <span class="checkmark">XXS</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">XS</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">S</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">M</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">L</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">XL</span>
                        </label>
                        <label class="size_radio">
                            <input type="checkbox" name="radio">
                            <span class="checkmark">XXL</span>
                        </label>
                    </div>


                    <div class="add_cart_area d-flex">
                        <div class='cart_counter' style="border-radius: 25px;">
                            <button class='down_count btn' title='Down'><i class="fas fa-minus"></i></button>
                            <input class='counter bg-transparent' type="text" placeholder="value..." value='1' />
                            <button class='up_count btn' title='Up'><i class="fas fa-plus"></i></button>
                        </div>
                        <button class="btn btn-secondary btn-sm cart cart-btn" id="{{$product->id}}"
                            style="border-radius: 25px;background: rgba(148, 202, 82, 1);box-shadow: 0px 6px 9px 0px rgba(148, 202, 82, 0.467);border: none;">

                            Add to cart
                        </button>
                        {{-- <button class="btn btn-gray rounded-btn btn-lg mt-4 wishlist">Wishlist
                                <i class="far fa-heart"></i>
                            </button> --}}
                    </div>
                    <div class="share_area mt-4">
                        Share:
                        <ul class="share_icon ml-2">
                            <li><a href="#."><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="#."><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href="#."><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#."><i class="fab fa-tiktok"></i></a></li>
                        </ul>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="product_details_tab sectionPT">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Review</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Size Guid</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                {!!$product->description!!}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Size Guid
                            </div>
                            <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-12">
                                        <label>Review</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="col">
                                        <span>Your rating</span>
                                        <div id="rateYo" style="display: inline-block;"></div>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4">Send</button>
                                {{-- <div style="display: flex; justify-content: space-between; flex-direction: row;
                                                        align-items: center;">
                                    </div> --}}

                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="aUTHDivDer mt-5">
                                <div>
                                    <h6 class="text-uppercase pl-2 pr-2 mt-1">Reviews</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="comment_lsit reviewList">
                            <li class="shadow">
                                <div class="img_area">
                                    <img alt="" src="{{ asset('/img/author/2.png') }}">
                                </div>
                                <div class="comment_info">
                                    <ul class="rating">
                                        <li class="active"><i class="fas fa-star"></i></li>
                                        <li class="active"><i class="fas fa-star"></i></li>
                                        <li class="active"><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <br>
                                    <small class="date">Sara Smith</small>
                                    <p class="comment_text">tempor incididunt ut labore et dolore magna
                                        aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="product--video__container">
                <div>
                    @if ($video)
                    {{-- <video class="rounded shadow" controls width="450" controlsList="nodownload" id="videoElement">
                                <source src="{{ $video }}" type="video/mp4">
                    </video> --}}
                    <div class="row mb-5">
                        <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                            <video playsinline controls autoplay controlsList="nodownload" muted
                                id="vid{{ $video->id }}" class="embed-responsive-item gVideo theVideo{{ $video->id }}"
                                poster="{{$video->video_thumb ?? '' }}">
                                <source src='{{ $video->file }}'>
                            </video>
                            {{-- <div class="overlay" onclick="loadVideo('{{ $video->id }}')">
                            <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                        </div> --}}
                    </div>
                    <div class="row vid-detail pt-2 px-2">
                        <div class="col-10 video-name">{{ ucfirst($video->name) }}</div>
                        <div class="col-2 text-right" style="color:#BDBDBD; font-size: 15px;">
                            <div class="btn-group dropleft">
                                <span style="width: 10px; cursor:pointer;" class="dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/3_dots.svg') }}" class="icon " height="15">
                                </span>
                                <div class="dropdown-menu g-menu">
                                    <a class="dropdown-item" href="/video/{{$video->id}}">
                                        <span class="guser-menu-icon"><i class="fa fa-external-link"
                                                aria-hidden="true"></i> </span>
                                        Open
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <span class="guser-menu-icon"><i class="fa fa-clone"
                                                aria-hidden="true"></i></span>
                                        Copy Link
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <span class="guser-menu-icon"><i class="fa fa-download"
                                                aria-hidden="true"></i></span>
                                        Download
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <span class="guser-menu-icon"><i class="fa fa-share"
                                                aria-hidden="true"></i></span>
                                        Share
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{route('mall.vendor', Str::slug($video->job->vendor->vendor_station))}}">
                                        <span class="guser-menu-icon"><i class="fas fa-store"></i></span>
                                        Visit Store
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <span class="guser-menu-icon"><i class="fa fa-ban"
                                                aria-hidden="true"></i></span>
                                        Block Store
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-2 pt-1" style="font-size: 13px; color:#BDBDBD;">
                        <img src="{{ asset('images/visibility.svg') }}" class="icon" height="15">
                        <span class="pr-3">
                            {{ $video->view_count }} Views
                        </span>
                        <img src="{{ asset('images/comment.svg') }}" class="icon" height="15">
                        <span>
                            {{ count($video->comments) }} Comments
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="right_sidebar p-3" style="height: 760px;background: rgba(239, 239, 239, 1);border-radius: 25px;">
            <p class="title">Suggested</p>
            @php
            $limited_trending_videos = $trending_videos->take(4);
            @endphp

            @if (count($limited_trending_videos) > 0)
            @foreach ($limited_trending_videos as $vid)
            <div class="single_video">

                <div class="embed-responsive embed-responsive-16by9 shadow other-vid mb-3" style="max-height: 120px;">
                    <video playsinline muted id="vid{{ $vid->id }}"
                        class="embed-responsive-item gVideo theVideo{{ $vid->id }}"
                        poster="{{$vid->video_thumb ?? '' }}" style="object-fit: none;">
                        {{-- <data-src src="{{ $vid->file }}" type="video/mp4"></data-src> --}}
                    </video>
                    <div class="overlay text-center" onclick="loadVideo('{{ $vid->id }}')">
                        <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                    </div>
                </div>
                <div class="row vid-detail mb-3">
                    <div class="w-100 video-name">{{ ucfirst($vid->name) }}</div>
                </div>

            </div>

            @endforeach
            @endif
        </div>
    </div>
</div>
</div>
@include('pages.partials.trendingVideos')
@include('pages.partials.footer')
@push('scripts')
<script>
    jQuery('document').ready(function() {
                jQuery("#rateYo").rateYo({
                    rating: 3.6,
                    starWidth: "15px"
                });
                jQuery('.thumb').on('click', '.img_area', function(e) {
                    var img = e.target.src;
                    jQuery('.mIGMPro').attr('src', img);
                })
            })
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
        const addToCartBtns = document.querySelectorAll(".cart-btn");
            const guestCart = [];
            const handleAddToCart = (product) => {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];

                // Check if the product already exists in the cart
                let productIndex = cart.findIndex(item => item.id === product.id);

                if (productIndex !== -1) {
                    // If the product exists, update its quantity
                    cart[productIndex].qty += product.qty;
                } else {
                    // If the product does not exist, add it to the cart
                    cart.push(product);
                }

                // Save the updated cart back to localStorage and sessionStorage
                localStorage.setItem("cart", JSON.stringify(cart));
                sessionStorage.setItem("cart", JSON.stringify(cart));    
                //if the product is already in the cart, update the quantity
                const {
                    id
                } = product;
                if (!sessionStorage.getItem("cartIdStore")) {
                    sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
                    sessionStorage.setItem("cart", JSON.stringify(cart));
                    localStorage.setItem("cart", JSON.stringify(cart));
                  
                 
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