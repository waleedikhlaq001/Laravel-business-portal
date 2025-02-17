@extends('pages.app')

@section('content')
<div>
    <section class="sectionPB" style="padding-top:40px;">
        <div class="container-fluid">
            <div class="row">
                @include('includes.messages')
                <div class="col-sm-12 col-md-6 col-lg-4 m-auto" id="log">
                    <div class="container p-4" style="border-radius: 5px; width: 100%;">
                        <h2 class="section_heading aUTHAEDER text-center"
                            style="font-weight: 300; color: #68a919; line-height: 50px; font-size: 20px;">Hi, Welcome
                            Back!</h2>

                        <div role="alert" id="alert" class="alert alert-danger alert-dismissible fade show"
                            style="font-size: 0.9rem; display: none;">
                            <button type="button" onclick="$('#alert').hide()" aria-label="Close" class="close"><span
                                    aria-hidden="true">×</span></button>
                        </div>

                        <form class="form1">

                            <input type="hidden" name="ref" value="{{$reff}}" />
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <div class="d-flex">
                                    <input type="password" class="form-control pass-input" name="password"
                                        placeholder="Password" id="password" required>
                                    <i class="fa fa-eye-slash toggle-pass text-secondary" style="align-self: center;
                                        margin-right: 15px;
                                        font-size: 25px !important;
                                        position: absolute;
                                        right: 30px;"></i>
                                </div>
                            </div>
                            {{-- <div class="form-floating mb-3 d-flex stf rounded  ">
                                <span class="input-group-text bg-transparent rounded-0 border-0"><i
                                        class="fa fa-envelope" aria-hidden="true"></i></span>
                                <input type="email" class="form-control rounded-0 border-0 st-input  " name="email"
                                    id="email" placeholder="Email Address" autofocus="autofocus" value="" required>
                                <label for="email" style="margin-left: 43px">Email address</label>
                            </div>
                            <div class="form-floating d-flex stf rounded  ">
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
                                <input type="password" class="form-control rounded-0 border-0 pass-input st-input  "
                                    name="password" placeholder="Password" id="xsspassword" required>

                                <label for="pasword" style="margin-left: 43px">Password</label>
                            </div> --}}

                            <div class="d-flex mt-4 justify-content-between">
                                <div class="form-check d-flex justify-content-center pl-4">
                                    <input class="form-check-input p-2" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label ml-2 mt-1" for="defaultCheck2">
                                        Remember Me
                                    </label>
                                </div>
                                <div>
                                    <a href="{{ route('auth.reset.email') }}" class="forgot">Forgot my password</a>
                                </div>
                            </div>
                            <button type="submit" id="btn" class="btn btn-primary btn-block mt-4">Log In</button>
                            <div class="aUTHDivDer my-2">
                                <div>
                                    <h6 class="text-uppercase pl-2 pr-2 mt-1">or</h6>
                                </div>
                            </div>
                            <a href="{{ route('login.google') }}" class="btn btn-block btn-google mt-2"> <img
                                    src="{{ asset('img/google.svg') }}" style="width: 25px;
                                    float: left;"> Log In with Google</a>
                            <a href="{{ route('login.facebook') }}" class="btn btn-block btn-facebook mt-2">
                                <img src="{{ asset('img/facebook.svg') }}" style="
                                float: left;"> Log In with Facebook</a>
                            {{-- <a href="{{route('login.instagram')}}" class="btn btn-primary btn-block btn-instagram
                            mt-2">
                            <i class="fab fa-instagram" aria-hidden="true"></i> | Connect Instagram</a> --}}
                            <div class="text-center mt-3 mb-4" style="font-size: 14px;">
                                Don't have an account <a href="{{ route('auth.welcome') }}">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 m-auto" id="ottp" style="display: none;">
                    <div class="container shadow p-4 paHtImg" style="border-radius: 5px; width: 100%;">
                        <img alt="" src="{{ asset('/img/path1.png') }}" class="p1">
                        <img alt="" src="{{ asset('/img/path2.png') }}" class="p2">
                        <h2 class="section_heading aUTHAEDER text-center mt-4"
                            style="font-weight: 300; color: #68a919; line-height: 30px; font-size: 20px;">Please check
                            your email for the<br> <b id="">OTP</b></h2>

                        <div role="alert" id="alert2" class="alert alert-danger alert-dismissible fade show"
                            style="font-size: 0.9rem; display: none;">
                            <button type="button" onclick="$('#alert2').hide()" aria-label="Close" class="close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form class="form2 pt-4">

                            <div class="form-floating d-flex stf rounded  ">
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
                                <input type="password" class="form-control rounded-0 border-0 pass-input st-input  "
                                    name="otp" placeholder="*******" id="otp" required>
                                <i class="fa fa-eye-slash toggle-pass text-secondary"
                                    style="align-self: center;margin-right: 15px;font-size: 25px!important;"></i>
                                <label for="otp" style="margin-left: 43px">OTP</label>

                            </div>
                            <div class="d-flex mt-4 justify-content-between">
                                <div>
                                    <a href="#" class="forgot">Didn't get the code? resend otp</a>
                                </div>
                            </div>
                            <div class="w-100"
                                style="display: flex; gap: 5px; align-items: center; justify-content: center;">
                                <button id="cancel" class="btn btn-outline-danger btn-block mt-4">Cancel</button>
                                <button type="submit" id="btn2" class="btn btn-primary btn-block mt-4">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
