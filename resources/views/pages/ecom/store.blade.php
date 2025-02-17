@include("pages.ecom.headerstore")

<style>
.product-title {
    margin-bottom: 0.7rem;
    font-size: 1.3rem;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.store-wcmp-banner .store-media img {
    min-height: 25rem;
    object-fit: cover;
}
.store {
    position: relative;
    border-radius: 0rem;
    overflow: hidden;
}
.expand::after, .collapse::after {
    content: none;
    -webkit-transition: -webkit-transform 0.3s;
    transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
    transition: transform 0.3s, -webkit-transform 0.3s;
}
</style>
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no" style="padding: 5px 0px;">
                        <li><a href="demo1.html">Home</a></li>
                        <li><a href="#">Store</a></li>
                        <li><a href="#">{{$vendor->vendor_station ?? ""}}</a></li>
                        <!-- <li>Store</li> -->
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Pgae Contetn -->
            <div class="page-content mb-8">
                <div class="container">
                    <div class="row gutter-lg">
                        <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <div class="sidebar-content">
                                <div class="pin-wrapper" style="height: 1168.61px;"><div class="sticky-sidebar" style="border-bottom: 0px none rgb(102, 102, 102); width: 280px;">
                                    <div class="widget widget-collapsible widget-categories">
                                        <h3 class="widget-title collapse"><span>All Categories</span><span class="toggle-btn"></span></h3>
                                        <ul class="widget-body filter-items search-ul" style="display: block;">
                                            <li class="with-ul">
                                                <a href="#">Clothing<i class="la la-angle-down"></i></a>
                                                <ul>
                                                    <li><a href="#">Accessories</a></li>
                                                    <li><a href="#">Babyclothes</a></li>
                                                    <li><a href="#">Dressers &amp; Shirts</a></li>
                                                    <li><a href="#">Jeans</a></li>
                                                    <li><a href="#">Jumpers</a></li>
                                                    <li><a href="#">Knitewears</a></li>
                                                    <li><a href="#">Lounge &amp; Underwear</a></li>
                                                    <li><a href="#">Shoes</a></li>
                                                    <li><a href="#">T-shirts</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Cosmetics</a></li>
                                            <li><a href="#">Electronics</a></li>
                                            <li><a href="#">Furniture</a></li>
                                            <li><a href="#">Kitchen</a></li>
                                            <li><a href="#">Technologies</a></li>
                                        </ul>
                                    </div>
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible widget-wcmp-contact">
                                        <h3 class="widget-title collapse"><span>Contact Vendor</span><span class="toggle-btn"></span></h3>
                                        <form id="contact-us" onsubmit="submitForm(event)">
                                        <div class="widget-body" style="display: block;">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                            <input type="text" class="form-control" name="email" id="email_1" placeholder="Email" required>
                                            <input type="hidden" name="id" value="{{$vendor->id}}"/>
                                            @csrf
                                            <textarea name="message" maxlength="1000" id="message" cols="25" rows="6" placeholder="Message" class="form-control" required="required"></textarea>
                                            <button type="submit" class="btn btn-dark btn-rounded" id="btn">Submit</button>
                                    </form>
                                        </div>
                                    </div>
                                    <!-- End of Widget -->
                                    <div class="widget widget-collapsible widget-search-products">
                                        <h3 class="widget-title"><span>Search Vendor Products</span><span class="toggle-btn"></span></h3>
                                        <div class="widget-body">
                                            <form method="get" class="input-wrapper-inline">
                                                <input type="search" id="search_1" class="form-control" placeholder="Search products..." required name="search">
                                                <button type="submit" class="btn btn-rounded">Search</button>
                                            </form>
                                        </div>
                                    </div>
                               
                                </div></div>
                            </div>
                        </aside>
                        <!-- End of Sidebar -->

                        <div class="main-content">
                            <div class="store store-wcmp-banner">
                                <figure class="store-media">
                                    <img style="height: 80px!important;" src="{{ ($vendor->banner != '') ? asset($vendor->banner) : '/img/vendorBG.jpg'}}" alt="Vendor" width="930" height="390" style="background-color: #ECE7E3;">
                                </figure>
                                <div class="store-content" style="min-height: 20%">
                                    <!-- <figure class="seller-brand">
                                        <img src="/ecom/assets/images/vendor/brand/1-100x100.png" alt="Brand" width="100" height="100">
                                    </figure> -->
                                    <h4 class="store-title">{{ ($vendor->header != '') ? $vendor->header : 'Welcome to my store' }}</h4>
                                    <div class="seller-info-list">
                                        <div class="store-address">
                                            <i class="w-icon-map-marker"></i>
                                            {{ ($vendor->slogan != '') ? $vendor->slogan : 'We deliver the best items' }}
                                        </div>
                                        <div class="store-email">
                                            <a href="#">
                                                <i class="w-icon-envelope"></i>
                                                {{$vendor->user->email}}
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="social-icons social-icons-colored border-thin">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-linkedin fab fa-linkedin"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                    </div> -->
                                </div>
                            </div>
                            <!-- End of Store WCMP Banner -->

                            <div class="tab tab-nav-underline tab-nav-boxed type2 tab-vendor-products">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#tab-1" class="nav-link active">Products</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#tab-2" class="nav-link">Reviews</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                         <!-- Start of Shop Main Content -->
                        <div class="">
                            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                <div class="toolbox-left">
                                    <a href="shop-banner-sidebar.html#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                        btn-icon-left d-block d-lg-none"><i
                                            class="w-icon-category"></i><span>Filters</span></a>
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <label>Sort By :</label>
                                        <select name="orderby" class="form-control" onchange="sort(event)">
                                            <option value="ASC" @if($sort == "ASC") selected="selected" @endif>Sort by price: low to high</option>
                                            <option value="DESC" @if($sort == "DESC") selected="selected" @endif>Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-show select-box">
                                        <select name="count" class="form-control" onchange="show(event)">
                                            <option value="30" @if($show == "30") selected="selected" @endif>Show 30</option>
                                            <option value="50" @if($show == "50") selected="selected" @endif>Show 50</option>
                                            <option value="100" @if($show == "100") selected="selected" @endif>Show 100</option>
                                            <option value="500" @if($show == "500") selected="selected" @endif>Show 500</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </nav>
                            <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                                @foreach($products as $product)
                                <div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="/mall/products/{{$product->id}}">
                                                <img style="object-fit: scale-down;background: #f5f5f5; height: 300px;" src="{{$product->image && gettype(json_decode($product->image)) == 'array' && count(json_decode($product->image)) > 0 && json_decode($product->image)[0]? 'https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.json_decode($product->image)[0] : '/img/empty.png'}}" alt="Product" width="300"
                                                    height="338" />
                                            </a>
                                            <div class="product-action-horizontal">
                                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                    title="Add to cart"></a>
                                                <!-- <a href="shop-banner-sidebar.html#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Wishlist"></a> -->
                                                <!-- <a href="shop-banner-sidebar.html#" class="btn-product-icon btn-compare w-icon-compare"
                                                    title="Compare"></a> -->
                                                <!--  <a href="shop-banner-sidebar.html#" class="btn-product-icon btn-quickview w-icon-search"
                                                    title="Quick View"></a> -->
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                <a href="#">{{$product->category->name}}</a>
                                            </div>
                                            <h3 class="product-title" id="{{$product->id}}">
                                                <a href="/mall/products/{{$product->id}}">{{$product->name}}</a>
                                            </h3>
                                            <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: {{(number_format(DB::table('reviews')->where('product_id', $product->id)->avg('rating'))/5) * 100}}%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">(({{DB::table("reviews")->where("product_id", $product->id)->count()}} Review{{DB::table("reviews")->where("product_id", $product->id)->count() != 1? "s" : ""}}))</a>
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price" id="sh{{$product->shipping}}">
                                                    ${{$product->price}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="toolbox toolbox-pagination justify-content-between">
                                {{$products->links()}}
                            </div>
                        </div>
                        <!-- End of Shop Main Content -->
                                    </div>
                                    <div class="tab-pane" id="tab-2">
                                        <h4 class="title review-title pt-6 mb-0">1 review for Vendor 1</h4>
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="/ecom/assets/images/agents/2-100x100.png" alt="Avatar" width="100" height="100">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 100%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <h4 class="comment-author">
                                                            Johnson Doe
                                                            <span class="comment-date">- March 26, 2021</span>
                                                        </h4>
                                                        <p>Great vendor with high quality products and service </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Main Content -->
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->
@include("pages.ecom.footer")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/purl/2.3.1/purl.min.js" integrity="sha512-xbWNJpa0EduIPOwctW2N6KjW1KAWai6wEfiC3bafkJZyd0X3Q3n5yDTXHd21MIostzgLTwhxjEH+l9a5j3RB4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const sort = (e) => {
    console.log(e)
if(e.target.value){
var url = window.location.href;
if ($.url(url).attr('query')) {
    url = url + '&sort='+e.target.value;
}
else {
    url = url + '?sort='+e.target.value;
}
location.href = url

}
}

const show = (e) => {
    console.log(e)
if(e.target.value){
var url = window.location.href;
if ($.url(url).attr('query')) {
    url = url + '&show='+e.target.value;
}
else {
    url = url + '?show='+e.target.value;
}
location.href = url

}
}

 function submitForm(e) {
        e.preventDefault();
        var submitButton = $('#btn');
        submitButton.attr('disabled', true);

        $.ajax({
          type: 'POST',
          url: '/message-vendor', // Replace with your server-side script URL
          data: {
              "name": $("#name").val(),
              "subject": $("#subject").val(),
              "email": $("#email_1").val(),
              "id": "{{$vendor->id}}",
              "message": $("#message").val(),
              "_token":  "{{csrf_token()}}"
          },
          success: function(response) {
            // Success message
            
            // Reset the form
             $("#name").val("");
               $("#subject").val("");
             $("#email_1").val("");
             $("#message").val("");
            return new swal("Success", response.message, "success");
          },
          error: function(xhr, status, error) {
            // Error message
           return new swal("Error", "An error occurred. Please try again later.", "error");
          },
          complete: function() {
            // Enable the submit button after the request is complete
            submitButton.attr('disabled', false);
          }
        });
    };
</script>