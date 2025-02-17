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
            <div class="card-header text-lg text-snd">Add a product</div>
            <div class="card-body">
                <form id="productForm" action="{{route('user.vendors.save')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="product-label" class="product-label" for="name">Product Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{old('name')}}" maxlength="30">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label class="product-label" class="product-label" for="name">Product Description <span class="required">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            id="content" cols="30" rows="5" maxlength="191">{{old('description')}}</textarea>
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
                                <option value="{{$category->id}}" @if (old('category_id')==$category->id)
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
                                class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="product-label" for="shipping">Shipping Fee Per Item ($) <span class="required">*</span></label>
                            <input type="number" min="1" name="shipping" id=""
                                class="form-control @error('shipping') is-invalid @enderror" value="{{old('shipping')}}">
                            @error('shipping')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="product-label" for="price">Quantity in Stock <span class="required">*</span></label>
                            <input type="number" min="1" name="stock" id=""
                                class="form-control @error('stock') is-invalid @enderror" value="{{old('stock')}}">
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
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
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
@endif
@push('scripts')
<script>
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
    });
</script>
@endpush
@endsection