</div>

@endsection

@push("scripts")
<script>
    $('#cancel').click( function (event) {
        $("#log").show();
            // $("#emm").html(email);
            $("#ottp").hide();
            $("#otp").val("");
            $('#alert2').hide()
            $("#alert").hide()
     })

     $(document).on('click', '#resendVerification', function(event) {
    event.preventDefault();
    const email  = $("#email").val();
    // Send AJAX POST request to resend verification email
    // $("#alert").removeClass("alert-danger");
    $.ajax({
        url: '/email/resend', // URL of the resend verification endpoint
        type: 'POST',
        'data': {
			// 'dataname': $('input').val(), ...
			email: email,
			"_token": "{{ csrf_token() }}"
		},
        dataType: 'json',
        success: function(response) {
            // Handle success response
        $("#alert").removeClass("alert-danger")
		$("#alert").addClass("alert-success")
		// $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
        $("#alert").html(`<strong>Success!</strong> ${response.message}     <button type="button" onclick="$('#alert').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
		
            // You can show a success message or perform any other action here
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error resending verification email:', error);
            // You can show an error message or perform any other action here
        }
    });
});

        $('.form1').submit( function (event) {
	// prevent the usual form submission behaviour; the "action" attribute of the form
	event.preventDefault();
	// validation goes below...
const email  = $("#email").val()
const password  = $("#password").val()

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/login',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			email: email,
			password: password,
			"_token": "{{ csrf_token() }}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
			// anything you want to have happen before sending the data to the server...
			// useful for "loading" animations
			$("#btn").attr("disabled",true)
$("#btn").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  <span class="sr-only">Loading...</span>`)
$('#alert').hide()
		}
	})
	.done( function (response) {
		// what you want to happen when an ajax call to the server is successfully completed
		// 'response' is what you get back from the script/server
		// usually you want to format your response and spit it out to the page
        console.log(response);
        // if(response.two_fa == false){

			$("#alert").removeClass("alert-danger")
		$("#alert").addClass("alert-success")
		// $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
        $("#alert").html(`<strong>Success!</strong> ${response.message}     <button type="button" onclick="$('#alert').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
		location.href = response.redirect
        // }else {
        //     $("#alert").removeClass("alert-success")
		// 		$("#alert").addClass("alert-danger")
		// // $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)
        // $("#alert").html(`<strong>Error!</strong>Please verify your email address before logging in! <a href="" id="resendVerification">Resend verification email <button type="button" onclick="$('#alert').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
	 
           
        // }
	})
	.fail( function (code, status) {
		// what you want to happen if the ajax request fails (404 error, timeout, etc.)
		// 'code' is the numeric code, and 'status' is the text explanation for the error
		// I usually just output some fancy error messages
		$("#alert").removeClass("alert-success")
				$("#alert").addClass("alert-danger")
		// $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)
        $("#alert").html(`<strong>Error!</strong> ${code.responseJSON.message}     <button type="button" onclick="$('#alert').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
	 
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
$('#alert').show()
$("#btn").attr("disabled",false)
$("#btn").html(`Log in`)
	});
});
$('.form2').submit( function (event) {
	// prevent the usual form submission behaviour; the "action" attribute of the form
	event.preventDefault();
	// validation goes below...
const otp  = $("#otp").val()
const email  = $("#email").val()

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/login-2fa',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			email: email,
			otp: otp,
			"_token": "{{ csrf_token() }}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
			// anything you want to have happen before sending the data to the server...
			// useful for "loading" animations
			$("#btn2").attr("disabled",true)
$("#btn2").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  <span class="sr-only">Loading...</span>`)
$('#alert2').hide()
		}
	})
	.done( function (response) {
		// what you want to happen when an ajax call to the server is successfully completed
		// 'response' is what you get back from the script/server
		// usually you want to format your response and spit it out to the page
			$("#alert2").removeClass("alert-danger")
		$("#alert2").addClass("alert-success")
		// $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
        $("#alert2").html(`<strong>Success!</strong> ${response.message}     <button type="button" onclick="$('#alert2').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
		location.href = response.redirect
	})
	.fail( function (code, status) {
		// what you want to happen if the ajax request fails (404 error, timeout, etc.)
		// 'code' is the numeric code, and 'status' is the text explanation for the error
		// I usually just output some fancy error messages
		$("#alert2").removeClass("alert-success")
				$("#alert2").addClass("alert-danger")
		// $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)
        $("#alert2").html(`<strong>Error!</strong> ${code.responseJSON.message}     <button type="button" onclick="$('#alert2').hide()" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>`)
	 
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
$('#alert2').show()
$("#btn2").attr("disabled",false)
$("#btn2").html(`Submit`)
	});
});
         
</script>
@endpush