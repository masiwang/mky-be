<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout as Portofolio;
use App\Models\FundProduct;
use App\Models\User;
use Carbon\Carbon;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = User::findOrFail($request->user_id);
      $portofolios = Portofolio::where('user_id', $user->user_id)->get();
      return response()->json(compact('portofolios'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return response()->json(['invoice' => $request->invoice_is_sent, 'return' => $request->return_is_sent]);
      $product = FundProduct::find($request->product_id);
      $time = new Carbon($request->time);
      $portofolio = new Portofolio;
      $portofolio->user_id = $request->user_id;
      $portofolio->invoice = 'MKYINVF'.$request->user_id.$time->timestamp;
      $portofolio->product_id = $request->product_id;
      $portofolio->qty = $request->qty;
      $portofolio->created_at = $time;
      if($request->invoice_is_sent == 'true'){
        $portofolio->invoice_sent_at = $time;
        $portofolio->invoice_sent_by = 1;
      }
      if($request->return_is_sent == 'true'){
        $portofolio->return_sent_at = $product->ended_at;
        $portofolio->return_sent_by = 1;
      }
      if($portofolio->save()){
        return response()->json(['status' => 'success'], 200);
      }else{
        return response()->json(['status' => 'bad request'], 200);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
