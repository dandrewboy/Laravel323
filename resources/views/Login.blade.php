@extends('layouts.appmaster1')
@section('title', 'Login Passed')

@section('content')
<form action="doLogin3" method="post">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>"/>
	<div>
		<h2 align="center">Login</h2>
	</div>
	<div>
		Username: 
		<input type="text" placeholder="Enter Username" name="username" maxlength="10"></input>{{ $errors->first('username') }}
	</div>
	<div>
		<br/>
		Password:
		<input type="password" placeholder="Enter Password" name="password" maxLength="10"></input>{{ $errors->first('password') }}
	</div>
	<div>
		<button type="submit" name="login">Login</button>
	</div>
	@if($errors->count() != 0)
		<h5>List of Errors</h5>
		@foreach($errors->all() as $message)
		{{ $message }} <br/>
		@endforeach
	@endif
</form>
@endsection

