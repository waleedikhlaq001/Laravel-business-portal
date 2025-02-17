@extends('pages.app')

@section('content')
    <div>
        <section class="sectionPT sectionPB ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 offset-sm-0 offset-md-3 offset-lg-4">
                        <div class="container shadow p-4 paHtImg">
                            <img alt=""  src="{{asset('img/path1.png')}}" class="p1">
                            <img alt=""  src="{{asset('img/path2.png')}}" class="p2">
                            <h4 class="text-center font-weight-bold mb-7">Reset Password</h4>
                            @include('includes.messages')
                            <form action="{{route('auth.reset.password')}}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group mt-3">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address">
                                    @error('email') 
                                        <div id="passwordValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password') 
                                        <div id="passwordValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                                    @error('password_confirmation') 
                                        <div id="passwordValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary btn-block mt-4">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
