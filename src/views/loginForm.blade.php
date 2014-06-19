
@if ( Auth::guest() )

<form method='POST' action="{{ URL::to('/login') }}">
<label class='loginLabel'>email: </label>
<input name='email' id='email'> <br />
<label class='loginLabel'>password: </label>
<input type='password' name='pword' id='pword'> <br />
<label class='loginLabel'><span class='labelHolder'>.</span></label>

<input type=checkbox> Remember Me 
<input type=submit value='Log In' name='remember'>
</form>

	@if ( isset( $loginMessage ) )
	<p>{{ $loginMessage }}</p>
	@endif

<label class='loginLabel'><span class='labelHolder'>.</span></label>
<a href='signup'>Sign up / Reset Password</a>
	
@else

You are logged in.  {{ HTML::link('logout', 'Log out.') }}

	@if ( 1 == 1 )
	
	@endif

@endif


