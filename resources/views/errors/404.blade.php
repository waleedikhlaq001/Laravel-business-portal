@extends('pages.appcompact')
@push('css')

@endpush
@section('content')
    @include('includes.messages')
    <section class="sectionPT sectionPB privacy_policy">
    <div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="img_area"><img alt="" src="/img/video.png"></div>
        </div>
        <div class="col-md-7 boxVcenter">
            <div class="content text-center">
                <h2 class="section_heading" style="margin-bottom: 20px;">404 - Page Not Found </h2>
                <p class="text1" style="">
                The page you requested could not be found.
                 </p>
                 <a class="btn btn-secondary btn-sm" style="color: #fff!important;border-radius: 20px;padding-top: 6px;" href="/" role="button">Go Back</a>
            </div>
        </div>
    </div>
</div>
    </section>
    @include('pages.partials.footer')
    @endsection
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endpush
