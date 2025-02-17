@extends('pages.app')
<meta name="id" content="{{ $id }}">
<meta name="type" content="{{ $type }}">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<style>
.form-group {
    transition: .5s;
}

.error {
    color: red;
    display: block;
    margin-top: .5rem;
}

</style>
@section('content')
@include('includes.messages')
<div id="vicomma-chat-module">
</div>
@push('scripts')
<!-- <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script> -->
<script>
// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

// var pusher = new Pusher("{{ config('chatify.pusher.key') }}", {
//     encrypted: true,
//     cluster: "{{ config('chatify.pusher.options.cluster') }}",
//     authEndpoint: '{{route("pusher.auth")}}',
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': "{{ csrf_token() }}"
//         }
//     }
// });

var authEndpoint = '{{route("pusher.auth")}}';

//local
var actor = "{{Auth::user()->id}}";
var tkon = "{{ csrf_token() }}";
</script>
<script src="{{ asset('client/chat/index.js') }}"></script>
@endpush
@endsection
