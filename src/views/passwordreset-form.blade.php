@extends('signup::layout')

@section('content')

{{ HTML::style('/packages/iateadonut/signup/css/signup.css') }}

@if ( isset ( $email ) )

<script type='text/javascript'>
function enablecreateAccount() {
	if (password1==1&&password2==1)
	{document.getElementById('createAccount').disabled = false;	}
	if (password1==0||password2==0)
	{document.getElementById('createAccount').disabled = true;}
	}

function checkPassword() {
	password1 = 0;
	document.getElementById('PW1').innerHTML = '<font color=red>too short</font>';
	if (document.getElementById('pw').value.length > 5)
	{ password1 = 1;  document.getElementById('PW1').innerHTML = '<font color=green>OK</font>'; }
	checkPassword2();
		enablecreateAccount(); }

function checkPassword2() {
	password2 = 0;
	document.getElementById('PW2').innerHTML = '<font color=red>passwords don\'t match</font>';
	if (document.getElementById('pw').value == document.getElementById('pw2').value)
	{ password2 = 1; document.getElementById('PW2').innerHTML = '<font color=green>OK</font>'; }
		enablecreateAccount(); }
</script>

<div class='signupbox'>

	<table width='600px' align='center'>
	
	<tr>
	<td>
	<form action={{ URL::to('/postpassword') }} method='post'>

	email: {{ $email }}
	<input type=hidden value='{{ $pw_code }}' name='pw_code'> <br /><br />

	new password: <br />
	<input type=password maxlength=20 name='pw' id='pw' onkeyup='checkPassword()'><d id='PW1'></d><br />

	confirm password: <br />
	<input type=password maxlength=20 name='pw2' id='pw2' onkeyup='checkPassword2()'><d id='PW2'></d><br />

	<input type='submit' value='update password' disabled=true id='createAccount' class='createAccount'>

	</form>
	</td>
	</tr>
	</table>

</div>

@else
	
<h2>Error</h2>
	
<p>You have either copied the url wrong or the code has already been used.</p>
	
@endif

@stop