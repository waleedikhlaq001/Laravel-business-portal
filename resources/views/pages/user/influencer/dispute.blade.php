@extends('pages.app')

<style>
.pirple-font {
    color: #6f3c96 !important;
}

</style>
@section('content')
@include('includes.messages')

<div>
    <div id="dispute-module">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@push('scripts')
<script>
var job_id = "{{ $job_id }}";
var actor_type = "{{ $actor_type }}";
</script>
<script src="{{ asset('client/dispute/index.js') }}"></script>
@endpush
@endsection
