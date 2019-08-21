<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Auth;
use Redirect;

class ViewController extends Controller
{
    public function index($place){
        $job = Job::withTrashed()->get();
        return view('index',compact('place'));
    }

    public function thankyou($place){
        $login_id = Auth::user()->id;
       Job::where('place',$place)
            ->where('user_id',$login_id)
            ->update(['quantity'=>'0']);
        $url = "https://www.ttgasia.com/";
        return Redirect::intended($url);
    }
}
