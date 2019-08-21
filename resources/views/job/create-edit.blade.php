@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
          @if(isset($job))
            <h3 class="box-title"><b>Edit Job</b></h3>
          @else
            <h3 class="box-title"><b>Create Job</b></h3>
          @endif
      </div>
      <section class="content">
          <div class ="row">
              <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div><br />
                @endif
								@if(isset($job))
											{!! Form::model($job ,['url'=>'job/'.$job->id,'class'=>'' , 'id' => 'ajax-form', 'method'=>'put', 'files' => true]) !!}
								@else
										{!! Form::open(['url'=>'job','class'=>'', 'id' => 'ajax-form','method'=>'product', 'files' => true]) !!}
								@endif
                  @csrf
                  <div class="box box-primary">
                      <div class="box-body">
                          <div class="form-group">
														 <div class ="row">
															 	 <div class="col-md-6">
																		 <label for="name">Job Name </label>
																		 @if(isset($job->name))
																				<input type="text" class="form-control" name="name" placeholder="Enter Job Name" value="{{$job->name}}">
																		 @else
																				<input type="text" class="form-control" name="name" placeholder="Enter Job Name" value="">
																		 @endif
															 	 </div>

																 <div class="col-md-6">
																		<label for="name">Quantity</label>
																		@if(isset($job->quantity))
																			 <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" value="{{$job->quantity}}" min="1">
																		@else
																			 <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" value="" min="1">
																		@endif
																 </div>
														 </div>

                          </div>

													<div class="form-group">
														 <div class ="row">
														 	 <div class="col-md-6">
			                             <label for="name">Place</label>
			                             @if(isset($job->place))
			                                <input type="text" class="form-control" name="place" placeholder="Enter Place Name" value="{{$job->place}}">
			                             @else
			                                <input type="text" class="form-control" name="place" placeholder="Enter Place Name" value="">
			                             @endif
														 	 </div>


																 <div class="col-md-6">
			 														 @if(isset($job))
			 														 		<img id="logo" class="img-responsive" src="{{ asset('/images/jobs/' . $job->image ) }}" alt="Logo" style="width: 100px;height: 100px;margin-bottom: 10px;" />
			 														 		{!! Form::file('image', array('onchange' => 'readURL(this);')); !!}
			 														 @else
				 														 <img id="logo" src="http://via.placeholder.com/150x150" alt="Logo" style="width: 100px;height: 100px;margin-bottom: 10px;"/>
				 														 {!! Form::file('image', array('onchange' => 'readURL(this);')); !!}
			 														 @endif
			                           </div>
													   </div>
                          </div>

                      </div>

                      <div class="box-footer">
                          <button type ="submit" class ="btn bg-blue btn-flat margin">Submit</button>
													<a href="{{url('job')}}" class="btn bg-olive btn-flat margin"> Back </a>
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
		$(function () {
			CKEDITOR.replace('description');
			$('#category_list').select2();
		});
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
