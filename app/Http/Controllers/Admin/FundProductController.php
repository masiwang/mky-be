<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundCheckout;
use App\Models\FundProduct;
use App\Models\FundProductCategory;
use App\Models\FundProductReport;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FundProductController extends Controller
{
    public function _resource($products){
        $response = [];
        foreach ($products as $product) {
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'vendor' => $product->vendor->name,
                'estimated_return' => $product->estimated_return,
                'actual_return' => $product->actual_return,
                'started_at' => $product->started_at,
                'ended_at' => $product->ended_at
            ];
            array_push($response, $data);
        }
        return $response;
    }

    public function index(){
        $products = new FundProduct;
        $all = $this->_resource( $products->all() );
        $active = $this->_resource( $products->where('ended_at', '>=', Carbon::now())->get() );
        $done = $this->_resource( $products->where('ended_at', '<', Carbon::now())->get() );
        $vendors = Vendor::select('id', 'name')->get();

        return response()->json(compact('all', 'active', 'done', 'vendors'), 200);
    }

    protected function _resourceDetail($product){
        $started_at = (new Carbon($product->started_at));
        $ended_at = (new Carbon($product->ended_at));
        $response = [
            'id' => $product->id,
            'name' => $product->name,
            'vendor' => $product->vendor,
            'category' => $product->category,
            'price' => $product->price,
            'estimated_return' => $product->estimated_return,
            'actual_return' => $product->actual_return,
            'total_stock' => $product->total_stock,
            'current_stock' => $product->current_stock,
            'started_at' => $product->started_at,
            'ended_at' => $product->ended_at,
            'duration' => $ended_at->diffInDays($started_at),
            'description' => $product->description,
            'prospectus' => $product->prospectus,
            'image' => $product->image,
        ];
        return $response;
    }

    protected function _resourceInvestor($portofolios){
      $response = [];
      foreach ($portofolios as $portofolio) {
        $data = [
          'id' => $portofolio->id,
          'user_id' => $portofolio->user->id,
          'user_name' => $portofolio->user->name,
          'funding_time' => $portofolio->created_at,
          'qty' => $portofolio->qty,
          'nominal' => (int)$portofolio->product->price * (int)$portofolio->qty,
          'invoice_sent' => $portofolio->invoice_sent_at,
          'return_sent' => $portofolio->return_sent_at,
        ];
        array_push($response, $data);
      }
      return $response;
    }

    public function detail($id){
        $product = $this->_resourceDetail( FundProduct::find($id) );
        $vendors = Vendor::select('id', 'name')->get();
        $categories = FundProductCategory::select('id', 'name')->get();
        $portofolios = FundCheckout::where('product_id', $id)->get();
        $investors = $this->_resourceInvestor($portofolios);
        $reports = FundProductReport::where('fund_product_id', $id)->get();
        return response()->json(compact('product', 'reports', 'vendors', 'investors', 'categories'), 200);
    }

    public function new(Request $request){
      $request->validate([
        'name' => 'required|min:6',
        'vendor' => 'required',
        'price' => 'required|min:4',
        'stock' => 'required',
        'periode' => 'required',
        'description' => 'required|max:512',
        'prospectus' => 'required'
      ]);
      $fund_product = new FundProduct();
      $fund_product->image = $request->image;
      $fund_product->name = $request->name;
      $fund_product->vendor_id = $request->vendor;
      $fund_product->category_id = $request->category;
      $fund_product->description = $request->description;
      $fund_product->price = $request->price;
      $fund_product->total_stock = $request->stock;
      $fund_product->current_stock = $request->stock;
      $fund_product->estimated_return = $request->est_roi;
      $fund_product->prospectus = $request->prospectus;
      $fund_product->started_at = $request->periode[0];
      $fund_product->ended_at = $request->periode[1];
      
      if($fund_product->save()){
        return response()->json(['status' => true, 'message' => 'success'], 200);
      }else{
        return response()->json(['status' => false, 'message' => 'bad request'], 200);
      }
  }
  public function edit($id, Request $request){
    $fund_product = FundProduct::find($id);
    if($request->name){
      $fund_product->name = $request->name;
    }
    if($request->vendor_id){
      $vendor_id = $request->vendor->id ?? $request->vendor;
      $fund_product->vendor_id = $request->vendor_id;
    }
    if($request->category_id){
      $category_id = $request->category->id ?? $request->category;
      $fund_product->category_id = $category_id;
    }
    if($request->description){
      $fund_product->description = $request->description;
    }
    if($request->price){
      $fund_product->price = $request->price;
    }
    if($request->total_stock){
      $fund_product->total_stock = $request->total_stock;
    }
    if($request->current_stock){
      $fund_product->current_stock = $request->current_stock;
    }
    if($request->estimated_return){
      $fund_product->estimated_return = $request->estimated_return;
    }
    if($request->actual_return){
      $fund_product->actual_return = floatval($request->actual_return);
    }
    if($request->prospectus){
      $fund_product->prospectus = $request->prospectus;
    }
    if($request->started_at){
      $fund_product->started_at = new Carbon($request->started_at);
    }
    if($request->ended_at){
      $fund_product->ended_at = new Carbon($request->ended_at);
    }

    if($fund_product->save()){
      return response()->json(['status' => 200, 'message' => $request], 200);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request'], 200);
    }
  }

  public function newReport(Request $request){
    $report = new FundProductReport();
    $report->fund_product_id = $request->id;
    $report->image = $request->image;
    $report->title = $request->title;
    $report->description = $request->description;
    
    if($report->save()){
      return response()->json(['status' => 200, 'message' => 'success'], 200);
    }else{
      return response()->json(['status' => 400, 'message' => 'bad request'], 400);
    }
  }
}
