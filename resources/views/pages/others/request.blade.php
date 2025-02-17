@extends('pages.app')
@push('css')
<style>
    .right_sidebar .img_area {
    width: 100px;
    height: 100px;
    display: inline-block;
    vertical-align: middle;
}

.sectionP{
    zoom: 80%;
}
.img_area image{
    object-fit: cover'
}
.bottom {
    display: flex;
    gap: 5px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
html {
  font-size: 62.5%;
}

body {
  font-family: "Poppins", sans-serif;
  line-height: 1.6;
  color: #1a1a1a;
  font-size: 16px;
  overflow-x: hidden;
}
a {
  color: #94cb52;
  text-decoration: none;
}
.container {
  display: grid;
  grid-template-rows: minmax(min-content, 100vh);
  grid-template-columns: repeat(2, 50vw);
}
.custom-dot {
  color: #2196f3;
}
.signup-container,
.signup-form {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}
.signup-container {
  width: 100vw;
  /* padding: 10rem 10rem; */
  padding: 5rem 0rem;
  align-items: flex-start;
  justify-content: flex-start;

  grid-column: 1 / 2;
  grid-row: 1;
}
.signup-form {
  /* max-width: 45rem; */
  max-width: 80%;
  width: 100%;
}
.text-mute {
  color: #aaa;
}
.heading-primary {
  font-size: 5rem;
}
.input-text {
  font-family: inherit;
  font-size: 1.8rem;
  padding: 3rem 5rem 1rem 2rem;
  border: none;
  border-radius: 2rem;
  background: #eee;
  font-weight: 600;
  width: 100%;
}
.input-text:focus {
  outline-color: #2196f3;
}

.btn {
  padding: 2rem 3rem;
  border: none;
  background: #703a97;
  color: #fff;
  border-radius: 1rem;
  cursor: pointer;
  font-family: inherit;
  font-weight: 500;
  font-size: inherit;
}
.btn-signup {
  align-self: flex-end;
  width: 100%;
  margin-top: 2rem;
  box-shadow: 0 1rem 2rem #00000025;
}
.btn-signup:active {
  box-shadow: none;
}
.btn-signup:hover {
  background: #fff;
  border: 1px solid #703a97;
  color: #703a97;
}
.inp {
  position: relative;
}
.label {
  pointer-events: none;

  position: absolute;
  top: 2rem;
  left: 2rem;
  color: #00000070;
  font-weight: 500;
  font-size: 1.8rem;

  transition: all 0.2s;
  transform-origin: left;
}
.input-text:not(:placeholder-shown) + .label,
.input-text:focus + .label {
  top: 0.7rem;
  transform: scale(0.75);
}
.input-text:focus + .label {
  color: #2196f3;
}
.f-row {
  display: flex;
  gap: 2rem;
}
.input-icon {
  position: absolute;
  top: 2rem;
  right: 2rem;
  font-size: 2rem;
  color: #00000070;
}
.input-icon-password {
  cursor: pointer;
}

.container {
  display: flex;
}
.heading-secondary {
  font-size: 3rem;
}

.welcome-container {
  /* background: #eeeeee75; */
  background: #703a97;
  grid-column: 2 / 3;
  grid-row: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  padding: 10rem;
}
.lg {
  font-size: 6rem;
}
.welcome-container img {
  width: 100%;
}

@media only screen and (max-width: 70rem) {
  html {
    font-size: 54.5%;
  }
}

@media only screen and (max-width: 60rem) {
  .signup-container {
    padding: 5rem;
  }
}
@media only screen and (max-width: 40rem) {
  html {
    font-size: 48.5%;
  }

  .input-text:not(:placeholder-shown) + .label,
  .input-text:focus + .label {
    top: 0.6rem;
    transform: scale(0.75);
  }
  .label {
    font-size: 1.9rem;
  }
  .input-wrapper {
    flex-direction: column;
  }
}

@media only screen and (max-width: 1200px) {
  .signup-container {
    grid-column: 1 / 3;
    width: 100%;
  }
  .welcome-container {
    display: none;
  }
  .signup-form{
    max-width: 100%;
  }
  #rtt {
    display: block;s
  }
}

