@extends('signup::layout')

@section('content')

<h2>Password Reset Email Sent to {{ $email }}</h2>

<p>A password reset email has been sent to {{ $email }} .</p>

<p>Go to your email box and click the link in the email.</p>

@stop