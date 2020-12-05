<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundCheckout;
use App\Models\FundProduct;
use Carbon\Carbon;

class FundProductController extends Controller
{
  public function index(Request $req){
    $user = $this->getUser();
    $fps = new FundProduct;
    if($req->category){
      $fps = $fps->where('category_id', $req->category);
    }
    $fps = $fps->orderBy('id', 'desc')->get();

    $products = [];

    foreach ($fps as $fp) {
      $start = new Carbon($fp->started_at);
      $end = new Carbon($fp->ended_at);
      $in_portofolio = FundCheckout::where('user_id', $user->id)->where('product_id', $fp->id)->first();
      $data = [
        'id' => $fp->id,
        'image' => $fp->image,
        'name' => $fp->name,
        'price' => $fp->price,
        'vendor_name' => $fp->vendor->name,
        'estimated_return' => $fp->estimated_return,
        'periode_length' => $start->diffInDays($end),
        'description' => $fp->description,
        'prospectus' => $fp->prospectus,
        'current_stock' => $fp->current_stock,
        'is_funded' => ($in_portofolio ? 1 : 0)
      ];
      array_push($products, $data);
    }

    return response()->json(compact('products'), 200);
  }
}
