<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Auth;
use Redirect;
use App\User;
use Mail;
use App\Mail\JobNotification;

class ViewController extends Controller
{
    public function index($place){
        // $jobs = Job::withTrashed()->where('place',$place)->get();
        $jobs = Job::withTrashed()->where('place',$place)->get();
        if(count($jobs) >0){
          foreach ($jobs as $key => $job) {
            $user_ids[] = $job->user_id;
          }
          $users = User::whereIn('id',$user_ids)->get();
          foreach ($users as $key => $user) {
             $emails[] = $user->email;
          }
        }
        if(isset($emails)){
            return view('index',compact('place','jobs','emails'));
        }else{
            return view('index',compact('place','jobs'));
        }

    }

    public function thankyou(Request $request){
        // $quantity = Job::where('place',$request->postalcode)->first()->quantity;
        // $address = Job::where('place',$request->address)->first()->place;
        // $login_id = Auth::user()->id;
        Job::where('place',$request->place)
            // ->where('user_id',$login_id)
            ->update([
              'quantity'=> 0,
              'decresed'=> '1'
            ]);

        $url = "https://www.ttgasia.com/";
        $place = $request->place;

        if(isset($request->emails)){
            $emails =$request->emails;
            $users = User::whereIn('email',$emails);
            Mail::to( $emails )->send( new JobNotification($place));
        }
        return Redirect::intended($url);


    }
}
