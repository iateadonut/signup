@extends('signup::layout')

@section('content')

<!--[if IE 7]>
	<style type="text/css">
	div.signupbox 
	{
	padding-bottom: -100px !important;
	}
	</style>
<![endif]-->

{{ HTML::style('/packages/iateadonut/signup/css/signup.css'); }}



<!--[IF IE]>
	<style type='text/css'>
	div.signupbox input
	{	
		clear:both;
	}
	</style>
<![endif]-->


<script type='text/javascript'>
var tzo=(new Date().getTimezoneOffset())*(-1);
</script>


<div class='signupbox'>

	<form action='signup2' method='post'>
		
	<!--desired screen name:<br>
	<div id='SN' style='float:right;'></div><input type='text' maxlength=25 name='sn' id='sn2' onkeyup='checkSN(); f(this);' onClick='checkSN();' onchange='checkSN();'><br>-->
	
	your email address: <br>
	<div id='EMAIL' style='float:right;'></div><input type='text' name='email' id='email2'><br>
	
	password: <br>
	<div id='PW1' style='float:right;'></div><input type=password maxlength=20 name='pw' id='pw' ><br>
	
	confirm password: <br>
	<div id='PW3' style='float:right;'></div><input type=password maxlength=20 name='pw2' id='pw2' ><br>
	
 
	birthdate (YYYY-MM-DD): <br>
	<div id='BDATE1' style='float:right;'></div><input type='text' maxlength=10 name='bdate' id='bdate' ><br>

	
	time zone: <br />{{ $tz_dropdown }}

	<script>
	//document.write("probably UTC "+tzo);
	$('#timezone option[data-int_offset='+tzo+']').attr('selected', 'selected');
	</script>
	<input type='submit' value='create account' disabled=true id='createAccount' class='createAccount'></form>
	<p>Use this when signing up for a new account.</p>
	
</div>


<div class='signupbox'>

	<form action='resetPassword' method='post' name='reset'>

	forget your password?:<br>
	<div id='email6' style='float:right;'></div>
	email address: 
	<input type='text' name='resetpassword' id='email4' >
	<br><input type='submit' value='Reset Password' disabled=true id='passwordReset' class='createAccount'>
	</form>

	<p>Use this if you have forgotten your password.  An email will be sent to you - just click the link in it to reset your password.</p>
	
</div>

<div class='signupbox'>

	<form action='newConfirmationEmail' method='post' name='confirm'>

	need a new confirmation email?:<br>
	
	<div id='email5' style='float:right;'></div> email address: <input type='text' name='emailsendconfirm' id='email3' >
	
	<br><input type='submit' value='Send New Confirmation Email' disabled=true id='sendNewConfirm' class='createAccount'>
	
	</form>
		
	<p>When you first sign up for an account, you are sent an email containing a link that you must click in order to activate your account.  If you have signed up, but have never received that email, use this form to receive another confirmation email.</p>
	
</div>

{{ HTML::script('/packages/iateadonut/signup/js/signup.js') }}

@stop
