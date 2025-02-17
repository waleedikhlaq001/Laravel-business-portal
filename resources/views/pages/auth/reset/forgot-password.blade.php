@extends('pages.app')
@section('content')
    <div>
        <section class="sectionPT sectionPB ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 offset-sm-0 offset-md-3 offset-lg-4">
                        <div class="container shadow p-4 paHtImg" style="height: 300px!important">
                            <img alt=""  src="img/path1.png" class="p1">
                            <img alt=""  src="img/path2.png" class="p2">
                            {{-- <h4 class="text-center font-weight-bold mb-7">Reset Password</h4> --}}
                            <h2 class="section_heading aUTHAEDER mb-7 text-center">Reset Password</h2>
                            <p class="mt-2 text-sm text-center text-muted">
                                Enter your Vicomma.com email address so we can reset your password.
                            </p>
                            <form action="{{route('auth.post.email')}}" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    @include('includes.messages')
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address">
                                    @error('email') 
                                        <div id="emailValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary btn-block mt-4">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
