<template>
    <div class="modal fade" id="desModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"> Description</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updateDescription()" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-bind:class="{'form-control':true, 'is-invalid':errors.get('description')}" name="description"
                                id="description" cols="30" rows="3" v-model="description">{{desc}}</textarea>
                            <small class="text-muted">Write a brief description about yourself</small>
                            <div class="invalid-feedback">
                                {{errors.get('description')}}
                            </div>
                            <button type="submit" class="btn btn-success btn-block">
                                <span v-show="isLoading">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </span>
                                <span v-show="!isLoading">Save changes</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import swal from 'sweetalert';

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
    data() {
        return {
            desc: '',
            description: '',
            isLoading: false,
            errors: new Errors()
        }
    },
    methods: {
        alertDisplay() {
            swal({
                title: "Successful",
                text: "Description updated successfully",
                icon: "success",
                buttons: false,
                dangerMode: true,
            });
        },
        updateDescription() {
            this.isLoading = true
            axios.post('/update-description', {
                description: this.description
            }).then(response => {
                this.isLoading = false
                this.description = ''
                this.errors = new Errors()
                this.alertDisplay()
                setTimeout(() => {
                    location.reload()
                },3000)
            }).catch(error => {
                this.isLoading = false
                // console.log(error);
                this.errors.record(error.response.data)
            })
        }
    },
    mounted() {
        axios.get('/user/description')
        .then(response => {
            this.desc = response.data.influencer_description
        }).catch(error => {
            console.log(error);
        })
    },
}
</script>