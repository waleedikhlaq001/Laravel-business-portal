<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\VideoContent;
use App\Notifications\ContactVendor;
use DB;

class MallController extends Controller
{
    public function currencyConverter($req)
    {
        // Attempt to retrieve IP info from cache or local storage
        $cacheFile = storage_path('app/ipinfo_cache.json');
        if (file_exists($cacheFile)) {
            $details = json_decode(file_get_contents($cacheFile), true);
        } else {
            // Try to fetch the IP details
            try {
                $details = json_decode(file_get_contents("http://ipinfo.io"), true);
                // Save details to cache
                file_put_contents($cacheFile, json_encode($details));
            } catch (\Exception $e) {
                // Handle the case where the IP info service is unavailable
                $details = null;
            }
        }

        if ($details) {
            $ip = $details['ip'];
            $ip = $req->getClientIp();

            // Attempt to retrieve geo data from the external API
            try {
                $geo = file_get_contents("https://api.timanetglobaltech.com/?ip=" . $ip . "&time=" . date('H:i:s'));
                $geo_data = json_decode($geo, true);
            } catch (\Exception $e) {
                // Handle the case where the geo service is unavailable
                $geo_data = null;
            }

            if ($geo_data && isset($geo_data['country']) && $geo_data['country'] === 'Nigeria') {
                // Use the data from the geo service
            } else {
                // Fallback data
                $geo_data = [
                    'currency_symbol' => '$',
                    'exchange_rate' => '1',
                ];
            }
        } else {
            // Fallback if unable to fetch IP details
            $geo_data = [
                'currency_symbol' => '$',
                'exchange_rate' => '1',
            ];
        }

        return $geo_data;
    }

    public function index(Request $request)
    {

        $geo = $this->currencyConverter($request);
        return view('pages.mall.index', compact('geo'));
    }

    public function orders(Order $order, OrderDetail $details)
    {
        $orders = $order::where("user_id", auth()->user()->id)->with("details")->orderBy("id", "DESC")->paginate(20);
        // dd($orders);
        return view("pages.ecom.orders", compact("orders"));
    }


    public function message_vendor(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $msg = $request->message;
        $subject = $request->subject;
        $vendor = Vendor::where('id', $id)->first();
        if (!$vendor) {
            return response()->json(["message" => "Invalid Vendor Id"], 404);
        }
        $user = $vendor->user;
        $details = [
            "user" => $user->last_name . ' ' . $user->first_name,
            "message" => "You Have Received a new message from your vendor station.",
            "name" => $name,
            "email" => $email,
            "subject" => $subject,
            "user_message" => $msg
        ];
        $user->notify(new ContactVendor($details));
        return response()->json(["message" => "Message Sent"]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->image);
        $colors = json_decode($product->colors);
        //no
        $job = Job::where('product_id', $id)->where('isApproved', Job::APPROVED)->with('video')->first();
        if ($job && $job->isCompleted == Job::COMPLETED) {
            $video = $job->video;
        } else {
            $video = null;
        }
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();

        return view('pages.mall.show', compact('product', 'images', 'colors', 'video', 'trending_videos'));
    }

    public function vendor(Request $request, $station)
    {

        $name = str_replace('-', ' ', $station);
        $vendor = Vendor::where('vendor_station', $name)->first();
        if (!$vendor) {
            return redirect("/mall/products");
        }
        //show only approved products
        // $products = Product::where(['vendor_id'=> $vendor->id, 'status' => Product::APPROVED])->get();
        $from = $request->from;
        $to = $request->to;
        $show = $request->show;
        if ($request->sort && $request->sort == "DESC" || $request->sort == "ASC") {
            $sort = $request->sort;
        } else {
            $sort = "DESC";
        }
        if ($request->show) {
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("vendor_id", $vendor->id)
                ->when($from, function ($query, $from) {
                    $query->where('price', ">=", $from);
                })
                ->when($to, function ($query, $to) {
                    $query->where('price', "<=", $to);
                })
                ->orderBy("id", $sort)->paginate($show);
        } else {
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("vendor_id", $vendor->id)
                ->when($from, function ($query, $from) {
                    $query->where('price', ">=", $from);
                })
                ->when($to, function ($query, $to) {
                    $query->where('price', "<=", $to);
                })
                ->orderBy("id", $sort)->paginate(6);
        }
        // dd($products);
        return view("pages.ecom.store", compact("products", "show", "from", "to", "sort", "vendor"));
        // return view('pages.mall.vendor', compact('vendor', 'products'));
    }

    public function checkout(Request $request)
    {
        $isLoggedIn = Auth::user()->id ?? false;
        $cart = "API";
        if (!$isLoggedIn) {
            $cart = \json_encode($request->session()->get('cart', [])); //get the cart items saved in the session
        }
        // dd($isLoggedIn);
        return view('pages.checkout.index', compact('isLoggedIn', 'cart'));
    }

