<?php

namespace App\Http\Controllers\Client\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarketCheckout;
use App\Models\MarketProduct;
use App\Models\MarketProductCategory;
use App\Models\MarketWishlist;
use Auth;
use Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.market.index', ['user' => $user, 'category_name' => '', $saldo => 'saldo']);
    }

    public function category($category){
        $category_id = MarketProductCategory::where('slug', $category)->first()->id;
        $products = MarketProduct::where('category_id', $category_id)->get();
        $user = Auth::user();
        $category_name = MarketProductCategory::where('slug', $category)->first()->name;
        return view('client.market.index', ['user' => $user, 'products' => $products, 'category_name' => $category_name]);
    }

    public function detail($category, $product){
        $product = MarketProduct::where('slug', $product)->first();
        $user = Auth::user();
        return view('client.market.detail', ['user' => $user,'product' => $product]);
    }

    public function buy(Request $request){
        $product = MarketProduct::where('slug', $request->product)->first();
        $invoice = 'MKYM'.Carbon::now()->timestamp;

        $checkout = new MarketCheckout;
        $checkout->invoice = $invoice;
        $checkout->product_id = $product->id;
        $checkout->user_id = Auth::id();
        $checkout->qty = $request->qty;
        $checkout->status_id = 1;
        $checkout->created_at = Carbon::now();
        $checkout->save();
        return redirect('/profile/market/invoice/'.$invoice);
    }

    public function like($category, $product){
        $product = MarketProduct::where('slug', $product)->first();
        $wishlist = new MarketWishlist;
        $wishlist->product_id = $product->id;
        $wishlist->user_id = Auth::id();
        $wishlist->created_at = Carbon::now();
        $wishlist->save();

        return back()->with('success-'.$product->slug, $product->slug);
    }

    /**
     * API area
     */
    public function _like(Request $request){
        $product = MarketProduct::where('slug', $product)->first();
        $wishlist = new MarketWishlist;
        $wishlist->product_id = $product->id;
        $wishlist->user_id = Auth::id();
        $wishlist->created_at = Carbon::now();
        $wishlist->save();

        return response()->json(['status' => 'success'], 201);
    }
}
