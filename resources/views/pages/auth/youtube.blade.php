@extends('pages.app')

@section('content')
<div>
    <section class="sectionPT sectionPB ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 offset-sm-0 offset-md-3 offset-lg-4">
                    <div class="container shadow p-4 paHtImg" style="height: 300px!important">
                        {{-- <img alt="" src="{{asset('img/path1.png')}}" class="p1">
                        <img alt="" src="{{asset('img/path2.png')}}" class="p2">
                        <h2 class="section_heading aUTHAEDER mb-2 text-center">Verify Email!</h2>
                        @include('includes.messages')
                        <h6 class="text-center" style="margin-top: 6rem;">Please verify that the email below is your
                            email address</h6>
                        <h5 class="text-center w-100 p-3 rounded" style="background: #eee;">
                            {{$email->email}}
                        </h5>
                        <form action="{{route('email.verify')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{$token}}">
                            <input type="hidden" name="email" value="{{$email->email}}">
                            <button type="submit" class="btn btn-primary mt-2 btn-block">Confirm!</button>
                        </form>
                        <p class="text-center text-snd mt-3" style="font-size: .8rem">
                            <i class="fa fa-info" aria-hidden="true"></i>
                            We take security seriously to protect our users
                        </p> --}}
                        <h1 class="text-center">Youtube successful</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection