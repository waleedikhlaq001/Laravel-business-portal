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
        <!-- <h1 class="sectionHeading3 mb-5">FAQ</h1> -->
        <div class="faq_image">
          <div class="img_area mb-5">
            <img alt="" src="/images/WEB-BANNERSFAQ.jpg" style="width: 100%">
          </div>
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
    <div id="accordion" class="faq_accordion mt-2">

      <div class="card">
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" href="#collapseOne">
            <span class="title content_heading1">
              What is Vicomma?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">

          </a>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            <p>Vicomma, Africa's first and only social viral platform for all things African.</p>
            <p>Social because you can interact, in real-time with, friends, fans, and celebrities. Viral because you can
              buy and sell merchandise, tickets, products, packages, events and more all through your videos; all on
              Vicomma! We connect Users and Vendors and vice versa through video. So stand out and let the world know
              who YOU are on the only platform of it's kind.</p>
            <p>Welcome to Planet <br> Vicomma.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
            <span class="title content_heading1">
              How can I find out how to do stuff on Vicomma?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseOffer">
            <span class="title content_heading1">
              What does Vicomma offer Users?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapseOffer" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
            <span class="title content_heading1">
              What is a Vendor on Vicomma?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapseThree" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
            <span class="title content_heading1">
              What is a Vendor Station?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapseFour" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
            <span class="title content_heading1">
              How do I create a Vendor Station?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse4" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
            <span class="title content_heading1">
              What can I do with a Station?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse5" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
            <span class="title content_heading1">
              How do I Upload a video?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse6" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse7">
            <span class="title content_heading1">
              Can I make money on Vicomma?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse7" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse8">
            <span class="title content_heading1">
              How much does Vicomma cost?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse8" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapse11">
            <span class="title content_heading1">
              How to Add Products and Events?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapse11" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseaddpackage">
            <span class="title content_heading1">
              How many products, events, packages can I add to my station?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapseaddpackage" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#payments">
            <span class="title content_heading1">
              How do I receive payments after a customer transaction?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="payments" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Lorem ipsum..
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#videoguide">
            <span class="title content_heading1">
              What is the format for videos on the platform?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="videoguide" class="collapse" data-parent="#accordion">
          <div class="card-body">
            <p>The following guidelines describe the formatting specifications that yield the highest quality for
              playing videos on Vicomma. Vicomma encourages partners to upload videos that are as close to the original,
              high quality source format as possible to increase the likelihood that your videos will play in higher
              quality (HQ).

            <ul style="padding-left: 2rem;!important; list-style: disc;">
              <li><b>File format:</b> Vicomma prefers the original, 1080p HD broadcast format that you have in your
                digital content library, as well as DVD-compliant MPEG-2 program streams saved with a .MPG extension. If
                you cannot submit videos in MPEG-2 format, then MPEG-4 is the preferred format. The following
                specifications provide optimal playback of MPEG-2 and MPEG-4 videos:
                <ul style="padding-left: 2rem;!important; list-style: circle;">
                  <li>
                    <b>MPEG-2</b>
                    <ul>
                      <li>
                        <b>Audio codec:</b> MPEG Layer II or Dolby AC-3
                      </li>
                      <li>
                        <b>Audio bitrate:</b> 128 kbps or better
                      </li>
                    </ul>
                  </li>
                  <li>
                    <b>MPEG-4</b>
                    <ul>
                      <li><b>Video codec:</b> H.264</li>
                      <li><b>Audio codec:</b> AAC</li>
                      <li><b>Audio bitrate:</b> 128 kbps or better</li>
                  </li>
                </ul>

            </ul>
            </li>
            <li><b>Minimum audio-visual duration:</b> 33 seconds (excluding black and static images in the video channel
              as well as silence and background noise in the audio channel)</li>
            <li><b>Framerate:</b> Videos should be in their native frame rates without resampling. For film sources, a
              24fps or 25fps progressive master yields the best results. Typically, frame rates are set at 24, 25 or 30
              frames per second. Please do not use resampling techniques since they can cause images to shudder and
              often result in lower quality video. Examples of undesirable techniques include upsampling and transfer
              processes such as Telecine pulldown.</li>
            <li><b>Aspect ratio:</b> Videos should be in their native aspect ratios, and uploaded videos should never
              include letterboxing or pillarboxing bars.
              <ul style="padding-left: 2rem;!important; list-style: circle;">
                <li>If the video's native aspect ratio is 1.77:1 and the total frame size also has a 1.77:1 aspect
                  ratio, use 16:9 matting with square pixels and no border.</li>
                <li>If the video's native aspect ratio is 1.77:1 and the total frame size does not have a 1.77:1 aspect
                  ratio, use 16:9 matting with square pixels and a single-color border with no variations over time.
                </li>
                <li>If the video's native aspect ratio is 1.33:1 and the total frame size also has a 1.33:1 aspect
                  ratio, use 4:3 matting with square pixels and no border.</li>
                <li>If the video's native aspect ratio is 1.33:1 and the total frame size does not have a 1.33:1 aspect
                  ratio, use 4:3 matting with square pixels and a single-color border with no variations over time.</li>
                If theatrical releases have a "pan-and-scan" version as well as the original 16:9 version, upload both
                versions separately.
            </li>
            </ul>
            <li><b>Video resolution:</b> Vicomma prefers high-definition videos and, in general, you should provide
              videos in the highest resolution available to provide the maximum degree of flexibility in the encoding
              and playback processes. For videos intended for sale or rental, you should provide a minimum resolution of
              1920x1080 with a 16:9 aspect ratio. For content with or without ads, Vicomma does not set a minimum
              resolution but recommends a resolution of at least 1280x720 for video that has a 16:9 aspect ratio and a
              resolution of at least 640x480 for video that has a 4:3 aspect ratio.</li>
            You may consider providing reduced quality videos if those videos will not be publicly visible on Vicomma
            and are only being uploaded to serve as Content ID references. These videos can be a typical "one quarter"
            resolution – i.e. 320x240. However, the videos must be greater than 200 lines to yield effective references.

            <li><b>Video bitrate:</b> Since bitrate is highly dependent on codec, there is no recommended minimum value.
              Videos should be optimized for frame rate, aspect ratio and resolution rather than bitrate. Bitrates of 50
              or 80Mbps are common for videos intended for sale or rental.</li>
            </ul>
            If you are unable to encode your videos using the preferred specifications, you can still submit your video
            in .WMV, .AVI, .MOV and .FLV formats. In this case, we recommend that you upload the highest quality video
            possible. Vicomma will still accept your video content and then re-encode your video files as necessary.
            However, the quality of your videos may not be optimal and could make your videos ineligible for HQ
            encoding. If you are not able to encode your videos using the preferred specifications, we recommend that
            you upload a few test videos online to ensure that you are satisfied with the playback quality on Vicomma.
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#collapsefee">
            <span class="title content_heading1">
              What are the fees for making a sale on Vicomma?
            </span>

            <img alt="" class="icon" src="img/accordionicon.png">
          </a>
        </div>
        <div id="collapsefee" class="collapse" data-parent="#accordion">
          <div class="card-body">
            <p>Below are the fees associated with sales made on the Vicomma platform. There are several fee options
              available depending if you are an independent Vendor or if you are a Vendor who wants to utilize the
              services of the Content Providers and creatives in our database These percentages are also dictated by the
              size of your business. In some cases. the Content Provider/Creative may also request a flat deposit to
              begin the process. This will all be negotiated upon your request. Please feel free to email us at
              info@vicomma.com for any questions.</p>


            <div class="table-responsive">
              <table class="table table-striped table_style2">
                <thead>
                  <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Fee(% per sale)</th>
                    <th scope="col">Small Business</th>
                    <th scope="col">Mid Size Business</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td scope="row">Automobile & Industrial </td>
                    <td>7.00%</td>
                    <td>12.00%</td>
                    <td>17.00%</td>
                    <td>32.00%</td>
                  </tr>
                  <tr>
                    <td scope="row">Baby, Kids & Toys</td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Beauty, Health & Personal Care</td>
                    <td>16.00%</td>
                    <td>21.00%</td>
                    <td>26.00%</td>
                    <td>41.00%</td>
                  </tr>
                  <tr>
                    <td scope="row">Office & School Supplies </td>
                    <td>12.50%</td>
                    <td>17.50%</td>
                    <td>22.50%</td>
                    <td>37.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Computers & Accessories </td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Electronics </td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Drinks & Groceries </td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Fashion</td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                  <tr>
                    <td scope="row">Drinks & Groceries </td>
                    <td>13.50%</td>
                    <td>18.50%</td>
                    <td>23.50%</td>
                    <td>38.50%</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

    </div>
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