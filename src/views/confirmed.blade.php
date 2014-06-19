@extends('signup::layout')

@section('content')

<p>Your account, {{ $email }} has been confirmed and you are now logged in.</p>

<p>You will be {{ HTML::link('', 'redirected') }} momentarily.</p>

<script type='text/javascript'>
setTimeout(function() {
	window.location.href = "/meat";
}, 4500);
</script>

@stop