@include("pages.ecom.headerstore")
<main class="main mb-10 pb-1">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav container">
                <ul class="breadcrumb bb-no">
                    <li><a href="demo1.html">Home</a></li>
                    <li>Product</li>
                </ul>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="main-content">
                            <div class="product product-single row">
                                <div class="col-md-6 mb-6">
                                    <div class="product-gallery product-gallery-sticky">
                                        <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                            <div class="swiper-wrapper row cols-1 gutter-no">
                                            @if (count($images) > 0)
                                                @foreach($images as $image)
                                                <div class="swiper-slide">
                                                    <figure class="product-image">
                                                        <img style="object-fit: scale-down; background: #f5f5f5!important;" src="{{'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image}}"
                                                            data-zoom-image="{{'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image}}"
                                                            alt="{{$product->name}}" width="800" height="900">
                                                    </figure>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="swiper-slide">
                                                    <figure class="product-image">
                                                        <img style="object-fit: scale-down; background: #f5f5f5;" src="/img/empty.png"
                                                            data-zoom-image="/img/empty.png"
                                                            alt="{{$product->name}}" width="800" height="900">
                                                    </figure>
                                                </div>
                                            @endif
                                            </div>
                                            <button class="swiper-button-next"></button>
                                            <button class="swiper-button-prev"></button>
                                          
                                        </div>
                                        @if (count($images) > 0)
                                        <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                            <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                            @foreach($images as $image)
                                                <div class="product-thumb swiper-slide">
                                                    <img style="object-fit: contain;" src="{{'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image}}"
                                                        alt="Product Thumb" width="800" height="900">
                                                </div>
                                            @endforeach
                                            </div>
                                            <button class="swiper-button-next"></button>
                                            <button class="swiper-button-prev"></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 mb-md-6">
                                    <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                        <h1 class="product-title product-" id="{{$product->id}}">{{$product->name}}</h1>
                                        <div class="product-bm-wrapper">
                                            <div class="product-meta">
                                                <div class="product-categories">
                                                    Category:
                                                    <span class="product-category"><a href="#">{{$product->category->name}}</a></span>
                                                </div>
                                                <!-- <div class="product-sku">
                                                    SKU: <span>MS46891340</span>
                                                </div> -->
                                            </div>
                                        </div>

                                        <hr class="product-divider">
                                        <!-- <img src="/ecom/assets/market.svg" class="mb-3" style="height: 200px;"/> -->
                                        <div class="col-md-12">
                                <div class="product--video__container">
                                                <div>
                                                    @if ($video)
                                                    <div id="player" class="mb-2"></div>
                                                    <div class="pt-2 mb-3" style="font-size: 13px; color:#BDBDBD;">
                                                                <img src="{{ asset('images/visibility.svg') }}"  style="height: 15px;" class="icon" height="15">
                                                                <span class="pr-3">
                                                                    {{ $video->view_count }} Views
                                                                </span>
                                                                <img src="{{ asset('images/comment.svg') }}" class="icon"  style="height: 15px;" height="15">
                                                                <span>
                                                                    {{ count($video->comments) }} Comments
                                                                </span>
                                                                <a href="/"><i class="icon w-icon-youtube ml-2"  style="font-size: 15px;" height="15"></i></a>
                                                                <span>
                                                                    Video Page
                                                                </span>
                                                            </div>
                                                        {{-- <video class="rounded shadow" controls width="450" controlsList="nodownload" id="videoElement">
                                                            <source src="{{ $video }}" type="video/mp4">
                                                        </video> --}}
                                                        <div class="d-none row mb-5">
                                                            <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                                                                <video style="height: 254px; width: 100%;" playsinline controls autoplay controlsList="nodownload" muted id="vid{{ $video->id }}"
                                                                    class="embed-responsive-item gVideo theVideo{{ $video->id }}" poster="{{$video->video_thumb ?? '' }}">
                                                                    <source src='{{ $video->file }}'>
                                                                </video>
                                                                {{-- <div class="overlay" onclick="loadVideo('{{ $video->id }}')">
                                                                    <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                                                                </div> --}}
                                                            </div>
                                                            <div class="row vid-detail pt-2 px-2">
                                                                <div class="col-10 video-name">{{ ucfirst($video->name) }}</div>
                                                                <div class="col-2 text-right" style="color:#BDBDBD; font-size: 15px;">
                                                                    <!-- <div class="btn-group dropleft">
                                                                        <span style="width: 10px; cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                            <img src="{{ asset('images/3_dots.svg') }}" class="icon " height="15" style="height: 15px;">
                                                                        </span>
                                                                        <div class="dropdown-menu g-menu">
                                                                            <a class="dropdown-item" href="/video/{{$video->id}}">
                                                                                <span class="guser-menu-icon"><i class="fa fa-external-link" aria-hidden="true"></i> </span>
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
                                                                            <a class="dropdown-item" href="{{route('mall.vendor', Str::slug($video->job->vendor->vendor_station))}}">
                                                                                <span class="guser-menu-icon"><i class="fas fa-store"></i></span>
                                                                                Visit Store
                                                                            </a>
                                                                            <a class="dropdown-item" href="#">
                                                                                <span class="guser-menu-icon"><i class="fa fa-ban" aria-hidden="true"></i></span>
                                                                                Block Store
                                                                            </a>
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="pl-2 pt-1" style="font-size: 13px; color:#BDBDBD;">
                                                                <img src="{{ asset('images/visibility.svg') }}"  style="height: 15px;" class="icon" height="15">
                                                                <span class="pr-3">
                                                                    {{ $video->view_count }} Views
                                                                </span>
                                                                <img src="{{ asset('images/comment.svg') }}" class="icon"  style="height: 15px;" height="15">
                                                                <span>
                                                                    {{ count($video->comments) }} Comments
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                                        </div>
                                        <div class="product-price" id="sh{{$product->shipping}}">${{number_format($product->price)}}</div>

                                        <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: {{(number_format(DB::table('reviews')->where('product_id', $product->id)->avg('rating'))/5) * 100}}%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">({{DB::table("reviews")->where("product_id", $product->id)->count()}} Review{{DB::table("reviews")->where("product_id", $product->id)->count() > 1? "s" : ""}})</a>
                                                </div>

                                        <!-- <hr class="product-divider">
                                        @if($colors)
                                        <div class="product-form product-variation-form product-color-swatch">
                                            <label>Color:</label>
                                            <div class="d-flex align-items-center product-variations">
                                            @foreach($colors as $color)
                                                <a href="#" class="color" style="background-color: {{$color}}"></a>
                                            @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <div class="product-variation-price">
                                            <span></span>
                                        </div> -->

                                        <div class="fix-bottom product-sticky-content sticky-content">
                                            <div class="product-form container">
                                                <div class="product-qty-form d-none">
                                                    <div class="input-group">
                                                        <input class="quantity form-control" type="number" min="1"
                                                            max="10000000">
                                                        <button class="quantity-plus w-icon-plus"></button>
                                                        <button class="quantity-minus w-icon-minus"></button>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary w-50 btn-cart" style="width: 50%;" id="addcart">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#product-tab-description" class="nav-link active">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#product-tab-reviews" class="nav-link">Customer Reviews ({{DB::table("reviews")->where("product_id", $product->id)->count()}})</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active in" id="product-tab-description">
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-5">
                                                <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                                <p class="mb-4">{!! $product->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product-tab-vendor">
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-4">
                                                <figure class="vendor-banner br-sm">
                                                    <img src="{{$product->vendor->banner? $product->vendor->banner : '/img/vendorBG.jpg'}}" alt="Vendor Banner" width="610" height="295" style="background-color: #f5f5f5;">
                                                </figure>
                                            </div>
                                            <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                                <div class="vendor-user">
                                                    <div>
                                                        <div class="vendor-name"><a href="#">{{$product->vendor->user->first_name}}</a></div> {{$product->vendor->user->last_name}}
                                                    </div>
                                                </div>
                                                <ul class="vendor-info list-style-none">
                                                    <li class="store-name">
                                                        <label>Store Name:</label>
                                                        <span class="detail">{{$product->vendor->vendor_station}}</span>
                                                    </li>
                                                    <li class="store-address">
                                                        <label>Address:</label>
                                                        <span class="detail">{{$product->vendor->user->street_address}}</span>
                                                    </li>
                                                    <li class="store-phone">
                                                        <label>Phone:</label>
                                                        <a href="#tel:">{{$product->vendor->user->phone_number}}</a>
                                                    </li>
                                                </ul>
                                                <a href="/mall/{{Str::slug($product->vendor->vendor_station)}}" class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                                    Store<i class="w-icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                      </div>
                                    <div class="tab-pane" id="product-tab-reviews">
                                        <div class="row mb-4">
                                            <div class="col-xl-4 col-lg-5 mb-4">
                                                <div class="ratings-wrapper">
                                                    <div class="avg-rating-container">
                                                        <h4 class="avg-mark font-weight-bolder ls-50">{{number_format($rating, 1)}}</h4>
                                                        <div class="avg-rating">
                                                            <p class="text-dark mb-1">Average Rating</p>
                                                            <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: {{(number_format($rating)/5) * 100}}%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <a href="#" class="rating-reviews">({{DB::table("reviews")->where("product_id", $product->id)->count()}} Review{{DB::table("reviews")->where("product_id", $product->id)->count() != 1 ? "s" : ""}})</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="ratings-value d-flex align-items-center text-dark ls-25">
                                                        <span class="text-dark font-weight-bold">66.7%</span>Recommended<span class="count">(2 of 3)</span>
                                                    </div> -->
                                                    <div class="ratings-list">
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 100%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{DB::table('reviews')->where('product_id', $product->id)->count() > 0? (DB::table('reviews')->where('product_id', $product->id)->where('rating', 5)->count()/DB::table('reviews')->where('product_id', $product->id)->count()) * 100 : 0}}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{$five_perc}}%</mark>
                                                            </div>
                                                        </div>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 80%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{DB::table('reviews')->where('product_id', $product->id)->count() > 0? (DB::table('reviews')->where('product_id', $product->id)->where('rating', 4)->count()/DB::table('reviews')->where('product_id', $product->id)->count()) * 100 : 0}}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{$four_perc}}%</mark>
                                                            </div>
                                                        </div>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{DB::table('reviews')->where('product_id', $product->id)->count() > 0? (DB::table('reviews')->where('product_id', $product->id)->where('rating', 3)->count()/DB::table('reviews')->where('product_id', $product->id)->count()) * 100 : 0}}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{$three_perc}}%</mark>
                                                            </div>
                                                        </div>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 40%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{DB::table('reviews')->where('product_id', $product->id)->count() > 0? (DB::table('reviews')->where('product_id', $product->id)->where('rating', 2)->count()/DB::table('reviews')->where('product_id', $product->id)->count()) * 100 : 0}}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{$two_perc}}%</mark>
                                                            </div>
                                                        </div>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 20%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{DB::table('reviews')->where('product_id', $product->id)->count() > 0? (DB::table('reviews')->where('product_id', $product->id)->where('rating', 1)->count()/DB::table('reviews')->where('product_id', $product->id)->count()) * 100 : 0}}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{$one_perc}}%</mark>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(auth()->user() && auth()->user()->email_verified_at)
                                            @if(!$commented)
                                            <div class="col-xl-8 col-lg-7 mb-4">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Your email address will not be published. Required
                                                        fields are marked *</p>
                                                    <form class="review-form" id="form2">
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                            <!-- <span class="rating-stars">
                                                                <a class="star-1" href="#">1</a>
                                                                <a class="star-2" href="#">2</a>
                                                                <a class="star-3" href="#">3</a>
                                                                <a class="star-4" href="#">4</a>
                                                                <a class="star-5" href="#">5</a>
                                                            </span> -->
                                                            <select name="rating" class="form-control" id="rating" required>
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>
                                                        <textarea cols="30" rows="6" placeholder="Write Your Review Here..." class="form-control" id="review"></textarea>
                                                        <div class="row gutter-md">
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" placeholder="Your Name" id="author" value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" placeholder="Your Email" value="{{auth()->user()->email}}" id="email_1" readonly>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <input type="checkbox" class="custom-checkbox" id="save-checkbox">
                                                            <label for="save-checkbox">Save my name, email, and website
                                                                in this browser for the next time I comment.</label>
                                                        </div> -->
                                                        <div class="alert alert-icon alert-error alert-bg alert-inline show-code-actiona mb-3" id="alert2" style="display: none;"></div>
                                                        <button type="submit" id="button2" class="btn btn-dark">Submit
                                                            Review</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                        </div>

                                        <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                            <!-- <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a href="#show-all" class="nav-link active">Show All</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#helpful-positive" class="nav-link">Most Helpful
                                                        Positive</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#helpful-negative" class="nav-link">Most Helpful
                                                        Negative</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                                </li>
                                            </ul> -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="show-all">
                                                    <ul class="comments list-style-none">
                                                        @foreach($reviews as $review)
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <figure class="comment-avatar">
                                                                    <img src="{{$review->image}}" alt="User" width="90" height="90">
                                                                </figure>
                                                                <div class="comment-content">
                                                                    <h4 class="comment-author">
                                                                        <a href="#">{{$review->first_name}} {{$review->last_name}}</a>
                                                                        <span class="comment-date">{{\Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</span>
                                                                    </h4>
                                                                    <div class="ratings-container comment-rating">
                                                                        <div class="ratings-full">
                                                                            <span class="ratings" style="width: {{(number_format($review->rating)/5) * 100}}%;"></span>
                                                                            <span class="tooltiptext tooltip-top"></span>
                                                                        </div>
                                                                    </div>
                                                                    <p>{{$review->review}}</p>
                                                                  
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    {{$reviews->links()}}
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(count($products) > 1)
                            <section class="vendor-product-section">
                                <div class="title-link-wrapper mb-4">
                                    <h4 class="title text-left">More Products From This Vendor</h4>
                                    <a href="product-default.html#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                        Products<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <div class="swiper-container swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 3
                                        },
                                        '768': {
                                            'slidesPerView': 4
                                        },
                                        '992': {
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                    @foreach($products as $product)   
                                    <div class="swiper-slide product">
                                            <figure class="product-media">
                                                <a href="/mall/products/{{$product->id}}">
                                                    <img style="object-fit: scale-down;background: #f5f5f5; height: 300px;" src="{{$product->image && gettype(json_decode($product->image)) == 'array' && count(json_decode($product->image)) > 0 && json_decode($product->image)[0]? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.json_decode($product->image)[0] : '/img/empty.png'}}" alt="Product"
                                                        width="300" height="338" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                </div>
                                                <div class="product-action">
                                                    <a href="/mall/products/{{$product->id}}" class="btn-product" title="Quick View">
                                                        View</a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <div class="product-cat"><a href="#">{{$product->category->name}}</a>
                                                </div>
                                                <h4 class="product-title" id="{{$product->id}}"><a href="/mall/products/{{$product->id}}">{{$product->name}}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: {{(number_format(DB::table('reviews')->where('product_id', $product->id)->avg('rating'))/5) * 100}}%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">({{DB::table("reviews")->where("product_id", $product->id)->count()}} Review{{DB::table("reviews")->where("product_id", $product->id)->count() != 1? "s" : ""}}</a>
                                                </div>
                                                <div class="product-pa-wrapper">
                                                    <div class="product-price" id="sh{{$product->shipping}}">${{$product->price}}</div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    </div>
                                </div>
                            </section>
                            @endif
                        </div>
                        <!-- End of Main Content -->
                        <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="product-default.html#"><i class="close-icon"></i></a>
                            <a href="product-default.html#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                            <div class="sidebar-content scrollable">
                                <div class="sticky-sidebar">
                        
                                    <div class="widget widget-icon-box mb-6">
                                    <div class="icon-box icon-box-side text-dark">
                                        <span class="icon-box-icon icon-shipping">
                                            <i class="w-icon-money"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title ls-normal">Secure Payments</h4>
                                            <p class="text-default">We ensure secure payments</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side text-dark">
                                        <span class="icon-box-icon icon-payment">
                                            <i class="w-icon-user"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title ls-normal">Vetted Vendors</h4>
                                            <p class="text-default">Vendors are legitimate</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side text-dark">
                                        <span class="icon-box-icon icon-money">
                                            <i class="w-icon-gift"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title ls-normal">Huge Selections</h4>
                                            <p class="text-default">Items from A-Z</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side text-dark">
                                        <span class="icon-box-icon icon-chat">
                                            <i class="w-icon-vendor-store" style="font-size: 3.4rem;"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title ls-normal">Latest Products</h4>
                                            <p class="text-default">Some of the hottest trends</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="widget widget-products">
    <div class="title-link-wrapper mb-2">
        <h4 class="title title-link font-weight-bold">Latests Products</h4>
    </div>

    <div class="swiper nav-top">
        <div class="swiper-container swiper-theme nav-top swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" data-swiper-options="{
                                                'slidesPerView': 1,
                                                'spaceBetween': 20,
                                                'navigation': {
                                                    'prevEl': '.swiper-button-prev',
                                                    'nextEl': '.swiper-button-next'
                                                }
                                            }">
            <div class="swiper-wrapper" id="swiper-wrapper-35c9593bed4b87a2" aria-live="polite" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                <div class="widget-col swiper-slide swiper-slide-active" style="width: 270px; margin-right: 20px;" role="group" aria-label="1 / 2">
                @foreach(DB::table("products")->where("id", "!=", $pid)->limit(3)->skip(3)->orderBy("id", "DESC")->get() as $latest)    
                <div class="product product-widget">
                        <figure class="product-media">
                        <a href="/mall/products/{{$latest->id}}">
                                                <img style="object-fit: cover;background: #f5f5f5;" src="{{$latest->image && gettype(json_decode($latest->image)) == 'array' && count(json_decode($latest->image)) > 0 && json_decode($latest->image)[0]? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.json_decode($latest->image)[0] : '/img/empty.png'}}" alt="Product" width="100" height="113">
                                                                </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name">
                                <a href="/mall/products/{{$latest->id}}">{{$latest->name}}</a>
                            </h4>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: {{(number_format(DB::table('reviews')->where('product_id', $latest->id)->avg('rating'))/5) * 100}}%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="product-price"> ${{$latest->price}}</div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="widget-col swiper-slide swiper-slide-next" style="width: 270px; margin-right: 20px;" role="group" aria-label="2 / 2">
                @foreach(DB::table("products")->where("id", "!=", $pid)->limit(3)->orderBy("id", "DESC")->get() as $latest)    
                <div class="product product-widget">
                        <figure class="product-media">
                        <a href="/mall/products/{{$product->id}}">
                                                <img style="object-fit: cover;background: #f5f5f5;" src="{{$latest->image && gettype(json_decode($latest->image)) == 'array' && count(json_decode($latest->image)) > 0 && json_decode($latest->image)[0]? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.json_decode($latest->image)[0] : '/img/empty.png'}}" alt="Product" width="100" height="113">
                                                                </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name">
                                <a href="/mall/products/{{$latest->id}}">{{$latest->name}}</a>
                            </h4>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: {{(number_format(DB::table('reviews')->where('product_id', $latest->id)->avg('rating'))/5) * 100}}%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="product-price"> ${{$latest->price}}</div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <button class="swiper-button-next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-35c9593bed4b87a2" aria-disabled="false"></button>
            <button class="swiper-button-prev swiper-button-disabled" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-35c9593bed4b87a2" aria-disabled="true" disabled=""></button>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
</div>
                                    <!-- End of Widget Icon Box -->

                                </div>
          
                        </aside>
                        <!-- End of Sidebar -->
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
@include("pages.ecom.footer")
<script src="/ecom/assets/playerjs.js" type="text/javascript"></script>

<script>
    $( document ).ready(function() {
    var maincart = JSON.parse(localStorage.getItem("cart"));
    console.log(maincart, "{{$product->id}}")
    if(maincart && Array.isArray(maincart)){
    var t="";
    var total = 0;
    if(maincart.length < 1){
        return $( "#addcart" ).attr( "disabled", false );
    }else {
        if(!maincart.find(elem => elem.id == "{{$product->id}}")){
            return $( "#addcart" ).attr( "disabled", true );
        }else {
            return $( "#addcart" ).attr( "disabled", false );
        }
    }

    }
    // else {
    //     return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    // }
});
$('#form2').submit( function (event) {
        // prevent the usual form submission behaviour; the "action" attribute of the form
        event.preventDefault();
        // validation goes below...
    const review  = $("#review").val()
            // now for the big event
            $.ajax({
          // the server script you want to send your data to
            'url': '/review',
            // all of your POST/GET variables
            'data': {
                // 'dataname': $('input').val(), ...
                review: review,
                product: "{{$pid}}",
                rating: $('#rating option:selected').val(),
                "_token":"{{ csrf_token() }}"
            },
            // you may change this to GET, if you like...
            'type': 'post',
         
            'beforeSend': function () {
                // anything you want to have happen before sending the data to the server...
                // useful for "loading" animations
                $("button").attr("disabled",true)
    $("#button2").html(`Loading...`)
    $('#alert2').hide()
            }
        })
        .done( function (response) {
            $("#alert2").removeClass("alert-error")
            $("#alert2").addClass("alert-success")
            $('#alert2').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
            // UIkit.notification(`<span uk-icon='icon: check' style="color: green"></span> ${response.message}`);
            location.reload()
        })
        .fail( function (code, status) {
            $("#alert2").removeClass("alert-success")
                    $("#alert2").addClass("alert-error")
            $('#alert2').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)
            // UIkit.notification(`<span uk-icon='icon: alert-circle' style="color: red"></span> ${code.responseJSON.message}`);
            // $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)

         
        })
        .always( function (xhr, status) {
            // what you want to have happen no matter if the response is success or error
            // here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
    $('#alert2').show()
    $("#button2").attr("disabled",false)
    $("#button2").html(`Review`)
        });
    });
</script>
@if ($video)
<script>
   var player = new Playerjs({id:"player", file:"{{$video->file}}", "title": "{{ ucfirst($video->name) }}", poster: "{{$video->video_thumb? $video->video_thumb : ""}}", autoplay:0});
</script>
@endif