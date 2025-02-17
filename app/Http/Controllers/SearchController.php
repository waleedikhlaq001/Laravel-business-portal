<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VideoContent;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function processSearchQuery($request){
        //code
        $products = Product::where('name', 'LIKE', "%{$request}%")->orWhere('description', 'LIKE', "%{$request}%")->get();
        $videos = VideoContent::where('name', 'LIKE', "%{$request}%")->get();
        $output = "<h5>Your search <i><b>{$request}</b></i> returned the following results:</h5><div class='table-responsive'>
                        <table class='table table-hover table-inverse search-table'>
                            <thead class='search-thead'>
                                <th class='text-center'>Image</th>
                                <th>Product Details</th>
                                <th>Action</th>
                            </thead>
                            <tbody>";
        if(count($products) > 0){
            foreach($products as $product){
                if(count(json_decode($product->image))>0){
                    $image = json_decode($product->image, true)[0];
                }else{
                    $image = "";
                }
                $output .=
                    '<tr>
                        <td scope="row">
                            <div class="search-prod-img m-auto">
                                <img src="https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/'.$image.'" class="img-fluid round-edges shadow-sm">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex" style="font-weight:600">
                                <p class="search-prod-name mb-0">
                                    <a class="text-dark" href="/mall/show/'.$product->id.'" target="_blank"><small class="small-font">'.$product->name.'</small></a>
                                </p>
                                <p class="search-prod-price mb-0 ml-auto">$'.number_format($product->price).'</p>
                            </div>
                            <div class="search-prod-desc">
                                <p>'.htmlspecialchars_decode(substr($product->description,0,50)).'</p>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm d-inline" href="/mall/show/'.$product->id.'" target="_blank">View</a>
                        </td>
                    </tr>';
            }
        }else{
            $output.= "<tr><td><p>Your search does not match any record....</p></td></tr>";
        }
        $output.= "</tbody></table></div>";
        return $output;
    }
}