{{--@extends('adminlte::page')--}}
@section('content_header')
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
      <div class="box-header with-border">
				<div class="col-md-10">
        		<h3></h3>
				</div>

      </div>

      <div class="box-body">
        @csrf
          <div class="row">
              <button class ="btn btn-info btn-flat">Thank you for submitting!</button>
         </div>
      <!-- end of col-md-12 -->
   </div>

  </div>
</div>
@stop

@section('css')
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-blue-light.css')}} ">

@stop


@section('js')
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@endsection
