<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index(){
      $products = Product::all();
      $categories = Category::pluck('category_name', 'id');
      return view('frontend.product.index',compact('products','categories'));
    }

    public function productDetail(Request $request,$id){
      $product = Product::findorFail($id);
      $categories = Category::pluck('category_name', 'id');
      return view('frontend.product.detail',compact('product','categories'));
    }

    public function addTocart(Request $request){
        dd($request);
        return view('frontend.product.index');
    }

    public function checkout(Request $request){
        return view('frontend.checkout.index');
    }
}
