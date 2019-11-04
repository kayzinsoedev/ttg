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
        		<h3>Role List</h3>
				</div>
        <div class="col-md-2">
           <a href="{{url('role/create')}}" class="btn bg-olive btn-flat margin" > <i class="fa fa-plus"> Add New Role </i> </a>
        </div>
      </div>
      <div class="box-body">
          <div class="row">
          	<table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>ID</th>
													<th>Name</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                 </thead>
                   <tbody>
                     @if(count($roles) >0)
                     @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
														@if(isset($role->deleted_at))
															<td><small class="label bg-red">Inactive</small></td>
														@else
															<td><small class="label bg-green">Active</small></td>
														@endif
                            <td>
                              <a href="{{url('role/'. $role->id . '/edit')}}" class="btn btn-success btn-flat">
                                <i class="fa fa-edit" style=""> </i>
                                Update Role
                              </a>
                                @if(isset($role->deleted_at))
                                    <a class="btn btn-info btn-flat" href="{{ url('/'. $role->id . '/restore') }}"><i class="fa fa-refresh" aria-hidden="true">  </i>  Restore Role</a>
                                @else
                                    {{Form::open(['method'  => 'DELETE', 'route' => ['role.destroy', $role->id],])}}
                                    <button class="btn btn-danger btn-flat" style="margin-left: 163px;margin-top: -56px;"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Role</button>
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
