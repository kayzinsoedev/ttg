<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Term;

class TermsController extends Controller
{
    public function index(){
      $terms = Term::withTrashed()->get();
      return view('backend.term.index',compact('terms'));
    }
}
