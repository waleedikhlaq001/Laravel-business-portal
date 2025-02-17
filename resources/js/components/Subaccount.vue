<template>
<div class="modal fade" id="flutterwaveModal" tabindex="-1" aria-labelledby="flutterwaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="flutterwaveModalLabel"> <i class="fas fa-money-check"
                        aria-hidden="true"></i> Add
                    Account</h6>
                <button type="button" class="close" id="closeFlutterWaveModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" @submit.prevent="createSubAccount()">
                <div class="modal-body">
                    <div class="form-floating">
                        <select v-bind:class="{'form-select':true, 'is-invalid':errors.get('bank')}" id="bank" name="bank" aria-label="bank" v-model="bank">
                            <option v-for="bank in banks" :key="bank.id"  v-bind:value="bank.code" >{{bank.name}}</option>
                        </select>
                        <label for="bank">Select Bank</label>
                        <div class="invalid-feedback">
                            {{errors.get('bank')}}
                    </div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" v-bind:class="{'form-control':true, 'is-invalid':errors.get('account_number')}" id="account_number" placeholder="0012190129" v-model="account_number">
                        <label for="account_number">Account number</label>
                        <div class="invalid-feedback">
                            {{errors.get('account_number')}}
                        </div>
                    </div>
                    <!-- <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="country" placeholder="Nigeria">
                        <label for="country">Country</label>
                    </div> -->
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" v-bind:class="{'form-control':true, 'is-invalid':errors.get('email')}"  id="email" placeholder="name@gmail.com" v-model="email">
                        <label for="email">Email address</label>
                        <div class="invalid-feedback">
                            {{errors.get('email')}}
                        </div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" v-bind:class="{'form-control':true, 'is-invalid':errors.get('phone_number')}" id="phone_number" placeholder="+2349101190234" v-model="phone_number">
                        <label for="phone_number">Phone number</label>
                        <div class="invalid-feedback">
                            {{errors.get('phone_number')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">
                            <span v-show="isLoading">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </span>
                            <span v-show="!isLoading">Submit</span>
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
                isLoading: false,
                banks: {},
                bank: '',
                account_number: '',
                phone_number: '',
                email: '',
                msg: '',
                errors: new Errors(),
            }
        },
        async mounted() {
            this.getBanks();
        },
        methods: {
            alertDisplay() {
                swal({
                    title: "Successful",
                    text: "Payment account added successfully",
                    icon: "success",
                    buttons: false,
                    dangerMode: true,
                });
            },
            alertDisplayError() {
                swal({
                    title: "Error!",
                    text: this.msg,
                    icon: "error",
                    buttons: false,
                    dangerMode: true,
                });
            },
            async getBanks (){
                await axios.get('/flutterwave/banks')
                .then(response => {
                    // console.log(response.data[0].data)
                    this.banks = response.data[0].data
                })
                .catch(error => console.log(error))
            },
            createSubAccount() {
                this.isLoading = true
                axios.post('/flutterwave/subaccount', {
                    account_bank: this.bank,
                    account_number: this.account_number,
                    phone_number: this.phone_number,
                    email: this.email,
                })
                .then(response => {
                    // console.log(response);
                    this.isLoading = false
                    this.bank = ''
                    this.account_number = ''
                    this.phone_number = ''
                    this.email = ''
                    this.errors = new Errors(),
                    this.alertDisplay()
                    setTimeout(() => {
                        location.reload()
                    },3000)
                })
                .catch(error => {
                    // console.log(error);
                    this.isLoading = false
                    this.errors.record({"message":'The account number and the bank already exists', "errors":{"account_number":['The account number and the bank already exists']}})
                    if(error.response.status === 400) {
                        this.msg = 'The account number and the bank already exists'
                        this.alertDisplayError()
                    } else {
                        this.isLoading = false
                        this.errors.record(error.response.data)
                    }

                })
            }
        }
    }
</script>