<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketProductCollection;
use Illuminate\Http\Request;
use Auth;
use App\Models\MarketProduct;
use App\Models\MarketProductCategory;
use App\Models\MarketWishlist;


class MarketProductController extends Controller
{
    public function _get_for_non_auth_user(){
        $products = MarketProduct::orderBy('id', 'desc')->limit(6)->get();
        $products_res = new MarketProductCollection($products);
        return response()->json($products_res, 200);
    }

    public function _get(Request $request){
        $per_page = 6;
        $wishlists = MarketWishlist::where('user_id', Auth::id())->select('product_id');
        if($wishlists){
            $products = MarketProduct::leftJoinSub(
                $wishlists, 'wishlist', function($join){
                    $join->on('market_products.id', '=', 'wishlist.product_id');
            });
            if($request->category){
                $category = MarketProductCategory::where('slug', $request->category)->first();
                if($category){
                    $products = $products->where('category_id', $category->id);
                }
            }
            $products = $products->skip(($request->page)*$per_page)->take($per_page)->get();
        }else{
            $products = MarketProduct::skip(($request->page)*$per_page)->take($per_page)->get();
        }
        $products_resource = new MarketProductCollection($products);
        return response()->json($products_resource, 200);
    }
}
