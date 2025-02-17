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
<section class="sectionPT sectionPB privacy_policy">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1 class="sectionHeading3 mb-5">Privacy Policy</h1> -->
                <div class="img_area mb-5">
                    <img alt="" src="/images/WEB-BANNERSPRIVACY POLICY.jpg" style="width: 100%">

                </div>
                <p class="m-0">The privacy of visitors to this site is very important to us. This Privacy Policy gives
                    you information on what types of </p>
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
        <p>personal information we collect when you use this site, and our practices with respect to the use and
            disclose of such information. By visiting vicomma.com or vicommaentertainment.com (collectively “vicomma”
            all which fall under the vicomma ENTERTAINMENT COMPANY LLC.), you agree to this Privacy Policy and to the
            Terms of Service (TOS).</p>
        <h2 class="content_heading1">Information We Collect By Default</h2>


        <p>We receive and may store any personal information you enter on your website or may give us in any other way.
            This
            information may include your name or email address, content you submit to the website, and other information
            When we disclose information about you: </p>

        <p> We may automatically receive and store certain types of information whenever you intreact with us For
            example, vicomma allows guest commenting. when you make a guest comment, we may publish the content of your
            comment
            and may collect your IP (internet protocol) address, the time and the date your made the comemnt. we do not
            use cookies to collect or store information about you.</p>

        <h2 class="content_heading1">How We Use The Information You Provide Us</h2>

        <p>We may use the information that you provide for a variety of purposes, including to respond to your requests,
            to improve the overall quality of the Website, and to communicate with you, among other things.</p>

        <p> When we disclose information about you:</p>

        <p>We never disclose your personal information to third parties.</p>

        <p>For information you give us, or information we automatically collect, certain records may be produced to law
            enforcement or private litigants in response to valid legal process. vicomma reserves the right to cooperate
            with government and law enforcement officials and private parties to enforce and comply with the law. We
            reserve the right to disclose any information about you to government or law enforcement officials or
            private parties as we, in our sole discretion, believe necessary or appropriate to respond to claims and
            legal process (including but not limited to subpoenas), to protect the property and rights of vicomma or a
            third party, to protect the safety of the public or any person, or to prevent or stop any activity we may
            consider to be, or to pose a risk of being, illegal, unethical, inappropriate or legally actionable.</p>

        <p>vicomma also reserves the right to, but is not obligated to, refuse to disclose confidential sources or
            unpublished information we collect as part of our journalistic and/or news gathering and reporting under
            federal and/or state law.</p>

        <h2 class="content_heading1">Information Our Advertising Parties Collect By Defaul</h2>
        <p>We use third party advertisements to support our site. Some of these advertisers may use technology such as
            cookies and web beacons when they advertise on our site, which will send these advertisers (such as Google
            through the Google AdSense program) information including your IP address, your ISP, the browser you used to
            visit our site, and in some cases, whether you have Flash installed. You can choose to disable or
            selectively turn off our cookies or third-party cookies in your browser settings, or by managing preferences
            in programs such as Norton Internet Security. However, this can affect how you are able to interact with our
            site as well as other websites. vicomma has no control over these ad providers’ practices and you should
            review their privacy policies and steps for managing cookies.</p>

        <p>We use third-party advertising companies to serve ads when you visit our Web site. These companies may use
            aggregated information (not including your name, address, email address or telephone number) about your
            visits to this and other Web sites in order to provide advertisements about goods and services of interest
            to you. If you would like more information about this practice and to know your choices about not having
            this information used by these companies, please see: http://www.networkadvertising.org/managing/opt_out.asp
        </p>

        <p>GDPR Disclaimer: Our advertising demand partners, supported advertising mediation partners, data partners,
            and fraud and measurement partners have a legitimate interest to collect and profile personal data in the
            form of IP address and cookie ID from users on our website in order to provide targeted online advertising
            and ad measurement. For more details including opt-out requests, access requests or complaints, please email
            legal@vicomma.com.</p>

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