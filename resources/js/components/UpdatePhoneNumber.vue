<template>
    <div class="modal fade" id="phoneNumberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"> <i class="fas fa-plus"
                            aria-hidden="true"></i> Add Phone Number</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updatePhone()" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+{{country}}</span>
                                <input type="number" name="phone_number" v-bind:class="{'form-control':true, 'is-invalid':errors.get('phone_number')}" id="phone_number" v-model="phone_number">
                                <div class="invalid-feedback">
                                    {{errors.get('phone_number')}}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">
                            <span v-show="isLoading">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </span>
                            <span v-show="!isLoading">Save changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert';
class Errors {
    constructor() {
        this.errors = {}
    }
    get(field) {
        if(this.errors[field]) {
            return this.errors[field][0]
        }
    }
    record(errors) {
        this.errors = errors.errors
    }
}
export default {
    props: ['country'],
    data() {
        return {
            phone_number: '',
            isLoading: false,
            errors: new Errors(),
        }
    },
    mounted() {
        // console.log('update phone modal');
    },
    methods: {
        alertDisplay() {
            swal({
                title: "Successful",
                text: "Phone number added successfully",
                icon: "success",
                buttons: false,
                dangerMode: true,
            });
        },
        updatePhone() {
            this.isLoading = true
            axios.post('/update-phone-number', {
                phone_number: this.phone_number
            }).then(response => {
                console.log(response)
                this.isLoading = false
                this.phone_number = ''
                this.errors = new Errors()
                this.alertDisplay()
                window.location.protocol = "https:";
                window.location.href = `/verify/phone/`;
            }).catch(error => {
                this.isLoading = false
                // console.log(error);
                this.errors.record(error.response.data)
            })
        }
    }
}
</script>
