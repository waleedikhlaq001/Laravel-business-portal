@extends('pages.app')


@section('content')

    <div id="final-payment" job="{{$job->id}}"></div>

@endsection

@push('scripts')
<script>
const jobid = '{{ $job->id }}';
const in_id = '{{ $influencer_id }}';
const mstone = '{{ $milestone }}';
const subaccount = '{{ $subaccountId }}';
const updaccess = '{{ route("user.job.update.payment.milestone") }}';
localStorage.setItem('final_m_data', JSON.stringify({
    mstone,
    in_id,
    jobid,
    subaccount
}));
</script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="{{ asset('client/milestones/final.js') }}"></script>
@endpush