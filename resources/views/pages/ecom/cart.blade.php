@extends('pages.app')
@push('css')

<style type="text/css">
    .table-heading {
        background-color: #94CA52;
        /* Background color */
        color: white;
        /* Text color */
        padding: 10px;
        /* Padding inside the cell */
        border-radius: 10px;
        /* Rounded corners */
        text-align: left;
        height: 65px;
        /* Text alignment */
    }

    /* Additional styling for the table to remove default borders */
    table {
        border-collapse: separate;
        border-spacing: 0 10px;
        /* Space between table rows */
    }

    .table td,
    .table th {
        vertical-align: middle !important;
        border-top: 0px solid #dee2e6 !important;

    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 0px solid #dee2e6 !important;
        border-top: 0px solid #dee2e6 !important;
    }

    table thead tr th:first-child {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    table thead tr th:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .input-group {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity {
        text-align: center;
        width: 10px !important;
        height: 40px !important;
        border: none !important;
        background-color: transparent !important;
        ;
        /* border-bottom: 1px solid #ccc !important;
        border-top: 1px solid #ccc !important;
        background-color: transparent !important; */
    }

    .quantity-plus,
    .quantity-minus {
        width: 30px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .quantity-plus {
        border: none !important;
        background: transparent;
    }

    .quantity-minus {
        border: none !important;
        background: transparent;
    }

    .w-icon-plus::before,
    .w-icon-minus::before {
        content: "";
        display: block;
        width: 10px;
        height: 2px;
        background-color: #333;
    }

    .w-icon-plus::before {
        transform: rotate(90deg);
    }

    .w-icon-minus::before {
        transform: rotate(0deg);
    }

    .stepper-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }

    .stepper-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-counter {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
        background-color: #6F3C96;
        z-index: 2;
        color: white;
    }

    .stepper-item.completed .step-counter {
        background-color: #94CA52;
        color: white;
    }

    .progress-bar-line,
    .progress-bar-active {
        position: absolute;
        top: 20px;
        height: 5px;
        width: 88%;
        left: 40px;
        /* Adjusted for full width */
        z-index: 1;
    }

    .progress-bar-line {
        background-color: #94CA52;
    }

    .rounded-25 {
        border-radius: 25px !important;
    }

    .bg-color {
        background: rgba(148, 202, 82, 1) !important;
        border: 0px !important;
        color: #fff !important;
    }

    .btn-padding {
        padding: 0px 20px;
    }

    .cart-action {
        float: right;
    }

    @media (max-width: 991px) {

        .progress-bar-line,
        .progress-bar-active {
            position: absolute;
            top: 20px;
            height: 5px;
            width: 77%;
            left: 40px;
            /* Adjusted for full width */
            z-index: 1;
        }

        .input-group {
            width: 114px;
        }

        .cart-action {
            float: none !important;
        }

        .rounded-25 {
            border-radius: 25px !important;
            width: 100%;
            margin-top: 12px;
        }

        .btn-padding {
            padding: 0px 15px;
        }
    }

</style>
@endpush
<!-- Default CSS -->
<!-- <link rel="stylesheet" type="text/css" href="/ecom/assets/css/demo10.min.css"> -->
{{-- <link rel="stylesheet" type="text/css" href="/ecom/assets/css/style.min.css"> --}}
@section('content')
{{-- @include('includes.mall-navigation') --}}
<style>
    .shop-table .product-name {
        white-space: nowrap;
        word-break: break-word;
    }

    th {
        text-align: left;
    }

</style>
<main class="main cart">
    <!-- Start of Breadcrumb -->

    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="p-2 p-lg-5">
            <div class="row gutter-lg mb-10">
                <div class="col-lg-8 pr-lg-4 mb-6">
                    <div class="stepper-wrapper mb-5">
                        <div class="stepper-item completed" id="step1Indicator">
                            <div class="step-counter">1</div>
                            <div>Shopping Cart</div>
                        </div>
                        <div class="stepper-item" id="step2Indicator">
                            <div class="step-counter">2</div>
                            <div>Checkout </div>
                        </div>

                        <div class="stepper-item" id="step5Indicator">
                            <div class="step-counter">3</div>
                            <div>Order Complete</div>
                        </div>
                        <div class="progress-bar-line"></div>
                        <div class="progress-bar-active" style="width: 0%;" id="progressBar"></div>

                    </div>
                    <div style="box-shadow: 0px 11px 10px 0px rgba(0, 0, 0, 0.29) !important;
                    border-radius: 32px;
                    padding: 0px 20px 20px 20px;" class="table-responsive">
                        <table id="theads" class="table">
                            <thead class="table-heading">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="body">
                            </tbody>
                        </table>

                        <div id="empt"></div>
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-5">
                                <form class="coupon d-flex justify-content-between align-items m-0">
                                    <div>

                                        <input type="text" class="form-control rounded-25"
                                            placeholder="Enter coupon code here..." required />
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-dark rounded-25 btn-outline btn-rounded btn-padding bg-color">Apply
                                            Coupon</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="cart-action">
                                    {{-- <a href="/mall/products"
                                        class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                            class="w-icon-long-arrow-left"></i>Continue Shopping</a> --}}
                                    <button onclick="cleardata()" type="button"
                                        class="btn btn-rounded btn-default rounded-25 bg-color">Clear
                                        Cart</button>
                                    <!-- <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-5 justify-content-end">
                        <div class="col-lg-7 pl-5 pr-5" style="box-shadow: 0px 11px 10px 0px rgba(0, 0, 0, 0.29) !important;
                        border-radius: 32px;
                        padding: 0px 20px 20px 20px;">
                            <div class="cart-summary mt-4">
                                <h6 class="cart-title text-uppercase text-center">CART TOTALS</h6>
                                <div class="order-total mt-4 mb-3 d-flex justify-content-between align-items-center">
                                    <label>Total products</label>
                                    <span class="ls-50 tt">$00.00</span>
                                </div>
                                <div class="order-total mb-3 d-flex justify-content-between align-items-center">
                                    <label>Total shipping</label>
                                    <span class="ls-50 ship">$00.00</span>
                                </div>

                                <div class="order-total mb-3 d-flex justify-content-between align-items-center">
                                    <h4 class="bold">
                                        <span class="ls-50 ">Total</span>
                                    </h4>
                                    <h4>
                                        <span class="ls-50 ttl" style="color: rgba(148, 202, 82, 1);">$00.00</span>
                                    </h4>

                                </div>
                                <a href="{{ url('mall/checkout')}}"
                                    class="btn btn-dark rounded-25 w-100 mt-4 bg-color ">PROCEED TO
                                    CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @php
                    $limited_trending_videos = $trending_videos->take(4);
                    @endphp

                    @if (count($limited_trending_videos) > 0)
                    @foreach ($limited_trending_videos as $vid)
                    <div class="single_video">

                        <div class="embed-responsive embed-responsive-16by9 shadow other-vid mb-3"
                            style="max-height: 120px;">
                            <video playsinline muted id="vid{{ $vid->id }}"
                                class="embed-responsive-item gVideo theVideo{{ $vid->id }}"
                                poster="{{$vid->video_thumb ?? '' }}" style="object-fit: none;">
                                {{-- <data-src src="{{ $vid->file }}" type="video/mp4"></data-src> --}}
                            </video>
                            <div class="overlay text-center" onclick="loadVideo('{{ $vid->id }}')">
                                <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                            </div>
                        </div>

                    </div>

                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
@include('pages.partials.trendingVideos')
{{-- 
@include("pages.ecom.footer") --}}
@include('pages.partials.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


    $( document ).ready(function() {


    var maincart = JSON.parse(localStorage.getItem("cart"));
    if(maincart && Array.isArray(maincart)){
    var t="";
    var total = 0;
    var shipping = 0;
    var maintotal = 0;
    if(maincart.length < 1){
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
    $("#theads").show()
    maincart.forEach(cart => {
                total += cart.qty * parseInt(cart.price)
        shipping += cart.qty * parseInt(cart.shipping)
        total += shipping
        t += `  <tr>
                                      
                                        <td class="product-name" style="display: flex;align-items: center;">
                                            <a href="/mall/products/${cart.id}">
                                                    <figure>
                                                        <img src="${cart.image}" style="object-fit: cover;" alt="product"
                                                            width="108" height="108">
                                                    </figure>
                                                </a>
                                            <a href="/mall/products/${cart.id}" style="padding-left: 8%;">
                                                ${cart.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">$${new Intl.NumberFormat().format(cart.price)}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group" style="border-radius: 12px;border: 0.5px solid rgba(111, 60, 150, 1);">
                                                <button class="quantity-minus">-</button>
                                                <input class="quantity form-control" type="number" oninput="change(event)" id="l${cart.id}" min="1" defaultvalue="${cart.qty}" max="100000">
                                                <button class="quantity-plus">+</button>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                                        </td>
                                          <td class="product-thumbnail">
                                            <div class="p-relative">
                                            
                                                <button class="btn btn-close" onclick="remove('${cart.id}')"></button>
                                            </div>
                                        </td>
                                    </tr>`
    })
    $("#body").html(t)
    Vicommart.initQtyInput(".quantity")
    $(".tt").text("$"+new Intl.NumberFormat().format(total - shipping))
    $(".ship").text("$"+new Intl.NumberFormat().format(shipping))
    $(".ttl").text("$"+new Intl.NumberFormat().format(total))
    }else {
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
});
const remove = (id) => {
    var maincart = JSON.parse(localStorage.getItem("cart"));
    if (maincart && Array.isArray(maincart)) {
        var t = "";
        var total = 0;
        var shipping = 0;

        // Check the type of id
        console.log("Type of id passed to remove function:", typeof id);

        var item = maincart.find((element) => element.id == id);

        // Check the type of ids in the cart
        maincart.forEach((element, index) => {
            console.log(`Type of id in maincart at index ${index}:`, typeof element.id);
        });

        if (item) {
            var newcart = maincart.filter(function(item) {
                return item.id != id;
            });

            // Update totals
            newcart.forEach(function(item) {
                total += item.price * item.qty;
                shipping += item.shipping;
            });

            console.log(newcart, id);
            localStorage.removeItem('cart');
            sessionStorage.removeItem('cart');
            localStorage.setItem("cart", JSON.stringify(newcart));
            sessionStorage.setItem("cart", JSON.stringify(newcart));
            $(".cart-count").text(newcart.length);
    }
    newcart.forEach(cart => {
                total += cart.qty * parseInt(cart.price)
        shipping += cart.qty * parseInt(cart.shipping)
        total += shipping
        t += `  <tr>
            <td class="product-name" style="display: flex;align-items: center;">
                                            <a href="/mall/products/${cart.id}">
                                                    <figure>
                                                        <img src="${cart.image}" style="object-fit: cover;" alt="product"
                                                            width="108" height="108">
                                                    </figure>
                                                </a>
                                            <a href="/mall/products/${cart.id}" style="padding-left: 8%;">
                                                ${cart.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">$${new Intl.NumberFormat().format(cart.price)}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group" style="border-radius: 12px;border: 0.5px solid rgba(111, 60, 150, 1);">
                                                <button class="quantity-minus">-</button>
                                                <input class="quantity form-control" type="number" oninput="change(event)" id="l${cart.id}" min="1" defaultvalue="${cart.qty}" max="100000">
                                                <button class="quantity-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                                        </td>
                                          <td class="product-thumbnail">
                                            <div class="p-relative">
                                            
                                                <button class="btn btn-close" onclick="remove('${cart.id}')"></button>
                                            </div>
                                        </td>
                                    </tr>`
    })

    $("#body").html(t)
    Vicommart.initQtyInput(".quantity")
    $(".tt").text("$"+new Intl.NumberFormat().format(total - shipping))
    $(".ship").text("$"+new Intl.NumberFormat().format(shipping))
    $(".ttl").text("$"+new Intl.NumberFormat().format(total))
    if(newcart.length < 1){
        $("#theads").hide()
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;"/><br /><p class="my-3">Empty Cart</p></center>')
    }
    }else {
        $("#theads").hide()
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
}

const change = (event) => {
    var id = event.target.id.substring(1);
    var val = event.target.value;
    console.log(id, val)
    if(!val){
    return false;
    }
    var maincart = JSON.parse(localStorage.getItem("cart"));
    if(maincart && Array.isArray(maincart)){
    var t="";
    var total = 0;
    var shipping = 0;
    var maintotal = 0;
    var item = maincart.find((element) => element.id == id);
    var index = maincart.findIndex((element) => element.id == id);
    if(item){
        maincart[index].qty = parseInt(val)
        localStorage.setItem("cart", JSON.stringify(maincart))
        $(".cart-count").text(maincart.length)
    }
    maincart.forEach(cart => {
                total += cart.qty * parseInt(cart.price)
        shipping += cart.qty * parseInt(cart.shipping)
        total += shipping
        t += `  <tr>
            <td class="product-name" style="display: flex;align-items: center;">
                                            <a href="/mall/products/${cart.id}">
                                                    <figure>
                                                        <img src="${cart.image}" style="object-fit: cover;" alt="product"
                                                            width="108" height="108">
                                                    </figure>
                                                </a>
                                            <a href="/mall/products/${cart.id}" style="padding-left: 8%;">
                                                ${cart.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">$${new Intl.NumberFormat().format(cart.price)}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group" style="border-radius: 12px;border: 0.5px solid rgba(111, 60, 150, 1);">
                                                <button class="quantity-minus">-</button>
                                                <input class="quantity form-control" type="number" oninput="change(event)" id="l${cart.id}" min="1" defaultvalue="${cart.qty}" max="100000">
                                                <button class="quantity-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                                        </td>
                                          <td class="product-thumbnail">
                                            <div class="p-relative">
                                            
                                                <button class="btn btn-close" onclick="remove('${cart.id}')"></button>
                                            </div>
                                        </td>
                                    </tr>`
    })
    $("#body").html(t)
    Vicommart.initQtyInput(".quantity")
    $(".tt").text("$"+new Intl.NumberFormat().format(total - shipping))
    $(".ship").text("$"+new Intl.NumberFormat().format(shipping))
    $(".ttl").text("$"+new Intl.NumberFormat().format(total))
    if(maincart.length < 1){
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;"/><br /><p class="my-3">Empty Cart</p></center>')
    }
    }else {
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
}

window.change2 = (id, value) => {
    var id = id.substring(1);
    var val = parseInt(value);
    console.log(id, val)
    if(!val){
    return false;
    }
    var maincart = JSON.parse(localStorage.getItem("cart"));
    if(maincart && Array.isArray(maincart)){
    var t="";
    var total = 0;
    var shipping = 0;
    var maintotal = 0;
    var item = maincart.find((element) => element.id == id);
    var index = maincart.findIndex((element) => element.id == id);
    if(item){
        maincart[index].qty = parseInt(val)
        localStorage.setItem("cart", JSON.stringify(maincart))
        $(".cart-count").text(maincart.length)
    }
    maincart.forEach(cart => {
                total += cart.qty * parseInt(cart.price)
        shipping += cart.qty * parseInt(cart.shipping)
        total += shipping
        t += `  <tr>
            <td class="product-name" style="display: flex;align-items: center;">
                                            <a href="/mall/products/${cart.id}">
                                                    <figure>
                                                        <img src="${cart.image}" style="object-fit: cover;" alt="product"
                                                            width="108" height="108">
                                                    </figure>
                                                </a>
                                            <a href="/mall/products/${cart.id}" style="padding-left: 8%;">
                                                ${cart.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">$${new Intl.NumberFormat().format(cart.price)}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group" style="border-radius: 12px;border: 0.5px solid rgba(111, 60, 150, 1);">
                                                <button class="quantity-minus">-</button>
                                                <input class="quantity form-control" type="number" oninput="change(event)" id="l${cart.id}" min="1" defaultvalue="${cart.qty}" max="100000">
                                                <button class="quantity-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                                        </td>
                                          <td class="product-thumbnail">
                                            <div class="p-relative">
                                            
                                                <button class="btn btn-close" onclick="remove('${cart.id}')"></button>
                                            </div>
                                        </td>
                                    </tr>`
    })
    $("#body").html(t)
    Vicommart.initQtyInput(".quantity")
    // console.log(t)
    $(".tt").text("$"+new Intl.NumberFormat().format(total - shipping))
    $(".ship").text("$"+new Intl.NumberFormat().format(shipping))
    $(".ttl").text("$"+new Intl.NumberFormat().format(total))
    if(maincart.length < 1){
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;"/><br /><p class="my-3">Empty Cart</p></center>')
    }
    }else {
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
}

const cleardata = () => {
    var newcart = [];
    if(newcart && Array.isArray(newcart)){
    var t="";
    var total = 0;
    var shipping = 0;
    var maintotal = 0;
    localStorage.setItem("cart", JSON.stringify(newcart))
    $(".cart-count").text(newcart.length)
    newcart.forEach(cart => {
                total += cart.qty * parseInt(cart.price)
        shipping += cart.qty * parseInt(cart.shipping)
        total += shipping
        t += `  <tr>
            <td class="product-name" style="display: flex;align-items: center;">
                                            <a href="/mall/products/${cart.id}">
                                                    <figure>
                                                        <img src="${cart.image}" style="object-fit: cover;" alt="product"
                                                            width="108" height="108">
                                                    </figure>
                                                </a>
                                            <a href="/mall/products/${cart.id}" style="padding-left: 8%;">
                                                ${cart.name}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">$${new Intl.NumberFormat().format(cart.price)}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group" style="border-radius: 12px;border: 0.5px solid rgba(111, 60, 150, 1);">
                                                <button class="quantity-minus">-</button>
                                                <input class="quantity form-control" type="number" oninput="change(event)" id="l${cart.id}" min="1" defaultvalue="${cart.qty}" max="100000">
                                                <button class="quantity-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                                        </td>
                                          <td class="product-thumbnail">
                                            <div class="p-relative">
                                            
                                                <button class="btn btn-close" onclick="remove('${cart.id}')"></button>
                                            </div>
                                        </td>
                                    </tr>`
    })
    $("#body").html(t)
    Vicommart.initQtyInput(".quantity")
    $(".tt").text("$"+new Intl.NumberFormat().format(total - shipping))
    $(".ship").text("$"+new Intl.NumberFormat().format(shipping))
    $(".ttl").text("$"+new Intl.NumberFormat().format(total))
    $("#theads").hide()
    if(newcart.length < 1){
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;"/><br /><p class="my-3">Empty Cart</p></center>')
    }
    }else {
        return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>')
    }
}


</script>
@endsection