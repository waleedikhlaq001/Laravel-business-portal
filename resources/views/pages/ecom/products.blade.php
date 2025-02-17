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
</style>
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="demo1.html">Mall</a></li>
                        <li>Products</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <!-- Start of Shop Banner -->
                    <!-- <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                        style="background-image: url('/ecom/assets/images/shop/banner1.jpg'); background-color: #FFC74E;">
                        <div class="banner-content">
                            <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
                            <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal">Smart Wrist
                                Watches</h3>
                            <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover
                                Now<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div> -->
                    <!-- End of Shop Banner -->


                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg mb-10">
                        <!-- Start of Sidebar, Shop Sidebar -->
                        <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="shop-banner-sidebar.html#"><i class="close-icon"></i></a>

                            <!-- Start of Sidebar Content -->
                            <div class="sidebar-content scrollable">
                                <!-- Start of Sticky Sidebar -->
                                <div class="sticky-sidebar">
                                    <div class="filter-actions">
                                        <label>Filter :</label>
                                        <a href="/mall/products" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                    </div>

                                    <!-- Start of Collapsible Widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><label>Price</label></h3>
                                        <div class="widget-body">
                                            <ul class="filter-items search-ul">
                                                <li><a href="/mall/products?from=0&to=100">$0.00 - $100.00</a></li>
                                                <li><a href="/mall/products?from=100&to=200">$100.00 - $200.00</a></li>
                                                <li><a href="/mall/products?from=200&to=300">$200.00 - $300.00</a></li>
                                                <li><a href="/mall/products?from=300&to=300">$300.00 - $500.00</a></li>
                                                <li><a href="/mall/products?from=500">$500.00+</a></li>
                                            </ul>
                                            <form class="price-range" action="/mall/products">
                                                <input type="number" name="from" class="min_price text-center"
                                                    placeholder="$min"  @if($from) value="{{$from}}" @endif required><span class="delimiter">-</span><input
                                                    type="number"  @if($to) value="{{$to}}" @endif name="to" class="max_price text-center"
                                                    placeholder="$max" required><button type="submit" class="btn btn-primary btn-rounded">Go</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End of Collapsible Widget -->

                                    <!-- End of Collapsible Widget -->
                                </div>
                                <!-- End of Sidebar Content -->
                            </div>
                            <!-- End of Sidebar Content -->
                        </aside>
                        <!-- End of Shop Sidebar -->

                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                                @if($category)
                                <h3>Results for: {{$category->name}}</h3>
                                @endif
                                @if($search)
                                <h3>Search Results for: {{$search}}</h3>
                                @endif
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
                                                    <a href="#" class="rating-reviews">(({{DB::table("reviews")->where("product_id", $product->id)->count()}} Review{{DB::table("reviews")->where("product_id", $product->id)->count() > 1? "s" : ""}}))</a>
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
                    <!-- End of Shop Content -->
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->
@include("pages.ecom.footer")
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
</script>