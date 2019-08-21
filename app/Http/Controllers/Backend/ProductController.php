<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Storage;
use Image;

class ProductController extends Controller
{
    public function index(){
      $user = shell_exec('whoami');
      $ucolor = 'blue-light';

      $products = Product::withTrashed()->get();
      return view('backend.product.index',compact('products'));
    }

    public function create(){
        $categories = Category::pluck('category_name', 'id');
        return view('backend.product.create-edit',compact('categories'));
    }

    public function edit($id){
        $product = Product::withTrashed()->findorFail($id);
        $categories = Category::pluck('category_name', 'id');
        return view('backend.product.create-edit',compact('product','categories'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
           'name' => 'required',
           'price' => 'required',
           'category' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->image = 'default.png';
        $product->save();

        if($request->hasFile('image')) {
            $lastInsertproduct = Product::findorFail($product->id);
            $image = $request->image;
            $imageName = $lastInsertproduct->id.'.png';
            $path = public_path('images/products/' . $imageName);
            // Image::make($image->getRealPath())->resize(150, 150)->encode('png')->save($path);
            Image::make($image->getRealPath())->encode('png')->save($path);
            $product->image = $imageName;
            $product->save();
        }
        flash('Product is successfully saved', 'success');
        return redirect('/product');

    }


    public function update(Request $request,$id){
        $product = Product::findorFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category;
        if($request->hasFile('image')) {
            $image = $request->image;
            $logoName = $id.'.png';
            $path = public_path('images/products/' . $logoName);
            // Image::make($image->getRealPath())->resize(150, 150)->encode('png')->save($path);
            Image::make($image->getRealPath())->encode('png')->save($path);
            $product->image = $logoName;
        }

        $product->save();
        flash('Product is successfully update', 'success');
        return redirect('/product');

    }

    public function destroy($id){
      $product = Product::find($id);
      $product->delete();
      flash('Product is successfully deleted', 'danger');
      return redirect('product');
    }


    public function restore($id){
      $product = Product::onlyTrashed()->find($id);
      $product->restore();
      flash('Product is successfully restored', 'success');
      return redirect('product');
    }
}
