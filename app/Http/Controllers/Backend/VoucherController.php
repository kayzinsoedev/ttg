<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;

class VoucherController extends Controller
{
    public function index(){
      $vouchers = Voucher::withTrashed()->get();
      return view('backend.voucher.index',compact('vouchers'));
    }

    public function create(){
      $type = ["0" =>"-- Choose --", "1"=> "Percent", "2" => "Amount"];
      $valid = ["0"=> "-- Choose --", "1"=> "Fixed", "2"=>"Period", "3"=> "Recurring"];
      $week_day =[
          "1" => "Monday",
          "2" => "Tuesday",
          "3" => "Wednesday",
          "4" => "Thursday",
          "5" => "Friday",
          "6" => "Saturday",
          "7" => "Sunday"
      ];
      return view('backend.voucher.create-edit',compact('type','valid','week_day'));
    }


    public function store(Request $request){
        $validatedData = $request->validate([
           'voucher_code' => 'required',
           'discount'=>'required',
           'type'=>'required',
           'valid'=>'required',
        ]);

        $voucher = new Voucher;
        $voucher->voucher_code = $request->voucher_code;
        $voucher->discount = $request->discount;
        $voucher->type = $request->type;
        $voucher->valid = $request->valid;
        $voucher->week_day = $request->week_days;
        $voucher->start_date_time = $request->start_date_time;
        $voucher->end_date_time = $request->end_date_time;
        $voucher->save();

        flash('Voucher is successfully saved', 'success');
        return redirect('voucher');

    }

    public function edit($id){
        $voucher = Voucher::withTrashed()->findorFail($id);
        $type = ["0" =>"-- Choose --", "1"=> "Percent", "2" => "Amount"];
        $valid = ["0"=> "-- Choose --", "1"=> "Fixed", "2"=>"Period", "3"=> "Recurring"];
        $week_day =[
            "1" => "Monday",
            "2" => "Tuesday",
            "3" => "Wednesday",
            "4" => "Thursday",
            "5" => "Friday",
            "6" => "Saturday",
            "7" => "Sunday"
        ];
        return view('backend.voucher.create-edit',compact('voucher','type','valid','week_day'));
    }

    public function update(Request $request,$id){
        $voucher = Voucher::findorFail($id);
        $voucher->voucher_code = $request->voucher_code;
        $voucher->discount = $request->discount;
        $voucher->type = $request->type;
        $voucher->valid = $request->valid;
        $voucher->week_day = $request->week_days;
        $voucher->start_date_time = $request->start_date_time;
        $voucher->end_date_time = $request->end_date_time;
        $voucher->save();

        flash('Voucher is successfully update', 'success');
        return redirect('voucher');
    }

    public function destroy($id){
      $voucher = Voucher::find($id);
      $voucher->delete();
      flash('Voucher is successfully deleted', 'danger');
      return redirect('voucher');
    }


    public function restore($id){
      $voucher = Voucher::onlyTrashed()->find($id);
      $voucher->restore();
      flash('Voucher is successfully restored', 'success');
      return redirect('voucher');
    }
}
