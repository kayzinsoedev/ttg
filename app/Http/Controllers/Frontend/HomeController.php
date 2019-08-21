<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Location;
use App\Product;

class HomeController extends Controller
{
    public function index(){
      $quantity = 0;
      if(isset($_GET['quantity'])){
          $quantity = $_GET['quantity'];
      }

      $categories = Category::pluck('category_name', 'id');
      $locations = Location::all();
      // $mains= Product::where('category_id','1')->get();
      // $green_selections=Product::where('category_id','2')->get();
      // $sandwiches=Product::where('category_id','3')->get();
      // $coffee=Product::where('category_id','4')->get();
      // $tea=Product::where('category_id','5')->get();
      // $smoothies=Product::where('category_id','6')->get();
      // $summer_drinks=Product::where('category_id','7')->get();
      // $toasts=Product::where('category_id','8')->get();
      // $dim_sums=Product::where('category_id','9')->get();
      return view('frontend.home.index',compact('categories','quantity','locations'));
      // return response()->json(['success' => true, 'html' => $html]);
    }
}
