@extends('pages.app')
<style>
    #name:focus {
        border-color: #6f3c96;
    }

</style>
@section('content')
<div>
    <section class="sectionPB">
        <div class="container-fluid">
            <div class="row">
                @include('includes.messages')
                <div class="col-sm-12 col-md-6 col-lg-4 m-auto">
                    <div class="container shadow p-4 paHtImg"
                        style="width: 100%; border-radius: 5px;padding-bottom: 70px!important;">
                        <img alt="" src="img/path1.png" class="p1">
                        <img alt="" src="img/path2.png" class="p2">
                        <h2 class="section_heading aUTHAEDER text-center">Join us on Vicomma!</h2>

                        <a href="/post/job" class="btn shadow-sm btn-light d-flex mb-3"
                            style="align-items: center;gap: 10px;">
                            <img src="/img_1.png">
                            <b>Hire a creative</b>
                        </a>

                        <a href="/register/creative" class="btn shadow-sm btn-light d-flex mb-3"
                            style="align-items: center;gap: 10px;">
                            <img src="/img_2.png">
                            <b>Earn Money Creating</b>
                        </a>

                        <a href="{{ url('/buyregister') }}" class="btn shadow-sm btn-light d-flex mb-4"
                            style="align-items: center;gap: 10px;">
                            <img src="/img_3.png">
                            <b>Watch and Buy</b>
                        </a>


                        <div class="text-center mt-4" style="font-size: 14px;">
                            Already have an account <a href="{{route('auth.login')}}">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection