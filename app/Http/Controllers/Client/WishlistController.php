<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistCollection as WishlistResources;
use Illuminate\Http\Request;
use Auth;
use App\Models\MarketWishlist;

class WishlistController extends Controller
{
    public function index(){
        return view('client.wishlist.index', ['user' => Auth::user()]);
    }
    public function _get(Request $request){
        $per_page = 6;
        $wishlist = MarketWishlist::where('user_id', Auth::id())
            ->skip((int)$request->page*$per_page)->take($per_page)->get();
        $wishlist = new WishlistResources($wishlist);
        return response()->json($wishlist, 200);
    }
}
