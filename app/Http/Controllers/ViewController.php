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
    public function index($postalcode){
        // $jobs = Job::withTrashed()->where('place',$place)->get();
        $jobs = Job::withTrashed()->where('postalcode',$postalcode)->get();
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
            return view('index',compact('postalcode','jobs','emails'));
        }else{
            return view('index',compact('postalcode','jobs'));
        }

    }

    public function thankyou(Request $request){

        $quantity = Job::where('postalcode',$request->postalcode)->first()->quantity;
        $last_quantity = ($quantity == 0 ) ? $quantity : $quantity - 1 ;
        $address = Job::where('postalcode',$request->postalcode)->first()->address;
        // $login_id = Auth::user()->id;
        Job::where('postalcode',$request->postalcode)
            // ->where('user_id',$login_id)
            ->update([
              'quantity'=> $last_quantity,
              'decresed'=> '1'
            ]);

        $url = "https://www.ttgasia.com/";
        $place = $request->place;

        if(isset($request->emails)){
            $emails =$request->emails;
            $users = User::whereIn('email',$emails);
            Mail::to( $emails )->send( new JobNotification($address));
        }
        return Redirect::intended($url);


    }
}
