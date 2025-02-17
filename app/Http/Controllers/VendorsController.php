<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralWallet;
use App\Notifications\NewPay;
use App\Models\WalletTransfer;
use Illuminate\Support\Facades\Log;
use App\Notifications\DeliveryToken;
use Illuminate\Support\Facades\Auth;
use App\Models\FlutterwaveSubaccount;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralWalletTransaction;


class VendorsController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        if(!$vendor){
            return redirect("/dashboard");
        }
        return view('pages.user.vendor.index', compact('vendor'));
    }
    // Digital Sign - agree to terms
    public function digitalSign(Request $request)
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        error_log($request->signature);
        if($request->signature){
            $vendor->vendorDigitalSignature = true;
            $vendor->save();
            return response()->json(["redirect"=>'/my-store/create', "status"=>"success"], 200);
        } else {
            return response()->json(['message'=>'An error occurred try again', "status"=>"error"], 500);
        }
    }

    public function orders()
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        $products = DB::table("orderdetails")->join("orders", 'orders.id', "orderdetails.order_id")->join("products", 'products.id', "orderdetails.product_id")->join("vendors", "vendors.id", "products.vendor_id")->where("vendors.id", $vendor->id)->where("orderdetails.status", "!=", 2)->select("orderdetails.*", "orders.amount", "orders.state", "orders.shipping_address", "orders.zip", "orders.shipping_name", "orders.email", "orders.phone", "orders.country", "products.shipping", "products.category_id")->paginate(50);
        return view('pages.user.vendor.orders', compact('vendor', "products"));
    }

    public function products() {
        $vendor = auth()->user()->vendor;
        $products = DB::table("products")->where("vendor_id", $vendor->id)->latest()->paginate(20);
        return view("pages.user.vendor.products", compact("products", 'vendor'));
    }

    public function deleted_products() {
        $vendor = auth()->user()->vendor;
        $products = Product::withTrashed()->where("vendor_id", $vendor->id)->where("deleted_at", "!=", null)->latest()->paginate(20);
        return view("pages.user.vendor.deleted", compact("products", 'vendor'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.user.vendor.create', compact('categories'));
    }
    public function edit($id)
    {
        $vendor = auth()->user()->vendor;
        $product = Product::where('id', $id)->where("vendor_id", $vendor->id)->first();
        $categories = Category::all();
        if(!$product){
            return redirect('/my-store/products');
        }
        return view('pages.user.vendor.edit', compact('product', "categories", 'vendor'));
    }


    public function delete_product(Request $request)
    {
        $vendor = auth()->user()->vendor;
        $id = $request->id;
        $product = Product::where('id', $id)->where("vendor_id", $vendor->id)->first();
        if(!$product){
            return response()->json(["message"=>"You cannot delete this Product"], 400);
        }
        $product->delete();
        return response()->json(["message"=>"Deleted"]);
    }

    public function edit2(Request $request)
    {
        $vendor = auth()->user()->vendor;
        $product = Product::where('id', $request->id)->where("vendor_id", $vendor->id)->first();
        $categories = Category::all();
        if(!$product){
            return redirect('/my-store/products');
        }
        return view('pages.user.vendor.edit', compact('product', "categories", 'vendor'));
    }

    public function save(Request $request, Product $product)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:191',
            'images' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'shipping' => 'required',
            "stock"=>'required'
        ]);
        $images = [];
        $colors = [];
        if ($request->hasFile('images')) {
            foreach( $request->file('images') as $mainItem){
                foreach ($request->images as $image) {
                    $filename = $image->getClientOriginalName();
                    $filename = $vendor->id . '_' . $filename;
                    // $path = $image->StoreAs('public/products', $filename);
                    $path =  $mainItem->storePubliclyAs('product-images', $filename, 's3');
                    Storage::disk('s3')->setVisibility($path, 'public');
                    $images[] = $filename;
                }
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $color) {
                $colors[] = $color;
            }
        }

        // dd($colors);


        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->vendor_id = $user->vendor->id;
        $product->unique_id = 'VIC-' . Str::random(26);
        $product->image = json_encode($images);
        $product->colors = json_encode($colors);
        $product->price = $request->price;
        $product->shipping = $request->shipping;
        $product->stock = $request->stock;
        $product->save();

        $activity = new Activity;
        $activity->type = 'product_add';
        $activity->name = 'Product Added';
        $activity->description = 'You added a Product <b>(' . $product->name . ')</b> to your store';
        $activity->user_id = $user->id;
        $activity->url = '/mall/show/' . $product->id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        if($request->has('JobPage')){
            return redirect()->back()->with('success', 'Product created successfully');
        }else{
            return redirect()->route('user.jobs.my-jobs')->with('success', 'Product created successfully');
        }
    }

    public function update(Request $request, Product $product){
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        $product = Product::where("id", $request->product_id)->first();
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:191',
            'images' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'shipping' => 'required',
            "stock"=>'required'
        ]);
        $images = [];
        $colors = [];
        if ($request->hasFile('images')) {
            foreach( $request->file('images') as $mainItem){
                foreach ($request->images as $image) {
                    $filename = $image->getClientOriginalName();
                    $filename = $vendor->id . '_' . $filename;
                    // $path = $image->StoreAs('public/products', $filename);
                    $path =  $mainItem->storePubliclyAs('product-images', $filename, 's3');
                    Storage::disk('s3')->setVisibility($path, 'public');
                    $images[] = $filename;
                }
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $color) {
                $colors[] = $color;
            }
        }

        // dd($colors);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->vendor_id = $user->vendor->id;
        $product->unique_id = 'VIC-' . Str::random(26);
        $product->image = json_encode($images);
        $product->colors = json_encode($colors);
        $product->price = $request->price;
        $product->shipping = $request->shipping;
        $product->stock = $request->stock;
        $product->save();

        $activity = new Activity;
        $activity->type = 'product_update';
        $activity->name = 'Product Updated';
        $activity->description = 'You Edited a Product <b>(' . $product->name . ')</b> in your store';
        $activity->user_id = $user->id;
        $activity->url = '/mall/show/' . $product->id;
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        if($request->has('JobPage')){
            return redirect()->back()->with('success', 'Product Updated successfully');
        }else{
            return redirect()->route('user.jobs.my-jobs')->with('success', 'Product updated successfully');
        }
    }


    public function customaize(Request $request)
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        $request->validate([
            'header' => 'string|max:50',
            'slogan' => 'string|max:50',
            'primary_color' => 'string|max:50',
            'secondary_color' => 'string|max:50',
            'button_color' => 'string|max:50',
        ]);

        $vendor->header = $request->header;
        $vendor->slogan = $request->slogan;
        $vendor->primary_color = $request->primary_color;
        $vendor->secondary_color = $request->secondary_color;
        $vendor->button_color = $request->button_color;
        $vendor->save();
        return redirect()->back()->with('success', 'Station Updated');
    }

    public function uploadBanner(Request $request)
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        if ($request->hasFile('image') && !empty($vendor)) {
            $path = $request->file('image')->storePubliclyAs('banners', $vendor->id, 's3');
            $vendor->banner = Storage::disk('s3')->url($path);
            $vendor->save();
            return redirect()->back()->with('success', 'Banner Updated');
        }

        $activity = new Activity;
        $activity->type = 'banner_update';
        $activity->name = 'Banner Updated';
        $activity->description = 'You change the banner for your store <b>(' . $vendor->name . ')</b>';
        $activity->user_id = $user_id;
        $activity->url = '/my-store';
        $activity->image = 'https://via.placeholder.com/50';
        $activity->account_type = 'vendor';
        $activity->save();

        return redirect()->back()->with('success', 'Failed to upload banner');
    }

    public function viewVideo()
    {
        $user_id = Auth::user()->id;
        $vendor = Vendor::where('user_id', $user_id)->first();
        return view('pages.user.vendor.video', compact('vendor'));
    }

    public function start_shipping(Request $request) {
    $id = $request->order;
    DB::table("orderdetails")->where("id", $id)->update(["status"=>1]);
    return response()->json(["message"=>"Status Set To Shipping"]);
    }
    public function start_delivery(Request $request) {
        $id = $request->order;
        // DB::table("orderdetails")->where("id", $id)->update(["status"=>1]);
        $token = DB::table('tokens')->where("type", "order")->where("order_id", $id)->first();

        if($token){
            DB::table("tokens")->where("id", $token->id)->delete();
            $tok = rand(000000, 999999);
            DB::table("tokens")->insert([
                "token"=>$tok,
                "data"=>"{}",
                "type"=>"order",
                "job_id"=>0,
                "order_id"=>$id
            ]);
        }else {
            $tok = rand(000000, 999999);
            DB::table("tokens")->insert([
                "token"=>$tok,
                "data"=>"{}",
                "type"=>"order",
                "job_id"=>0,
                "order_id"=>$id
            ]);
        }
        $order = DB::table("orderdetails")->where("id", $id)->first();
        $user2 = User::where("id", $order->user_id)->first();
        $details = [
            'user' => $user2->last_name . ' ' . $user2->first_name,
            'message' => 'Provide the code '.$tok.' to the vendor to confirm your order delivery',
        ];
        $user2->notify(new DeliveryToken($details));
        return response()->json(["message"=>"OTP SENT", "show"=>true]);
        }

        public function deliver(Request $request) {
            $id = $request->id;
            $order = DB::table("orderdetails")->where("id", $request->id)->first();
            $amount = $request->amount;
            $otp = $request->otp;
            $user = auth()->user();
            $token = DB::table('tokens')->where("type", "order")->where("order_id", $id)->where("token", $otp)->first();
            if(!$token){
                return response()->json(["message"=>"You have provided an incorrect delivery code"], 400);
            }
            DB::table("orderdetails")->where("id", $id)->update(["status"=>2]);
            DB::table("tokens")->where("id", $token->id)->delete();
                $gwallet = GeneralWallet::where('user_id', $user->id)->first();

                // dd([$transaction, $response]);
                $transaction = new GeneralWalletTransaction;
                $transaction->name = 'Product Sale';
                $transaction->desc = 'Product: '.$order->name ?? "";
                $transaction->tx_ref = "Product".rand(11111, 0000);
                $transaction->amount = $amount;
                date_default_timezone_set($user->timezone);
                $transaction->time = date("h:ia");
                $transaction->date = date("d F Y");
                $transaction->type = 'credit';
                $transaction->currency_id = $gwallet->currency_id;
                $transaction->status = 'successful';
                $transaction->user_id = $gwallet->user_id;
                $transaction->save();
                //Update Wallet Balance
                $gwallet->balance = $gwallet->balance + $amount;
                $gwallet->save();
    
                //Create General Notification
    
                //create new Activity
                $activity = new Activity;
                $activity->type = 'gwallet_topup';
                $activity->name = 'Wallet Credited';
                $activity->description = 'You recieved $'.$amount.' for a Product.';
                $activity->user_id = $user->id;
                $activity->url = '/gwallet/index';
                $activity->image = 'https://via.placeholder.com/50';
                $activity->account_type = 'user';
                $activity->save();


            return response()->json(["message"=>"Your Product Delivery Was Successful"]);
        }
}
