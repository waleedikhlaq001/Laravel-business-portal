@extends('pages.app')
@push('scripts')
<script>
     document.title = "My Orders";
</script>
@endpush
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
    border-color: #a6d172;
    border-style: solid;
    border-width: 2px;
}
</style>

@section('content')
@include('includes.messages')

<div class="container-fluid">
    <div class="contactFreelancersContainer"
        style="height: 200px; background: url(/img/bdbg.png) center center / cover no-repeat; padding-left: 1rem; padding-right: 1rem;">
        <h6>My Orders</h6>
        
    </div>
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="jbContainer bg-white p-4 w-100 shadow" style="margin-top: -2rem;">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-left">
                        <tr>
                            <th>Order ID</th>
                            <th>Buyer Name</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Products Bought</th>
                            <!-- <th>Status</th> -->
                            <!-- <th>Status</th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders)>0)
                            @foreach ($orders as $order)
                            <tr>
                                <td class="position-relative">
                                    <a href="" class="text-snd" target="_blank">
                                        #{{$order->id}}
                                    </a>
                                                
                                            
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                        {{$order->shipping_name}}
                                    </a>
                                </td>
                                <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                                <td>${{number_format($order->total, 2)}}</td>
                                <td>
                                {{$order->quantity}}
                                </td>
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
                                    <a class="btn btn-sm details" data-bs-toggle="collapse" href="#col_{{$order->id}}"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-chevron-down text-lg dwn"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="border-0">
                                    <div class="collapse" id="col_{{$order->id}}">
                                        <div class="card card-body border-0 shadow-none">
                                        <div class="row">
                                               
                                               <div class="col-12 col-sm-12 col-md-3 col-xl-3">
                                                   <div class="mt-2 jbDetailsSection">
                                                   <h6 class="mt-2 text-uppercase text-sm mb-1">Shipping Address</h6>
                                                       <p class="text-sm">{{$order->shipping_address ?? ''}}</p>
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">State/City</h6>
                                                       <p class="text-sm">{{$order->state ?? ''}}</p>    
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Country</h6>
                                                       <p class="text-sm">{{$order->country ?? ''}}</p>   
                                                       <h6 class="mt-2 text-uppercase text-sm mb-1">Zip Code</h6>
                                                       <p class="text-sm">{{$order->zip ?? ''}}</p>  
                                                   </div>             
                                                   </div>
                                               
                                               <div class="col-12 col-sm-12 col-md-9 col-xl-9">
                                                   <h4 class="mb-3 mt-2">Products Purchased</h4>
                                                   <div class="table-responsive">
                                                   <!-- <div class="jbDetailsSection pl-4 pr-4"> -->
                                                   <table class="table">
                    <thead class="text-left">
                        <tr>
                            <th>Product</th>
                            <th>Buyer Name</th>
                            <th>Product Category</th>
                            <th>Vendor</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Quantity</th>
                            <!-- <th>Status</th> -->
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($order->details)>0)
                            @foreach ($order->details as $product)
                            <tr>
                                <td class="position-relative">
                                    <a href="" class="text-snd" target="_blank">
                                        {{$product->name}}
                                    </a>
                                                
                                            
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                        {{$order->shipping_name}}
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                        {{DB::table("categories")->where("id", DB::table("products")->where("id", $product->product_id)->first()->category_id)->first()->name ?? ""}}
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-snd">
                                    {{App\Models\Product::where("id", $product->product_id)->first()->vendor->vendor_station ?? ""}}
                                    </a>
                                </td>
                                <td>{{\Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</td>
                                <td>${{number_format($product->amount, 2)}}</td>
                                <td>
                                {{$product->qty}}
                                </td>
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
                                    @if ($product->status && $product->status)
                                        <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Completed">
                                            <i class="fa fa-check" aria-hidden="true" style="font-size: 15px;"></i>
                                        </button>
                                    @elseif ($product->status && !$product->status)
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
                              </tr>
                            @endforeach
                        @else
                            <h2 class="mb-3">No Data Available</h2>
                        @endif
                    </tbody>
                </table>
                </div>
                                               </div>
                                           </div> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <h2 class="mb-3">You have not made any order yet.</h2>
                        @endif
                    </tbody>
                </table>
                {{count($orders) > 1? $orders->links() : ""}}
            </div>
        </div>
        {{-- </div> --}}
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
</script>
@endpush
@endsection
