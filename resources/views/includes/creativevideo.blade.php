<div class="modal fade" id="uploadVideo" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="uploadVideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;width: 100%;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="uploadVideoLabel">Video Profile</h5>
                <button type="button" class="close" onclick="close_modl()" data-diiss="modal" aria-label="Cose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <div class="modal-body" style="padding-bottom: 30px;">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="video_div">
                                <video controls id="video-creative" autoplay muted
                                    style="width: 100%; height: 400px;object-fit: cover;" poster="/video-pre.png">
                                    <source
                                        src="https://viccomma-videos.s3.us-east-2.amazonaws.com/banners/Welcome+for+Creatives+4to3+aspect+Gar.mp4"
                                        type="video/mp4" />
                                </video>
                            </div>
                            <div class="d-flex my-2" style="justify-content: center; gap: 20px;">
                                <button type="button" class="btn btn-sm btn-secondary" id="uploadbutton" disable
                                    onclick="$('#video-file').click()" style="border-radius: 10px;">Upload Your
                                    Video</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="makebutton" disable
                                    onclick="$('#make-vid').click()" style="border-radius: 10px;display: none;">Make
                                    Your Video</button>

                            </div>

                            <!-- <span id="selectedVideoFileName"></span>
            <button onclick="clearInput('video_file')">Clear</button>

            <span id="selectedRecordedFileName"></span>
    <button onclick="clearInput('make-vid')">Clear</button> -->

                        </div>
                        <p class=" error text-center mb-0" id="errorMsg"></p>
                        <p class=" text-success text-center my-2" id="successMsg" style="display: none;"></p>
                        <div class="col-md-7 d-none">
                            <div class="form-group">
                                <label for="video-title" class="col-form-label">Title: <span
                                        class="required">*</span></label>
                                <input type="text" class="form-control" name="video_title" id="video-title"
                                    placeholder="Add a title that describes your video">
                            </div>
                            <div class="form-group">
                                <label for="video-desc" class="col-form-label">Description: <span
                                        class="required">*</span></label>
                                <textarea class="form-control" name="video_desc" id="video-desc" rows="5"
                                    placeholder="Tell Viewers about your video"></textarea>
                            </div>

                        </div>
                        <div class="col-md-5 d-none">
                            <div class="form-group mb-5">
                                <label for="video-file" class="col-form-label">Video: <span
                                        class="required">*</span></label>
                                <input type="file" name="video_file" class="form-control mb-2" id="video-file"
                                    accept=".mp4,.mov" onchange="validateVideo(this)">
                                <small class="d-block mb-4">Select or upload a video not greater than 10MB.</small>
                                <video id="video-preview" class="card shadow d-none" controls
                                    style="width: 100%"></video>
                                <input type="file" id="make-vid" capture="camera" accept="video/*"
                                    onchange="validateVideo(this)">


                                <!-- <div class="card shadow m-1" id="thumb_preview"></div> -->
                            </div>

                        </div>


                    </div>
                    <a href="/terms">
                        <h6 class="mt-2">Right of Use: </h6>
                    </a>
                    <small class="d-bloc mb-5">
                        vicomma and our companies reserve the right to utilize this video for promotional and marketing
                        purposes as stated in our Terms of Service.
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
                <!-- <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div> -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    //    $('#exampleModal').on('show.bs.modal', function (event) {
    //         var button = $(event.relatedTarget) // Button that triggered the modal
    //         var recipient = button.data('whatever') // Extract info from data-* attributes
    //         // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    //         // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //         var modal = $(this)
    //         modal.find('.modal-title').text('New message to ' + recipient)
    //         modal.find('.modal-body input').val(recipient)
    //     });
</script>

<script>
    $(function() {
        $('[data-toggle="popover"]').popover()
    })

    $('form').submit(function() {
        $(this).children('input[type=submit]').prop('disabled', true);
    });

    const vid = document.getElementById("video-creative");

// Add an event listener for the 'ended' event
vid.addEventListener("ended", function() {
  // Your code to execute after the video has ended
    // Your code to execute after the video has ended
    $('#makebutton').attr('disabled', false);
  $('#uploadbutton').attr('disabled', false);
  // You can replace the alert with any action you want.
});

    const input = document.getElementById('video-file');
    const video = document.getElementById('video-preview');
    // const thumb = document.getElementById('video-thumbnail');
    const errorMsg = document.getElementById('errorMsg');
    // thumb.addEventListener('change', function() {
    //     video.classList.remove("d-none");
    //     const files = this.files || [];
    //     if (!files.length) return;
    //     const reader = new FileReader();
    //     reader.onload = function(event) {
    //         var img = event.target.result;
    //         video.poster = img;
    //     }
    //     reader.readAsDataURL(files[0]);
    // });
    // input.addEventListener('change', function() {
    //     errorMsg.classList.add("d-none");
    //     video.classList.remove("d-none");
    //     var blobURL = URL.createObjectURL(event.target.files[0]);
    //     video.src = blobURL;
    //     // console.log(event.target.files[0].size);
    //     var vidSize = event.target.files[0].size;
    //     vidSize = vidSize / (1024 * 1024);
    //     vidSize = Math.round(vidSize);
    //     if (vidSize > 10) {
    //         errorMsg.classList.remove("d-none");
    //         errorMsg.innerHTML = 'Video size: (' + vidSize + 'MB), Video must not be more than 10MB';
    //     }
    // });
