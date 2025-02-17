@extends('pages.app')
<style>
    #name:focus {
        border-color: #6f3c96;
    }

</style>
@section('content')
<div>
    <section>
        <div class="">
            <div class="row" style="min-height: 100vh">
                {{-- @include('includes.messages') --}}
                <div class="col-sm-12 col-md-6 col-lg-5">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7" style="background: white;border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;">
                    <div class="row d-flex justify-content-center" style="height: 100%">
                        <span class="text-end mt-2" style="height: 0px">Already have an account? <a
                                class="btn btn-google" style="border-radius: 10px;
                                line-height: 0.6;" href="{{route('auth.login')}}">Log
                                In</a></span>
                        <div class="col-lg-5 col-sm-12 mt-sm-5">
                            <div class="container p-4 paHtImg text-center" style="border-radius: 5px;">
                                <img src="{{ asset('img/logo-text.png') }}">
                                <h2 class="section_heading aUTHAEDER mt-3">Sign Up!</h2>

                                <form action="{{route('register.first')}}" method="POST">

                                    @csrf
                                    @php
                                    $errorExists = false;
                                    foreach ($errors->keys() as $errorKey) {
                                    if ($errors->has($errorKey)) {
                                    $errorExists = true;
                                    break;
                                    }
                                    }
                                    @endphp

                                    @if($errorExists)
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
            hideSocial();
        });
                                    </script>
                                    @endif
                                    <div style="display:none" id="withemail">
                                        <div class="form-floating d-flex stf mt-3 rounded @error('first_name') is-invalid @enderror"
                                            id="floatingInput">
                                            <span class="input-group-text bg-transparent" style="border: 0;">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" name="first_name"
                                                class="form-control rounded-0 border-0 st-input @error('first_name') is-invalid @enderror"
                                                placeholder="First name" autofocus value="{{old('first_name')}}"
                                                required>
                                            <label for="first_name" style="margin-left: 37px">First Name</label>
                                        </div>

                                        @error('first_name')
                                        <script>
                                            hideSocial();
                                        </script>
                                        <div id="first_nameValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div
                                            class="form-floating d-flex stf mt-3 rounded @error('last_name') is-invalid @enderror">
                                            <span class="input-group-text bg-transparent" style="border: 0;">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" name="last_name"
                                                class="form-control rounded-0 border-0 st-input @error('last_name') is-invalid @enderror"
                                                placeholder="Last name" value="{{old('last_name')}}" required>
                                            <label for="last_name" style="margin-left: 37px">Last Name</label>
                                        </div>
                                        @error('last_name')
                                        <script>
                                            hideSocial();
                                        </script>
                                        <div id="last_nameValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div
                                            class="form-floating d-flex stf mt-3 rounded @error('email') is-invalid @enderror">
                                            <span class="input-group-text bg-transparent" style="border: 0;">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" name="email"
                                                class="form-control rounded-0 border-0 st-input @error('email') is-invalid @enderror"
                                                placeholder="Email Address" value="{{old('email')}}" required>
                                            <label for="email" style="margin-left: 37px">Email Address</label>
                                        </div>
                                        @error('email')
                                        <script>
                                            hideSocial();
                                        </script>
                                        <div id="emailValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        <div
                                            class="form-floating d-flex stf mt-3 rounded @error('password') is-invalid @enderror">
                                            <span class="input-group-text bg-transparent" style="border: 0;">
                                                <svg width="19" height="25" viewBox="0 0 31 45" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M24.0859 17.5594H6.23486V9.87035C6.23447 8.69818 6.465 7.53742 6.9133 6.45436C7.3616 5.37131 8.01889 4.38718 8.8476 3.5582C9.6763 2.72921 10.6602 2.0716 11.7431 1.62294C12.826 1.17428 13.9867 0.943359 15.1589 0.943359V0.943359C17.5265 0.943359 19.7971 1.88388 21.4712 3.55801C23.1454 5.23215 24.0859 7.50276 24.0859 9.87035V17.5594Z"
                                                        stroke="#6F3C96" stroke-miterlimit="10" />
                                                    <path
                                                        d="M27.533 16.5H2.78799C2.08189 16.5005 1.40484 16.7813 0.905548 17.2805C0.406253 17.7798 0.12553 18.4569 0.125 19.163V29.455C0.125 33.4424 1.70896 37.2665 4.52847 40.086C7.34799 42.9055 11.1721 44.4895 15.1595 44.4895C19.1469 44.4895 22.971 42.9055 25.7905 40.086C28.61 37.2665 30.194 33.4424 30.194 29.455V19.165C30.1942 18.8153 30.1256 18.4689 29.992 18.1458C29.8584 17.8226 29.6625 17.5289 29.4154 17.2814C29.1683 17.0339 28.8749 16.8375 28.5519 16.7035C28.2289 16.5694 27.8827 16.5003 27.533 16.5ZM16.933 29.8V36.91H13.383V29.8C12.8503 29.4981 12.4061 29.0617 12.0948 28.5343C11.7835 28.007 11.616 27.4073 11.609 26.795C11.609 25.8535 11.983 24.9505 12.6487 24.2848C13.3145 23.619 14.2175 23.245 15.159 23.245C16.1005 23.245 17.0035 23.619 17.6692 24.2848C18.335 24.9505 18.709 25.8535 18.709 26.795C18.7007 27.4062 18.5328 28.0047 18.2217 28.5309C17.9107 29.0572 17.4675 29.493 16.936 29.795L16.933 29.8Z"
                                                        fill="#6F3C96" />
                                                </svg>
                                            </span>
                                            <input type="password" name="password"
                                                class="form-control rounded-0 border-0 pass-input st-input @error('password') is-invalid @enderror"
                                                placeholder="Password" value="{{old('password')}}" required>
                                            <i class="fa fa-eye-slash toggle-pass text-secondary"
                                                style="align-self: center;margin-right: 15px;font-size: 25px!important;"></i>
                                            <label for="password" style="margin-left: 37px">Password</label>
                                        </div>
                                        @error('password')
                                        <script>
                                            hideSocial();
                                        </script>
                                        <div id="passwordValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="form-floating d-flex stf mt-3 rounded">
                                            <span class="input-group-text bg-transparent" style="border: 0;">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" name="ref_code"
                                                class="form-control rounded-0 border-0 st-input"
                                                placeholder="Referral Code" value="">
                                            <label for="ref_code" style="margin-left: 37px">AUC Code (Optional)</label>
                                        </div>
                                        <div class="form-group mt-2 mb-0">
                                            {{-- CAPTCHA --}}
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                        @error('g-recaptcha-response')
                                        <script>
                                            hideSocial();
                                        </script>
                                        <div id="captchaValidation" class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <button class="btn btn-primary btn-block mt-3">Join Vicomma</button>
                                    </div>
                                    <div id="social-login">
                                        <a href="{{route('login.google')}}" class="btn  btn-block btn-google mt-2">
                                            <img src="{{ asset('img/google.svg') }}" style="width:25px;
                                        float: left;"> Continue with Google</a>
                                        <a href="{{route('login.facebook')}}" class="btn  btn-block btn-facebook mb-3">
                                            <img src="{{ asset('img/facebook.svg') }}" style="
                            float: left;"> Log In with Facebook</a>
                                        <div class="aUTHDivDer">
                                            <div>
                                                <h6 class="text-uppercase pl-2 pr-2 mt-1">or</h6>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-block mt-3"
                                            onclick="hideSocial()">Join Vicomma</button>
                                    </div>



                                    {{-- <p class="text-muted">
                                    Your personal data will be used to support your experience throughout this website,
                                    to manage access to your account, and for other purposes described in our Terms & Conditions ,
                                    Online Video Upload Agreements and privacy policy .
                                </p> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
<script>
    function hideSocial() {
        var socialLogin = document.getElementById('social-login');
        var withEmail = document.getElementById('withemail');
    
        // Check if the social-login is visible
        if (socialLogin.style.display === 'none') {
            socialLogin.style.display = 'block';  // Show the social login buttons
            withEmail.style.display = 'none';     // Hide the email form
        } else {
            socialLogin.style.display = 'none';   // Hide the social login buttons
            withEmail.style.display = 'block';    // Show the email form
        }
    }
</script>