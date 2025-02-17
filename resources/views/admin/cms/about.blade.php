@extends('admin.app')
@section('content')
@include('includes.messages')
<div class="container-fluid">
    <h1>Manage Content</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-uppercase">About Us Section</div>
                <form>
                    <!-- @csrf -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="main_header">Main Title</label>
                            <input type="hidden" name="id" value="">
                            <input type="text" name="main_header" id="title"
                                class="form-control"
                                value="{{$about && $about->title? $about->title : ''}}" required>
                            
                            <div class="invalid-feedback">
                                =
                            </div>
                        
                        </div>
                        <div class="form-group">
                            <label for="main_description">Body</label>
                            <!-- <input type="text" name="main_description" id=""
                                class="form-control"
                                value=""> -->
                                <div id="editor"></div>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="button btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@push("scripts")
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    function escapeHtml(unsafe)
{
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }
    CKEDITOR.replace( 'editor' );

    @if($about && $about->body)
    console.log(`{!! $about->body !!}`);
    $(".button").attr("disabled",true)
    setTimeout(() => 
    {
    CKEDITOR.instances['editor'].insertHtml(`{!! html_entity_decode($about->body) !!}`);
    $(".button").attr("disabled",false)
    },3000)
    @endif

    $('form').submit( function (event) {
	// prevent the usual form submission behaviour; the "action" attribute of the form
	event.preventDefault();
	// validation goes below...
const title  = $("#title").val()
const body = CKEDITOR.instances['editor'].getData()

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/admin/cms/update-about',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			title: title,
			body: body,
			"_token":"{{ csrf_token() }}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
			// anything you want to have happen before sending the data to the server...
			// useful for "loading" animations
			$(".button").attr("disabled",true)
$(".button").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  <span class="sr-only">Loading...</span>`)
$('#alert').hide()
		}
	})
	.done( function (response) {
		// what you want to happen when an ajax call to the server is successfully completed
		// 'response' is what you get back from the script/server
		// usually you want to format your response and spit it out to the page
        console.log(response)
        Swal.fire("Done!",response.message,"success")
		location.reload();
	})
	.fail( function (code, status) {
		// what you want to happen if the ajax request fails (404 error, timeout, etc.)
		// 'code' is the numeric code, and 'status' is the text explanation for the error
		// I usually just output some fancy error messages
        Swal.fire("Error!",code.responseJSON.message,"error")
	 
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
$('#alert').show()
$(".button").attr("disabled",false)
$(".button").html(`Save`)
	});
});
</script>
@endpush