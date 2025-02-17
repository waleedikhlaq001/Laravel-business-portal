@extends('pages.app')

<style>
.table thead th {
    font-weight: 500;
    font-size: 15px;
    /* border-bottom: 1px solid #dee2e6 !important; */
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
</style>

@section('content')
@include('includes.messages')

<div class="container-fluid">
    <div class="contactFreelancersContainer"
        style="height: 200px; background: url(/img/bdbg.png) center center / cover no-repeat; padding-left: 1rem; padding-right: 1rem;">
        <h6>Deleted Products</h6>
       
    </div>
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="jbContainer bg-white p-4 w-100 shadow" style="margin-top: -2rem;">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-left">
                        <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <!-- <th>Image</th> -->
                            <th>Price</th>
                            <th>Category</th>
                            <th>Amount in Stock</th>
                            <th>Shipping Fee</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products)>0)
                            @foreach ($products as $id => $product)
                            <tr>
                                <td>{{$id + 1}}</td>
                                <td class="position-relative">
                                    <a href="/mall/products/{{$product->id}}" class="text-snd" target="_blank">
                                        {{$product->name}}
                                    </a>
                                                
                                            
                                </td>
                                <!-- <td>
                                    <a href="#" class="text-snd">
                                        {{$product->shipping}}
                                    </a>
                                </td> -->
                                <td>
                                ${{number_format($product->price, 2)}}
                                </td>
                                <td>${{DB::table("categories")->where("id", $product->category_id)->first()->name ?? ""}}</td>
                                <td>
                                {{$product->stock}}
                                </td>
                                <td>${{number_format($product->shipping, 2)}}</td>
                                <td>{{\Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</td>
                               <td></td>
                            </tr>
                           
                            @endforeach
                        @else
                        <h6 class="my-1">You have not deleted any Product in your Station</h6>
                
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

@push('scripts')
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
// jQuery(document).ready(function() {

</script>
@endpush
@endsection
