@extends('signup::layout')

@section('content')

<h2>Home Page - Laravel Signer-Upper</h2>

<p>If this was your home page, you'd be talking about your application here.</p>

<p>This is a demo of Laravel Signer-Upper, a plugin for laravel that provides a login and sign up for your application.  The features include:</p>

<ul>
<li>Sign Up</li>
<li>Resend Confirmation Email</li>
<li>Password Recovery</li>
</ul>

<h3>Installing</h3>

<p>The process for installing on a fresh installation of Laravel includes:</p>

<ol>
<li>Move files into app_root/vendor directory</li>
<li>Add 'Iateadonut\Signup\SignupServiceProvider', to the 'providers' array in app_root/config/app.php</li>
<li>Add
<pre>
"psr-0": {
	"Iateadonut\\Signup\\": "vendor/iateadonut/signup/src/"
}</pre>
to autoload in app_root/composer.json so it looks like:
<pre>
"autoload": {
	"classmap": [
		"app/commands",
		"app/controllers",
		"app/models",
		"app/database/migrations",
		"app/database/seeds",
		"app/tests/TestCase.php"
	],
    "psr-0": {
        "Iateadonut\\Signup\\": "vendor/iateadonut/signup/src/"
    }
},</pre>
<li>app_root> composer dump-autoload</li>
<li>app_root> php artisan dump-autoload</li>
<li>Configure database in config\database.php</li>
<li>Create users table: php artisan migrate --package=iateadonut/signup</li>
<li>Move Package Assets: php artisan asset:publish iateadonut/signup</li>
<li>Update app/routes: Remove any Route::get('/')</li>
<li>You may also want to update the 'meat' (the application) route
<pre>Route::get('/meat', function()
{
	return Redirect::to('/wherever');
});</pre>
</li>
<li>Configure SMTP Mail in app_root/config/mail.php</li>
</ol>


	
@stop


