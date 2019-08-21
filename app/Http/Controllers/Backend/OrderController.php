<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::withTrashed()->get();
        return view('backend.order.index',compact('orders'));
    }
}
