<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundProduct;
use Auth;

class HomeController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $view = $user ? 'index' : 'landing';
    if($user){
      if($user->level <5){
        return redirect('/getting-started');
      }
    }
    $fund_products = FundProduct::limit(12)->orderBy('started_at', 'desc')->get();
    $all_fund_products = FundProduct::get();
    return view('pages.'.$view, compact('fund_products', 'all_fund_products', 'user'));
  }
}
