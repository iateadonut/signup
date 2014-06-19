@extends('signup::layout')

@section('content')

@if ( $success == 1 )
	<h2>Password Updated</h2>
	
	<p>Your password has been updated and you have been logged in.</p>

	<p>You will be {{ HTML::link('', 'redirected') }} momentarily.</p>
	
	<script type='text/javascript'>
	setTimeout(function() {
		window.location.href = "/";
	}, 4500);
	</script>
	
@else
	<h2>Error</h2>
	<p>The link you clicked has either malfunctioned or has already been used.</p>
@endif

@stop