    public function getCartSession(Request $request)
    {
        try {
            $cart = $request->session()->get('cart', []);
            $cart_ids = [];
            foreach ($cart as $product) {
                $cart_ids[] = $product['id'];
            }
            return response()->json(['message' => 'Fetched Successfully', 'cart' => $cart, 'cart_count' => count($cart), 'cart_ids' => $cart_ids]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function deleteProductCartSession(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        //check Product ID
        if (!isset($request->productId)) {
            return response()->json(['message' => 'Product ID is required'], 400);
        }
        try {
            //check if product exists
            $product = Product::where('id', '=', $request->productId)->first();
            if (\in_array($product, $cart)) {
                $unique_key = array_search($product, $cart);
                unset($cart[$unique_key]);
                $request->session()->put('cart', $cart);
                return response()->json(['message' => 'Product Deleted Successfully', 'cart' => $cart, 'cart_count' => count($cart)]);
            }

            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not in cart', 'cart' => $cart], 404);
        }
    }

    public function getProducts(Request $request)
    {
        $geo = $this->currencyConverter($request);
        return view('pages.mall.products', compact('geo'));
    }

    //newmall
    public function mall_home(Request $request)
    {
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();

        $related_products = Product::inRandomOrder()->limit(5)->get();

        $geo = $this->currencyConverter($request);
        return view("pages.ecom.index", compact('geo', 'trending_videos', 'related_products'));
    }

    public function mall_products(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $cat = $request->cat;
        $search = $request->search;
        $show = $request->show;
        if ($request->sort && $request->sort == "DESC" || $request->sort == "ASC") {
            $sort = $request->sort;
        } else {
            $sort = "DESC";
        }
        $category = "";
        if ($cat) {
            $category = DB::table("categories")->where("id", $cat)->first();
        }
        if ($request->show) {
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])
                ->when($from, function ($query, $from) {
                    $query->where('price', ">=", $from);
                })
                ->when($to, function ($query, $to) {
                    $query->where('price', "<=", $to);
                })
                ->when($category, function ($query, $category) {
                    $query->where('category_id', $category->id);
                })
                ->when($search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->orderBy("id", $sort)->paginate($show);
        } else {
            $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])
                ->when($from, function ($query, $from) {
                    $query->where('price', ">=", $from);
                })
                ->when($to, function ($query, $to) {
                    $query->where('price', "<=", $to);
                })
                ->when($category, function ($query, $category) {
                    $query->where('category_id', $category->id);
                })
                ->when($search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->orderBy("id", $sort)->paginate(30);
        }
        // dd($products);
        return view("pages.ecom.products", compact("products", "show", "from", "to", "sort", "category", "search"));
    }

    public function mall_product($id)
    {
        $product = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("id", $id)->first();
        if (!$product) {
            return redirect("/mall/products");
        }
        $pid = $product->id;
        $images = json_decode($product->image);

        $colors = json_decode($product->colors);
        function get_perc($num, $main)
        {
            if ($main == 0 || $num == 0) {
                return 0;
            }
            $count1 = $num / $main;
            $count2 = $count1 * 100;
            $count = number_format($count2, 0);
            return $count;
        }

        //no=
        $job = Job::where('product_id', $id)->where('isApproved', Job::APPROVED)->with('video')->first();
        if ($job && $job->isCompleted == Job::COMPLETED) {
            $video = $job->video;
        } else {
            $video = null;
        }
        $commented = Auth::check() ? DB::table("reviews")->where("product_id", $product->id)->where("user_id", Auth::user()->id)->exists() : false;
        $reviews = DB::table("reviews")->join("users", "reviews.user_id", "users.id")->where("reviews.product_id", $product->id)->orderBy("reviews.id", "DESC")->select("reviews.*", "users.first_name", "users.last_name", "users.image")->paginate(10);
        $count = DB::table("reviews")->where("product_id", $product->id)->count();
        $five = DB::table("reviews")->where("product_id", $product->id)->where("rating", 5)->count();
        $four = DB::table("reviews")->where("product_id", $product->id)->where("rating", 4)->count();
        $three = DB::table("reviews")->where("product_id", $product->id)->where("rating", 3)->count();
        $two = DB::table("reviews")->where("product_id", $product->id)->where("rating", 2)->count();
        $one = DB::table("reviews")->where("product_id", $product->id)->where("rating", 1)->count();
        $rating = DB::table("reviews")->where("product_id", $product->id)->avg('rating');
        $total = DB::table("reviews")->where("product_id", $product->id)->sum('rating');
        $five_perc = get_perc($five, $count);
        $four_perc = get_perc($four, $count);
        $three_perc = get_perc($three, $count);
        $two_perc = get_perc($two, $count);
        $one_perc = get_perc($one, $count);

        $products = Product::with(['category:*', 'vendor:*', 'vendor.user:*'])->where("vendor_id", $product->vendor->id)->where("id", "!=", $product->id)->orderBy("id", "DESC")->limit(3)->get();
        // dd($product->vendor->user);
        return view('pages.ecom.product', compact('pid', 'product', 'images', 'colors', 'video', "products", "rating", "five_perc", "four_perc", "three_perc", "two_perc", "one_perc", "count", "commented", "total", "reviews"));
    }
    public function rate(Request $request)
    {
        $rating = $request->rating;
        $review = $request->review;
        $product_id = $request->product;

        DB::table("reviews")->insert([
            "product_id" => $product_id,
            "user_id" => Auth::user()->id,
            "rating" => $rating,
            "review" => $review
        ]);
        return response()->json([
            "message" => "Thanks for your feedback"
        ]);
    }
    public function mall_cart(Request $request)
    {
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();
        $geo = $this->currencyConverter($request);
        return view("pages.ecom.cart", compact('geo', 'trending_videos'));
    }

    public function mall_checkout(Request $request)
    {
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();
        $geo = $this->currencyConverter($request);
        return view("pages.ecom.checkout", compact('geo', 'trending_videos'));
    }


    public function success(Order $order, OrderDetail $detail, $id)
    {
        $trending_videos = VideoContent::orderBy('view_count', 'desc')->limit(12)->get();
        $order = Order::where("id", $id)->first();
        if (!$order) {
            return redirect("/mall/cart");
        }
        $items = $detail::where("order_id", $order->id)->get();
        return view("pages.ecom.success", compact("order", "items", 'trending_videos'));
    }


    public function mall_callback()
    {
    }
}
