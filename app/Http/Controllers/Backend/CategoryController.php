<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
      $categories = Category::withTrashed()->get();
      return view('backend.category.index',compact('categories'));
    }


    public function create(){
        return view('backend.category.create-edit');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
           'category_name' => 'required',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        // $category->status = $request->status;
        $category->save();

        flash('Category is successfully saved', 'success');
        return redirect('/category');

    }


    public function edit($id){
        $categories = Category::withTrashed()->get();
        $category = Category::withTrashed()->findorFail($id);
        $c_name = $category->category_name;
        return view('backend.category.create-edit',compact('category'));
    }



    public function update(Request $request,$id){
        $category = Category::findorFail($id);
        $category->category_name = $request->category_name;
        $category->save();
        flash('Category is successfully update', 'success');
        return redirect('category');
    }


    public function destroy($id){
      $category = Category::find($id);
      $category->delete();
      flash('Category is successfully deleted', 'danger');
      return redirect('category');
    }


    public function restore($id){
      $category = Category::onlyTrashed()->find($id);
      $category->restore();
      flash('Category is successfully restored', 'success');
      return redirect('category');
    }
}
