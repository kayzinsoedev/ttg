<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Image;
use Auth;
use Postcode;

class JobController extends Controller
{
    public function index(){
      $jobs = Job::withTrashed()->where('user_id',Auth::user()->id)->get();
      return view('job.index',compact('jobs'));
    }

    public function create(){
      return view('job.create-edit');
    }


    public function store(Request $request){
        $validatedData = $request->validate([
           'name' => 'required',
           // 'place' => 'required',
           'quantity' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $job = new Job;
        $job->user_id = Auth::user()->id;
        $job->name = $request->name;
        $job->place = $request->place;
        $job->quantity = $request->quantity;
        $job->postalcode = $request->postalcode;
        $job->image = 'default.png';
        $job->save();

        if($request->hasFile('image')) {
            $lastInsertproduct = Job::findorFail($job->id);
            $image = $request->image;
            $imageName = $lastInsertproduct->id.'.png';
            $path = public_path('images/jobs/' . $imageName);
            // Image::make($image->getRealPath())->resize(150, 150)->encode('png')->save($path);
            Image::make($image->getRealPath())->encode('png')->save($path);
            $job->image = $imageName;
            $job->save();
        }
        flash('Job is successfully created', 'success');
        return redirect('/job');
    }

    public function edit($id){
        $job = Job::withTrashed()->findorFail($id);
        return view('job.create-edit',compact('job'));
    }


    public function update(Request $request,$id){
         if(isset($request->postalcode)){
            // $this->getLnt($request->postalcode);
            $address = urlencode($request->postalcode);
            // $url='https://maps.googleapis.com/maps/api/geocode/json?address=1.$address.CA&key=AIzaSyD9OyzhihG7EMV6oRvxTNDaEXL6IORHu7k';
            $url='https://maps.googleapis.com/maps/api/geocode/json?address=1.$address.CA&key=AIzaSyD9OyzhihG7EMV6oRvxTNDaEXL6IORHu7k';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            dd($data);
            curl_close($ch);
            $source = $data;

            $obj = json_decode($source);
            $lat = $obj->results[0]->geometry->location->lat;
            $long = $obj->results[0]->geometry->location->lng;


         }
        $job = Job::findorFail($id);
        $job->name = $request->name;
        $job->place = $request->place;
        $job->quantity = $request->quantity;
        $job->postalcode = $request->postalcode;
        $job->decresed = '0';
        if($request->hasFile('image')) {
            $image = $request->image;
            $logoName = $id.'.png';
            $path = public_path('images/jobs/' . $logoName);
            // Image::make($image->getRealPath())->resize(150, 150)->encode('png')->save($path);
            Image::make($image->getRealPath())->encode('png')->save($path);
            $job->image = $logoName;
        }

        $job->save();
        flash('Job is successfully updated', 'success');
        return redirect('/job');
    }

      // function getLnt($zip){
      //   $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";
      //   $result_string = file_get_contents($url);
      //   // $result = json_decode($result_string, true);
      //   dd($result_string);
      //   // return $result['results'][0]['geometry']['location'];
      // }


    public function destroy($id){
      $job = Job::find($id);
      $job->delete();
      flash('Job is successfully deleted', 'danger');
      return redirect('job');
    }


    public function restore($id){
      $job = Job::onlyTrashed()->find($id);
      $job->restore();
      flash('Job is successfully restored', 'success');
      return redirect('job');
    }
}
