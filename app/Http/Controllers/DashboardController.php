<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class DashboardController extends Controller
{
    public function index() {
        $jobs = Job::withTrashed()->get();
    		return view('job.index',compact("jobs"));
    }

}
