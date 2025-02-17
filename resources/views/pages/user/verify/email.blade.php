@extends('pages.app')

@push('css')
<style>
    .verify-div {
        height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
@endpush

@section('content')
@include('includes.messages')
<div class="verify-div">
    <div class="col-md-8 text-center">
        <p class="text-center">Check and verify your email to continue. Click Resend if you did not receive an email.
        </p>
        <form action="{{route('user.verify.email')}}" class="mb-0" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{auth()->user()->email}}">
            <center><button type="submit" class="btn btn-primary btn-sm">Resend</button></center>
        </form>
        <small>If you have verified your email, refresh this page</small>
    </div>
</div>
@endsection