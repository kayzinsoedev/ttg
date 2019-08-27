{{--@extends('adminlte::page')--}}
@section('content_header')
@stop
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="container">
<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
         <div class="col-md-2" style="margin-top:45px;">
            <img src="{{ asset('/images/logo.png') }}" class="img-thumbnail" alt="Responsive image">
         </div>
         <div class="col-md-10">
            <img src="{{ asset('/images/logo.jpeg') }}" class="img-thumbnail" alt="Responsive image">
         </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="font-size:1.2em;">
            About TTG Asia Media<br><br>
            The Leading Travel and Tourism Publisher and Events Organiser In The Asia-Pacific
            Established in 1974, TTG Asia Media is at the forefront of the Asia-Pacific travel and tourism industry. Its authority encompasses the leisure trade, luxury travel, corporate travel, MICE and association domains. Through its four business groups, the company publishes leading regional trade titles for the travel industry, Singapore maps and guides for inbound tourists, organises international trade events and creates solutions that foster global business collaborations among travel industry players worldwide.
        </div>
        <div class="col-md-1"></div>
      </div>

      <form action ="{{route('thanks')}}" method="post">
          <div class=col-md-4></div>
          <div class=col-md-4>
              <div class="box-body">
                @csrf
                  <div class="row">
                    <button class ="btn btn-danger btn-flat collect" onclick="">Please click and submit to distribute more map!</button>
                    <input type="text" value="{{$place}}" name="place" id="place" > </input>
										{{--@foreach($jobs as $job)--}}
                    		{{--<input type="text" value="{{$job->place}}" name="place" > </input>--}}
										{{--@endforeach--}}
										@if(isset($emails))
												@foreach($emails as $email)
		                    	<input type="text" value="{{$email}}" name="emails[]" ></input>
											  @endforeach
										@endif
                  </div>
              </div>
          </div>

          <div class=col-md-4></div>
     </form>
  </div>
</div>
</div>
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-blue-light.css')}} ">

<link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
	$(document).ready(function() {
			$(".collect").on("click", function(){
					location.reload("http://localhost/ttg/public/job");
			});
  } );

	// function thankyou(){
	// 	var postalcode = $("#postalcode").val();
	// 	$.ajax({
	// 			 url: '../thankyou',
	// 			 type: 'POST',
	// 			 data: {'postalcode': postalcode},
	// 			 contentType: 'application/json',
	// 			 success: function(data) {
	// 					 console.log('SUCCESS: ', data);
	// 			 },
	// 			 error: function(data) {
	// 					 console.log('ERROR: ', data);
	// 			 },
	//  });
	//
	// }
</script>
