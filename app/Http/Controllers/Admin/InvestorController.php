<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundCheckout;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Hash;

class InvestorController extends Controller
{
  protected function _totalFunding($user){
    $total_funding = 0;
    $portofolios = $user->portofolio;
    foreach ($portofolios as $portofolio) {
        $price = $portofolio->product->price;
        $qty = $portofolio->qty;
        $funding = $price * $qty;
        $total_funding = $total_funding + $funding;
    }
    return $total_funding;
  }

  protected function _totalWithdraw($user){
      $total_withdraw = 0;
      $withdraws = $user->transaction->where('comment', 'withdraw');
      foreach($withdraws as $withdraw){
          $total_withdraw = $total_withdraw + (-1*$withdraw->nominal);
      }
      return $total_withdraw;
  }

  protected function _resourceUser($users){
      $response = [];
      foreach ($users as $user) {
          $data = [
              'id' => $user->id,
              'name' => $user->name,
              'portofolio' => $user->portofolio->count(),
              'total_funding' => $this->_totalFunding($user),
              'total_withdraw' => $this->_totalWithdraw($user)
          ];
          array_push($response, $data);
      }
      return $response;
  }

  protected function _resourceConfirmation($users){
      $response = [];
      foreach($users as $user){
          $data = [
              'id' => $user->id,
              'name' => $user->name,
              'join_at' => $user->created_at,
              'ktp_image' => $user->ktp_image
          ];
          array_push($response, $data);
      }
      return $response;
  }

  public function index(){
      $users = new User;
      $all = $this->_resourceUser( $users->get() );
      $last_month = $this->_resourceUser( $users->where('created_at', '>', Carbon::now()->subMonths(1))->get() );
      $need_confirm = $this->_resourceConfirmation( $users->whereNotNull('ktp_image')->whereNull('ktp_verified_at')->get() );

      return response()->json(compact('all', 'last_month', 'need_confirm'), 200);
  }

  public function _resourceUserDetail($user){
    $data = [
      'ktp' => $user->ktp,
      'name' => $user->name,
      'gender'=> $user->gender,
      'birthplace' => $user->birthplace,
      'birthday' => new Carbon($user->birthday),
      'jalan' => $user->jalan,
      'kelurahan' => $user->kelurahan,
      'kecamatan' => $user->kecamatan,
      'kabupaten' => $user->kabupaten,
      'kodepos' => $user->kodepos,
      'email' => $user->email,
      'phone' => $user->phone,
    ];
    return $data;
  }

  public function _resourcePortofolio($portofolios){
    $response = [];
    foreach ($portofolios as $portofolio) {
      $data = [
        'product_id' => $portofolio->product->id,
        'invoice' => $portofolio->invoice,
        'product' => $portofolio->product->name,
        'qty' => $portofolio->qty,
        'nominal' => (int)$portofolio->qty * (int)$portofolio->product->price,
        'funding_time' => $portofolio->created_at,
        'actual_return' => ((int)$portofolio->qty * (int)$portofolio->product->price)*(1+($portofolio->product->actual_return/100))
      ];
      array_push($response, $data);
    }
    return $response;
  }

  public function _resourceTransaction($transactions){
    $response = [];
    foreach ($transactions as $transaction) {
      $data = [
        'code' => $transaction->code,
        'time' => $transaction->created_at,
        'type' => substr($transaction->code, 4, 1),
        'bank' => $transaction->bank_type.' '.$transaction->bank_acc,
        'nominal' => $transaction->nominal,
        'status' => $transaction->approved_at
      ];
      array_push($response, $data);
    }
    return $response;
  }

  public function detail($id){
    $user = $this->_resourceUserDetail(User::find($id));
    $portofolios = $this->_resourcePortofolio( FundCheckout::where('user_id', $id)->get() );
    $transactions = $this->_resourceTransaction( Transaction::where('user_id', $id)->get() );
    return response()->json(compact('user', 'portofolios', 'transactions'));
  }

  public function ktpConfirmSave(Request $request){
    $user = User::findOrFail($request->id);
    $admin = User::findOrFail(Auth::id());

    if(!(Hash::check($request->password, $admin->password))){
      return response()->json(['error' => 'unauthenticated'], 401);
    }

    $user->ktp_verified_at = Carbon::now();
    $user->ktp_verified_by = Auth::id();

    if($user->save()){
      return response()->json(['success' => 'user confirmed'], 200);
    }else{
      return response()->json(['error' => 'bad request'], 400);
    }
  }
}
