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
			                             <label for="name">Postal Code</label>
			                             @if(isset($job->postalcode))
			                                <input type="text" id="postalcode" class="form-control" name="postalcode" placeholder="Enter Postal Code" value="{{$job->postalcode}}" onkeyup="getAddress(this)">
			                             @else
			                                <input type="text" id="postalcode" class="form-control" name="postalcode" placeholder="Enter Postal Code" value="" onkeyup="getAddress(this)">
			                             @endif
														 	 </div>


																 <div class="col-md-6">
																	 <label for="name">Address</label>
																	 @if(isset($job->place))
			                                <input type="text" id="address" class="form-control" name="address" placeholder="" value="{{$job->place}}">
			                             @else
			                                <input type="text" id="address" class="form-control" name="address" placeholder="" value="">
			                             @endif
			                           </div>
													   </div>
                          </div>

													<div class="form-group">
														 <div class ="row">
														 	 <div class="col-md-6">
			                             <label for="name">Place</label>
			                             @if(isset($job->place))
			                                <input type="text" id="address" class="form-control" name="address" placeholder="Enter Place" value="{{$job->place}}" onkeyup="">
			                             @else
			                                <input type="text" id="address" class="form-control" name="address" placeholder="Enter Place" value="" onkeyup="">
			                             @endif
														 	 </div>
													   </div>
                          </div>


													<div class="form-group">
														 <div class ="row">
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


													<div class="form-group">
														 <div class ="row">
																 <div class="col-md-6">
			 														 @if(isset($job))
																	 <?php
																			 $exists = Storage::disk('sftp')->exists($job->file_name);
																	 ?>
																		 @if($exists)
																		 			{{$job->id}}
									                        <small id="exist-file" class="form-text text-muted">Existing File: <a href="{{ route('file.download', $job->id) }}" > Download File</a> </small>
									                   @else
									                        No Files Uploaded on server.
									                   @endif
			 														 @else
				 														 <input type="file" class="form-control" id="file" name="attach_file" value="">
			 														 @endif
			                           </div>
													   </div>
                          </div>

                      </div>

                      <div class="box-footer">
                          <button type ="submit" class ="btn bg-blue btn-flat margin" onclick="">Submit</button>
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
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?components=country:SG&key=AIzaSyCdlahDXtrlOW0fvUyWxDKm6rLuCEUgaP4"></script> -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?components=country:SG&key=AIzaSyCdlahDXtrlOW0fvUyWxDKm6rLuCEUgaP4"></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/geocode/json?components=country:SG&sensor=false&key=AIzaSyCdlahDXtrlOW0fvUyWxDKm6rLuCEUgaP4"></script> -->



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

		function getAddress(input){
			  if($("#postalcode").val() == "" ){
						$("#address").val("");
				}
				var postalcode = input.value;
				// getaddr(postalcode);
				var lat;
		    var lng;
		    var geocoder = new google.maps.Geocoder();
				geocoder.geocode({ 'address': postalcode }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            geocoder.geocode({'latLng': results[0].geometry.location}, function(results, status) {
		            if (status == google.maps.GeocoderStatus.OK) {
		                if (results[1]) {
		                    var loc = getCityState(results);
												// console.log(loc);
												$("#address").val(loc);
		                }
		            }
        		});
        	}
    	  });
		}

		function getCityState(results){
        var a = results[0].address_components;
        var city, state;
        for(i = 0; i <  a.length; ++i)
        {
           var t = a[i].types;
           if(compIsType(t, 'administrative_area_level_1'))
              state = a[i].long_name; //store the state
           else if(compIsType(t, 'locality'))
              city = a[i].long_name; //store the city
        }
        return (city + ', ' + state)
    }

		function compIsType(t, s) {
       for(z = 0; z < t.length; ++z)
          if(t[z] == s)
             return true;
       return false;
  	}

		function UpdateJob(){

		}


</script>
@endsection
