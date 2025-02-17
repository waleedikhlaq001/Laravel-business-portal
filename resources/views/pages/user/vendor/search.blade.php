@extends('pages.app')

<style>
.css-18stlw0,
.css-14lr3b6-MuiButtonBase-root-MuiChip-root {
    background-color: #94CA52 !important;
    border-radius: 0 !important;
}

.css-18stlw0 .css-14lr3b6-MuiButtonBase-root-MuiChip-root .MuiChip-deleteIcon {
    color: rgb(20 18 18 / 70%) !important;
}

.mantine-tegy7k {
    background-color: #94CA52 !important;
}

</style>
@section('content')
@include('includes.messages')

<div>
    <!-- <pre>
    {{ $jobs->toJson()}}
    </pre> -->

    <div id="creativeSearch-module">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="for-creative"></div>
</div>

@push('scripts')
<script>
var currentJobs = "{{ $jobs->toJson()}}";
var availableJobsEndpoint = "{{ route('user.jobs.available') }}";
</script>
<script src="{{ asset('client/jobs/index.js') }}"></script>
@endpush
@endsection
