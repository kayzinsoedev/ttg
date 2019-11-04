@extends('adminlte::page')

@section('title', 'TTG Asia')

@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
	@if (session()->has('flash_notification.message'))
		<div class="alert alert-{{ session('flash_notification.level') }}">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  {!! session('flash_notification.message') !!}
		</div>
	@endif
	</div>
</div>

<div class="row job">
	<div class="col-md-12">
      <div class="box-header with-border">
				<div class="col-md-10">
        		<h3>Job List</h3>
				</div>
        <div class="col-md-2">
           <a href="{{url('job/create')}}" class="btn bg-olive btn-flat margin" ><i class="fa fa-plus"></i> Add Job</a>
        </div>
      </div>
      <div class="box-body">
          <div class="row">
          	<table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
												  @if($admin_email == "admin@gmail.com")
													<th>Distributor Name</th>
													@endif
                          <th>Name</th>
                          <th>Place</th>
                          <th>Image</th>
													<th>Quantity</th>
													<!-- <th>Status</th> -->
                          <th>Action</th>
													@if($admin_email == "admin@gmail.com")
													<th>Job Status</th>
													@endif
                      </tr>
                 </thead>
                   <tbody>
                     @if(count($jobs) >0)
                     @foreach($jobs as $job)
                        <tr>
													  @if($admin_email == "admin@gmail.com")
														<td>{{$job->user->name}}</td>
														@endif
                            <td>{{$job->name}}</td>
                            <td>{{$job->place}}</td>
                            <td><img class="img-rounded img-responsive" src="{{ asset('/images/jobs/' . $job->image ) }}" alt="..." style="width:60px;height: 60px;"></td>
														<td>
															@if( ($job->decresed == '1') && ($job->quantity != '0')  )
																 {{$job->quantity}} <small class="label btn btn-warning btn-flat"> map in holder is decresed </small>
														  @elseif( $job->quantity == '0' )
																{{--<input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" value="{{$job->quantity}}" min="1">--}}
																{{$job->quantity}} <small class="label btn btn-danger btn-flat"> map in holder is empty </small>
															@elseif( ($job->quantity != '0') &&  ( $job->decresed != '1') )
																{{--<input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" value="{{$job->quantity}}" min="1">--}}
																{{$job->quantity}} <small class="label btn btn-success btn-flat"> map in holder is still full </small>
															@endif
														</td>
                            <!-- <td>
																@if(isset($job->deleted_at))
																	<small class="label bg-red">Inactive</small>
																@else
																	<small class="label bg-green">Active</small>
																@endif
														</td> -->
														<td>
															{{--@if($job->quantity == '0')--}}
																<a href="{{url('job/'. $job->id . '/edit')}}" class="btn btn-success btn-flat">
																	<i class="fa fa-edit" style=""> </i>
																	Update the quantity
																</a>
															{{--@endif--}}
															@if(isset($job->deleted_at))
															<a class="btn btn-info btn-flat" href="{{ url('job/'. $job->id . '/restore') }}"><i class="fa fa-refresh" aria-hidden="true">  </i>  Restore Job</a>
															@else
															{{Form::open(['method'  => 'DELETE', 'route' => ['job.destroy', $job->id],])}}
															<button class="btn btn-danger btn-flat" style="margin-left: 163px;margin-top: -56px;"> <i class="fa fa-trash-o" aria-hidden="true"></i>  Delete Job</button>
															{{Form::close()}}
															@endif
														</td>
														@if($admin_email == "admin@gmail.com")
																@if(isset($job->deleted_at))
																	<td><small class="label bg-red">Inactive</small></td>
																@else
																	<td><small class="label bg-green">Active</small></td>
																@endif
														@endif
                        </tr>
                      @endforeach

                      @endif
                  </tbody>
          </table>
        </div>
      <!-- end of col-md-12 -->
   </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop


@section('js')
<script>
		$(document).ready(function() {
				$('#example').DataTable();
		});
</script>
@endsection
