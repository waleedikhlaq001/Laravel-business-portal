@extends('pages.app')

@section('content')

@include('includes.messages')
<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8">
                <h2>Videos</h2>
                <div class="img_area">
                    <img alt=""  src="img/about.png">
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
