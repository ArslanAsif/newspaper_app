@extends('layouts.app')

@section('content')
	<div style="text-align: center;">
		<br><br><br>
		<h1>{{ $message }}</h1>
		<br>
		<a class="btn btn-lg btn-default" href="{{ url('/') }}"><i class="fa fa-arrow-left"></i> Back to homepage</a>
		<br><br><br>
	</div>
@endsection