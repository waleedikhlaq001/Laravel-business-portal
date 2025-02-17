@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css"
    integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .form-group {
        transition: .5s;
    }

    .error {
        color: red;
        display: block;
        margin-top: .5rem;
    }

    .pay-t {
        color: #6F3A97;
    }

    .swal-button--cancel {
        color: #555 !important;
        background-color: #efefef !important;
    }

    .introjs-nextbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745 !important;
        color: #fff;
        text-shadow: none;
    }

    .introjs-prevbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745;
        color: #fff;
        text-shadow: none;
    }

    .introjs-skipbutton {
        box-sizing: content-box;
        margin-right: 5px;
        color: #fff;
        background: #6f3a97;
        text-shadow: none;
    }



    .introjs-skipbutton.introjs-donebutton {
        color: #fff;
        background: #44255b !important;
        text-shadow: none;
    }

    .introjs-bullets {
        display: none;
    }

    @media (min-width: 768px) {
        .meat {
            padding-top: 0;
            padding-left: 14rem !important;
            padding-right: 14rem !important;
            padding-bottom: 14rem !important;
        }
    }

    .select2-container {
        box-sizing: border-box;
        display: block;
        margin: 0;
        position: relative;
        vertical-align: middle;
    }

    .select2-container--default .select2-selection--single {
        background-color: #6f42c11c !important;
        border: 1px solid #6f3c96 !important;
        padding: 12px 20px !important;
        height: 50px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        right: 6px;
    }

</style>
@section('content')
@include('includes.messages')
<div class="row mt-4 px-4 ">
    <div class="card">
        <div class="card-header text-center pay-t">
            PAYMENT METHOD UPDATE
        </div>
        @if($country_error)
        <div class="alert alert-danger">
            <strong>Profile Update Required: You currently do not have a country set. </strong>
        </div>
        @endif
        <div id="mainplace" class="card-body">

            <!-- Main payment options -->
            <div class="row mt-4">
                {{-- <div class="col-sm-6">
                    <div class="card vicom-ba">
                        <div class="card-body">
                            <h5 class="card-title pay-t font-weight-bold">Bank Account</h5>
                            <p class="card-text">You can add up to 5 bank accounts to recieve or make payments</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#bankAccountModal" data-whatever="@mdo"
                                {{ ($country_error) ? 'disabled': '' }}>Add Bank Account</button>
            </div>
        </div>
    </div> --}}
    <div class="col-sm-6">
        <div class="card vicom-pg">
            <div class="card-body">
                <h5 class="card-title pay-t font-weight-bold">Payment Gateway</h5>
                <p class="card-text">You can add up to 2 payment gateways to recieve and make payments.</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gatewaysModal"
                    data-whatever="@mdo" {{ ($country_error) ? 'disabled': '' }}>Add Payment Gateway</button>
            </div>
        </div>
    </div>
</div>
<!-- End of main -->
<!-- Account details Added -->
<h3>Account Details</h3>
{{-- <ul class="list-group">
                <div id="account-details"></div>
            </ul> --}}
<!-- End Account details -->
<h3 class="mt-4">Payment Gateway connected</h3>
<div id="connected-gateways"></div>
</div>
</div>

</div>

<div class="modal fade" id="bankAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bank Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-payment-dets">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Bank:</label>
                        <select id="bankList" class="form-control select2">
                            @foreach($banks as $bank)
                            <option key="{{$bank->id}}" value="{{$bank->code}}">
                                {{$bank->name}}
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Account Number: <span id="acctResolve"
                                class="ml-2"><span></label>
                        <input type="text" class="form-control" id="bankaccount">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Phone Number:</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="addAcctCta" type="button" class="btn btn-primary add-account" value="0">Add Account</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gatewaysModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Gateways</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Available Payment Gateways</h1>
                <div style="text-center" id="payment-gateways">
                </div>
                <div></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="gatway-close-btn" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Add Gateway</button> -->
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"
    integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chakra-ui@0.3.9/dist/index.min.js"></script>
<script crossorigin src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#bankList').select2({
            dropdownParent: $('#bankAccountModal .modal-content')
        });
});
const userId = '{{Auth::user()->id}}';
const pd = "{{ route('pay.details') }}";
const gb = "{{ route('flutterwave.banks') }}";
const raccount = "{{ route('pay.resolveacc') }}";
const addflwsubaccount = "{{ route('flutterwave.subaccount') }}";
const paymentGatewaysCountry = "{{ $countryName }}";
const deleteSubaccountUrl = "{{ route('subaccount.delete') }}";
const isCountrySet = "{{ $country_error}}";
const stripeConnect = "{{ route('user.stripe.account') }}";
const token = $('meta[name="csrf-token"]').attr("content");
const isStripeVerified = true && "{{ $isStripeVerified }}"

if (isCountrySet) {
    document.querySelector('.vicom-ba').style.filter = 'blur(3px)';
    document.querySelector('.vicom-pg').style.filter = 'blur(3px)';
}
</script>
<script>
    const tooltip_tour = (url) =>  {
    swal({
        title: 'Success',
        text: "Need to add any more accounts?",
        icon: 'success',
        buttons: { cancel: 'Add more accounts', 
                process: {
                text: 'No, proceed to make my first bid!',
                value: "go",
                }
            },
        }).then((value) => {
        if (value == "go") {
            location.href = url
        }else{
            location.reload()
        }
    })
}
</script>
<script src="{{ asset('client/bootstrap.js') }}"></script>
<script type="text/babel" src="{{ asset('client/helper.js') }}"></script>

<script type="text/babel" src="{{ asset('client/index.js') }}"></script>
@endpush