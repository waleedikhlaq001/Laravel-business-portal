@push('css')
<style>
    .breakdown-item {
        display: flex;
        padding: 10px;
        margin: 10px 0;
        background: #dbebc6;
        border-radius: 5px;
        color: #476423;
        font-weight: 500;
        justify-content: space-between;
    }

    .total {
        font-size: 22px;
        font-weight: 700;
        background: #66972b;
        color: #fff;
    }

    .percTitle {
        padding: 10px;
        margin: 0px;
        text-align: center;
    }


    .formr {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .label {
        display: flex;
        cursor: pointer;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        margin-bottom: 0.375em;
        /* Accessible outline */
        /* Remove comment to use */
        /*
  	&:focus-within {
  			outline: .125em solid $primary-color;
  	}
  */
    }

    .label input {
        position: absolute;
        left: -9999px;
    }

    .label input:checked+span {
        background-color: #dcecc7;
    }

    .label input:checked+span:before {
        box-shadow: inset 0 0 0 0.4375em #66972b;
    }

    .label span {
        display: flex;
        align-items: center;
        padding: 0.375em 0.75em 0.375em 0.375em;
        border-radius: 99em;
        transition: 0.25s ease;
    }

    .label span:hover {
        background-color: #d6d6e5;
    }

    .label span:before {
        display: flex;
        flex-shrink: 0;
        content: "";
        background-color: #fff;
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        margin-right: 0.375em;
        transition: 0.25s ease;
        box-shadow: inset 0 0 0 0.125em #00005c;
    }

    .containerr {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

</style>
@endpush
<div class="modal fade" id="creditWallet" tabindex="-1" role="dialog" aria-labelledby="creditWalletLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="creditWalletLabel">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Confirm Your Action!
                    <input type="hidden" id="totBud" value="{{$wallet->budget ?? ''}}">
                    <input type="hidden" id="uid" value="{{$wallet->uid ?? ''}}">
                    <input type="hidden" id="vfee" value="{{$wallet->vicomma_fee ?? ''}}">
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-0">
                    <p class="percTitle">You are about to credit <b><span id="creditPerc"></span>%</b> of the Total Job
                        Budget</p>
                    <hr style="margin: 0px">
                    <div style="margin: 20px">
                        <div id="breakdown">
                            <div class="breakdown-item" style="background: #f4f3f3; padding: 5px 10px;">
                                <div class="breakdown-name">
                                    <div class="form-check pt-1">
                                        <label class="form-check-label big-font">
                                            <input type="checkbox" class="form-check-input" name=""
                                                id="vicWallet_checkbox" value="1">
                                            Withdraw from Vicomma Wallet <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="breakdown-cost pt-1"><small>Bal: <b><span
                                                id="balance">${{Auth::user()->generalwallet->balance ?? '0'}}</span></b></small>
                                </div>
                            </div>
                            <p class="small my-2 ttt">Select Payment Method</p>
                            <div class="formr ttt">
                                <label class="label">
                                    <input type="radio" name="p_method" value="flutterwave" checked />
                                    <span>Flutterwave</span>
                                </label>
                                <label class="label">
                                    <input type="radio" name="p_method" value="paystack" />
                                    <span>Paystack</span>
                                </label>
                                <label class="label">
                                    <input type="radio" name="p_method" value="paystack" />
                                    <span>PayPal</span>
                                </label>
                            </div>
                            <div class="breakdown-item">
                                <div class="breakdown-name">Amount</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="amt"></span></div>
                            </div>
                            <div class="breakdown-item" id="flutChargeDiv">
                                <div class="breakdown-name">Flutterwave Charge</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="flutCharge"></span></div>
                            </div>
                            <div class="breakdown-item" style="display: none;" id="payChargeDiv">
                                <div class="breakdown-name">Paystack Charge</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="payCharge"></span></div>
                            </div>
                            @if($wallet)
                            @if(!$wallet->vicomma_fee)
                            <div class="breakdown-item">
                                <div class="breakdown-name">Vicomma Charge</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="vicCharge"></span></div>
                            </div>
                            @endif
                            @endif
                            <div class="breakdown-item" id="payChargeDiv">
                                <div class="breakdown-name">VAT</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="vat"></span></div>
                            </div>
                            <div class="breakdown-item total">
                                <div class="breakdown-name">TOTAL</div>
                                <div class="breakdown-cost"><span>{{$wallet->currency->symbol ?? ''}}</span><span
                                        id="totCharge"></span></div>
                            </div>

                        </div>
                        <div class="d-flex">
                            <form action="{{route('wallet.credit')}}" method="post">
                                <input type="hidden" name="uid" id="vwallet_uid">
                                <input type="hidden" name="percT" id="vwallet_percT">
                                <input type="hidden" name="gwallet" id="from_gwallet">
                                <input type="hidden" name="type" value="flutterwave" id="py_type">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-sm ml-auto mt-3" value="Proceed">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var perc = 0;
        jQuery('document').ready(function() {
            var job_budget = "{{$job->budget_id}}";
            switch(job_budget) {
            case "1":
                // code block
                var px = 0.03;
                break;
            case "2":
                // code block
                var px = 0.03;
                break;
            case "3":
                // code block
                var px = 0.05;
                break;
            case "4":
                // code block
                var px = 0.05;
                break;
            case "5":
                // code block
                var px = 0.05;
                break;
            case "6":
                // code block
                var px = 0.08;
                break;
            case "7":
                // code block
                var px = 0.08;
                break;
            case "8":
                // code block
                var px = 0.10;
                break;                            
            default:
                // code block
                var px = 0.00;
            }
            $('.percBtn').click(function(){
                var pay_type = $('input[name="p_method"]:checked').val();
                
                var percT = $(this).attr('data-perc');
                var budget = $('#totBud').val();
                var uid = $('#uid').val();
                var vfee = $('#vfee').val();
                var vatfee = 1;

                $('#creditPerc').html(percT);

                perc = percT / 100;
                var amount = budget * perc;
                $('#amt').html(amount);

                var flutCharge = amount * 0.014;
                $('#flutCharge').html(flutCharge.toFixed(2));
                
                  var payCharge = amount * 0.015;
                $('#payCharge').html(payCharge.toFixed(2));

                var vicCharge = budget * px;
                $('#vicCharge').html(vicCharge.toFixed(2));

                 $('#vat').html(vatfee.toFixed(2));

                if(vfee == ''){
                    console.log(amount, pay_type)
                    var charge = pay_type == "flutterwave"? flutCharge + 1 : payCharge + 1;
                    var totCharge = amount + charge + vicCharge;
                }else{
                    var charge = pay_type == "flutterwave"? flutCharge + 1 : payCharge + 1;
                    var totCharge = amount + charge;
                }
                $('#totCharge').html(totCharge.toFixed(2));

                $('#vwallet_uid').val(uid);
                $('#vwallet_percT').val(percT);

                // $('#submitCharge').attr('href', '/wallet/'+uid+'/'+percT+'/credit');
            });

            $('#vicWallet_checkbox').click(function(){
                var pay_type = $('input[name="p_method"]:checked').val();
                var check_val = $(this).prop('checked');

                var percT = $('#creditPerc').html();;
                var budget = $('#totBud').val();
                var uid = $('#uid').val();
                var vfee = $('#vfee').val();
                var vatfee = 1;
                $('#vwallet_uid').val(uid);
                $('#vwallet_percT').val(percT);

                perc = percT / 100;
                var amount = budget * perc;

                var vicCharge = budget * px;
                var flutCharge = amount * 0.014;
                var payCharge = amount * 0.015;
                if(vfee == ''){
                     var charge = pay_type == "flutterwave"? flutCharge + 1 : payCharge + 1;
                    var totCharge = amount + charge + vicCharge;
                }else{
                    var charge = pay_type == "flutterwave"? flutCharge + 1: payCharge + 1;
                    var totCharge = amount + charge;
                }

                if(check_val == true){
                    var charge = pay_type == "flutterwave"? flutCharge + 1 : payCharge + 1;
                    $('#flutChargeDiv').hide();
                    $('#payChargeDiv').hide();
                    $('#totCharge').html((totCharge - charge).toFixed(2)); 
                    $('#from_gwallet').val('1'); 
                    $(".ttt").hide();
                    
                }else if(check_val == false){
                    if(pay_type == "flutterwave"){
                    $('#flutChargeDiv').show();
                    }
                    if(pay_type == "paystack"){
                    $('#payChargeDiv').show();
                    }
                    $('#vat').html(vatfee.toFixed(2));
                    $('#totCharge').html((totCharge).toFixed(2));
                    $('#from_gwallet').val('0');
                    $(".ttt").show();
                }
            });
            
            $('input[type=radio][name=p_method]').change(function() {
                console.log(this.value,"yee")
                var pay_type = $('input[name="p_method"]:checked').val();
                if (this.value == 'flutterwave' && !$('#vicWallet_checkbox').is(":checked")) {
                    // ...
                    console.log(this.value,"yee2")
                    $('#flutChargeDiv').show();
                    $('#payChargeDiv').hide();
                    $("#py_type").val(this.value)
                            // var percT = $(this).attr('data-perc');
                var percT = parseInt($('#creditPerc').html());
                var budget = $('#totBud').val();
                var uid = $('#uid').val();
                var vfee = $('#vfee').val();

                $('#creditPerc').html(percT);

                perc = percT / 100;
                var amount = budget * perc;
                $('#amt').html(amount);

                var flutCharge = amount * 0.014;
                $('#flutCharge').html(flutCharge.toFixed(2));
                
                  var payCharge = amount * 0.015;
                $('#payCharge').html(payCharge.toFixed(2));

                var vicCharge = budget * px;
                $('#vicCharge').html(vicCharge.toFixed(2));
console.log(amount, charge)
                if(vfee == ''){
                    console.log(amount, pay_type)
                    var charge = flutCharge;
                    var totCharge = amount + charge + vicCharge;
                }else{
                    var charge = flutCharge;
                    var totCharge = amount + charge;
                }
                $('#totCharge').html(totCharge.toFixed(2));

                $('#vwallet_uid').val(uid);
                $('#vwallet_percT').val(percT);
                }
                else if (this.value == 'paystack' && !$('#vicWallet_checkbox').is(":checked")) {
                    // ...
                    console.log(this.value,"yee2")
                    $('#flutChargeDiv').hide();
                    $('#payChargeDiv').show();
                    $("#py_type").val(this.value)
                    
                // var percT = $(this).attr('data-perc');
                var percT = parseInt($('#creditPerc').html());
                var budget = $('#totBud').val();
                var uid = $('#uid').val();
                var vfee = $('#vfee').val();

                $('#creditPerc').html(percT);

                perc = percT / 100;
                var amount = budget * perc;
                $('#amt').html(amount);

                var flutCharge = amount * 0.014;
                $('#flutCharge').html(flutCharge.toFixed(2));
                
                  var payCharge = amount * 0.015;
                $('#payCharge').html(payCharge.toFixed(2));

                var vicCharge = budget * px;
                $('#vicCharge').html(vicCharge.toFixed(2));

                if(vfee == ''){
                    console.log(amount)
                    var charge = payCharge;
                    var totCharge = amount + charge + vicCharge;
                }else{
                    var charge = payCharge;
                    var totCharge = amount + charge + payCharge;
                }
                $('#totCharge').html(totCharge.toFixed(2));

                $('#vwallet_uid').val(uid);
                $('#vwallet_percT').val(percT);
                }
            });
        });
</script>
@endpush