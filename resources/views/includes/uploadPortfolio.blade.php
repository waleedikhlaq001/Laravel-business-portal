<div class="modal fade" id="fileUpload" tabindex="-1" role="dialog" aria-labelledby="fileUpload" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadVideoLabel">Upload Portfolio Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-center">
                    <div class="alert alert-icon" id="alert" role="alert" style="display:none">  </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="video-title" class="col-form-label">Title: <span class="required">*</span></label>
                                <input type="text" class="form-control" name="video_title" id="video-title" placeholder="Add a title that describes your video" required>
                            </div>
                            <div class="form-group">
                                <label for="video-desc" class="col-form-label">Description: <span class="required">*</span></label>
                                <textarea class="form-control" name="video_desc" id="video-desc" rows="5" placeholder="Tell Viewers about your video" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="video-thumbnail" class="col-form-label">Thumbnail:</label>
                                <small class="d-block mb-2">Select or upload a picture that shows what's in your video. A good thumbnail stands out and draws viewers' attention.</small>
                                <input type="file" class="form-control" name="video_thumb" id="video-thumbnail" accept="image/jpeg, image/png, image/jpg" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="video-link" class="col-form-label">Post Link: <span class="required">*</span></label>
                                <input type="url" class="form-control" name="video_link" id="video-link" placeholder="Provide a link to your video" required>
                            </div>

                            <div class="form-group">
                                <label for="video-link" class="col-form-label">Views: <span class="required">*</span></label>
                                <input type="text" class="form-control" name="video_views" id="video-views" placeholder="Tell us how many people have viewed your video" required>
                            </div>
                            <div class="form-group mb-5">
                                <label for="video-file" class="col-form-label">Video: <span class="required">*</span></label>
                                <input type="file" name="video_file" class="form-control mb-2" id="video-file" accept="video/*" required>
                                <small class="d-block mb-4">Select or upload a video not greater than 10MB.</small>
                                <video id="video-preview" class="card shadow d-none" controls style="width: 100%"></video>

                                <label for="coppa" class="col-form-label">Is this video made for kids: <span class="required">*</span> <i class="fa fa-exclamation-circle" style="font-size: 15px !important" aria-hidden="true" data-toggle="popover" data-bs-trigger="hover" title="Video Disclaimer" data-bs-content="Regardless of your location, you're legally required to comply with the Children's Online Privacy Protection Act (COPPA) and/or other laws. You're required to tell us whether your videos are made for kids"></i></label>
                                <div class="form-check">
                                    <input class="form-check-input" value="YES" type="radio" name="kids_compliant" value="1" id="kids_compliant1" required>
                                    <label class="form-check-label" for="kids_compliant1">
                                        Yes, it&#39;s made for kids.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="NO" type="radio" name="kids_compliant" value="0" id="kids_compliant2" required>
                                    <label class="form-check-label" for="kids_compliant2">
                                        No, it&#39;s not made for kids
                                    </label>
                                </div>
                            </div>

                            <div class="card shadow m-1" id="thumb_preview"></div>
                        </div>


                    </div>
                    <h6>Disclaimer: </h6>
                    <small class="d-bloc mb-2">
                    By uploading a file, you agree to Vicomma's security policy. In some cases we may alter your file for the security of our users. Visit our Trust, Safety & Security Page for more information
                    </small>
                    <!-- <small class="d-block mb-2 d-none">Regardless of your location,
                        you&#39;re legally required to
                        comply with the Children&#39;s
                        Online Privacy Protection Act
                        (COPPA) and/or other laws.
                        You&#39;re required to tell us
                        whether your videos are made
                        for kids.</small> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary"  id="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Get the form element
    const uploadForm = $('#uploadForm');

    // Add a submit event listener to the form
    uploadForm.on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the form data
        const formData = new FormData();

        // Add form data items individually
        formData.append('video_title', $('#video-title').val());
        formData.append('video_desc', $('#video-desc').val());
        formData.append('video_thumb', $('#video-thumbnail')[0].files[0]);
        formData.append('file', $('#video-file')[0].files[0]);
        formData.append('video_link', $('#video-link').val());       
        formData.append('video_views', $('#video-views').val());   
        formData.append('_token', '{{csrf_token()}}');         
        formData.append('for_kids', $('input[name=kids_compliant]:checked').val());   

        // Make an AJAX request
        $.ajax({
            url: '/upload-portfolio',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
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
			$("#alert").removeClass("alert-danger")
		$("#alert").addClass("alert-success")
		$('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
		location.reload()
	})
	.fail( function (code, status) {
		// what you want to happen if the ajax request fails (404 error, timeout, etc.)
		// 'code' is the numeric code, and 'status' is the text explanation for the error
		// I usually just output some fancy error messages
		$("#alert").removeClass("alert-success")
				$("#alert").addClass("alert-danger")
		$('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)
	 
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
$('#alert').show()
$("#btn").attr("disabled",false)
$("#btn").html(`Submit`)
	});
    });
</script>
@endpush