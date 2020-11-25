<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class WishlistController extends Controller
{
    public function wishlist(){
        return view('client.dashboard.market.wishlist', ['user' => Auth::user()]);
    }
}
