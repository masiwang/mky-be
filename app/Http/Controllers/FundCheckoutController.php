<?php

namespace App\Http\Controllers;

use App\Models\FundCheckout;
use App\Models\FundProductReport;
use Illuminate\Http\Request;

class FundCheckoutController extends Controller
{
  public function index(){
    $user = $this->getUser();
    $portofolios = FundCheckout::where('user_id', $user->id)->get();
    return view('pages.portofolio.index', compact('portofolios', 'user'));
  }

  public function detail($invoice){
    $user = $this->getUser();
    $portofolio = FundCheckout::where('user_id', $user->id)->where('invoice', $invoice)->firstOrFail();
    $reports = FundProductReport::where('fund_product_id', $portofolio->product->id)->get();
    return view('pages.portofolio.detail', compact('portofolio', 'reports', 'user'));
  }
}
