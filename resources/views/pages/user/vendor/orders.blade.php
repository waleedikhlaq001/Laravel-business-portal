@extends('pages.app')

<style>
.table thead th {
    font-weight: 500;
    font-size: 15px;
    border-bottom: 1px solid #dee2e6 !important;
}
.table td,
.table th {
    border-top: 0 !important;
}
.table td,
.table th {
    font-size: 15px;
}
.chat-init {
    display: inline-flex;
    background: #f3f6f9;
}
.status {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}
.details .fas {
    transition: .3s all;
}
.fAsRT {
    transform: rotate(180deg);
}
tbody, td, tfoot, th, thead, tr {
    border-color: #a6d172!important;
    border-style: solid!important;
    border-width: 1px!important;
}
.breakdown-item{
            display: flex;
            padding: 10px;
            margin: 10px 0;
            background: #dbebc6;
            border-radius: 5px;
            color: #476423;
            font-weight: 500;
            justify-content: space-between;
        }

        .total{
            font-size: 22px;
            font-weight: 700;
            background: #66972b;
            color: #fff;
        }

        .percTitle{
            padding: 10px;
            margin: 0px;
            text-align: center;
        }
        .customBtn{
  border-radius:0px;
  padding:10px;
}



form input {
    display: inline-block;
    width: 50px;
    height: 50px;
    border: 2px solid #67972b;
    border-radius: 10px;
    text-align: center;
}
</style>

@section('content')
@include('includes.messages')

