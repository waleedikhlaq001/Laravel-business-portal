@extends('pages.app')

@section('content')
@include('includes.messages')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
        <div class="p-4 shadow">
            <div>Verify Your Phone Number</div>
            <hr>
            <form action="{{route('user.phone.verify')}}" method="POST">
                @csrf
                <small>Enter OTP sent to your number {{$phone_number}}</small>
                <input type="hidden" name="phone_number" value="{{$phone_number}}">
                <div class="form-floating mb-3 mt-2">
                    <input type="text" class="form-control" name="verification_code" id="floatingInput" placeholder="OTP">
                    <label for="floatingInput">OTP</label>
                </div>
                <button class="btn btn-success" type="submit">Verify Phone Number</button>
            </form>
        </div>
    </div>
</div>

@endsection
