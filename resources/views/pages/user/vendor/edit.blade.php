@extends('pages.app')

@php
$user = Auth::user();
@endphp

@push('css')
   <style>
        .error {
            color: red;
            font-size: 12px;
            font-weight: 400 !important;
        }
        .product-label{
            font-size: 14px !important;
            font-weight: 500 !important;
        }

        #video_mt {
        position: relative;
        background-color: black;
        height: 100vh;
        min-height: 45rem;
        width: 100%;
        overflow: hidden;
    }

    #video_mt video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        -ms-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }

    #background {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: black;
        opacity: 0.5;
        z-index: 0;
    }

    .container-fluid{
        padding-left: 50px !important;
        padding-right: 50px !important;
    }

    @media (max-width: 768px) {
        .container-fluid{
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    }
        
.l-modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%; 
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transform: scale(1.1);
    text-align: center;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
}

.l-modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #6F3C96;
    color: #fff;
    padding: 2rem 3rem 2rem 3rem;
    width: 40rem;
    border-radius: 30px;
}

@media screen and (max-width: 555px){
   .l-modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #6F3C96;
    color: #fff;
    padding: 2rem 2.5rem 2rem 2.5rem;
    width: 25rem;
    border-radius: 30px;
} 

.txx {
    font-size: 13px!important;
}
}

.l-close-button {
    float: right;
    width: 1.8rem;
    line-height: 1.5rem;
    text-align: center;
    display: flex;
    align-items: center;
    /*padding-bto*/
    padding-bottom: 3px;
    font-size: 21px;
    justify-content: center; 
    cursor: pointer;
    border-radius: 50%;
    color: #6F3C96;
    background-color: #fff;
}

.l-close-button:hover {
    background-color: darkgray;
}

.show-modal {
    opacity: 1;
    visibility: visible;
    z-index: 9999;
    transform: scale(1.0);
    transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
}
    </style>
@endpush

@section('content')
@include('includes.messages')

@if(Auth::user()->isPhoneVerified != "1")
    <div class="col-8 m-auto">
        <div class="card d-flex position-relative" style="min-height: 150px; margin-top: 120px; box-shadow: 2px 3px 12px 8px rgba(0, 0, 0, 0.11); border-radius: 30px;">
            <div class="position-absolute top-0 start-50 translate-middle">
                <div class="position-relative d-flex" style="background: #94CA52; height: 120px; width:120px; border-radius: 50%;">
                    <i class="fa fa-exclamation-circle fs-5 position-absolute" style="top: 10%; right:20%;color: #fff; width:20px; height:20px;" aria-hidden="true"></i>
                    <img class="m-auto mt-2" src="{{ asset('img/phonexxs.png') }}" style="width: 50%; height: 50%" alt="">
                </div>
            </div>
            
            <p class="p-5 text-center" style="margin-top: 70px;  color:#fff;">
                <a class="btn btn-outline-light text-decoration-none btn-sm update-t px-4 py-2" href="/settings" role="button"
                style="background-color: #6f3c96; color: white !important;"
                >Verify Your Phone Number</a>
            </p>
        </div>
    </div>
