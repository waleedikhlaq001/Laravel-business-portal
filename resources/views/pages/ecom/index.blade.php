@extends('pages.app')
<link rel="stylesheet" href="{{ asset('/css/mall-navigation.css') }}">
@push('css')
<style>
    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 5.5px;
        margin-left: 5.5px;
    }

</style>
@endpush
@section('content')
<!-- Start of Main -->
<main class="main">

    <div class="p-2 p-lg-5">
        <div class="row" style="margin-right: 5.5px !important;margin-left: 5.5px !important;">
            <div class="col-md-9">
                <h3 class="mb-4 mt-5" style="font-size: 40px; color: rgba(111, 60, 150, 1); ">The Mall at
                    vicomma</h3>
                <div class="row">
                    @foreach(DB::table("products")->latest()->limit(15)->get() as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <img style="object-fit: scale-down;background: #f5f5f5; height: 360px;"
                                src="{{$product->image && gettype(json_decode($product->image)) == 'array' && count(json_decode($product->image)) > 0 && json_decode($product->image)[0]? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.json_decode($product->image)[0] : '/img/empty.png'}}"
                                alt="Product" />
                            <div class="card-body">
                                <h4 class="product-name product-title" id="{{$product->id}}"><a
                                        href="/mall/show/{{$product->id}}" style="color: rgba(0, 0, 0, 1);
                                        font-weight: 700;
                                        font-size: 21px;
                                    }">{{$product->name}}</a></h4>
                                <div class="d-flex mt-4" style="justify-content: space-between;align-items: center;">
                                    <div class="product-price" id="sh{{$product->shipping}}" style="color: rgba(0, 0, 0, 1);
                                        font-size: 22px;
                                        font-weight: 400;">
                                        {{$geo['currency_symbol']}}{{$product->price*$geo['exchange_rate']}}
                                        <!-- <del class="old-price">$266.38</del> -->
                                    </div>
                                    <button class="btn-cart btn-product btn cart-btn" id="{{$product->id}}" style="background: rgba(111, 60, 150, 1);
                                    border-radius: 20px;
                                    color: white;
                                    padding: 3px 20px;">Add
                                        To Cart</button>

                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 p-3 vid-products shadow">
                <div class="row">
                    <span class="w-100" style="color: #6F3C96; font-family: 'poppins';">Top Selling</span>
                    <span class="w-100" style="height: 30px; margin-top: -10px;">
                        <hr style="float:left;width:100%" />
                    </span>
                </div>


                <div class="overflow-vid-sidebar fine-scrollbar">


                    @if ($related_products)
                    @foreach ($related_products as $product)
                    <?php
                                
                            if($product->description){
                                $description = $product->description;
                            }else{
                                $description = "";
                            }
                            if (json_decode($product->image, true) && is_array(json_decode($product->image, true)) && count(json_decode($product->image, true)) > 0) {
                                $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($product->image, true)[0];
                            } else {
                                $image = '/img/no-image.png';
                            }
                    ?>
                    <div class="row mb-3">
                        <div class="col-lg-5 col-5">
                            <div class="img-div">
                                <img src="{{ $image }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-7 col-7">
                            <h4><a class="text-dark" href="/mall/show/{{ $product->id }}" target="_blank"><small
                                        class="small-font">{{ucwords($product->name)}}</small></a></h4>
                            <div class="row">
                                <div class="col-4 p-2 pt-3 prod-price">
                                    {{$geo['currency_symbol']}}{{ number_format(($product->price * $geo['exchange_rate'])) }}
                                </div>
                                <div class="col-8 p-2 text-center">
                                    <a href="/mall/show/{{ $product->id }}" class="btn-bag-it"
                                        style="border-radius: 20px;display: flex; align-items: center; justify-content: center; color: white !important;"
                                        ii="{{ $product->id }}">Shop Now</a>
                                    <!-- <button class="btn-bag-it"
                                                    id="{{ $product->id }}">Bag
                                                    It</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <small>No Related products found</small>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- End of Container -->

</main>
<!-- End of Main -->
@include('pages.partials.trendingVideos')
{{-- 
@include("pages.ecom.footer") --}}
@include('pages.partials.footer')
@push('scripts')
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        $(document).ready(function() {
            $('body').addClass('sidebar-collapse');
            $(".overlay")
                .mouseenter(function() {
                    var video = $(this).prev();
                    $(video).get(0).play();
                })
                .mouseleave(function() {
                    var video = $(this).prev();
                    $(video).get(0).pause();
                });
        });
    const addToCartBtns = document.querySelectorAll(".cart-btn");
            const guestCart = [];
            const handleAddToCart = (product) => {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];

                // Check if the product already exists in the cart
                let productIndex = cart.findIndex(item => item.id === product.id);

                if (productIndex !== -1) {
                    // If the product exists, update its quantity
                    cart[productIndex].qty += product.qty;
                } else {
                    // If the product does not exist, add it to the cart
                    cart.push(product);
                }

                // Save the updated cart back to localStorage and sessionStorage
                localStorage.setItem("cart", JSON.stringify(cart));
                sessionStorage.setItem("cart", JSON.stringify(cart));    
                //if the product is already in the cart, update the quantity
                const {
                    id
                } = product;
                if (!sessionStorage.getItem("cartIdStore")) {
                    sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
                    sessionStorage.setItem("cart", JSON.stringify(cart));
                    localStorage.setItem("cart", JSON.stringify(cart));
                  
                 
                } else {
                    if (!JSON.parse(sessionStorage.getItem("cartIdStore")).includes(id)) {
                        sessionStorage.setItem(
                            "cart",
                            JSON.stringify([
                                ...JSON.parse(sessionStorage.getItem("cart")),
                                product,
                            ])
                        );
                        sessionStorage.setItem(
                            "cartIdStore",
                            JSON.stringify([
                                ...JSON.parse(sessionStorage.getItem("cartIdStore")),
                                id,
                            ])
                        );
                    }
                }
            };
            for (let i = 0; i < addToCartBtns.length; i++) {
                addToCartBtns[i].addEventListener('click', function() {
                    console.log(addToCartBtns[i].id)
                    guestCart.push(addToCartBtns[i].id);
                    //make a call to the server to add product to session
                    axios.post(`${window.location.origin}/cartsession`, {
                        product_id: addToCartBtns[i].id
                    }).then(function(response) {
                        console.log(response.data)
                        const {
                            message,
                            product,
                            cart_count
                        } = response.data;
                        swal({
                            title: "Product Added Successfully!",
                            text: message,
                            icon: "success",
                        });
                        handleAddToCart(product)
                        document.querySelector('#vicomma-cart-cta').innerHTML = cart_count;
                    })
                })
            }
</script>

@endpush
@endsection