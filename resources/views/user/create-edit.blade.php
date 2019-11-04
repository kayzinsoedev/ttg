@extends('adminlte::page')

@section('title', 'TTG Asia')

@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
          @if(isset($user))
            <h3 class="box-title"><b>Update User</b></h3>
          @else
            <h3 class="box-title"><b>Create New User</b></h3>
          @endif
      </div>
      <section class="content">
          <div class ="row">
              <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div><br />
                @endif
								@if(isset($user))
											{!! Form::model($user ,['url'=>'user/'.$user->id,'class'=>'' , 'id' => 'ajax-form', 'method'=>'put', 'files' => true]) !!}
								@else
										{!! Form::open(['url'=>'user','class'=>'', 'id' => 'ajax-form','method'=>'product', 'files' => true]) !!}
								@endif
                  @csrf
                  <div class="box box-primary">
                      <div class="box-body">
                          <div class="form-group">
														 <div class ="row">
															 	 <div class="col-md-4">
																		 <label for="name">User Name</label>
																		 @if(isset($user->name))
																				<input type="text" class="form-control" name="name" placeholder="Enter User Name" value="{{$user->name}}">
																		 @else
																				<input type="text" class="form-control" name="name" placeholder="Enter User Name" value="">
																		 @endif
															 	 </div>
														 </div>
                             <div class ="row">
															 	 <div class="col-md-4">
																		 <label for="name">user Email</label>
																		 @if(isset($user->email))
																				<input type="text" class="form-control" name="email" placeholder="Enter User Email" value="{{$user->email}}">
																		 @else
																				<input type="text" class="form-control" name="email" placeholder="Enter User Email" value="">
																		 @endif
															 	 </div>
														 </div>

                             <div class ="row">
															 	 <div class="col-md-4">
                                   {{Form::label('role', 'Role')}}
                                   @if(isset($roles))
                                     <select id="role" name="role_id" class="form-control" >
                                        <option value="">Select User Role</option>
                                        @foreach($roles as $key=> $role)
                                        <option value="{{$key}}">{{$role}}</option>
                                        @endforeach
                                     </select>
                                   @endif
															 	 </div>
														 </div>
                          </div>
                      </div>

                      <div class="box-footer">
                          <button type ="submit" class ="btn bg-blue btn-flat margin" onclick="">Update</button>
													<a href="{{url('user')}}" class="btn bg-olive btn-flat margin"> Back </a>
                      </div>
                  </div>
                </form>
              </div>
          </div>
      </section>
  </div>
</div>
@stop

@section('css')
@stop

@section('js')
@endsection