@else
<div class="container-fluid">
    <div class="container">
        <div class="card shadow">
            <div class="card-header text-lg text-snd">Edit Product</div>
            <div class="card-body">
                <form id="productForm" action="{{route('user.vendors.edit')}}" method="POST"
                    enctype="multipart/form-data">
                    <input name="product_id" type="hidden" value="{{$product->id}}" />
                    @csrf
                    
                    <div class="form-group">
                        <label class="product-label" class="product-label" for="name">Product Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{$product->name}}" maxlength="30">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label class="product-label" class="product-label" for="name">Product Description <span class="required">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            id="content" cols="30" rows="5" maxlength="191">{{$product->description}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label class="product-label" class="product-label" for="name">Product Image <span class="required">*</span></label>
                        <div class="row g-2 justify-content-center imgContainer">
                        </div>
                        <input type="file" name="images[]" id="images" class="form-control" multiple
                            accept="image/jpeg, image/png, image/jpg">
                    </div>
                    <div class="form-row mt-4">
                        <div class="col-md-6">
                            <label class="product-label" for="category_id">Select product category <span class="required">*</span></label>
                            <select name="category_id" id=""
                                class="form-control form-select @error('category_id') is-invalid @enderror">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if ($product->category_id == $category->id)
                                    {{'selected'}}@endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="product-label" for="price">Product price ($) <span class="required">*</span></label>
                            <input type="text" name="price" id=""
                                class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="product-label" for="shipping">Shipping Fee Per Item ($) <span class="required">*</span></label>
                            <input type="number" min="1" name="shipping" id=""
                                class="form-control @error('shipping') is-invalid @enderror" value="{{$product->shipping}}">
                            @error('shipping')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="product-label" for="price">Quantity in Stock <span class="required">*</span></label>
                            <input type="number" min="1" name="stock" id=""
                                class="form-control @error('stock') is-invalid @enderror" value="{{$product-> stock}}">
                            @error('stock')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-4 colorContainer">
                        <div class="d-flex align-items-center">
                            <label class="product-label" for="color" class="mt-2 mr-2">Color </label>
                            <input type="color" name="colors[]" id="color">
                            <span class="p-1 ml-2 text-white addColor" style="font-size: .7rem; background: #93c952;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add
                            </span>
                        </div>
                        <small class="text-muted">*Select colors for item if it applies to the product</small>
                    </div>
                    @if($vendor->vendorDigitalSignature)
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    @else
                        <div class="form-group mt-4">
                            <button id="digitalSignBtn" class="btn btn-primary">Save</button>
                        </div>
                    @endif
                </form>
                <div class="d-none clone">
                    <div class="d-flex align-items-center">
                        <label class="product-label" for="color" class="mt-2 mr-2">Color</label>
                        <input type="color" name="colors[]" id="color">
                    </div>
                </div>
            </div>
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
            <!-- <div class="px-3 mb-2">
                <p>Products offered for sale on vicomma must be authentic. The sale or promotion of counterfeit products/services is strictly prohibited on the platform including our mobile app. Failure to abide by this policy may result in loss of selling privileges and/or funds being withheld. The sale, trafficking, and or promotion of counterfeit products/services may also result in referral to law enforcement/criminal prosecution as well as civil action. It is each seller’s and supplier’s responsibility to source, sell, and fulfill only authentic products. Prohibited products include bootlegs, fakes, or pirated copies of products or content; products that have been illegally replicated, reproduced, or manufactured; and products that infringe another party’s intellectual property rights. You must agree to these terms to sell and/or promote on vicomma by your digital signature. To learn more please visit our <a href="/terms">Terms & Conditions Page</a></p>
                <div class="mb-3 form-check">
                    <input id="agreeSign" type="checkbox" class="form-check-input mt-0" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">By checking this box, I agree to comply with vicomma's stated policies.</label>
                </div>
            </div>
            <button id="signContinue" class="btn btn-primary m-auto footer-btn my-3" disabled>Continue</button> -->
        </div>
    </div>
</div>

