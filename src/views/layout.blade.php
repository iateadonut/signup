<!DOCTYPE html>
<head>
{{ HTML::script('/packages/iateadonut/signup/js/jquery-1.11.1.min.js') }}
{{ HTML::script('/packages/iateadonut/signup/js/jquery-migrate-1.2.1.min.js') }}
{{ HTML::style('/packages/iateadonut/signup/css/layout.css') }}
</head>	
<body>

<div id='header'>
	<div id='title'><a href='{{ URL::to('/') }}'>{{ HTML::image('/packages/iateadonut/signup/images/yourLogo.png') }}</a></div>
	
	@if ( isset ( $loginForm ) )
	<div id='loginFormHolder'>
		@if (isset ( $loginMessage ) )
		<p class='warning'>{{ $loginMessage }}</p>
		@endif
	{{ $loginForm }}</div>
	@endif
	
</div>

<div id='content'>

@yield('content')

</div>

</body>
</html>
