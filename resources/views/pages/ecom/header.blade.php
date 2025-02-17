<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <title>{{env('APP_NAME')}}</title>
        <link rel="icon" href="{{asset('/images/favicon2.ico')}}" type="image/x-icon">

        <!-- <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES"> -->

        <!-- Favicon -->
        <!-- <link rel="icon" type="image/png" href="/ecom/assets/images/icons/favicon.png"> -->

        <!-- WebFont.js -->
        <script>
            WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="preload" href="/ecom/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="/ecom/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="/ecom/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="/ecom/assets/fonts/wolmart.woff%3Fpng09e" as="font" type="font/woff"
            crossorigin="anonymous">

        <!-- Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="/ecom/assets/vendor/fontawesome-free/css/all.min.css">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="/ecom/assets/vendor/swiper/swiper-bundle.min.css">
        <link rel="stylesheet" type="text/css" href="/ecom/assets/vendor/animate/animate.min.css">
        <link rel="stylesheet" type="text/css" href="/ecom/assets/vendor/magnific-popup/magnific-popup.min.css">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="/ecom/assets/css/demo10.min.css">
        <style>
            .footer {
                content: "";
                background-image: url(../img/footerbg.png);
                background-color: #000;
                /* width: 100%;
        height: 100%;
        position: absolute;
        background-size: contain;
        background-position-x: center;
        top: 0;
        background-repeat-x: repeat;
        background-repeat-y: no-repeat; */
                left: 0;
            }

            .footer a {
                color: #fff;
            }

        </style>
    </head>

    <body class="home" style="zoom: 90%;">
        <div class="page-wrapper">
            <h1 class="d-none"></h1>
            <header class="header has-center">
                <div class="d-none header-top">
                    <div class="container">
                        <div class="header-left">
                            <p class="welcome-msg">Welcome to Vicomma Store message or remove it!</p>
                        </div>
                        <div class="header-right">
                            <div class="dropdown">
                                <a href="demo10.html#currency">USD</a>
                                <div class="dropdown-box">
                                    <a href="demo10.html#USD">USD</a>
                                    <a href="demo10.html#EUR">EUR</a>
                                </div>
                            </div>
                            <!-- End of DropDown Menu -->

                            <div class="dropdown">
                                <a href="demo10.html#language"><img src="/ecom/assets/images/flags/eng.png"
                                        alt="ENG Flag" width="14" height="8" class="dropdown-image" /> ENG</a>
                                <div class="dropdown-box">
                                    <a href="demo10.html#ENG">
                                        <img src="/ecom/assets/images/flags/eng.png" alt="ENG Flag" width="14"
                                            height="8" class="dropdown-image" />
                                        ENG
                                    </a>
                                    <a href="demo10.html#FRA">
                                        <img src="/ecom/assets/images/flags/fra.png" alt="FRA Flag" width="14"
                                            height="8" class="dropdown-image" />
                                        FRA
                                    </a>
                                </div>
                            </div>
                            <!-- End of Dropdown Menu -->
                            <span class="divider d-lg-show"></span>
                            <a href="blog.html" class="d-lg-show">Blog</a>
                            <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                            <a href="my-account.html" class="d-lg-show">My Account</a>
                            <a href="/ecom/assets/ajax/login.html" class="d-lg-show login sign-in"><i
                                    class="w-icon-account"></i>Sign In</a>
                            <span class="delimiter d-lg-show">/</span>
                            <a href="/ecom/assets/ajax/login.html" class="ml-0 d-lg-show login register">Register</a>
                        </div>
                    </div>
                </div>
                <!-- End of Header Top -->

                <div class="header-middle">
                    <div class="container">
                        <div class="header-left mr-md-4">
                            <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                            </a>
                            <form method="get" action="/mall/products"
                                class="header-search hs-rounded d-none d-md-flex ml-4 ml-lg-0 input-wrapper">
                                <input type="text" class="form-control" required name="search" id="search"
                                    placeholder="Search..." required />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End of Header Left -->

                        <div class="header-center">
                            <a href="demo10.html" class="logo ml-lg-0">
                                <img src="/img/logo-text.png" alt="logo" width="145" height="45" />
                            </a>
                        </div>
                        <!-- End of Header Center -->

                        <div class="header-right">
                            <!-- <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:#" class="w-icon-call"></a>
                            <div class="call-info d-lg-show">
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                    <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>
                                <a href="tel:#" class="phone-number font-weight-bolder ls-50">0(800)123-456</a>
                            </div>
                        </div> -->
                            <!-- <a class="wishlist label-down link d-none d-md-flex" href="wishlist.html">
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a> -->
                            <!-- <a class="compare label-down link d-none d-md-flex" href="compare.html">
                            <i class="w-icon-compare"></i>
                            <span class="compare-label d-lg-show">Compare</span>
                        </a> -->
                            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                                <div class="cart-overlay"></div>
                                <a href="/mall/cart" class="cart-toggle label-down link">
                                    <i class="w-icon-cart">
                                        <span class="cart-count">0</span>
                                    </i>
                                    <span class="cart-label">Cart</span>
                                </a>
                                <!-- End of Dropdown Box -->
                            </div>
                        </div>
                        <!-- End of Header Right -->
                    </div>
                </div>
                <!-- End of Header Middle -->

                <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
                    <div class="container">
                        <div class="inner-wrap">
                            @if(DB::table("categories")->count() > 0)
                            <div class="header-left">
                                <div class="dropdown category-dropdown" data-visible="true">
                                    <a href="#" class="category-toggle text-white" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true" data-display="static"
                                        title="Browse Categories">
                                        <i class="w-icon-category"></i>
                                        <span>Browse Categories</span>
                                    </a>

                                    <div class="dropdown-box text-default">
                                        <ul class="menu vertical-menu category-menu">
                                            @foreach(DB::table("categories")->orderBy("name", "ASC")->limit(15)->get()
                                            as $cat)
                                            <li>
                                                <a href="/mall/products?cat={{$cat->id}}">
                                                    <!-- <i class="w-icon-ruby"></i> -->
                                                    {{$cat->name}}
                                                </a>
                                            </li>
                                            @endforeach
                                            <li>
                                                <a href="">
                                                    <!-- <i class="w-icon-ruby"></i> -->
                                                    View All Categories<i class="w-icon-angle-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <nav class="main-nav ml-4">
                                    <ul class="menu">
                                        <li class="">
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="">
                                            <a href="/mall">Mall</a>
                                        </li>
                                        <li class="">
                                            <a href="/mall/products">Products</a>
                                        </li>
                                        <li class="">
                                            <a href="/mall">For The Creators</a>
                                        </li>
                                        <li class="">
                                            <a href="/mall">How It Works</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right">
                                @if(!auth()->check())
                                <a href="/login" class="d-xl-show"><i class="w-icon-user mr-1"></i>Login</a>
                                <a href="/register"><i class="w-icon-account mr-1"></i>Register</a>
                                @else
                                <a href="/dashboard" class="d-xl-show"><i
                                        class="w-icon-dashboard mr-1"></i>Dashboard</a>
                                <a href="{{route('auth.logout')}}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                                        class="w-icon-logout mr-1"></i>Logout</a>
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End of Header -->