</script>
<script>
    // const input = document.getElementById('file-input');
    // const video = document.getElementById('video');
    // const videoSource = document.createElement('source');
    // input.addEventListener('change', function() {
    //   const files = this.files || [];
    //   if (!files.length) return;
    //   const reader = new FileReader();
    //   reader.onload = function (e) {
    //     videoSource.setAttribute('src', e.target.result);
    //     video.appendChild(videoSource);
    //     video.load();
    //     video.play();
    //   };
    //   reader.onprogress = function (e) {
    //     console.log('progress: ', Math.round((e.loaded * 100) / e.total));
    //   };
    //   reader.readAsDataURL(files[0]);
    // });

   


function displayFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : '';
            const inputId = input.id;

            if (inputId === 'video_file') {
                document.getElementById('selectedVideoFileName').textContent = fileName;
            } else if (inputId === 'make-vid') {
                document.getElementById('selectedRecordedFileName').textContent = fileName;
            }
        }

        function clearInput(inputId) {
            const input = document.getElementById(inputId);
            input.value = ''; // Clear the selected file
            const spanId = 'selected' + inputId.charAt(0).toUpperCase() + inputId.slice(1) + 'FileName';
            document.getElementById(spanId).textContent = ''; // Clear the displayed file name
        }

        // Set a maximum file size limit (20MB)
        const maxFileSize = 50 * 1024 * 1024; // 20MB in bytes
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                if (input.files[0] && input.files[0].size > maxFileSize) {
                    alert('File size exceeds the limit of 20MB.');
                    input.value = ''; // Clear the selected file
                    const spanId = 'selected' + input.id.charAt(0).toUpperCase() + input.id.slice(1) + 'FileName';
                    document.getElementById(spanId).textContent = ''; // Clear the displayed file name
                }
            });
        });


        function validateVideo(input) {
    const allowedTypes = ['video/mp4', 'video/quicktime'];
    const maxFileSize = 50 * 1024 * 1024; // 50MB in bytes
    const maxDuration = 300; // Maximum video length in seconds

    const videoValidationError = document.getElementById('errorMsg');
    videoValidationError.textContent = '';

    const file = input.files[0];

    if (!file) {
        return; // No file selected
    }

    if (allowedTypes.indexOf(file.type) === -1) {
        videoValidationError.textContent = 'Invalid file type. Please select a valid MP4 or MOV video.';
        input.value = ''; // Clear the selected file
        return;
    }

    if (file.size > maxFileSize) {
        videoValidationError.textContent = 'File size exceeds the limit of 50MB.';
        input.value = ''; // Clear the selected file
        return;
    }

    // Check video resolution and aspect ratio
    const video = document.createElement('video');
    video.preload = 'metadata';
    var submit = 0;
    video.onloadedmetadata = function() {
        URL.revokeObjectURL(video.src);
        const landscapeAspectRatio = 16 / 9;
        const squareAspectRatio = 1;
        const verticalAspectRatio = 4 / 5;

        // if (
        //     (video.videoWidth >= 600 && video.videoHeight >= 315 && video.videoWidth / video.videoHeight === landscapeAspectRatio) || // Landscape
        //     (video.videoWidth >= 600 && video.videoHeight >= 600 && video.videoWidth / video.videoHeight === squareAspectRatio) || // Square
        //     (video.videoWidth >= 600 && video.videoHeight >= 750 && video.videoWidth / video.videoHeight === verticalAspectRatio)    // Vertical
        // ) {
            // Check video duration
            if (video.duration > maxDuration) {
                videoValidationError.textContent = 'Video duration exceeds the limit of 30 seconds.';
                input.value = ''; // Clear the selected file
            } else {
                // All checks passed, show the success message and submit the form
                $("#successMsg").show();
                document.getElementById('successMsg').innerHTML = '<span class="spinner spinner-sm spinner-border"></span> Uploading.....';
                $('form').submit();
            }
        // } else {
        //     videoValidationError.innerHTML = 'Invalid video resolution, aspect ratio, or dimensions.<br/>Aspect Ratio: 16:9 for landscape, 1:1 for square, and 4:5 for vertical.<br/>Minimum Resolution: 600×315 for landscape, 600×600 for square, and 600×750 for vertical';
        //     input.value = ''; // Clear the selected file
        // }
    };

    // Create an object URL for the video
    video.src = URL.createObjectURL(file);
}
</script>
@endpush