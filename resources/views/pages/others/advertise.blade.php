@extends('pages.app')
@push('css')
<style>
    .right_sidebar .img_area {
        width: 100px;
        height: 100px;
        display: inline-block;
        vertical-align: middle;
    }

    .img_area image {
        object-fit: cover'

    }

    .bottom {
        display: flex;
        gap: 5px;
    }

</style>
@endpush
@section('content')

@include('includes.messages')

<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="sectionHeading3 mb-5">Advertise on vicomma</h1>
                <div class="adv_content">
                    <p>So you have a business or event and you need to reach more people; well why not reach millions?
                        When you advertise on Vicomma.com you have the potential of reaching that many, from all over
                        the world. Take a look at our plans below and compare to print ads, sending brochures, or social
                        networking; you can’t get a better rate right in one place. Give us a try today.</p>
                </div>

                <div class="_catd1">
                    <img alt="" src="img/path1.png" class="p1">
                    <img alt="" src="img/path2.png" class="p2">
                    <div class="row">
                        <div class="col-md-11 pricing_table advertise row margin0">
                            <div class="single_table col-md-4">
                                <ul>
                                    <li class="title">Daily Ad Blast</li>
                                    <li>posting of your ad on our left side vertical side banner (size: 1200×587) plan
                                        duration: good for the day</li>
                                    <li class="price">
                                        <span class="dollar_txt">$</span>
                                        <div class="price_txt">
                                            <span class="price_amount">24.99</span>
                                            <span class="price_time">Day</span>
                                        </div>
                                    </li>
                                    <button class="btn btn-start">Sign Up</button>

                                </ul>
                            </div>
                            <div class="single_table check-col col-md-4">
                                <ul>
                                    <li class="title">Weekly Ad Blast</li>
                                    <li>posting of your ad on our right side vertical side banner (size: 300×250) plan
                                        duration: good for one week</li>
                                    <li class="price">
                                        <span class="dollar_txt">$</span>
                                        <div class="price_txt">
                                            <span class="price_amount">44.99</span>
                                            <span class="price_time">Week</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="single_table check-col col-md-4">
                                <ul>
                                    <li class="title">Weekly Plus Ad Blast</li>
                                    <li>posting of your ad on one of our vertical side banners (left or right side
                                        banner) posting of your ad on the top slider banner for 1 week ( size:
                                        800×250)plan duration: good for up to one month paid per the month</li>
                                    <li class="price">
                                        <span class="dollar_txt">$</span>
                                        <div class="price_txt">
                                            <span class="price_amount">64.99</span>
                                            <span class="price_time">Week</span>
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btn-start" onclick="location.href = '/register';">Sign Up</button>

                            </div>
                        </div>
                    </div>
                    <p class="mb-3 ad_note">For businesses with well known brands, please contact us at <a href="#.">
                            enterprise@vicoma.com for pricing.</a></p>
                    <p class="mb-5 ad_note">We Accept all types of Credit/Debit Cards. payments are made through a
                        secure gateway.</p>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>

                    <!-- <div class="col-md-6 col_center mb-5">
                                <div class="img_area">
                                    <img alt=""  src="img/gateways.png">
                                </div>
                            </div> -->
                </div>
            </div>
            {{-- <div class="col-md-4">
                        <div class="right_sidebar">
                            <p class="title">Top selling</p>
                            <ul class="fine-scrollbar">
                                @if (count($random_products) > 0)
                                    @foreach ($random_products as $product)
                                        <?php

                                        // if (count(json_decode($product->image, true)) > 0) {
                                            if (gettype(json_decode($product->image, true)) == "array" && count(json_decode($product->image, true)) > 0) {

                                            // if(count($product->image) > 0){
                                            $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($product->image, true)[0];
                                        } else {
                                            $image = '/img/no-image.png';
                                        }
                                        ?>
                                        <li>
                                                <div class="img_area product-img shadow-sm">
                                                    <img alt="{{$product->name}}" src="{{ $image }}">
        </div>
        <div class="info pr-4">
            <p class="p_title text-dark"><a href="/mall/products/{{ $product->id }}"
                    target="_blank">{{ucwords($product->name)}}</a></p>
            <div class="bottom mt-3">
                <span class="price">${{ number_format($product->price) }}</span>
                <a href="/mall/products/{{ $product->id }}" class="btn-bag-it"
                    style="border-radius: 20px;display: flex; align-items: center; justify-content: center;"
                    ii="{{ $product->id }}">Bag It</a>
            </div>
        </div>
        </li>
        @endforeach
        @else
        <li><small>No Top Selling Products found</small></li>
        @endif
        </ul>
    </div>
    </div> --}}
    </div>
    </div>
</section>

@include('pages.partials.trendingVideos')
@include('pages.partials.footer')
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>
@endpush