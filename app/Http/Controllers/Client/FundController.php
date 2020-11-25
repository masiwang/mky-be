<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\FundProduct as FundProductResources;
use App\Models\FundProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;


class FundController extends Controller
{
    public function _detail($slug){
        $product = FundProduct::where('slug', $slug)->first();
        if(!$product){
            return response()->json(['status', 'bad request'], 400);
        }
        $product_res = new FundProductResources($product);
        return response()->json($product_res, 200);
    }

    protected function _resourceProduct($product){
        $started_at = new Carbon($product->started_at);
        $ended_at = new Carbon($product->ended_at);
        $response = [
            'category_slug' => $product->category->slug,
            'product_slug' => $product->slug,
            'name' => $product->name,
            'price' => $product->price,
            'return_per_periode' => $product->return_per_periode,
            'periode' => $started_at->diffInDays($ended_at)
        ];
        return $response;
    }

    public function detail($category, $product){
        $product = $this->_resourceProduct( FundProduct::where('slug', $product)->first() );
        $user = Auth::user();
        $saldo = $this->saldo();
        return view('client.fund.detail', ['user' => $user,'product' => $product, 'saldo' => $saldo]);
    }

      public function funding_save(Request $request){
        // TODO: validasi
        
        // cek ketersediaan produk
        $product = InvestProduct::find($request->product_id);
        if( (int)$product->stock < (int)$request->qty ){
            return back()->with('error', 'Periksa kembali stock produk ini');
        }

        // minus stock
        $product = MarketProduct::where('id', $invoice->product_id)->first();
        $old_stock = $product->stock;
        $product->stock = (int)$old_stock - (int)$invoice->qty;
        $product->save();
        return redirect('checkout');

    }
}
