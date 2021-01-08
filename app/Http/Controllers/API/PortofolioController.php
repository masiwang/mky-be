<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout as Portofolio;
use App\Models\FundProduct;
use App\Models\Notification;
use App\Models\Transaction;
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

    public function store_(Request $request){
      $user_id = 2;
      $user = User::find($user_id);
      // validasi
      $request->validate([
        'product_id' => 'required',
        'qty' => 'required|min:1|max:1000'
      ]);
      // cek apakah sudah pernah funding
      $is_funded = Portofolio::where([
        'user_id' => $user_id,
        'product_id' => $request->product_id
      ])->first();
      // return response()->json(compact('is_funded'));
      if($is_funded){
        return response()->json(['error' => 'Anda telah melakukan pendanaan pada produk ini.'], 400);
      }
      // product price
      $product = FundProduct::find($request->product_id);
      $product_price = $product->price;
      // total price
      $total_price = $product_price * $request->qty;
      // cek apakah saldo mencukupi
      $trf_in_success = Transaction::where([
        'user_id' => 2,
        'type' => 'in',
        'status_id' => 2,
      ])->sum('nominal');
      $trf_out_success = Transaction::where([
        'user_id' => 2,
        'type' => 'out',
        'status_id' => 2
      ])->sum('nominal');
      $trf_out_pending = Transaction::where([
        'user_id' => 2,
        'type' => 'out',
        'status_id' => 1
      ])->sum('nominal');
      $saldo_with_pending_withdraw = $trf_in_success + $trf_out_success + $trf_out_pending;
      if($saldo_with_pending_withdraw < $total_price){
        return response()->json(['error' => 'Saldo Anda tidak mencukupi.'], 400);
      }
      // menambah portofolio
      Portofolio::create([
        'invoice' => 'MKYINVF'.$user_id.Carbon::now()->timestamp,
        'product_id' => $request->product_id,
        'user_id' => $user_id,
        'qty' => $request->qty
      ]);
      // mengurangi saldo
      $transaction = new Transaction;
      $transaction->code = 'MKYTRFO'.$user_id.Carbon::now()->timestamp;
      $transaction->user_id = $user_id;
      $transaction->type = 'out';
      $transaction->bank_type = 'MAKARYA';
      $transaction->bank_acc = $user_id;
      $transaction->nominal = $total_price;
      $transaction->status_id = 1;
      $transaction->comment = 'Pendanaan '.$product->name;
      $transaction->save();
      // mengurangi stock
      $product = FundProduct::find($request->product_id);
      $product_old_stock = $product->current_stock;
      $product->current_stock = $product_old_stock - $request->qty;
      $product->save();
      // membuat notifikasi
      Notification::create([
        'user_id' => $user->id,
        'title' => 'Pendanaan '.$product->name,
        'body' => '<p>Hi '.$user->name.'👋</p>'.
        '<p>Terimakasih telah melakukan pendanaan pada produk '.$product->name.'. Setelah pendanaan dimulai, Anda akan menerima invoice dan rincian pendanaan dari kami. Terimakasih 🙏.</p>'.
        '<p>Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in.</p>'.
        '<br/><p>Salam 💚,<br/><br/>Tim makarya</p>'
      ]);
      return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $portofolio = Portofolio::with('product')->find($id);
      return response()->json(compact('portofolio'), 200);
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
      // return $request->user_id;
      $time = new Carbon($request->time);
      $portofolio = Portofolio::find($id);
      $portofolio->user_id = $request->user_id;
      $portofolio->invoice = 'MKYINVF'.$request->user_id.$time->timestamp;
      $portofolio->product_id = $request->product_id;
      $portofolio->qty = $request->qty;
      $portofolio->created_at = $time;
      if($request->invoice_is_sent == 'true'){
        $portofolio->invoice_sent_at = $time;
        $portofolio->invoice_sent_by = 1;
      }else{
        $portofolio->invoice_sent_at = null;
        $portofolio->invoice_sent_by = null;
      }
      if($request->return_is_sent == 'true'){
        $product = FundProduct::find($request->product_id);
        $portofolio->return_sent_at = $product->ended_at;
        $portofolio->return_sent_by = 1;
      }else{
        $portofolio->return_sent_at = null;
        $portofolio->return_sent_by = null;
      }
      if($portofolio->save()){
        return response()->json(['status' => 'success'], 200);
      }else{
        return response()->json(['status' => 'bad request'], 200);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $portofolio = Portofolio::find($id);
      $portofolio->delete();
      return response()->json(['status' => 'success'], 200);
    }
}
