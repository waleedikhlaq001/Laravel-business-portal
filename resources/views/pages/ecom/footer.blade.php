<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="" class="logo-footer">
                            <img src="/img/logo-text.png" alt="logo-footer" width="144" height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title text-white">For users: Vicomma has combined the joy of watching
                                videos with the convenience of buying what you see in your favorites videos. Get the
                                latest products, merchandise, event tickets, specials and discounts, and more all in one
                                place.</p>
                            <!-- <a href="tel:18005707777" class="widget-about-call">1-800-570-7777</a> -->
                            <p class="widget-about-desc text-white">For vendors: Register a Vendor Station to develop a
                                direct
                            </p>

                            <div class="social-icons social-icons-colored">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title text-white">About</h3>
                        <ul class="widget-body text-white">
                            <li><a href="/about">About Vicomma</a></li>
                            <li><a href="/team">The Team</a></li>
                            <li><a href="/faq">Frequency Asked Questions</a></li>
                            <li><a href="/vendor-user-information">Vendor and User Information</a></li>
                            <li><a href="/message">Send us a Quick Message</a></li>
                            <li><a href="/advertise">Advertise with Us</a></li>
                            <!-- <li><a href="/advertise">Order History</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title text-white">Terms</h4>
                        <ul class="widget-body text-white">
                            <li><a href="/privacy">Privacy Policy</a></li>
                            <li><a href="{{route('public.acceptable_use')}}">Acceptable Use Policy</a></li>
                            <li><a href="/online-video-submission">Online Video Submission Agreement</a></li>
                            <li><a href="/terms">Terms and Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title text-white">Apps</h4>
                        <ul class="widget-body text-white">
                            <li><img src="https://www.f-cdn.com/assets/main/en/assets/footer/app-store.svg"
                                    class="app-icon"></li>
                            <li><img src="https://www.f-cdn.com/assets/main/en/assets/footer/google-play.svg"
                                    class="app-icon"></li>
                            <!-- <li><a href="/privacy">Privacy Policy</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright text-white">Copyright © {{date("Y")}} Vicomma. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8 text-white">We're using safe payment for</span>
                <figure class="payment">
                    <img src="/ecom/assets/images/payment.png" alt="payment" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Page-wrapper -->

<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="/" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="/mall" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Mall</p>
    </a>
    <a href="/dashboard" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Dashboard</p>
    </a>
    <div class="cart-dropdown">
        <a href="/mall/cart" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <!-- End of Dropdown Box -->
    </div>

    <div class="header-search hs-toggle dir-up">
        <a href="#" class="search-toggle sticky-link">
            <i class="w-icon-search"></i>
            <p>Search</p>
        </a>
        <form action="/mall/products" class="input-wrapper">
            <input type="text" class="form-control" required name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
    </div>
</div>
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
        version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
            r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg> </a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="/mall/products" method="get" class="input-wrapper">
            <input type="text" class="form-control" required name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/mall">Mall</a></li>
                    <li><a href="/mall/products">Home</a></li>
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    @foreach(DB::table("categories")->orderBy("name", "ASC")->limit(15)->get() as $cat)
                    <li>
                        <a href="/mall/products?cat={{$cat->id}}">
                            <!-- <i class="w-icon-ruby"></i> -->
                            {{$cat->name}}
                        </a>
                    </li>
                    @endforeach
                    <!-- <li>
                            <a href="shop-banner-sidebar.html"
                                class="font-weight-bold text-primary text-uppercase ls-25">
                                View All Categories<i class="w-icon-angle-right"></i>
                            </a>
                        </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Mobile Menu -->

<!-- Start of Newsletter popup -->
<div class="newsletter-popup mfp-hide">
    <div class="newsletter-content">
        <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span></h4>
        <h2 class="ls-25">Sign up to Wolmart</h2>
        <p class="text-light ls-10">Subscribe to the Wolmart market newsletter to
            receive updates on special offers.</p>
        <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
            <input type="email" class="form-control email font-size-md" name="email" id="email2"
                placeholder="Your email address" required="">
            <button class="btn btn-dark" type="submit">SUBMIT</button>
        </form>
        <div class="form-checkbox d-flex align-items-center">
            <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                required="">
            <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
        </div>
    </div>
</div>
<!-- End of Newsletter popup -->

<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky mb-0">
                <div class="product-single-swiper swiper-container swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="/ecom/assets/images/products/popup/1-440x494.jpg"
                                    data-zoom-image="/ecom/assets/images/products/popup/1-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="/ecom/assets/images/products/popup/2-440x494.jpg"
                                    data-zoom-image="/ecom/assets/images/products/popup/2-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="/ecom/assets/images/products/popup/3-440x494.jpg"
                                    data-zoom-image="/ecom/assets/images/products/popup/3-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="/ecom/assets/images/products/popup/4-440x494.jpg"
                                    data-zoom-image="/ecom/assets/images/products/popup/4-800x900.jpg"
                                    alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="product-thumbs-wrap swiper-container">
                    <div class="product-thumbs swiper-wrapper">
                        <div class="swiper-slide product-thumb">
                            <img src="/ecom/assets/images/products/popup/1-103x116.jpg" alt="Product Thumb" width="103"
                                height="116">
                        </div>
                        <div class="swiper-slide product-thumb">
                            <img src="/ecom/assets/images/products/popup/2-103x116.jpg" alt="Product Thumb" width="103"
                                height="116">
                        </div>
                        <div class="swiper-slide product-thumb">
                            <img src="/ecom/assets/images/products/popup/3-103x116.jpg" alt="Product Thumb" width="103"
                                height="116">
                        </div>
                        <div class="swiper-slide product-thumb">
                            <img src="/ecom/assets/images/products/popup/4-103x116.jpg" alt="Product Thumb" width="103"
                                height="116">
                        </div>
                    </div>
                    <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                    <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">Electronics Black Wrist Watch</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="/ecom/assets/images/products/brand/brand-1.jpg" alt="Brand" width="102" height="48" />
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category"><a href="#">Electronics</a></span>
                        </div>
                        <div class="product-sku">
                            SKU: <span>MS46891340</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">$40.00</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-form product-variation-form product-color-swatch">
                    <label>Color:</label>
                    <div class="d-flex align-items-center product-variations">
                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                        <a href="#" class="color" style="background-color: #ccc;"></a>
                        <a href="#" class="color" style="background-color: #333;"></a>
                    </div>
                </div>
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">Size:</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        <a href="#" class="size">Small</a>
                        <a href="#" class="size">Medium</a>
                        <a href="#" class="size">Large</a>
                        <a href="#" class="size">Extra Large</a>
                    </div>
                    <a href="#" class="product-variation-clean">Clean All</a>
                </div>

                <div class="product-variation-price">
                    <span></span>
                </div>

                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>

                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                        <a href="#" class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->

<!-- Plugin JS File -->
<script src="/ecom/assets/vendor/jquery/jquery.min.js"></script>
<script src="/ecom/assets/vendor/floating-parallax/parallax.min.js"></script>
<script src="/ecom/assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
<script src="/ecom/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/ecom/assets/vendor/isotope/isotope.pkgd.min.js"></script>
<script src="/ecom/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/ecom/assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
<script src="/ecom/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/ecom/assets/vendor/zoom/jquery.zoom.js"></script>

<!-- Main JS -->
<script>
    var maincart = JSON.parse(localStorage.getItem("cart"));
                            if(maincart && Array.isArray(maincart)){
                            $(".cart-count").text(maincart.length)
                            }
</script>
<script src="/ecom/assets/js/main.min.js"></script>
</body>