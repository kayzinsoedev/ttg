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
           <a href="{{url('/')}}" class="btn bg-olive btn-flat margin" ><i class="fa fa-plus"></i> </a>
        </div>
      </div>
      <div class="box-body">
          <div class="row">
          	<table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
													<th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                 </thead>
                   <tbody>
                     @if(count($users) >0)
                     @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @if(isset($user->role->description))
                              <td>{{$user->role->description}}</td>
                            @else
                              <td></td>
                            @endif
														@if(isset($user->deleted_at))
															<td><small class="label bg-red">Inactive</small></td>
														@else
															<td><small class="label bg-green">Active</small></td>
														@endif
                            <td>
                              <a href="{{url('user/'. $user->id . '/edit')}}" class="btn btn-success btn-flat">
                                <i class="fa fa-edit" style=""> </i>
                                Update User
                              </a>
                                @if(isset($job->deleted_at))
                                    <a class="btn btn-info btn-flat" href="{{ url('/'. $user->id . '/restore') }}"><i class="fa fa-refresh" aria-hidden="true">  </i>  Restore User</a>
                                @else
                                    {{Form::open(['method'  => 'DELETE', 'route' => ['user.destroy', $user->id],])}}
                                    <button class="btn btn-danger btn-flat" style="margin-left: 163px;margin-top: -56px;"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete User</button>
                                    {{Form::close()}}
                                @endif
                            </td>
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
