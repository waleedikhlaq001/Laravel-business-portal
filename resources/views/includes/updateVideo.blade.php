<div class="modal fade" id="uploadVideo" tabindex="-1" role="dialog" aria-labelledby="uploadVideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadVideoLabel">Upload Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('user.job.video.upload')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-center">
                     
                            <div class="form-group">
                                <label for="video-thumbnail" class="col-form-label">Thumbnail:</label>
                                <small class="d-block mb-2">Select or upload a picture that shows what's in your video. A good thumbnail stands out and draws viewers' attention.</small>
                                <input type="file" class="form-control" name="video_thumb" id="video-thumbnail" accept="image/jpeg, image/png, image/jpg">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-5">
                                <label for="video-file" class="col-form-label">Video: <span class="required">*</span></label>
                                <input type="file" name="video_file" class="form-control mb-2" id="video-file" accept="video/*">
                                <small class="d-block mb-4">Select or upload a video not greater than 10MB.</small>
                                <video id="video-preview" class="card shadow d-none" controls style="width: 100%"></video>

                                <label for="coppa" class="col-form-label">Is this video made for kids: <span class="required">*</span> <i class="fa fa-exclamation-circle" style="font-size: 15px !important" aria-hidden="true" data-toggle="popover" data-bs-trigger="hover" title="Video Disclaimer" data-bs-content="Regardless of your location, you're legally required to comply with the Children's Online Privacy Protection Act (COPPA) and/or other laws. You're required to tell us whether your videos are made for kids"></i></label>
                                <div class="form-check">
                                    <input class="form-check-input" value="YES" type="radio" name="kids_compliant" id="kids_compliant1">
                                    <label class="form-check-label" for="kids_compliant1">
                                        Yes, it&#39;s made for kids.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="NO" type="radio" name="kids_compliant" id="kids_compliant2">
                                    <label class="form-check-label" for="kids_compliant2">
                                        No, it&#39;s not made for kids
                                    </label>
                                </div>
                            </div>

                            <div class="card shadow m-1" id="thumb_preview"></div>
                        </div>


                    </div>
                    <h6>Disclaimer: </h6>
                    <small class="d-block mb-2">Regardless of your location,
                        you&#39;re legally required to
                        comply with the Children&#39;s
                        Online Privacy Protection Act
                        (COPPA) and/or other laws.
                        You&#39;re required to tell us
                        whether your videos are made
                        for kids.</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
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

    const input = document.getElementById('video-file');
    const video = document.getElementById('video-preview');
    const thumb = document.getElementById('video-thumbnail');
    const errorMsg = document.getElementById('errorMsg');
    thumb.addEventListener('change', function() {
        video.classList.remove("d-none");
        const files = this.files || [];
        if (!files.length) return;
        const reader = new FileReader();
        reader.onload = function(event) {
            var img = event.target.result;
            video.poster = img;
        }
        reader.readAsDataURL(files[0]);
    });
    input.addEventListener('change', function() {
        errorMsg.classList.add("d-none");
        video.classList.remove("d-none");
        var blobURL = URL.createObjectURL(event.target.files[0]);
        video.src = blobURL;
        // console.log(event.target.files[0].size);
        var vidSize = event.target.files[0].size;
        vidSize = vidSize / (1024 * 1024);
        vidSize = Math.round(vidSize);
        if (vidSize > 10) {
            errorMsg.classList.remove("d-none");
            errorMsg.innerHTML = 'Video size: (' + vidSize + 'MB), Video must not be more than 10MB';
        }
    });
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
</script>
@endpush