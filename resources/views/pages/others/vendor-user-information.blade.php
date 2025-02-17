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

    .txt ul {
        list-style: disc;
        padding-left: 20px;
    }

    .txt li {
        margin-bottom: 5px;
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
<section class="sectionPT sectionPB vendro_user_information px-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1 class="sectionHeading3 mb-5">{{$info->title}}</h1> -->
                <div class="img_area mb-5">
                    <img alt="" src="/WEB-BANNERSAGREEMENT.jpeg">
                </div>



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
        {!! $info->body !!}
        <!-- <h1 class="content_heading1">How vicomma Keeps You Safe Online</h1>
                        <br>
                        <h4 class="content_heading1">Buyer Safety Algorithms</h4>
                        <p>vicomma has developed and continuously updates proprietary software algorithms to automatically monitor data for patterns, and quickly detect potential risks and violations.</p>

                        <h4 class="content_heading1">Community Reporting</h4>
                        <p>We encourage our buyer community to report inappropriate or suspicious activity. To file a report please email trustandsafety@vicomma.com or visit the Send Us A Quick Message page.</p>

                        <h4 class="content_heading1">Trust and Safety Teams</h4>
                        <p>In addition to data-driven algorithms and automated tools, vicomma has a number of teams focused on protecting the integrity of vicomma’s marketplace by proactively investigating, sanctioning, and preventing various types of inappropriate behavior.</p>

                        <h4 class="content_heading1">Merchant Quality Assurance</h4>
                        <p>In addition to data-driven algorithms and automated tools, vicomma has a number of teams focused on protecting the integrity of vicomma’s marketplace by proactively investigating, sanctioning, and preventing various types of inappropriate behavior.</p>

                        <h1 class="content_heading1">Improve You Purchase Experience On vicomma</h1>

                        <h4 class="content_heading1">Quickly Find Your Preferred Items By Filtering Search Results</h4>
                        <p>vicomma has developed and continuously updates proprietary software algorithms to automatically monitor data for patterns, and quickly detect potential risks and violations.</p>

                        <h4 class="content_heading1">Inspect Product Details and Ratings & Reviews Before You Purchase</h4>
                        <p>Inspecting details & reviews can help prevent surprises and confirm that an item meets your needs. Stronger ratings & reviews indicate safer, more trustworthy vendors.</p>

                        <h4 class="content_heading1">If You Have Outstanding Questions Or Concerns, Message The Vendor Before You Buy</h4>
                        <p>If you have questions/concerns about a product, vicomma makes it easy to contact the vendor before you buy — just send the Vendor a chat in real time.</p>

                        <h4 class="content_heading1">Double-Check the Items In Your Order Before Paying</h4>
                        <p>Before you choose your payment method, take a second to check that your order contains the items and quantities you want.</p>

                        <h4 class="content_heading1">Double-Check Your Phone Number And Delivery Address Before Paying</h4>
                        <p>Before you choose your payment method, check your contact details to make sure that you can be contacted about your delivery.</p>

                        <h4 class="content_heading1">Pay When You Checkout To Receive Maximum Protection</h4>
                        <p>When you pay at checkout, vicomma holds your payment (temporarily) before forwarding it to the vendor& can protect you 100% if things somehow don’t go as planned.</p>


                        <h4 class="content_heading1">Check Your SMS & Email For Messages About Your Transaction</h4>
                        <p>After you place your order, vicomma will send you an order confirmation by email; we will eventually be adding an SMS communications option for users. Check for communications about your order.</p>

                        <h1 class="content_heading1">What You Should Know</h1>
                        <h4 class="content_heading1">Not all products on vicomma are sold by vicomma</h4>
                        <p>vicomma is a true online marketplace that supports African entrepreneurs. Supporting ‘third-party’ vendors means vicomma can offer buyers wider product selection, more choice, increased convenience, and better pricing. To learn more about selling on vicomma, please Send Us A Quick Message.</p>

                        <h4 class="content_heading1">Not every order goes perfectly every time, but if things don’t go as planned vicomma is here to help</h4>
                        <p>Generally, vicomma vendors have a remarkable track record. Most orders go wonderfully, but selling online may be new for some Vendors and despite best efforts mistakes can sometimes happen. In the rare event things don’t go as planned, vicomma has a number of teams working to help make things right. To contact us about a purchase, email mypurchase@vicomma.com.</p>


                        <h4 class="content_heading1">Your feedback matters</h4>
                        <p>When you place an order, you trust the vendor to deliver a quality product as described and on time. So vicomma makes it easy for you to research both the item and the vendor before you buy. You can read the item’s description and check how past buyers rated and reviewed the vendor and the item. When your order is delivered, we will ask you to rate and review the transaction and over time we remove lower performing vendors to make vicomma safer for you</p>

                        <h1 class="content_heading1">Frequently Asked Questions</h1>


                        <h2 class="content_heading1">Inspect Product Details and Ratings & Reviews Before You Buy</h2>
                        <P>Inspecting details & reviews can help prevent surprises and confirm that an item meets your needs. Stronger ratings & reviews indicate safer, more trustworthy vendors.</P>

                        <h2 class="content_heading1">If You Have Outstanding Questions Or Concerns, Message The Vendor Before You Buy</h2>
                        <p>If you have questions/concerns about a product, vicomma makes it easy to contact the vendor before you buy — just send the Vendor a chat in real time.</p>

                        <h2 class="content_heading1">How does vicomma protect me from fake or substandard products?</h2>
                        <p>vicomma has a formal Authentic Items Policy that prohibits the sale of counterfeit items, and our team continuously monitors items offered for sale. Vendors who are found to violate the policy may be banned from selling on vicomma. If you suspect an item displayed on the website is not authentic, please contact trustandsafety@vicomma.com.</p>

                        <h2 class="content_heading1">I just received my order and something is wrong, what should I do? What can I expect?</h2>
                        <p>If you recently received your order and something is wrong, please email mypurchase@vicomma.com and provide details. Depending on the exact issue and whether you paid before delivery or paid on delivery, different resolutions can occur. But in all cases, vicomma will offer support and will try to work with the vendor to offer a resolution quickly, such as a repair, replacement, refund upon return, instant refund, or other form of compensation as applicable. Please refer to more details on our Return Policy page.</p>

                        <h2 class="content_heading1">How do I avoid fraudulent individuals posing as genuine vendors?</h2>
                        <p>We take various actions to keep fraudulent individuals out of our community including requiring vendors to undergo verification before listing products. If you feel that a vendor is potentially fraudulent, please contact trustandsafety@vicomma.com</p>

                        <h2 class="content_heading1">Can I trust all vendors on vicomma? How do I know which vendors to trust?</h2>
                        <p>vicomma has several processes in place to make sure vendors are safe and worthy of your trust. All vendors go through verification processes and we continuously monitor vendor behavior. In addition, you can inspect a vendor’s ratings and reviews — stronger ratings & reviews indicate safer, more trustworthy vendors. We take our responsibility to provide a safe marketplace very seriously, but sometimes bad behavior does happen. If you feel that a vendor has violated your trust by misrepresenting an item or otherwise acting inappropriately, please contact trustandsafety@vicomma.com.</p>

                        <h2 class="content_heading1">I appreciate vicomma’s efforts on my behalf. What can I do to help?</h2>
                        <p class="m-0">We thank you for you business and we will continue to make sure vicomma remains the safest and most trusted place to buy and sell online in Africa. You can help by: </p>
                        <ul class="_list1">
                            <li>paying online at checkout when you place an order</li>
                            <li>providing honest ratings & reviews for all of your items after delivery (so you and other members of our buyer’s marketplace can have more information about items and vendors)</li>
                            <li>interacting with us on Twitter, Instagram, and/or Facebook (so we can hear your feedback and suggestions directly)</li>
                            <li>referring us to your friends and family (so we can increase the size of our community and help more Africans enjoy purchasing through video while making the experience safe & secure!</li>
                        </ul> -->
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