<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout as Portofolio;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::get();
      return response()->json(compact('users'), 200);
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

    public function portofolios($user_id){
      $portofolios = Portofolio::where('user_id', $user_id)->with('product')->with('product.vendor')->get();
      return response()->json(compact('portofolios'), 200);
    }

    public function notifications($user_id){
      $notifications = Notification::where('user_id', $user_id)->get();
      
      return response()->json(compact('notifications'), 200);
    }



    public function transaction($id){
      $transactions = Transaction::where('user_id', $id)->get();
      return response()->json(compact('transactions'), 200);
    }
}
