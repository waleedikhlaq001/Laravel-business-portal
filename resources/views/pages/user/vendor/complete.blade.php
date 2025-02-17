@extends('pages.app')

@php
$user = Auth::user();
@endphp
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<style>
.error {
    color: red;
    font-size: 12px;
    font-weight: 400 !important;
}

.mantine-ctnni {
    border-top-color: #6f3c96 !important;
}

.mantine-35689o {
    color: #6f3c96 !important;
    border: 1px solid #6f3c96 !important;
}

.mantine-sk8uha {
    background-color: #94CA52 !important;
}

.mantine-1cnb47v {
    background-color: #94CA52 !important;
    color: #fff !important;
    border: 1px solid #94CA52 !important;
}

.mantine-a4vf5g {
    text-align: center;
}

.mantine-a4vf5g:focus {
    color: #6f3c96 !important;
    border: 1px solid #6f3c96 !important;
}

.pirple-font {
    color: #6f3c96 !important;
}

.mantine-1xz4396 {
    height: 445 !important;
}

video {
    width: 100%;
}

.video-wrapper {
    width: 100%;
    position: relative;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

</style>

@section('content')
@include('includes.messages')
<div class="container-fluid">
    <div id="vicomma-complete-module"></div>
</div>
@push('scripts')
<script>
var authEndpoint = '{{route("pusher.auth")}}';

//local
var actor = "{{Auth::user()->id}}";
var tkon = "{{ csrf_token() }}";
</script>
<script src="{{ asset('client/video/accept.js') }}"></script>


@endpush
@endsection
