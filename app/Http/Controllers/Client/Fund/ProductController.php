<?php

namespace App\Http\Controllers\Client\Fund;

use App\Http\Controllers\Controller;
use App\Http\Resources\FundProductCollection as FundProductResources;
use Illuminate\Http\Request;
use App\Models\FundProduct;
use App\Models\FundProductCategory;
use App\Models\FundCheckout;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $products = FundProduct::paginate(10);
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.fund.index', ['user' => $user, 'products' => $products, 'category_name' => '', 'saldo'=>$saldo]);
    }

    public function category($category){
        $category_id = FundProductCategory::where('slug', $category)->first()->id;
        $products = FundProduct::where('category_id', $category_id)->get();
        $user = Auth::user();
        $category_name = FundProductCategory::where('slug', $category)->first()->name;
        return view('client.fund.index', ['user' => $user, 'products' => $products, 'category_name' => $category_name]); 
    }

    public function buy(Request $request){
        $product = FundProduct::where('slug', $request->product)->first();
        $invoice = 'MKYF'.Carbon::now()->timestamp;
        $checkout = new FundCheckout;
        $checkout->invoice = $invoice;
        $checkout->product_id = $product->id;
        $checkout->user_id = Auth::id();
        $checkout->qty = $request->lots;
        $checkout->status_id = 1;
        $checkout->created_at = Carbon::now();
        $checkout->save();
        return redirect('/profile/fund/invoice/'.$invoice);
    }

    public function _get(Request $request){
        $per_page = 6;
        $products = new FundProduct;
        if($request->category){
            $category = FundProductCategory::where('slug', $request->category)->first();
            if($category){
                $products = $products->where('category_id', $category->id);
            }
        }
        $products = $products->orderBy('id', 'desc')->skip(($request->page)*$per_page)->take($per_page)->get();
        $products = new FundProductResources($products);
        return response()->json($products, 200);
    }
}