</style>
@endpush
@section('content')

@include('includes.messages')
<section class="sectionP sectionP">
<div class="container-fluid d-flex" id="rtt">
  <main class="signup-container col-md-6 pb-5 col-sm-12">
    <h1 class="heading-primary">Create your Free Account<span class="custom-dot">.</span></h1>
    <p class="text-mute">Already have an account? <a href="/login">Log in</a></p>
    <form class="signup-form">
      <div class="f-row input-wrapper">
        <label class="inp">
          <input type="text" class="input-text" placeholder=" " id="fname" required>
          <span class="label">First name</span>
          <span class="input-icon"><i class="fa-solid fa fa-address-card"></i></span>
        </label>
        <label class="inp">
          <input type="text" class="input-text" placeholder=" " id="lname" required>
          <span class="label">Last name</span>
          <span class="input-icon"><i class="fa-solid fa fa-address-card"></i></span>
        </label>
      </div>
      <label class="inp">
        <input type="email" class="input-text" placeholder=" " id="email" required>
        <span class="label">Email</span>
        <span class="input-icon"><i class="fa-solid fa fa-envelope"></i></span>
      </label>
      <label class="inp">
        <input type="password" class="input-text" placeholder=" " id="password" required>
        <span class="label">Password</span>
        <span class="input-icon input-icon-password" data-password><i class="fa fa-solid fa-eye"></i></span>
      </label>
      <label class="inp">
        <input type="text" class="input-text" placeholder=" " id="bname" required>
        <span class="label">Business/Company/Brand Name</span>
        <span class="input-icon"><i class="fa-solid fa fa-building fa-building-o"></i></span>
      </label>
      <label class="inp">
        <input type="text" class="input-text" placeholder=" " id="service" >
        <span class="label">Product/Company/Brand</span>
        <span class="input-icon"><i class="fa-solid fa fa-list"></i></span>
      </label>
      <label class="inp">
        <input type="text" class="input-text" placeholder=" " id="whatsapp">
        <span class="label">Whatsapp Number</span>
        <span class="input-icon"><i class="fa-solid fa fa-whatsapp"></i></span>
      </label>
      <div class="form-check">
                                    <input class="form-check-input" style="float: none; width: 1.5em; height: 1.5em;margin-left: -1.25rem;" type="checkbox" name="send_mails" id="send_mails">
                                    <label class="form-check-label ml-2 text-mute" style="margin-top: 3px; font-size: 15px;" for="send_mails">
                                        Send Me Emails on how to choose Creatives
                                    </label>
                                </div>
        <div class="form-check">
            <input class="form-check-input" style="float: none; width: 1.5em; height: 1.5em;margin-left: -1.25rem;" type="checkbox" name="agree" id="agree" required>
            <label class="form-check-label ml-2 text-mute" style="margin-top: 3px; font-size: 15px;" for="agree">
                Yes, I undestand and agree to the Vicomma Terms of Service
            </label>
        </div>
      <button class="btn btn-signup" id="btn" type="submit">Create account</button>
    </form>
  </main>
  <div class="welcome-container col-md-6" >
    <!-- <h1 class="heading-secondary">Welcome to <span class="lg">Planner Buddy!</span></h1> -->
    <img src="/img/step1.png" alt="">
  </div>
