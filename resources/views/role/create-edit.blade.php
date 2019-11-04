@extends('adminlte::page')

@section('title', 'TTG Asia')

@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
          @if(isset($role))
            <h3 class="box-title"><b>Update Role</b></h3>
          @else
            <h3 class="box-title"><b>Create New Role</b></h3>
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
								@if(isset($role))
											{!! Form::model($role ,['url'=>'role/'.$role->id,'class'=>'' , 'id' => 'ajax-form', 'method'=>'put', 'files' => true]) !!}
								@else
										{!! Form::open(['url'=>'role','class'=>'', 'id' => 'ajax-form','method'=>'product', 'files' => true]) !!}
								@endif
                  @csrf
                  <div class="box box-primary">
                      <div class="box-body">
                          <div class="form-group">
														 <div class ="row">
															 	 <div class="col-md-4">
																		 <label for="name">Role Name</label>
																		 @if(isset($role->name))
																				<input type="text" class="form-control" name="name" placeholder="Enter Role Name" value="{{$role->name}}">
																		 @else
																				<input type="text" class="form-control" name="name" placeholder="Enter Role Name" value="">
																		 @endif
															 	 </div>
														 </div>
                             <div class ="row">
															 	 <div class="col-md-4">
																		 <label for="name">Role Description</label>
																		 @if(isset($role->description))
																				<input type="text" class="form-control" name="description" placeholder="Enter Role Description" value="{{$role->description}}">
																		 @else
																				<input type="text" class="form-control" name="description" placeholder="Enter Role Description" value="">
																		 @endif
															 	 </div>
														 </div>
                          </div>
                      </div>

                      <div class="box-footer">
                          <button type ="submit" class ="btn bg-blue btn-flat margin" onclick="">Update</button>
													<a href="{{url('role')}}" class="btn bg-olive btn-flat margin"> Back </a>
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
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
<script>
		function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
					$('#logo')
					.attr('src', e.target.result)
					.width(150)
					.height(150);
					};
					reader.readAsDataURL(input.files[0]);
				}
		}
</script>
@endsection
