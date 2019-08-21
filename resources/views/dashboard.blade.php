@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
        <h3 class="box-title"><b>Dashboard</b></h3>
      </div>
      <div class="box-body">
          <div class="row">
          	<div class="col-lg-3 col-xs-6">
              <div class ="small-box bg-green">
                 <div class ="inner">
									 @if(count($orders)>0)
									 <?php
									 			$length = count($orders);
												for ($i=0; $i <$length ; $i++) {
													  $quantity+= $orders[$i]["quantity"];
												}
									 ?>
									 		<h3>{{$quantity}}</h3>
									 @else
									 		<h4>No Order</h4>
									 @endif
                   <p>New Orders</p>
                 </div>
                 <div class ="icon">
                   <i class ="fa fa-shopping-cart"></i>
                 </div>
                 <a href ="#" class ="small-box-footer"> More Info
                   <i class ="fa fa-arrow-circle-right"></i>
              </div>

            </div>
        </div>
      <!-- end of col-md-12 -->
   </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop
