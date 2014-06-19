@extends('signup::layout')

@section('content')

<p>Your account could not be confirmed or has already been confirmed.</p>

<p>Please go to the {{ HTML::link('signup', 'Sign Up') }} page and create an account, or use the form to check if your email has already been confirmed.</p>

@stop