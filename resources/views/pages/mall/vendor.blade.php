@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/mall-navigation.css')}}">
<style>
.vendor--name__container {
    background: #000;
    color: #fff;
    text-align: center;
    padding: 1rem;
}

.vm-container {
    position: absolute;
    bottom: 50px;
    right: 0;
}

</style>
@section('content')
<div class="">
    @include('includes.mall-navigation')

    <div class="d-flex justify-content-end align-items-center"
        style="background: url({{ ($vendor->banner != '') ? asset($vendor->banner) : '/img/vendorBG.jpg'}})!important; background-repeat: no-repeat; background-size: cover; background-position: 63% 10%; height: calc(100% / 1.5); position: relative; overflow: hidden">
        <div class="container vm-container pr-0">
            <div class="vendor--name__container text-left pl-4 col-12 col-sm-12 col-md-12 col-lg-6 ml-auto"
                style="border-left: 5px solid {{$vendor->secondary_color}}; color: #fff; background-color: {{$vendor->primary_color}};">
                <h3 class="text-uppercase"> {{ ($vendor->header != '') ? $vendor->header : 'Welcome to my store' }}
                </h3>
                <p class="font-weight-normal" style="color: #fff;">
                    {{ ($vendor->slogan != '') ? $vendor->slogan : 'We deliver the best items' }}
                </p>
                <button class="btn btn-secondary btn-sm rounded-0 text-uppercase font-weight-light"
                    style="background-color: {{$vendor->button_color}}; border-color: {{$vendor->button_color}}">Shop
                    Now!</button>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row g-2">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-snd text-lg mr-3">
                        <i class="fas fa-money-bill" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-snd font-weight-bold mb-1">Refund Option</h6>
                        <small class="text-muted">100% Money Back Gaurantee</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-snd text-lg mr-3">
                        <i class="fas fa-headset" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-snd font-weight-bold mb-1">Online Support</h6>
                        <small class="text-muted">Live support available</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="aUTHDivDer mt-5">
            <div>
                <h6 class="text-uppercase pl-2 pr-2 mt-1">Featured Products</h6>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-5 mt-4">
        <div class="owl-carousel owl-theme featured">
            @if (count($products)>0)
            @foreach ($products as $product)
            <?php
                if (count(json_decode($product->image, true)) > 0) {
                    $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($product->image, true)[0];
                } else {
                    $image = '/img/no-image.png';
                }
            ?>
            <div class="item product p-2">
                <div class="product-img">
                    <img src="{{$image}}"
                        alt="">
                    <div class="view-product">
                        <a href="{{route('mall.show', $product->id)}}"
                            class="btn btn-primary btn-block rounded-0 btn-sm"> <i class="fa fa-eye"
                                aria-hidden="true"></i> View Product</a>
                    </div>
                </div>
                {{-- <div class="view-product">
                                    <a href="#" class="btn btn-primary btn-block rounded-0">View Product</a>
                                </div> --}}
                <div class="product-content text-center mt-3">
                    <small class="text-uppercase text-muted">{{$product->category->name}}</small>
                    <h6 class="text-uppercase font-weight-normal text-snd mt-3">{{$product->name}}</h6>
                    <div class="rating text-muted">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-2 font-weight-light">${{number_format($product->price)}}</h6>
                    <div class="add-cart">
                        <a class="btn btn-secondary text-uppercase btn-sm rounded-0 btn-bag-it" id="{{$product->id}}">
                            <span class="cart-icon">
                                <svg class="mr-1" width="22" height="22" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25.0127 6.25969C24.9228 6.1491 24.8094 6.05995 24.6807 5.99872C24.552 5.93748 24.4112 5.9057 24.2687 5.90569H6.89871L6.82771 5.25169V5.23069C6.65936 3.9727 6.04073 2.81837 5.08644 1.98158C4.13216 1.14479 2.90691 0.68226 1.63771 0.679688C1.38337 0.679688 1.13944 0.780725 0.959596 0.960572C0.779748 1.14042 0.678711 1.38434 0.678711 1.63869C0.678711 1.89303 0.779748 2.13696 0.959596 2.3168C1.13944 2.49665 1.38337 2.59769 1.63771 2.59769C2.43974 2.59968 3.21401 2.89159 3.81772 3.41959C4.42144 3.94759 4.81389 4.67607 4.92271 5.47069L6.06271 15.9427C5.55881 16.171 5.13129 16.5396 4.83125 17.0044C4.53121 17.4691 4.37133 18.0105 4.37071 18.5637C4.37071 18.5717 4.37071 18.5797 4.37071 18.5877C4.37071 18.5957 4.37071 18.6037 4.37071 18.6117C4.37151 19.3745 4.67487 20.1058 5.21424 20.6452C5.75361 21.1845 6.48493 21.4879 7.24771 21.4887H7.63771C7.493 21.9144 7.45186 22.3685 7.51771 22.8134C7.58355 23.2582 7.75449 23.6809 8.01634 24.0465C8.27819 24.412 8.62341 24.7099 9.02338 24.9154C9.42335 25.1209 9.86654 25.2281 10.3162 25.2281C10.7659 25.2281 11.2091 25.1209 11.609 24.9154C12.009 24.7099 12.3542 24.412 12.6161 24.0465C12.8779 23.6809 13.0489 23.2582 13.1147 22.8134C13.1806 22.3685 13.1394 21.9144 12.9947 21.4887H17.1317C16.9388 22.0559 16.9309 22.6697 17.1092 23.2416C17.2875 23.8136 17.6428 24.3141 18.1238 24.6712C18.6048 25.0283 19.1868 25.2235 19.7859 25.2286C20.385 25.2337 20.9702 25.0485 21.4573 24.6996C21.9443 24.3508 22.3081 23.8564 22.4961 23.2875C22.6841 22.7187 22.6867 22.1049 22.5035 21.5345C22.3202 20.9641 21.9607 20.4666 21.4766 20.1137C20.9925 19.7607 20.4088 19.5706 19.8097 19.5707H7.24771C6.99345 19.5704 6.74968 19.4693 6.56989 19.2895C6.3901 19.1097 6.28898 18.8659 6.28871 18.6117C6.28871 18.6037 6.28871 18.5957 6.28871 18.5877C6.28871 18.5797 6.28871 18.5717 6.28871 18.5637C6.28898 18.3094 6.3901 18.0657 6.56989 17.8859C6.74968 17.7061 6.99345 17.605 7.24771 17.6047H19.4897C20.3419 17.592 21.172 17.3316 21.8788 16.8551C22.5855 16.3787 23.1383 15.7069 23.4697 14.9217C23.5225 14.8061 23.5517 14.6811 23.5557 14.5541C23.5598 14.4271 23.5385 14.3005 23.4932 14.1818C23.4479 14.063 23.3794 13.9545 23.2918 13.8624C23.2042 13.7704 23.0991 13.6967 22.9827 13.6456C22.8664 13.5945 22.741 13.567 22.614 13.5648C22.4869 13.5626 22.3606 13.5857 22.2426 13.6327C22.1245 13.6797 22.0169 13.7497 21.9261 13.8386C21.8353 13.9275 21.7631 14.0336 21.7137 14.1507C21.5285 14.5924 21.2206 14.9719 20.8264 15.2441C20.4323 15.5163 19.9684 15.6699 19.4897 15.6867H7.96371L7.10771 7.82369H23.0887L22.6197 10.0727C22.5907 10.1971 22.5869 10.3261 22.6085 10.4521C22.6301 10.578 22.6766 10.6984 22.7453 10.8061C22.8141 10.9138 22.9037 11.0067 23.0088 11.0793C23.114 11.152 23.2326 11.2028 23.3577 11.2289C23.4828 11.2551 23.6118 11.2559 23.7372 11.2315C23.8627 11.207 23.9819 11.1577 24.088 11.0865C24.1942 11.0154 24.285 10.9237 24.3552 10.8169C24.4253 10.7101 24.4735 10.5903 24.4967 10.4647L25.2067 7.06469C25.2366 6.92454 25.2346 6.77948 25.2011 6.64017C25.1675 6.50086 25.1031 6.37085 25.0127 6.25969ZM19.8127 21.4887C19.9929 21.4887 20.169 21.5421 20.3188 21.6422C20.4686 21.7423 20.5854 21.8846 20.6544 22.0511C20.7233 22.2175 20.7414 22.4007 20.7062 22.5774C20.6711 22.7541 20.5843 22.9165 20.4569 23.0439C20.3295 23.1713 20.1672 23.258 19.9904 23.2932C19.8137 23.3283 19.6306 23.3103 19.4641 23.2413C19.2976 23.1724 19.1553 23.0556 19.0552 22.9058C18.9551 22.756 18.9017 22.5799 18.9017 22.3997C18.902 22.1587 18.9976 21.9276 19.1678 21.7569C19.3379 21.5862 19.5687 21.4897 19.8097 21.4887H19.8127ZM10.3197 21.4887C10.4999 21.4887 10.676 21.5421 10.8258 21.6422C10.9756 21.7423 11.0924 21.8846 11.1614 22.0511C11.2303 22.2175 11.2484 22.4007 11.2132 22.5774C11.1781 22.7541 11.0913 22.9165 10.9639 23.0439C10.8365 23.1713 10.6742 23.258 10.4974 23.2932C10.3207 23.3283 10.1376 23.3103 9.97109 23.2413C9.80462 23.1724 9.66234 23.0556 9.56224 22.9058C9.46214 22.756 9.40871 22.5799 9.40871 22.3997C9.40897 22.1588 9.50449 21.9279 9.67441 21.7572C9.84434 21.5865 10.0749 21.49 10.3157 21.4887H10.3197Z"
                                        fill="#fff"></path>
                                </svg>
                            </span>
                            Bag it
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <small>This store contains no products at the moment. Please check back again at a future time.</small>
            @endif
        </div>
    </div>
    <div class="faSHSECTION d-flex justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center text-white font-weight-bold text-uppercase">
                Top Fashion
                <br>Deals
            </h2>
        </div>
    </div>

    {{-- top sales --}}
    <div class="container-fluid mt-5 pb-5">
        <div class="row g-2">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Featured Selling</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Best Selling</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Lastest Products</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h6 class="text-snd font-weight-bold text-uppercase mb-4">Top Rated Products</h6>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/vendorBG.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="mulTCATSECIMG">
                        <img src="{{asset('img/p-img.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="ml-4 mulTCATSEDES">
                        <h6 class="font-weight-normal text-snd mb-1">Women shopping bag</h6>
                        <div class="text-muted text-sm">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h6 class="mt-0">$499.00</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ./ top sales --}}

</div>

@push('scripts')
<script>
const addToCartBtns = document.querySelectorAll(".btn-bag-it");
const guestCart = [];

const handleAddToCart = (product) => {
    //if the product is already in the cart, update the quantity
    const {
        id
    } = product;

    if (!sessionStorage.getItem("cartIdStore")) {
        sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
        sessionStorage.setItem("cart", JSON.stringify([product]));
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

<script>
jQuery('.owl-banner').owlCarousel({
    loop: false,
    margin: 5,
    nav: true,
    dots: false,
    lazyLoad: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});

jQuery('.featured').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 5
        }
    }
})

jQuery('.arrivals').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 5
        }
    }
})
</script>
@endpush
@endsection
