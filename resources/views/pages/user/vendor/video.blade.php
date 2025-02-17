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

.mantine-35689o {
    color: #6f3c96 !important;
    border: 1px solid #6f3c96 !important;
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

.mantine-1p1khox {
    border-top-color: #6f3c96 !important;
}

.mantine-sk8uha {
    background-color: #6f3c96 !important;
}

.mantine-1cnb47v {
    border-color: #93CB52 !important;
    color: #93CB52 !important;
}

.mantine-ewdd90 {
    border-top-color: #93CB52 !important;
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
    <div id="vicomma-chat-module"></div>
    <div id="video-module"></div>
</div>
@push('scripts')
<script>
var authEndpoint = '{{route("pusher.auth")}}';

//local
var actor = "{{Auth::user()->id}}";
var tkon = "{{ csrf_token() }}";
</script>
<script src="{{ asset('client/chat/index.js') }}"></script>
<script src="{{ asset('client/video/index.js') }}"></script>


@endpush
@endsection
