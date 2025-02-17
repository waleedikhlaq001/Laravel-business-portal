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
<section class="sectionPT sectionPB terms_conditions">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1 class="sectionHeading3 mb-5">{{$terms->title}}</h1> -->
                <div class="img_area mb-5">
                    <img alt="" src="/images/WEB-BANNERSTERMS & CONDITION.jpg" style="width: 100%">
                </div>

                <p>If you visit vicomma.com or vicommaentertainment.com, you agree to these Terms of Service and to our
                    Privacy Policy. If you do not agree to either of these policies, do not continue to visit these
                    sites. As used in this agreement, “vicomma” refers to vicomma.com and vicommaentertainment.com.</p>

            </div>
            {{-- <div class="col-md-4">
                        <div class="right_sidebar">
                            <p class="title">Top selling</p>
                            <ul class="fine-scrollbar">
                                @if (count($random_products) > 0)
                                    @foreach ($random_products as $product)
                                        <?php

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
    <div class="col-md-8 txt">
        {!! $terms->body !!}
        <!-- <h2 class="content_heading1">GENERAL</h2>

                        <p>vicomma is for your general information, entertainment and non-commercial use only. <br> The website is subject to change without notice.
                        </p>

                        <h2 class="content_heading1">AUDIENCE</h2>

                        <p>vicomma is intended for users who are over the age of 13. However, some of the materials on this site are only intended for those over the age of 18. If you are not over the age of 18, you must click Exit when you are presented with the notice that such materials are for adults only, when and if applicable.</p>

                        <h2 class="content_heading1">PRIVACY</h2>

                        <p>You should periodically review our Privacy Policy, which governs your visits to vicomma, to understand our information collection and use practices.</p>

                        <h2 class="content_heading1">PRIVACY</h2>
                        <p>vicomma, vicomma Entertainment, vicomma.com, vicommaentertainment.com, and other website graphics, logos, page headers, button icons, scripts, and service names are trademarks, registered trademarks or trade dress of vicomma ENTERTAINMENT COMPANY LLC., or its affiliates. You may not use our trademarks or trade dress in connection with any product or service that is not vicomma ENTERTAINMENT COMPANY LLC’s, or in any manner that is likely to cause confusion among customers. All other trademarks not owned by vicomma ENTERTAINMENT COMPANY LLC. or its affiliates that appear on this site are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by vicomma or its affiliates.</p>

                        <h2 class="content_heading1">TRADEMARKS</h2>
                        <p>vicomma, vicomma Entertainment, vicomma.com, vicommaentertainment.com, and other website graphics, logos, page headers, button icons, scripts, and service names are trademarks, registered trademarks or trade dress of vicomma ENTERTAINMENT COMPANY LLC., or its affiliates. You may not use our trademarks or trade dress in connection with any product or service that is not vicomma ENTERTAINMENT COMPANY LLC’s, or in any manner that is likely to cause confusion among customers. All other trademarks not owned by vicomma ENTERTAINMENT COMPANY LLC. or its affiliates that appear on this site are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by vicomma or its affiliates.</p>

                        <h2 class="content_heading1">COPYRIGHT NOTICE</h2>
                        <p>All content included on this site, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of vicomma ENTERTAINMENT COMPANY LLC or its content suppliers and protected by United States and international copyright laws.</p>

                        <h2 class="content_heading1">COPYRIGHT COMPLAINTS</h2>
                        <p>The compilation of all content on this site is the exclusive property of vicomma ENTERTAINMENT COMPANY LLC and protected by United States and international copyright laws.</p>
                        <p>vicomma ENTERTAINMENT COMPANY LLC and its affiliates respect the intellectual property of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please visit our DMCA policy and request removal of the infringing content.</p>

                        <h2 class="content_heading1">YOUR COMMENTS, COMMUNICATIONS,</h2>
                        <p>Visitors may post comments, suggestions, questions, or other content to vicomma so long as the content is not illegal, obscene, defamatory, infringing of intellectual property rights or contain software viruses or commercial solicitations. We reserve the right (but have no obligation) to remove or edit such content. We also reserve the right to take action to seek to prevent further use of our site by individuals who violate this Terms of Service. We do not regularly review posted comments and make no representations or warrantees concerning its suitability or veracity. If you read comments, you do so at your own risk.</p>

                        <p>If you do post comments on or otherwise send content to vicomma, you grant us and our affiliates a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. </p>

                        <p>You represent and warrant that you own or otherwise control all of the rights to the content that you post that the content is accurate; that use of the content you supply does not violate this policy; and that you will indemnify vicomma ENTERTAINMENT COMPANY LLC or its affiliates for all claims resulting from content you supply. vicomma ENTERTAINMENT COMPANY LLC takes no responsibility and assumes no liability for any content posted by you or any third party. </p>
                        <p>You also represent and warrant that the content you have provided is legal in the United States and suitable for the general audience of the site, unless you have otherwise indicated that the material should be restricted to adults during the submission process.</p>


                        <h2 class="content_heading1">APPLICABLE LAW</h2>
                        <p>By visiting vicomma, you agree that the laws of the state of Florida, without regard to principles of conflict of laws, will govern these Conditions of Use and any dispute of any sort that might arise between you and vicomma ENTERTAINMENT COMPANY LLC or its affiliates.</p>


                        <h2 class="content_heading1">CONTACT INFORMATION</h2>
                        <p>Legal matters: legal@vicomma.com</p>
                        <p>Copyright matters: Please note that if you are submitting any video or media or if you permit vicomma or its companies to submit/post a video or media on our sites it is as your own risk. Although vicomma does not condone nor support copyright infringement we reserve the right to not be held liable for any such action on our site(s).</p> -->
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