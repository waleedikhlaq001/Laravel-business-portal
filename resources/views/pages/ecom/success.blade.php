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

<main class="main order">

    <!-- Start of PageContent -->
    <div class="page-content pb-2">
        <div class="p-2 p-lg-5">
            <div class="row gutter-lg mb-10">
                <div class="col-lg-8 pr-lg-4 mb-6">
                    <div class="stepper-wrapper mb-5">
                        <div class="stepper-item completed" id="step1Indicator">
                            <div class="step-counter">1</div>
                            <div>Shopping Cart</div>
                        </div>
                        <div class="stepper-item completed" id="step2Indicator">
                            <div class="step-counter">2</div>
                            <div>Checkout </div>
                        </div>

                        <div class="stepper-item completed" id="step5Indicator">
                            <div class="step-counter">3</div>
                            <div>Order Complete</div>
                        </div>
                        <div class="progress-bar-line"></div>
                        <div class="progress-bar-active" style="width: 0%;" id="progressBar"></div>

                    </div>
                    <div class="container" style="box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.16);
                    padding: 28px;
                    border-radius: 25px;">
                        <div class="row">
                            <div class="order-success text-center font-weight-bolder text-dark">
                                <i class="fas fa-check"></i>
                                Thank you. Your order has been received.
                            </div>
                            <h4 class="title text-uppercase mt-5 ls-25 mb-5">Order Details</h4>

                            <div class="col-md-4">
                                <ul class="order-view list-style-none">
                                    <li>
                                        <label>Order ID</label>
                                        <strong>#{{$order->id}}</strong>
                                    </li>
                                    <li>
                                        <label>Status</label>
                                        <strong>{{$order->shipped == 1? "Processing" : "Pending"}}</strong>
                                    </li>
                                    <li>
                                        <label>Date</label>
                                        <strong>{{$order->created_at}}</strong>
                                    </li>
                                    <li>
                                        <label>Total</label>
                                        <strong>${{number_format($order->amount, 2)}}</strong>
                                    </li>
                                    <li>
                                        <label>Payment method</label>
                                        <strong>{{$order->payment_method}}</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div class="order-details-wrapper">
                                    <table class="order-table" style="width: 80%;">
                                        <thead>
                                            <tr>
                                                <th class="text-dark">Product</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="/mall/products/{{$item->product_id}}">{{$item->name}}</a>&nbsp;<strong>X
                                                        {{$item->qty}}</strong><br>
                                                    Vendor : <a
                                                        href="/mall/{{Str::slug(\App\Models\Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where('id', $item->product_id)->first()->vendor->vendor_station)}}">{{\App\Models\Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("id", $item->product_id)->first()->vendor->vendor_station}}</a>
                                                </td>
                                                <td>${{number_format($order->amount, 2)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td>${{number_format($order->amount, 2)}}</td>
                                            </tr>

                                            <tr class="total">
                                                <th class="border-no">Total:</th>
                                                <td class="border-no">${{number_format($order->amount, 2)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div id="account-addresses">
                                    <div class="ecommerce-address shipping-address">
                                        <h4 class="title text-uppercase mt-5 ls-25 mb-5">Shipping
                                            Address
                                        </h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Name:</b> {{$order->shipping_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Address Line:</b>
                                                            {{$order->shipping_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>State/City:</b>
                                                            {{App\Models\User::statename($order->state)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Country:</b>
                                                            {{App\Models\User::countryname($order->country)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Zip:</b> {{$order->zip}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Account Address -->

                            <a href="/mall" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i
                                    class="w-icon-long-arrow-left"></i>Back to Mall</a>
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
@include('pages.partials.footer')
@endsection