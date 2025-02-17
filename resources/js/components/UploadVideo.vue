<template>
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mb-0" @submit.prevent="submit"
                    enctype="multipart/form-data">
                    <!-- <input type="hidden" name="job_id" value="{{$job->id}}"> -->
                    <div class="form-group">
                        <input v-bind:class="{'form-control':true, 'is-invalid':errors.get('video')}" type="file" name="video"
                            id="video" ref="video" v-on:change="handleFileUpload()" accept="video/*">
                        <div class="invalid-feedback" v-if="!isValid">
                            {{errors.get('video')}}
                        </div>
                        <progress class="mt-2 w-100" max="100" :value.prop="progress" v-if="progress"></progress>
                        <h6 class="text-center" v-if="uploading">
                            {{progress}} %
                        </h6>
                        <div>Share your video content with the vendor</div>
                    </div>
                    <button class="btn btn-success btn-block" v-if="isValid">
                        <span v-show="isLoading">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Uploading
                        </span>
                        <span v-show="!isLoading">Submit</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import swal from 'sweetalert';
window.URL = window.URL || window.webkitURL;

class Errors{
    constructor() {
        this.errors = {};
    }
    get(field) {
        if(this.errors[field]) {
            return this.errors[field][0];
        }
    }
    record(errors) {
        this.errors = errors.errors;
    }
}
export default {
    props: ['job_id'],
    data() {
        return  {
            video: '',
            progress: 0,
            uploading: false,
            isLoading: false,
            isValid: false,
            uploadedFiles: [],
            errors: new Errors(),
            job: this.job_id,
        }
    },
    mounted() {
        // console.log(this.job_id);
    },
    methods: {
        handleFileUpload(){
            this.video = this.$refs.video.files[0];
            this.validate();
        },
        alertDisplay() {
            swal({
                title: "Successful",
                text: "video uploaded",
                icon: "success",
                buttons: false,
                dangerMode: true,
            });
        },
        validate() {
            this.isValid = true;
            this.errors = new Errors();
            if((this.video.size / (1024 * 1024)) > 10) {
                this.errors.record({"errors" : {"video" : ["Max Video size exceeded. Upload a video less than 10MB"]}});
                this.isValid = false;
                return false;
            }
            var vid = document.createElement('video');
            vid.preload = 'metadata';
            vid.src = URL.createObjectURL(this.video);
            vid.onloadedmetadata = () => {
                window.URL.revokeObjectURL(vid.src);
                var duration = vid.duration;
                if(duration > 60) {
                    this.errors.record({"errors" : {"video" : ["Max Video duration exceeded. Upload a video less than 60s"]}});
                    this.isValid = false;
                    return false;
                }
                this.isValid = true;
                this.errors = new Errors();
            };
            return true;
        },
        async submit() {
            const video = new FormData()
            video.append('video', this.video)
            video.append('job_id', this.job_id)
            this.uploading = true
            this.isLoading = true
            const res = await axios.post('/job/video',
             video,
            {
                onUploadProgress: e => this.progress = Math.round(e.loaded * 100 / e.total)
            })
            .then(response => {
                console.log(response.data);
                this.uploading = false
                this.isLoading = false
                this.alertDisplay()
                setTimeout(() => {
                    location.reload()
                },3000)
            })
            .catch(error => {
                console.log(error);
                this.uploading = false
                this.isLoading = false
                this.progress = 0
                this.errors.record(error.response.data)
            });
        }
    }
}
</script>
