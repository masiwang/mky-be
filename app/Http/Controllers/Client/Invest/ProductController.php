<?php

namespace App\Http\Controllers\Invest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InvestProducts;

class ProductController extends Controller
{
    private function store($method, $request){
        if($method == 'new'){
            $product = new InvestProducts;
            $product->created_at = Carbon::now();
        }
        if($method == 'update'){
            $product = InvestProducts::find($request->id);
            $product->updated_at = Carbon::now();
        }
        $product->slug = Str::of($request->name)->slug('-').Str::random(5);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->return = $request->return;
        $product->stock = $request->stock;
        $product->closed_at = $request->closed_at;
        $product->started_at = $request->started_at;
        $product->ended_at = $request->ended_at;
        $product->category_id = $request->category_id;
        $product->vendor_id = $request->vendor_id;
        return $product->save();
    }

    public function index(Request $request){
        $products = new InvestProducts;
        if( $request->name ){
            $products = $products->where('name', 'like', '%'.$request->name.'%');
        }
        $products = $products->paginate(10);
        return redirect('/invest/product', ['products' => $products]);
    }

    public function new(){
        return view('/invest/product/new');
    }

    public function new_save(Request $request){
        // $request->validate();
        $this->store('new', $request);
        return redirect('/invest/product/'.$request->slug);
    }

    public function edit($id){
        $product = InvestProduct::find($id);
        return view('/invest/product/'.$request->slug.'/edit');
    }

    public function edit_save(Request $request){
        $this->store('update', $request);
        return redirect('/invest/product/'.$request->slug);
    }

    public function delete_save(Request $request){
        $product = InvestProduct::find($id)->delete();
        return redirect('/invest/product');
    }
}
