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
<section class="sectionPT sectionPB online_video_submission">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1 class="sectionHeading3 mb-5">{{$info->title}}</h1> -->
                <div class="img_area mb-5">
                    <img alt="" src="/vid_agree.jpeg">
                </div>
                <!-- <p>This Online Video Submission Agreement (“Agreement”) shall confirm certain of your rights and responsibilities.</p> -->
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

        <p>By uploading any data or information, or posting or submitting any content to Vicomma Entertainment, Inc.
            (“User Content”), you certify, represent and acknowledge that you wholly own the User Content or have the
            sole and exclusive right to permit Vicomma Entertainment, Inc. and its parents, members, managers,
            directors, shareholders, partners, representatives, subsidiaries, affiliates, sponsors, successors, assigns,
            heirs and licensees (collectively, “Vicomma”) to use, edit, publish and otherwise exploit your User Content
            and your name in connection with your User Content without any obligation or liability to you or any other
            party whatsoever. You shall be solely responsible for your User Content and the consequences of submitting
            and publishing your User Content.</p>

        <p>By uploading any data or information, or posting or submitting any content to Vicomma Entertainment, Inc.
            (“User Content”), you certify, represent and acknowledge that you wholly own the User Content or have the
            sole and exclusive right to permit Vicomma Entertainment, Inc. and its parents, members, managers,
            directors, shareholders, partners, representatives, subsidiaries, affiliates, sponsors, successors, assigns,
            heirs and licensees (collectively, “Vicomma”) to use, edit, publish and otherwise exploit your User Content
            and your name in connection with your User Content without any obligation or liability to you or any other
            party whatsoever. You shall be solely responsible for your User Content and the consequences of submitting
            and publishing your User Content.</p>
        <p>When you provide us with your User Content, you give Vicomma a non-exclusive, worldwide, perpetual,
            irrevocable, royalty-free, sublicensable and transferable (through multiple tiers) right and license to
            exercise any and all copyright, trademark, publicity and database rights that you have in the User Content
            in any and all formats or media now known or hereafter devised in the future.</p>

        <p>You further hereby grant to Vicomma the non-exclusive, irrevocable and unconditional right and license to
            describe, relate, broadcast, exhibit, transmit, publish, use, monetize, distribute and/or exploit your User
            Content in any such manner as Vicomma shall elect, in whole or in part, on the internet, in print and
            electronic form, in merchandising, publicity and advertising, or in any other media now known or hereafter
            created or devised throughout the universe in perpetuity.</p>

        <p> For the avoidance of doubt, this shall include, without limitation, the right to submit and license (and
            sublicense) your User Content to third-parties including, but not limited to, television broadcast networks,
            cable stations, pay, pay-per-view, satellite or free television networks, television syndicators, home video
            distributors, podcast/mobisode distributors, or any other third-party distributor ("Third Parties") for the
            further exploitation of your User Content in any format or media, including the development of a possible
            television and/or other audiovisual production.</p>


        <p>You agree that Vicomma and the Third Parties shall have the right to edit, change, add to, take from,
            rearrange, vary, embellish, alter, modify, revise, duplicate, translate, reformat and/or reprocess your User
            Content in any manner Vicomma or the Third Parties may in their sole discretion determine and to use it as
            Vicomma or the Third Parties in their sole discretion may determine and to make derivative works of the
            same, in whole or in part, without notifying you and without obligation to you. You waive any right to
            inspect or approve the final display or other exploitation of your User Content now or in the future,
            whether that use is known to you or unknown, and you waive any right to royalties or any other compensation
            arising from or related to the use of your User Content.</p>

    </div>
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