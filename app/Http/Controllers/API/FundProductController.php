<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundProduct;
use App\Models\FundCheckout as Portofolio;

class FundProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request){
        $products = FundProduct::get();
      }else{
        $products = new FundProduct;
        if($request->category){
          $products = $products->where('category_id', $request->category);
        }
        if($request->search){
          $products = $products->where('name', 'like', '%'.$request->search.'%');
        }
        $products = $products->orderBy('started_at', 'desc')->get();
      }
      
      return response()->json(compact('products'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = FundProduct::with(['vendor', 'report', 'checkout', 'checkout.user'])->find($id);
      return response()->json(compact('product'), 200);
    }

    public function investor($id){
      $investors = Portofolio::where('product_id', $id)->with('user')->get();
      return response()->json(compact('investors'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $product = FundProduct::find($id);
      $product->update([
        'name' => $request->name,
        'vendor_id' => $request->vendor_id,
        'price' => $request->price,
        'total_stock' => $request->total_stock,
        'current_stock' => $request->current_stock,
        'estimated_return' => $request->estimated_return,
        'actual_return' => $request->actual_return,
        'category_id' => $request->category_id,
        'started_at' => $request->started_at,
        'ended_at' => $request->ended_at,
        'prospectus' => $request->prospectus,
        'description' => $request->description
      ]);
      return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
