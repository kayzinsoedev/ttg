<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    public function index(){
      $location = Location::withTrashed()->get();
      return view('backend.location.index',compact('location'));
    }

    public function create(){
      return view('backend.location.create-edit');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
           'location_name' => 'required',
           'location_address' => 'required',
        ]);
        $location = new Location;
        $location->name = $request->location_name;
        $location->address = $request->location_address;
        $location->save();
        flash('Location is successfully saved', 'success');
        return redirect('location');
    }


    public function edit($id){
        $location = Location::withTrashed()->findorFail($id);
        return view('backend.location.create-edit',compact('location'));
    }


    public function update(Request $request,$id){
        $location = Location::findorFail($id);
        $location->name = $request->location_name;
        $location->address = $request->location_address;
        $location->save();
        flash('Location is successfully update', 'success');
        return redirect('location');
    }
}
