@extends('pages.app')

@push('css')
<style>
    .txt h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: var(--snd-color) !important;
        font-weight: bold !important;
        font-family: var(--snd-font) !important;
    }

</style>
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
                <div class="img_area">
                    <img alt="" src="/WEB-BANNERSABOUT.jpeg">
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
                                            $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".trim(json_decode($product->image, true)[0], '"');
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
    <div class="col-md-12">
        <div class="about_section">
            <h1 class="section_heading2 colorSnd mt-2"> {{$about->title}} </h1>

            <div class="row">
                <div class="col-md-12 mb-4 txt">
                    {!! $about->body !!}
                </div>
                <!-- <div class="col-md-6">
                                    <p>Maxflix, Africa’s first and only social viral platform for all things African. We aim to connect Users and Vendors and vice versa through video. We originated in 2007 “to your doorstep” African video delivery service. Due to a few setbacks we went offline; but now we’re back! We have restructured now as the only medium of its kind where you visually get the African experience on all things African. Africa is a great big continent why not share what she has with the world. From culture, to entertainment, to style and beauty; maxflix.com lets’s e YOU sell your </p>
                                </div>
                                <div class="col-md-6">
                                    <p>brand through videos. Register an account today, create your station and post your videos and products today on the only platform of its kind. We have more in store so we hope that you stay with us as long as possible. </p>

                                    <p>Take a look at where we were 11 years ago!</p>

                                    <p>Thank you and happy viewing and see you soon…literally!
                                    Planet Maxflix</p>
                                </div> -->
                <!-- v> -->
            </div>
            {{-- <div class="col-md-10">
                         <div class="  new-video mt-5" data-video="https://www.w3schools.com/html/mov_bbb.mp4" data-poster="img/sample.jpg" data-type='video/mp4'></div>
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