<div class="l-modal">
    <div class="l-modal-content">
        <span class="l-close-button">×</span>
        <img src="/Group (1).png" style="margin-top: 30px; margin-bottom: 20px;height: 100px; margin-left: 45px;">
        <!--<h1 style="font-size: 26px;">Hello, I am a modal!</h1>-->
        <p class="txx" style="font-size: 13px; line-height: 1.7; color: #fff;text-align: justify;">Products offered for sale on vicomma must be authentic. The sale or promotion of counterfeit products/services is strictly prohibited on the platform including our mobile app. Failure to abide by this policy may result in loss of selling privileges and/or funds being withheld. The sale, trafficking, and or promotion of counterfeit products/services may also result in referral to law enforcement/criminal prosecution as well as civil action. It is each seller’s and supplier’s responsibility to source, sell, and fulfill only authentic products. Prohibited products include bootlegs, fakes, or pirated copies of products or content; products that have been illegally replicated, reproduced, or manufactured; and products that infringe another party’s intellectual property rights. You must agree to these terms to sell and/or promote on vicomma by your digital signature. To learn more please visit our <a href="/terms" style="color: #94CA52;">Terms & Conditions Page</a></p>
        <div class="" style="font-size: 13px; line-height: 1.7; color: #fff;">
                 <div class="mb-3 form-check" style="display: flex; align-items: center; gap: 10px;">
                    <input id="agreeSign" type="checkbox" class="form-check-input mt-0" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">By checking this box, I agree to comply with vicomma's stated policies.</label>
                </div>
            </div>
            <button id="signContinue" class="btn btn-primary m-auto footer-btn my-3" disabled>Continue</button>
        <!--<button class="btn btn-sm btn-primary">Continue</button>-->
    </div>
</div>
<!--Digital Sign Modal End-->
@endif
@push('scripts')
<script>
               const modal = document.querySelector(".l-modal");
            // const trigger = document.querySelector(".trigger");
            const closeButton = document.querySelector(".l-close-button");
            
            function toggleModal() {
                modal.classList.toggle("show-modal");
            }
            
            function windowOnClick(event) {
                if (event.target === modal) {
                    toggleModal();
                }
            }
    var doc = document.querySelector('#images');
    var filesContainer = document.querySelector('.imgContainer');
    var color1 = document.querySelector('#color1');
    var colorContainer = document.querySelector('.colorContainer');
    jQuery('document').ready(function() {
        jQuery('#productForm').validate({
            rules: {
                name: 'required',
                description: 'required',
                images: 'required',
                category_id: 'required',
                price: 'required'
            },
            messages: {
                name: {
                    required: 'product name is required!'
                },
                description: {
                    required: 'product description is required!'
                },
                category_id: {
                    required: 'product category is required!'
                },
                price: {
                    required: 'product price is required!'
                }
            }
        })
        CKEDITOR.replace('content');
        jQuery('.addColor').on('click', function() {
            var newColor = jQuery('.clone').html();
            colorContainer.insertAdjacentHTML('afterbegin', newColor);
        });
        jQuery('#color').on('change', function(e) {
            jQuery(this).val(e.target.value);
            console.log(jQuery(this).val())
        })
        // jQuery('#color2').on('change', function(e) {
        //     console.log(e.target.value);
        //     jQuery('#color2').val(e.target.value);
        // })
        // Multiple images preview in browser
        $('#images').on('change', function() {
            imagesPreview(this);
            console.log($(this).val());
        });
        var imagesPreview = function(input) {
            if (input.files) {
            var filesAmount = input.files.length;
            $(".imgContainer").html("")
                for (i = 0; i < filesAmount; i++) {
                    var reader=new FileReader();
                    reader.onload = function(event) {
                        // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        var img = event.target.result;
                        // console.log(e.target.result);
                        filesContainer.insertAdjacentHTML('afterbegin', `
                            <div class="col-sm-12 col-md-12 col-lg-3">
                                <img src="${img}" class="img-fluid" alt="">
                            </div>
                        `);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $("#agreeSign").on('change', (e) => {
            e.preventDefault();
            if(e.target.checked){
                $("#signContinue").removeAttr("disabled");
            } else{
                $("#signContinue").attr("disabled", "disabled");
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
                            // window.location.replace("/my-store/create");
                            $('#productForm').submit();
                        }
                    }
                })
            }
        })
        $('#digitalSignBtn').on('click', (e)=>{
            e.preventDefault()
            console.log('been Clicked')
            // $('#signModal').modal('show')
            toggleModal();
        })
    });
</script>
@endpush
@endsection