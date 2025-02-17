@extends('pages.app')

@push('css')
    <style>
        .error {
            font-weight: 400 !important;
            font-size: 12px;
            color: red;
        }

        .big-font{
            font-size: 16px;font-weight: 500;
        }

        .product-label{
            font-size: 14px !important;
            font-weight: 500 !important;
        }
    </style>
@endpush

@section('content')
@include('includes.messages')

    <div class="generalPostContainer" style="height: 270px;padding: 0rem;padding-top: 3.5rem;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h6><strong>Watch this short video  </strong></h6>
                <p class="mt-4">
                Because you own a brand, service, product or all the above, you need a vicomma Creative.
            </div>
          
        </div>
    </div>
    <div class="row justify-content-center">
                    <div class="col-md-6 mt-4 pb-5">
                        <div class="video_div">
                        <video controls id="video-creative"
                        autoplay
                        muted
                        style="width: 100%; height: 400px;object-fit: cover;" poster="/video-pre.png" >
                        <source src="https://viccomma-videos.s3.us-east-2.amazonaws.com/banners/Gargi+welcom+for+Vendors+4to3+aspect.mp4" type="video/mp4"/>
                        </video>
                        </div>
                        <div class="d-flex my-2" style="justify-content: center; gap: 20px;">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="uploadbutton"  onclick="location.href = '/post/job';"  style="border-radius: 10px;">Get me a Creative</button>
                        <button type="button" class="btn btn-sm btn-outline-primary"  id="makebutton"  onclick="location.href = '/vendor-info';"  style="border-radius: 10px;">I need more time</button>

                        </div>
                        <p class=" error text-center mb-0" id="errorMsg"></p>
                        <p class=" text-success text-center my-2" id="successMsg" style="display: none;"></p>
                        <!-- <a href="/terms"><h6 class="mt-2">Right of Use: </h6></a>
                    <small class="d-bloc mb-5">
                    vicomma and our companies reserve the right to utilize this video for promotional and marketing purposes as stated in our Terms of Service.
                    </small> -->

                    </div>

                        <div class="col-md-7 d-none">
                            <div class="form-group">
                                <label for="video-title" class="col-form-label">Title: <span class="required">*</span></label>
                                <input type="text" class="form-control" name="video_title" id="video-title" placeholder="Add a title that describes your video">
                            </div>
                            <div class="form-group">
                                <label for="video-desc" class="col-form-label">Description: <span class="required">*</span></label>
                                <textarea class="form-control" name="video_desc" id="video-desc" rows="5" placeholder="Tell Viewers about your video"></textarea>
                            </div>
                          
                        </div>
                        <div class="col-md-5 d-none">
                            <div class="form-group mb-5">
                                <label for="video-file" class="col-form-label">Video: <span class="required">*</span></label>
                                <input type="file" name="video_file" class="form-control mb-2" id="video-file"accept=".mp4,.mov" onchange="validateVideo(this)">
                                <small class="d-block mb-4">Select or upload a video not greater than 10MB.</small>
                                <video id="video-preview" class="card shadow d-none" controls style="width: 100%"></video>
                                <input type="file"  id="make-vid" capture="camera" accept="video/*" onchange="validateVideo(this)">


                                <!-- <div class="card shadow m-1" id="thumb_preview"></div> -->
                            </div>

                        </div>


                    </div>

@push('scripts')
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
@endpush
@endsection
