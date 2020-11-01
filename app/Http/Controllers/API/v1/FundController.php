<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FundCollection;
use App\Http\Resources\Fund as FundResource;
use Illuminate\Http\Request;
use App\Models\Fund;

class FundController extends Controller
{
    public function product(Request $request){
        $container = $request->container;
        $page = $request->page;
        $funds = new Fund;

        if( $request->category ){
            $category = FundCategory::where('slug', $request->category)->first();
            $funds = $funds->where('category_id', $category->id);
        }

        // if( $request->container ){
        //     if( $request->container == 'front_page' ){
        //         $funds = $funds->orderBy('id', 'desc')->limit(6)->get();
        //     }else{
        //         $funds = $funds->orderBy('id', 'desc')->skip($request->page * $this->perpage)->take($this->perpage)->get();
        //     }
        // }else{
            $funds = $funds->orderBy('id', 'desc')->skip($request->page * $this->perpage)->take($this->perpage)->get();
        // }
        // $funds = new FundCollection($funds);
        return $this->respondWithToken($funds, 200);
    }


    public function product_detail($id){
        $fund = Fund::find($id);
        $fund = new FundResource($fund);
        return $this->respondWithToken($fund, 200);
    }

    public function product_guest(){
        $products = Fund::orderBy('id', 'desc')->limit(6)->get();
        return response()->json(compact('products'), 200);
    }
}