</div>
            <div class="container-fluid">
                <div class="row d-none">
                    <div class="col-md-8">
                        <h1 class="sectionHeading3 mb-5">Send Us A Quick Message</h1>
                        <div class="form_style1">
                            <div class="form-group">
                                <label for="fname">Full Name (required)</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Business/Company name (required)</label>
                                <input type="text" class="form-control" id="bname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Product/Service/Brand (required)</label>
                                <input type="text" class="form-control" id="service" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email (required)</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Phone Number (required)</label>
                                <input type="text" class="form-control" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Whatsapp Number (required)</label>
                                <input type="text" class="form-control" id="whatsapp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">IG, Facebook, Twitter (required)</label>
                                <textarea class="form-control" id="socials" rows="5" required></textarea>
                            </div>
   
                            <button type="submit" id="" class="btn btn-primary rounded-btn mt-4">Send</button>
</div>
                        <br><br>
                        <!-- <div class="vicomma_add  text-center mt-5">
                            <p>Vicomma Entertainment</p>
                            <p class="add_text">22 Callaway Ct. Suite A</p>
                            <p class="add_text">Tampa FL, 33610Tampa FL, 33610</p>
                        </div> -->
                    </div>
                    <div class="col-md-4">
                        <div class="right_sidebar">
                            <p class="title">Top selling</p>
                            <ul class="fine-scrollbar">
                                @if (count($random_products) > 0)
                                    @foreach ($random_products as $product)
                                        <?php

                                        // if (count(json_decode($product->image, true)) > 0) {
                                            if (gettype(json_decode($product->image, true)) == "array" && count(json_decode($product->image, true)) > 0) {

                                            // if(count($product->image) > 0){
                                            $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".trim(json_decode($product->image, true)[0], '"');
                                        } else {
                                            $image = '/img/no-image.png';
                                        }
                                        ?>
                                                               <li>
                            <div class="img_area product-img shadow-sm">
                                <img alt="{{$product->name}}" src="{{ $image }}">
                            </div>
                            <div class="info pr-4">
                                <p class="p_title text-dark"><a href="/mall/products/{{ $product->id }}"
                                    target="_blank">{{ucwords($product->name)}}</a></p>
                                <div class="bottom mt-3">
                                    <span class="price">${{ number_format($product->price) }}</span>
                                    <a href="/mall/products/{{ $product->id }}" class="btn-bag-it" style="border-radius: 20px;display: flex; align-items: center; justify-content: center;" ii="{{ $product->id }}">Bag It</a>
                                </div>
                            </div>
                        </li>
                                    @endforeach
                                @else
                                    <li><small>No Top Selling Products found</small></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>

<script>
        $('form').submit( function (event) {
	// prevent the usual form submission behaviour; the "action" attribute of the form
	event.preventDefault();
	// validation goes below...
const email  = $("#email").val()
const fname  = $("#fname").val()
const lname  = $("#lname").val()
const name  = $("#fname").val() + " " + $("#lname").val()
const business  = $("#bname").val()
const service  = $("#service").val()
const whatsapp  = $("#whatsapp").val()

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/vendor-info',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			"email": email,
			"name": name,
            "fname": fname,
            "lname": lname,
            "business": business,
            "service": service,
            "phone": whatsapp,
            "whatsapp": whatsapp,
			"_token": "{{csrf_token()}}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
			// anything you want to have happen before sending the data to the server...
			// useful for "loading" animations
			$("#btn").attr("disabled",true)
$("#btn").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  <span class="sr-only">Loading...</span>`)
		}
	})
	.done( function (response) {
		     Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: response.message
        });
		location.href = "/dashboard"
	})
	.fail( function (code, status) {
	
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: code.responseJSON.message
        });
	 
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"

$("#btn").attr("disabled",false)
$("#btn").html(`Create account`)
	});
});
      


const eyeClick = document.querySelector("[data-password]");
const password_elem = document.getElementById("password");

eyeClick.onclick = () => {
  const icon = eyeClick.children[0];
  icon.classList.toggle("fa-eye-slash");
  if (password_elem.type === "password") {
    password_elem.type = "text";
  } else if (password_elem.type === "text") {
    password_elem.type = "password";
  }
};

    </script>
@endpush
