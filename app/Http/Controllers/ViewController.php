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

        $PublicIP = get_client_ip();
        $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
        $json     = json_decode($json, true);
        $country  = $json['country'];
        $region   = $json['region'];
        $city     = $json['city'];
        dd($city);

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

    function get_client_ip(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
      }
}
