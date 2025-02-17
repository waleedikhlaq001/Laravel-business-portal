@extends('pages.app')

@php
$user = Auth::user();
@endphp

<style>
.error {
    color: red;
    font-size: 12px;
    font-weight: 400 !important;
}

.pirple-font {
    color: #6f3c96 !important;
}

.mantine-ewdd90 {
    border-top-color: #93CB52 !important;
}

</style>

@section('content')
@include('includes.messages')
<div class="container-fluid">

    <div id="milestone-module"></div>

</div>
@push('scripts')
<script>
const jobid = '{{ $jobid }}';
const in_id = '{{ $influencer_id }}';
const mstone = '{{ $milestone }}';
const subaccount = '{{ $subaccountId }}';
localStorage.setItem('m_data', JSON.stringify({
    mstone,
    in_id,
    jobid,
    subaccount
}));
</script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="{{ asset('client/milestones/index.js') }}"></script>
@endpush
@endsection
