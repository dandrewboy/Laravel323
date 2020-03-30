@extends('layouts.appmaster1')
@section('title', 'Login Passed')

@section('content')
		@if($model->getUsername() == 'mark')
		<h3>Mark has Logged in!</h3>
		@else
		<h3>Someone other than mark has logged in!</h3>
		@endif
		<br>
		<a href="Login">Login Again</a>
	
@endsection
