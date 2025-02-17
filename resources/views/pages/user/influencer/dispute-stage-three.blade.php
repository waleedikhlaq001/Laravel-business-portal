@extends('pages.app')

<style>
.pirple-font {
    color: #6f3c96 !important;
}

.mantine-ctnni {
    border-top-color: #6F3C96 !important;
}

</style>
@section('content')
@include('includes.messages')

<div>
    <div id="dispute-three-module">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('client/dispute/index.js') }}"></script>
@endpush
@endsection
