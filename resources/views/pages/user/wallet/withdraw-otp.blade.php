@extends('pages.app')

@push('css')
    <style>
        .verify-div{
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
        <div class="col-md-8 text-center" style="border: 1px solid gray; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <p class="text-center">OTP was sent to your email {{auth()->user()->email}}</p>
            <form action="{{route('gwallet.withdraw')}}" class="mb-0" method="POST">
                @csrf
                <input type="hidden" name="withdrawal_amt" value="{{$withdrawal_amt}}">
                <input name="withdrawal_token" value="" placeholder="">
                <center><button type="submit" class="btn btn-primary btn-sm mt-2">Continue</button></center>
            </form>
            <small>OTP expires in 5 minutes</small>
        </div>
    </div>
@endsection