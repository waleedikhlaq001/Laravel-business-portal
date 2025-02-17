<template>
    <div>
        <div class="row justify-content-center"  v-if="verifyToken">


            <div class="col-12 col-md-6">
                <form action="" @submit.prevent="submit()">
                    <div class="form-group">
                        <small>Enter Token sent to your email to watch video</small>
                        <input v-bind:class="{'form-control': true, 'is-invalid':errors.get('token')}" type="password" id="token" v-model="token"
                            placeholder="Enter token">
                            <div class="invalid-feedback">
                                {{errors.get('token')}}
                            </div>
                            <small class="text-danger">Note: Once Token is used, you have 48hrs to approve or reject.</small>
                    </div>
                    <button class="btn btn-success btn-sm btn-block">
                        <span v-show="isLoading">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </span>
                        <span v-show="!isLoading">Submit</span>
                    </button>
                </form>
            </div>
        </div>
        <div v-if="verified">
            <div class="d-flex justify-content-center">
<!--                <iframe width="420" height="315"-->
<!--                    :src="url + code">-->
<!--                </iframe>-->
                <video class="rounded shadow" controls width="520" controlsList="nodownload"
                       id="videoElement">
                    <source :src="videoFile"
                            type="video/mp4">
                </video>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-success btn-sm" :class="approvalButton ? 'buttonRed' : ''" @click="approveVideo" :disabled="approvalButton">{{ApprovalText}} <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
            </div>
        </div>
    </div>
</template>
<script>
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
    props: ['job','video', 'videoid'],
    data() {
        return {
            token: '',
            loading: false,
            verified: false,
            verifyToken: true,
            errors: new Errors(),
            isLoading: false,
            msg: '',
            code: '',
            url: 'https://www.youtube.com/embed/',
            videoFile : '',
            approvalButton: false,
            ApprovalText : 'Agree'
        }
    },
    mounted() {
        // console.log(this.job);
        this.videoFile = this.video;
        console.log('hehehre' ,this.videoid)
        this.fetchVideoStatus()
    },
    methods: {
        submit() {
            this.isLoading = true
            axios.post('/job/video/token', {
                token: this.token,
                jobId: this.job
            })
            .then(response => {
                this.isLoading = false
                this.errors = new Errors(),
                this.verified = true
                this.verifyToken = false
                axios.get('/job/video/code/' + this.job)
                .then(response => {
                    console.log(response.data);
                    this.code = response.data
                }).catch(error => {
                    console.log(error);
                })
            }).catch(error => {
                if(error.response.status === 400) {
                    this.msg = 'Token not found'
                    this.errors.record({"message":error.response.data, "errors":{"token":error.response.data}})
                    this.isLoading = false
                } else {
                    this.isLoading = false
                    this.verified = false
                    this.errors.record(error.response.data)
                }

            })
        },
        approveVideo(){
            axios.get(`/approve/jobs/video/${this.videoid}`)
                .then(response => {
                    console.log(response.data)
                    if(response.data){
                        this.approvalButton = true,
                            this.ApprovalText = 'Agreed to terms'
                    }
                }).catch(error => {
                console.log(error)
            })
        },
        fetchVideoStatus(){
            axios.get(`/fetch/video/${this.videoid}/status`)
                .then(response => {
                    console.log(response.data);
                    if(response.data.data.video.isApproved === 1){
                        this.approvalButton = true,
                            this.ApprovalText = 'Agreed to terms'
                    }
                }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
<style scoped>
.buttonRed{
    background: red;
    color: white;
    border: 1px solid red;
}

</style>