<div class="container-fluid">
    <div class="contactFreelancersContainer"
        style="height: 200px; background: url(/img/bdbg.png) center center / cover no-repeat; padding-left: 1rem; padding-right: 1rem;">
        <h6>Orders For My Products(Pending)</h6>
        <a href="{{route('user.vendor.orders')}}"
            class="btn btn-primary btn-sm d-block d-md-inline-block mt-2">
            View Completed Orders
        </a>
    </div>
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="jbContainer bg-white p-4 w-100 shadow" style="margin-top: -2rem;">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-left">
                        <tr>
                            <th>S/N</th>
                            <th>Product</th>
                            <th>Product Category</th>
                            <th>Buyer Name</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Quantity</th>
                            <th>Vicomma Charge</th>
                            <th>Shipping Fee</th>
                            <!-- <th>Status</th> -->
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products)>0)
                            @foreach ($products as $id => $product)
                            <tr>
                                <td>{{$id + 1}}</td>
                                <td class="position-relative">
                                    <a href="" class="text-snd" target="_blank">
                                        {{$product->name}}
                                    </a>
                                                
                                            
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                    {{DB::table("categories")->where("id", DB::table("products")->where("id", $product->product_id)->first()->category_id)->first()->name ?? ""}}
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                        {{$product->shipping_name}}
                                    </a>
                                </td>
                                <td>{{\Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</td>
                                <td>${{number_format($product->amount, 2)}}</td>
                                <td>
                                {{$product->qty}}
                                </td>
                                <td>${{DB::table("categories")->where("id", $product->category_id)->first()? number_format((DB::table("categories")->where("id", $product->category_id)->first()->percentage * $product->amount)/100, 2) : 0}}</td>
                                <td>${{number_format($product->shipping, 2)}}</td>
                                <!-- <td>
                                    <div class="d-flex mt-1">
                                        {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                                        {{-- @if ($job->isApproved == 2)
                                            <span class="mr-2 mt-1 status" style="background: red !important;"></span>
                                            Flagged
                                        @elseif ($job->isApproved == 1 && $job->isAwarded)
                                            <span class="mr-2 mt-1 status" style="background: green !important;"></span>
                                            Awarded
                                        @elseif ($job->isApproved == 1 && $job->isAwarded == 0)
                                            <span class="mr-2 mt-1 status" style="background: #ffbf00 !important;"></span>
                                            Open
                                        @elseif ($job->isApproved == 0)
                                            <span class="mr-2 mt-1 status" style="background: #6f3c96 !important;"></span>
                                            Pending
                                        @endif --}}
                                    </div>
                                </td> -->
                                <td>
                                @if ($product->status == 1)
                                    @if ($product->status == 2)
                                        <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Completed">
                                            <i class="fa fa-check" aria-hidden="true" style="font-size: 15px;"></i>
                                        </button>
                                    @elseif ($product->status == 1)
                                        <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Shipping">
                                            <i class="fas fa-truck" aria-hidden="true"></i>
                                        </button>
                                    @else
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Pending">
                                            <i class="fas fa-spinner" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                @else
                                <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Pending">
                                            <i class="fas fa-spinner" aria-hidden="true"></i>
                                        </button>
                                @endif 
                                </td>
                                <td>
                                    <a class="btn btn-sm details" data-bs-toggle="collapse" href="#col_{{$product->id}}"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-chevron-down text-lg dwn"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="border-0">
                                    <div class="collapse" id="col_{{$product->id}}">
                                        <div class="card card-body border-0 shadow-none">
                                        <div class="row">
                                               
                                               <div class="col-12 col-sm-12 col-md-5 col-xl-5">
                                                   <div class="mt-2 jbDetailsSection">
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Buyer Name</h6>
                                                       <p class="text-sm">{{$product->shipping_name ?? ''}}</p>
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Buyer's Email Address</h6>
                                                       <p class="text-sm">{{$product->email ?? ''}}</p>    
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Buyer's Phone Number</h6>
                                                       <p class="text-sm">{{$product->phone ?? ''}}</p>   
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Buyer Name</h6>
                                                       <p class="text-sm">{{$product->shipping_name ?? ''}}</p>   
                                                       @if($product->status == 0)  
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Start Shipping</h6>
                                                       <p class="text-sm"> 
                                                        <!-- <div class="form-group">
                                                        <select class="form-control" id="exampleFormControlSelect2">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Shipping</option>
                                                        <option value="2">Delivered</option>
                                                        </select>
                                                    </div> -->
                                                    <button class="btn btn-warning" id="shipp_{{$product->id}}" onclick="ship({{$product->id}})">Start</button>
                                                    </p>     
                                                    @elseif($product->status == 1)

                                                    <h6 class="mt-2 text-uppercase text-sm mb-1">Start Delivery</h6>
                                                       <p class="text-sm"> 
                                                        <!-- <div class="form-group">
                                                        <select class="form-control" id="exampleFormControlSelect2">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Shipping</option>
                                                        <option value="2">Delivered</option>
                                                        </select>
                                                    </div> -->
                                                    <button class="btn btn-primary" onclick="opendel('{{$product->id}}', '{{$product->shipping_name}}', {{$product->amount}}, {{DB::table('categories')->where('id', $product->category_id)->first()? number_format((DB::table('categories')->where('id', $product->category_id)->first()->percentage * $product->amount)/100, 2) : 0}})">Initiate Delivery</button>
                                                    </p>     
                                                    @endif
                                                           
                                                   </div>
                                               </div>
                                               <div class="col-12 col-sm-12 col-md-7 col-xl-7">
                                                   <div class="jbDetailsSection pl-4 pr-4">
                                                   <h6 class="mt-2 text-uppercase text-sm mb-1">Shipping Address</h6>
                                                       <p class="text-sm">{{$product->shipping_address ?? ''}}</p>
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">State/City</h6>
                                                       <p class="text-sm">{{$product->state ?? ''}}</p>    
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Country</h6>
                                                       <p class="text-sm">{{$product->country ?? ''}}</p>   
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Zip Code</h6>
                                                       <p class="text-sm">{{$product->zip ?? ''}}</p>  
                                                   </div>
                                               </div>
                                           </div> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <h2 class="mb-3">You do not have any order yet</h2>
                        @endif
                    </tbody>
                </table>
                {{count($products) > 1? $products->links() : ""}}
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>
</div>
<div class="modal fade" id="delivery" tabindex="-1" role="dialog" aria-labelledby="creditWalletLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="delivery">
                    <!-- <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i> -->
                    Delivery Action
                    
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-0">
                    <div class="one">
                    <p class="percTitle">You are about to Intitate the Delivery of this Product</p>
                    <hr style="margin: 0px">
                    <div style="margin: 20px">
                    <div class="alert alert-icon alert-danger alert-bg alert-inline show-code-actiona mb-3" id="alert2" style="display: none;"></div>
                        <div id="breakdown">
                            <div class="breakdown-item">
                                <div class="breakdown-name">Vicomma Charge</div>
                                <div class="breakdown-cost"><span>$</span><span id="charge">50.00</span></div>
                            </div>
                            <div class="breakdown-item">
                                <div class="breakdown-name">Total Earnings</div>
                                <div class="breakdown-cost"><span>$</span><span id="amt">600.00</span></div>
                            </div>
                            <input type="hidden" id="amount">
                            <input type="hidden" id="id">
                           
                            
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm ml-auto mt-3" onclick="deliv()" id="delv_" href="#">Proceed</a>
                        </div>
                    </div>

                    </div>
                    <div class="two mb-3" style="display: none;">
                    <div class="alert m-3 alert-icon alert-danger alert-bg alert-inline show-code-actiona mb-3" id="alert3" style="display: none;"></div>
                    <center>
                    <img src="/ecom/delivery.png" style="height: 250px" />
                    <p class="small px-3 mt-2 ">A Delivery Code has ben Sent to the Customer: <b id="cust" class="text-uppercase"></b>. Please Provide The Delivery Code to confirm your delivery.</p>
                    <form class="mb-5">
                    <input class="otp input" id="t1" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 required>
                    <input class="otp input" id="t2" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 required>
                    <input class="otp input" id="t3" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 required>
                    <input class="otp input" id="t4" type="text" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 required>
                    <input class="otp input" id="t5" type="text" oninput='digitValidate(this)'onkeyup='tabChange(5)' maxlength=1 required>
                    <input class="otp input" id="t6" type="text" oninput='digitValidate(this)'onkeyup='tabChange(6)' maxlength=1 required>
                    <div class="mt-2">
                            <a class="btn btn-primary btn-sm ml-auto mt-3" onclick="otp()" id="otp" href="#">Continue</a>
                        </div>
                    </form>
                </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
// jQuery(document).ready(function() {
//     jQuery('.details').on('click', '.fas', function() {
//     jQuery('.dwn').toggleClass('fAsRT')
//         console.log('icon');
//     })
// })
const opendel = (id, name, amount, charge) => {
    $("#amount").val(amount - charge)
    $("#id").val(id)
    $("#charge").text(charge)
    $("#amt").text(amount - charge)
    $("#cust").text(name)
    $('#alert2').hide()
    $('#alert3').hide()
    $('#one').show()
    $('#two').hide()
    $("#delivery").modal("show")
}
const deliv = () => {
    $.ajax({
          // the server script you want to send your data to
            'url': '/my-store/start-delivery',
            // all of your POST/GET variables
            'data': {
                // 'dataname': $('input').val(), ...
                order: $("#id").val(),
                "_token":"{{ csrf_token() }}"
            },
            // you may change this to GET, if you like...
            'type': 'post',
         
            'beforeSend': function () {
                // anything you want to have happen before sending the data to the server...
                // useful for "loading" animations
                $("#delv_").attr("disabled",true)
    $("#delv_").html(`Loading...`)
    $('#alert2').hide()
            }
        })
        .done( function (response) {
            $("#alert2").removeClass("alert-danger")
            $("#alert2").addClass("alert-success")
            $('#alert2').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
            // UIkit.notification(`<span uk-icon='icon: check' style="color: green"></span> ${response.message}`);
            setTimeout(() => {
            $('.one').hide()
            $('.two').show()
            $("#alert2").hide()
            }, 1000);
        })
        .fail( function (code, status) {
            $("#alert2").removeClass("alert-success")
                    $("#alert2").addClass("alert-danger")
            $('#alert2').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON && code.responseJSON.message? code.responseJSON.message : "There was an error with your request"}`)
            // UIkit.notification(`<span uk-icon='icon: alert-circle' style="color: red"></span> ${code.responseJSON.message}`);
            // $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)

         
        })
        .always( function (xhr, status) {
            // what you want to have happen no matter if the response is success or error
            // here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
    $('#alert2').show()
    $("#delv_").attr("disabled",false)
    $("#delv_").html(`Start`)
        });
}
const ship = (id) => {
        // prevent the usual form submission behaviour; the "action" attribute of the form
        // validation goes below...
            // now for the big event
            $.ajax({
          // the server script you want to send your data to
            'url': '/my-store/start-shipping',
            // all of your POST/GET variables
            'data': {
                // 'dataname': $('input').val(), ...
                order: id,
                "_token":"{{ csrf_token() }}"
            },
            // you may change this to GET, if you like...
            'type': 'post',
         
            'beforeSend': function () {
                // anything you want to have happen before sending the data to the server...
                // useful for "loading" animations
                $("#shipp_"+id).attr("disabled",true)
    $("#shipp_"+id).html(`Loading...`)
            }
        })
        .done( function (response) {
            swal("SUCCESS", response.message, "success")
            location.reload()
        })
        .fail( function (code, status) {
            swal("ERROR", code.responseJSON.message, "error")
          
        })
        .always( function (xhr, status) {
            // what you want to have happen no matter if the response is success or error
            // here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
    // $('#alert2').show()
    $("#shipp_"+id).attr("disabled",false)
    $("#shipp_"+id).html(`Start`)
        });
    };
    let digitValidate = function(ele){
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g,'');
}

let tabChange = function(val){
    let ele = document.querySelectorAll('.input');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
    console.log(val)
 }
const otp = () => {
    $.ajax({
          // the server script you want to send your data to
            'url': '/my-store/deliver',
            // all of your POST/GET variables
            'data': {
                // 'dataname': $('input').val(), ...
                id: $("#id").val(),
                otp: `${$("#t1").val()}${$("#t2").val()}${$("#t3").val()}${$("#t4").val()}${$("#t5").val()}${$("#t6").val()}`,
                amount: $("#amount").val(),
                "_token":"{{ csrf_token() }}"
            },
            // you may change this to GET, if you like...
            'type': 'post',
         
            'beforeSend': function () {
                // anything you want to have happen before sending the data to the server...
                // useful for "loading" animations
                $(".input").attr("disabled",true)
    // $("#delv_").html(`Loading...`)
    $("#otp").attr("disabled",true)
    $("#otp").html(`Loading...`)
    $('#alert3').hide()
            }
        })
        .done( function (response) {
            $("#alert3").removeClass("alert-danger")
            $("#alert3").addClass("alert-success")
            $('#alert3').html(` <em class="icon ni ni-alert-circle"></em>   ${response.message}`)
            // UIkit.notification(`<span uk-icon='icon: check' style="color: green"></span> ${response.message}`);
            location.reload()
        })
        .fail( function (code, status) {
            $("#alert3").removeClass("alert-success")
                    $("#alert3").addClass("alert-danger")
            $('#alert3').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON && code.responseJSON.message? code.responseJSON.message : "There was an error with your request"}`)
            // UIkit.notification(`<span uk-icon='icon: alert-circle' style="color: red"></span> ${code.responseJSON.message}`);
            // $('#alert').html(` <em class="icon ni ni-alert-circle"></em>   ${code.responseJSON.message}`)

         
        })
        .always( function (xhr, status) {
            // what you want to have happen no matter if the response is success or error
            // here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
    $('#alert3').show()
    $(".input").attr("disabled",false)
    $(".input").val("")
    // $("#delv_").html(`Start`)
    $("#otp").attr("disabled",false)
    $("#otp").html(`Start`)
        });
}

</script>

@endpush
@endsection
