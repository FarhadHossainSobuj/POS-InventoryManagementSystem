<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $categories = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        return response()->json($categories);
    }
    public function getProduct(Request $request){
        $category_id = $request->category_id;
//        $products = Product::where('category_id', $category_id)->groupBy('id')->get();
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products);
    }

    public function getStock(Request $request){
        $product_id = $request->product_id;
        $stock = Product::where('id', $product_id)->first()->quantity;
        return response()->json($stock);
    }
}
