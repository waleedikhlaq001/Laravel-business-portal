@extends('pages.app')
<style>

</style>
@section('content')
@include('includes.messages')

<div>
    <!-- <pre>
    {{ $jobs->toJson()}}
    </pre> -->

    <div id="category-details-module"></div>

    <script>
    var currentJobs = "{{ $jobs->toJson()}}";
    var availableJobsEndpoint = "{{ route('user.jobs.available') }}";
    </script>
    <script src="{{ asset('client/jobs/browse.js') }}"></script>

</div>
@endsection
