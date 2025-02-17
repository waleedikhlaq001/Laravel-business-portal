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
        <h6>My Products</h6>
        @if($vendor->vendorDigitalSignature)
        <a href="/my-store/create"
            class="btn btn-primary btn-sm d-blok d-md-inine-block mt-2 mb-3">
            Add A New Product
        </a>
        @else
        <button id="digitalSignBtn"
            class="btn btn-primary btn-sm d-blok d-md-inine-block mt-2 mb-3">
            Add A New Product
        </button>
        @endif
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
                            <th>Delete</th>
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
                                @if($vendor->vendorDigitalSignature)
                                <td><a href="/my-store/edit/{{$product->id}}" class="btn btn-primary btn-sm">Edit</a></td>
                                @else
                                <td><button id="editDigitalSignBtn" class="btn btn-primary btn-sm">Edit</button></td>
                                @endif
                                <td>
                                <button onclick="delete_product({{$product->id}})" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Delete Product">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                                </td>
                            </tr>
                           
                            @endforeach
                        @else
                        <h6 class="my-1">You do not have any Product in your Station</h6>
                <a href="/my-store/create" class="btn btn-primary my-3" target="_blank" role="button">
                    Upload Product
                </a>
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
<!--Digital Sign Modal -->
<div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <img alt="" src="/img/path1.png" class="p1">
            <img alt="" src="/img/path2.png" class="p2">
            <div class="d-flex p-3">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Disclaimer</h5>
                <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal" aria-label="Close" style="z-index: 9999"></button>
            </div>
            <div class="px-3 mb-2">
                <p>Products offered for sale on vicomma must be authentic. The sale or promotion of counterfeit products/services is strictly prohibited on the platform including our mobile app. Failure to abide by this policy may result in loss of selling privileges and/or funds being withheld. The sale, trafficking, and or promotion of counterfeit products/services may also result in referral to law enforcement/criminal prosecution as well as civil action. It is each seller’s and supplier’s responsibility to source, sell, and fulfill only authentic products. Prohibited products include bootlegs, fakes, or pirated copies of products or content; products that have been illegally replicated, reproduced, or manufactured; and products that infringe another party’s intellectual property rights. You must agree to these terms to sell and/or promote on vicomma by your digital signature. To learn more please visit our <a href="/terms">Terms & Conditions Page</a></p>
                <div class="mb-3 form-check">
                    <input id="agreeSign" type="checkbox" class="form-check-input mt-0" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">By checking this box, I agree to comply with vicomma's stated policies.</label>
                </div>
            </div>
            <button id="signContinue" class="btn btn-primary m-auto footer-btn my-3" disabled>Continue</button>
        </div>
    </div>
</div>
<!--Digital Sign Modal End-->
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
    document.getElementById("agreeSign").addEventListener('change', (e) => {
        e.preventDefault();
        if(e.target.checked){
            document.getElementById("signContinue").removeAttribute('disabled');
        } else{
            document.getElementById("signContinue").setAttribute("disabled", "disabled");
        }
    })

    $("#signContinue").on('click', (e)=> {
        e.preventDefault();
        if($("#agreeSign").is(":checked")){
            $.ajax({
                url:"{{route('user.vendors.digitalSign')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                'type': 'POST',
                'data': {
                    "signature": true
                },
                success: function(result){
                    console.log(result)
                    if(result.status == 'success'){
                        if(isEditClicked){
                            window.location.replace("/my-store/edit/{{$product->id}}");
                        }else{
                            window.location.replace("/my-store/create");
                        }
                    }
                }
            })
        }
    })

    var isEditClicked = false

    const digitalSignBtn = document.getElementById('digitalSignBtn')
    digitalSignBtn.addEventListener("click", () => {
        isEditClicked = false
       var signModal = new bootstrap.Modal(document.getElementById('signModal'),{keyboard: false})
       signModal.show();
    })
    const editDigitalSignBtn = document.getElementById('editDigitalSignBtn')
    editDigitalSignBtn.addEventListener("click", () => {
        isEditClicked = true
       var signModal = new bootstrap.Modal(document.getElementById('signModal'),{keyboard: false})
       signModal.show();
    })
</script>
<script>

const delete_product = (id) => {
    Swal.fire({
  title: 'Looks, like you want to delete your Product; are you sure? ',
  text: 'Well, if you really must, just click delete.',
  showDenyButton: true,
  icon: "info",
  confirmButtonText: 'Delete',
  denyButtonText: `Cancel`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $.post('/my-store/delete-product',{
          id,
          "_token":"{{csrf_token()}}"
        }).done((res)=>{
            Swal.fire("",res.message,"success")
            setTimeout(()=>{
              location.reload();
            },1000)
        }).fail((err)=>{
        //   $("button").attr("disabled",false)
            Swal.fire("",err.responseJSON.message,"error")
        })
  } else if (result.isDenied) {
    // Swal.fire('Changes are not saved', '', 'info')
  }
})
}
</script>
@endpush
@endsection
