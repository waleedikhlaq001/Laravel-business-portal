@extends('pages.app')
@push('css')
<style>
    .right_sidebar .img_area {
        width: 100px;
        height: 100px;
        display: inline-block;
        vertical-align: middle;
    }

    .img_area image {
        object-fit: cover'

    }

    .bottom {
        display: flex;
        gap: 5px;
    }

</style>
@endpush
@section('content')

@include('includes.messages')
<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="sectionHeading3 mb-5">Send Us A Quick Message</h1>
                <form class="form_style1">
                    <div class="form-group">
                        <label for="fname">First Name (required)</label>
                        <input type="text" class="form-control" id="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name (required)</label>
                        <input type="text" class="form-control" id="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email (required)</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message (required)</label>
                        <textarea class="form-control" id="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" id="btn" class="btn btn-primary rounded-btn mt-4">Send</button>
                </form>
                <br><br>
                <!-- <div class="vicomma_add  text-center mt-5">
                            <p>Vicomma Entertainment</p>
                            <p class="add_text">22 Callaway Ct. Suite A</p>
                            <p class="add_text">Tampa FL, 33610Tampa FL, 33610</p>
                        </div> -->
            </div>
            {{-- <div class="col-md-4">
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
                <a href="/mall/products/{{ $product->id }}" class="btn-bag-it"
                    style="border-radius: 20px;display: flex; align-items: center; justify-content: center;"
                    ii="{{ $product->id }}">Bag It</a>
            </div>
        </div>
        </li>
        @endforeach
        @else
        <li><small>No Top Selling Products found</small></li>
        @endif
        </ul>
    </div>
    </div> --}}
    </div>
    </div>
</section>

@include('pages.partials.trendingVideos')

@include('pages.partials.footer')
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
var message  = $("#message").val()

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/send-message',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			"email": email,
			"first_name": fname,
            "last_name": lname,
            "message": message,
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
		location.reload()
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
$("#btn").html(`Send`)
	});
});
        
</script>
@endpush