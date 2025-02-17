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
        width: 60px !important;
        height: 40px !important;
        border-left: 0px !important;
        border-right: 0px !important;
        border-bottom: 1px solid #ccc !important;
        border-top: 1px solid #ccc !important;
        background-color: transparent !important;
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
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-left: 0px;
        border-right: 1px solid #ccc;
        background: transparent;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .quantity-minus {
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 0;
        background: transparent;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
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
        width: 92%;
        left: 40px;
        /* Adjusted for full width */
        z-index: 1;
    }

    .progress-bar-line {
        background-color: #94CA52;
    }

    .rounded-25 {
        border-radius: 25px !important;
        border: 1px solid rgba(148, 202, 82, 1)
    }

    .bg-color {
        background: rgba(148, 202, 82, 1) !important;
        border: 0px !important;
        color: #fff !important;
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
            <div class="row">
                <div class="col-lg-9 pr-lg-4">
                    <div class="stepper-wrapper mb-5">
                        <div class="stepper-item completed" id="step1Indicator">
                            <div class="step-counter">1</div>
                            <div>Shopping Cart</div>
                        </div>
                        <div class="stepper-item completed" id="step2Indicator">
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
                    <form class="shipping-calculator-form" onsubmit="pay(event)" id="payment-form">

                        <div class="row gutter-lg mb-10">

                            <div class="col-lg-8 pr-lg-4 mb-6">

                                <div style="box-shadow: 0px 11px 10px 0px rgba(0, 0, 0, 0.29) !important;
                    border-radius: 32px;
                    padding: 0px 20px 20px 20px;">

                                    <div class="container pt-4">
                                        <!-- Returning Customer Login -->
                                        <div class="mb-4">
                                            <p>Returning customer? Click here to<a href="#" style="color:#94CA52"
                                                    class="btn btn-link">Login</a></p>
                                        </div>


                                        <h5 class="mb-4">Billing Details</h5>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control rounded-25" id="firstName"
                                                    name="first_name" @if(auth()->user())
                                                value="{{ auth()->user()->first_name}}" @endif required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control rounded-25" id="lastName"
                                                    name="last_name" @if(auth()->user())
                                                value="{{ auth()->user()->last_name}}"
                                                @endif required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control rounded-25" id="email"
                                                    name="email" @if(auth()->user())
                                                value="{{ auth()->user()->email}}" @endif required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" class="form-control rounded-25" id="phone"
                                                    name="phone_number" @if(auth()->user())
                                                value="{{ auth()->user()->phone_number}}" @endif required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="companyName" class="form-label">Company Name</label>
                                            <input type="text" class="form-control rounded-25" id="companyName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <select name="country" id="country"
                                                class="form-control rounded-25 form-control rounded-25-md"
                                                onchange="GetStates(this.value)" required>
                                                <option value="default">Select Country
                                                </option>
                                                @foreach(DB::table("countries")->orderBy("name", "ASC")->get() as
                                                $country)
                                                <option value="{{$country->id}}" @if(auth()->user() &&
                                                    auth()->user()->country_id && auth()->user()->country() &&
                                                    $country->name == auth()->user()->country->name) selected
                                                    @endif>{{$country->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <select name="state"
                                                class="form-control rounded-25 form-control rounded-25-md" id="state1"
                                                onchange="GetCities(this.value)">

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <select name="city"
                                                class="form-control rounded-25 form-control rounded-25-md" id="city1">

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Zip or Postal Code</label>
                                            <input class="form-control rounded-25 form-control rounded-25-md"
                                                type="text" name="zipcode" id="zip" placeholder="ZIP"
                                                @if(auth()->user())
                                            value="{{auth()->user()->postal_code}}" @endif required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input class="form-control rounded-25 form-control rounded-25-md"
                                                type="text" id="address" name="addr" placeholder="Address Line"
                                                @if(auth()->user())
                                            value="{{auth()->user()->street_address}}" @endif required>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="createAccount">
                                            <label for="createAccount" class="form-check-label">Create an
                                                account?</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="shipDifferentAddress">
                                            <label for="shipDifferentAddress" class="form-check-label">Ship to a
                                                different
                                                address?</label>
                                        </div>
                                        <!-- Additional Shipping Address Fields -->
                                        <div id="differentAddressFields" style="display: none;">
                                            <h4 class="mb-4">Shipping Address</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="shippingFirstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control rounded-25"
                                                        id="shippingFirstName">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="shippingLastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control rounded-25"
                                                        id="shippingLastName">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="shippingEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control rounded-25"
                                                        id="shippingEmail">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="shippingPhone" class="form-label">Phone</label>
                                                    <input type="tel" class="form-control rounded-25"
                                                        id="shippingPhone">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="shippingCompanyName" class="form-label">Company Name</label>
                                                <input type="text" class="form-control rounded-25"
                                                    id="shippingCompanyName">
                                            </div>
                                            <div class="mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <select name="country" id="country"
                                                    class="form-control rounded-25 form-control rounded-25-md"
                                                    onchange="GetStates(this.value)" required>
                                                    <option value="default">Select Country
                                                    </option>
                                                    @foreach(DB::table("countries")->orderBy("name", "ASC")->get() as
                                                    $country)
                                                    <option value="{{$country->id}}" @if(auth()->user() &&
                                                        auth()->user()->country_id && auth()->user()->country() &&
                                                        $country->name == auth()->user()->country->name) selected
                                                        @endif>{{$country->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="state" class="form-label">State</label>
                                                <select name="state"
                                                    class="form-control rounded-25 form-control rounded-25-md"
                                                    id="state1" onchange="GetCities(this.value)">

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <select name="city"
                                                    class="form-control rounded-25 form-control rounded-25-md"
                                                    id="city1">

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Zip or Postal Code</label>
                                                <input class="form-control rounded-25 form-control rounded-25-md"
                                                    type="text" name="zipcode" id="zip" placeholder="ZIP"
                                                    @if(auth()->user())
                                                value="{{auth()->user()->postal_code}}" @endif required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="shippingAddress" class="form-label">Address</label>
                                                <input class="form-control rounded-25 form-control rounded-25-md"
                                                    type="text" id="address" name="addr" placeholder="Address Line"
                                                    @if(auth()->user())
                                                value="{{auth()->user()->street_address}}" @endif required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="orderNotes" class="form-label">Order Notes</label>
                                            <textarea class="form-control rounded-25" id="orderNotes"
                                                rows="3"></textarea>
                                        </div>

                                    </div>


                                </div>

                            </div>
                            <div class="col-lg-4 sticky-sidebar-wrapper">

                                <div style="box-shadow: 0px 11px 10px 0px rgba(0, 0, 0, 0.29) !important;
                border-radius: 32px;
                padding: 0px 20px 20px 20px;">
                                    <div class="sticky-sidebar pt-5">
                                        <div class="cart-summary mb-4">
                                            <h5 class="cart-title text-uppercase text-center mb-3">YOUR ORDER</h5>
                                            <div
                                                class="order-total mt-4 mb-5 d-flex justify-content-between align-items-center">
                                                <span class="bold" style="font-weight: bold;">PRODUCT</span>
                                                <span class="ls-50" style="font-weight: bold;">TOTAL</span>
                                            </div>
                                            <div id="productinfo"></div>

                                            <hr>
                                            <div class="order-total d-flex justify-content-between align-items-center">
                                                <label style="font-weight: bold;">CART SUBTOTAL</label>
                                                <span class="ls-50 tt">$00.00</span>
                                            </div>
                                            <hr>
                                            <div class="order-total d-flex justify-content-between align-items-center">
                                                <label style="font-weight: bold;">SHIPPING</label>
                                                <span class="ls-50 ship">$00.00</span>
                                            </div>
                                            <hr>

                                            <div class="order-total d-flex justify-content-between align-items-center">
                                                <h4>
                                                    <label style="font-weight: bold;">ORDER TOTAL</label>
                                                </h4>
                                                <h4>
                                                    <span class="ls-50 ttl">$00.00</span>
                                                </h4>

                                            </div>
                                            <div class="form-group mt-4">
                                                <p for="payment-method" style="margin-bottom: 15px;
                                            text-align: center;
                                            font-size: 16px;
                                            font-weight: bold;">Select Payment
                                                    Method</p>
                                                <div style="display: grid;">
                                                    <label>
                                                        <input type="radio" name="payment_method" value="stripe"
                                                            checked>
                                                        Stripe
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="payment_method" value="flutterwave">
                                                        Flutterwave
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group" id="stripe-card-element">
                                                <label for="card-element" style="margin-bottom: 10px;">Credit or debit
                                                    card</label>
                                                <div id="card-element"></div>
                                                <div id="card-errors" role="alert"></div>

                                            </div>

                                            @if(auth()->user())
                                            <button type="submit" class="btn btn-dark rounded-25 w-100 mt-4 bg-color">
                                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></button>
                                            @else
                                            <a href="/login?ref=/mall/cart"
                                                class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                                Login to continue<i class="w-icon-long-arrow-right"></i></a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>

                </div>
                <div class="col-md-3">
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
@push('scripts')

<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.stripe.com/v3/"></script>

<!-- Main JS -->

{{-- <script src="/ecom/assets/js/main.min.js"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('shipDifferentAddress').addEventListener('change', function () {
            const differentAddressFields = document.getElementById('differentAddressFields');
            differentAddressFields.style.display = this.checked ? 'block' : 'none';
        });
    });
    
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
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
    
        $('input[name="payment_method"]').change(function() {
            if ($(this).val() === 'stripe') {
                $('#stripe-card-element').show();
            } else {
                $('#stripe-card-element').hide();
            }
        });
    
        if ($('input[name="payment_method"]:checked').val() === 'stripe') {
            $('#stripe-card-element').show();
        } else {
            $('#stripe-card-element').hide();
        }
    });
    
    var stripe = Stripe('pk_test_51HfwjlJFbzmLaIp8zyhYxxVYbSdLJaN3AYABsB46t27FFiTxLsxvklalqWr8yri1oVGExYC8q9P5TQL61kJuU8Pk001y1v06Cx');
    var elements = stripe.elements();
    
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    
    var card = elements.create('card', {style: style});
    card.mount('#card-element');
    
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    function GetStates(val) {
        $("#state").empty();
        $("#city").empty();
        $("#city").html("<option value='' selected disabled>Select State First</option>");
        $.ajax({
            url: "{{ url('/getstates') }}/" + val,
            method: "get",
            success: function (data) {
                $("#state1").html(data);
                $("#state2").html(data);
                $("#state3").html(data);
            }
        });
    }
    
    function GetCities(val) {
        $.ajax({
            url: "{{ url('/getcities') }}/" + val,
            method: "get",
            success: function (data) {
                $("#city1").html(data);
                $("#city2").html(data);
            }
        });
    }
    
    $(document).ready(function() {
        var maincart = JSON.parse(localStorage.getItem("cart"));
        if (maincart && Array.isArray(maincart)) {
            var t = "";
            var total = 0;
            var shipping = 0;
            var maintotal = 0;
            if (maincart.length < 1) {
                return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>');
            }
            $("#theads").show();
            maincart.forEach(cart => {
                total += cart.qty * parseInt(cart.price);
                shipping += cart.qty * parseInt(cart.shipping);
                total += shipping;
    
                t += `<div class="order-total d-flex justify-content-between align-items-center">
                    <label> ${cart.name} &nbsp;&nbsp;&nbsp; x${cart.qty}</label>
                    <span class="ls-50">$${new Intl.NumberFormat().format(cart.qty * parseInt(cart.price))}</span>
                </div>`;
            });
            $("#productinfo").html(t);
           
            $(".tt").text("$" + new Intl.NumberFormat().format(total - shipping));
            $(".ship").text("$" + new Intl.NumberFormat().format(shipping));
            $(".ttl").text("$" + new Intl.NumberFormat().format(total));
        } else {
            return $("#empt").html('<center><img src="/img/storepic.png" style="height: 250px;" /><br /><p class="my-3">Empty Cart</p></center>');
        }
    });
    
    function payWithPaystack(e) {
        e.preventDefault();
        var total = parseInt($(".ttl").text().substring(1).replace(/\,/g, '')) * "{{$geo['exchange_rate']}}";
    
        if (total == "0") {
            return false;
        }
    
        var handler = PaystackPop.setup({
            key: 'pk_test_985b8d0dfb5d833abf1e3a056b7bf3947a4cc1f8',
            email: "{{auth()->user() ? auth()->user()->email : ''}}",
            amount: parseInt(total) * 100,
            currency: "{{$geo['currency_symbol']}}",
            ref: '' + Math.floor((Math.random() * 1000000000) + 1),
            metadata: {
                custom_fields: [
                    {
                        email: "{{auth()->user() ? auth()->user()->email : ''}}",
                        phonenumber: "{{auth()->user() ? auth()->user()->phone : ''}}",
                        name: "{{auth()->user() ? auth()->user()->first_name : ''}}"
                    }
                ]
            },
            callback: function(response) {
                var ref = response.reference;
                verifyTransactionPaystack(response, total);
            },
            onClose: function() {
                swal("Window Closed", "Window closed by user", "info");
            }
        });
        handler.openIframe();
    }
    
    function pay(e) {
        e.preventDefault();
        var total = parseInt($(".ttl").text().substring(1).replace(/\,/g, ''));
        if (total == "0") {
            return false;
        }
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
        if (paymentMethod === 'stripe') {
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        stripeTokenHandler(result.token, total);
                    }
                });
            });
    
            function stripeTokenHandler(token, amount) {
                var maincart = JSON.parse(localStorage.getItem("cart"));
                if (!maincart || !Array.isArray(maincart)) {
                    maincart = [];
                }
                @if(auth()->user())
                $.post('/mall/callback', {
                    id: token.id,
                    products: JSON.stringify(maincart),
                    user_id: "{{auth()->user()->id}}",
                    name: "{{auth()->user()->first_name}} {{auth()->user()->last_name}}",
                    email: "{{auth()->user()->email}}",
                    phone: "{{auth()->user()->phone}}",
                    address: $("#address").val(),
                    state: document.getElementById('state1').value,
                    country: document.getElementById('country').value,
                    postal_code: $("#zip").val(),
                    stripeToken: token.id,
                    shipping: parseInt($(".ship").text().substring(1)),
                    payment_method: 'stripe',
                    "_token": "{{csrf_token()}}",
                    amount: amount,
                }).done((res) => {
                    var newcart = [];
                    if (newcart && Array.isArray(newcart)) {
                        localStorage.setItem("cart", JSON.stringify(newcart));
                    }
                    location.href = "/mall/success/" + res.id;
                }).fail((err) => {
                    $("button").attr("disabled", false);
                    Swal.fire("", err.responseJSON.message, "error");
                });
                @endif
            }
        } else {
            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-5e81d0391b0f847910f835caab12bebd-X",
                tx_ref: "VC-12345" + Date.now(),
                amount: total,
                currency: "USD",
                country: "US",
                payment_options: "card,ussd,account,banktransfer,qr,mobilemoneyghana,paypal",
                customer: {
                    email: "{{auth()->user() ? auth()->user()->email : ''}}",
                    phonenumber: "{{auth()->user() ? auth()->user()->phone : ''}}",
                    name: "{{auth()->user() ? auth()->user()->first_name : ''}}",
                },
                callback: function(payment) {
                    verifyTransactionOnBackend(payment);
                },
                onclose: function(incomplete) {
                    $("iframe").remove();
                    $("body").css("overflow", "unset");
                    if (incomplete || window.verified === false) {
                        document.querySelector("#payment-failed").style.display = 'block';
                    } else {
                        document.querySelector("form").style.display = 'none';
                        if (window.verified === true) {
                            document.querySelector("#payment-success").style.display = 'block';
                        } else {
                            document.querySelector("#payment-pending").style.display = 'block';
                        }
                    }
                },
                meta: {
                    consumer_id: 23,
                    consumer_mac: "92a3-912ba-1192a",
                },
                customizations: {
                    title: "VICOMMA MALL CHECKOUT",
                    description: "Payment for Items in Cart",
                    logo: "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                },
            });
        }
    }
    
    function verifyTransactionPaystack(data, amount) {
        var maincart = JSON.parse(localStorage.getItem("cart"));
        if (!maincart || !Array.isArray(maincart)) {
            maincart = [];
        }
        @if(auth()->user())
        $.post('/mall/callback', {
            id: data.reference,
            products: JSON.stringify(maincart),
            user_id: "{{auth()->user()->id}}",
            name: "{{auth()->user()->first_name}} {{auth()->user()->last_name}}",
            email: "{{auth()->user()->email}}",
            phone: "{{auth()->user()->phone}}",
            address: $("#address").val(),
            state: $("#state1").val(),
            country: $("#country").val(),
            postal_code: $("#zip").val(),
            shipping: parseInt($(".ship").text().substring(1)),
            payment_method: 'paystack',
            "_token": "{{csrf_token()}}",
            amount: amount,
        }).done((res) => {
            $("iframe").remove();
            setTimeout(function() {
                Swal.fire("", res.message, "success");
            }, 500);
            var newcart = [];
            if (newcart && Array.isArray(newcart)) {
                localStorage.setItem("cart", JSON.stringify(newcart));
            }
            location.href = "/mall/success/" + res.id;
        }).fail((err) => {
            $("button").attr("disabled", false);
            Swal.fire("", err.responseJSON.message, "error");
        });
        @endif
    }
    
    function verifyTransactionOnBackend(data) {
        var maincart = JSON.parse(localStorage.getItem("cart"));
        if (!maincart || !Array.isArray(maincart)) {
            maincart = [];
        }
        @if(auth()->user())
        $.post('/mall/callback', {
            id: data.tx_ref,
            products: JSON.stringify(maincart),
            user_id: "{{auth()->user()->id}}",
            name: "{{auth()->user()->first_name}} {{auth()->user()->last_name}}",
            email: "{{auth()->user()->email}}",
            phone: "{{auth()->user()->phone}}",
            address: $("#address").val(),
            state: $("#state").val(),
            country: $("#country").val(),
            postal_code: $("#zip").val(),
            shipping: parseInt($(".ship").text().substring(1)),
            payment_method: 'flutterwave',
            "_token": "{{csrf_token()}}",
            amount: data.amount,
        }).done((res) => {
            $("iframe").remove();
            setTimeout(function() {
                Swal.fire("", res.message, "success");
            }, 500);
            var newcart = [];
            if (newcart && Array.isArray(newcart)) {
                localStorage.setItem("cart", JSON.stringify(newcart));
            }
            location.href = "/mall/success/" + res.id;
        }).fail((err) => {
            $("button").attr("disabled", false);
            Swal.fire("", err.responseJSON.message, "error");
        });
        @endif
    }
</script>
@endpush

@endsection