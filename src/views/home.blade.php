@extends('signup::layout')

@section('content')

<h2>Home Page - Laravel Signer-Upper</h2>

<p>If this were your home page, you'd be reading about your application.</p>

<p>This is a demo of Laravel Signer-Upper, a plugin for laravel that provides a login and sign up for your application.  The features include:</p>

<ul>
<li>Sign Up to an application by confirming an email</li>
<li>Resend Confirmation Email</li>
<li>Password Recovery</li>
</ul>

<p>To test the functionality, simply sign up to this webpage by clicking the Sign up link above.</p>

<h3>Reporting Bugs and Asking Questions</h3>

{{ HTML::link('https://github.com/iateadonut/signup/issues', 'Laravel Signup Issues') }}

<h3>To Do</h3>
<ul>
<li>update packagist</li>
</ul>

<h3>Update Packagist (for developers of this project)</h3>

<ol>
	<li>/laravel_signup/workbench/iateadonut/signup> git push origin master</li>
	<li>> git tag -a v1.0.x -m "1.0.x"</li>
	<li>> git push origin --tag</li>
	<li>login to packagist and force update</li>
</ol>


<h3>Installing</h3>

<p>The process for installing on a fresh installation of Laravel includes:</p>

<ol>
	
	<li>Move files into app_root/vendor directory</li>

		<ul>
			<li><h4>through github</h4>
				<ol>
					<li>cd app_root/vendor/</li>
					<li>mkdir iateadonut</li>
					<li>cd iateadonut</li>
					<li>git clone https://github.com/iateadonut/signup.git</li>
				</ol>
			
			</li>
			<li><h4>through composer</h4>
				<ol>
				<li>cd app_root/</li>
				<li>composer require iateadonut/signup</li>
				<li>version constraint: 1.1.*</li>
				</ol>
			</li>
		</ul>
		<br />


	<li>Add 'Iateadonut\Signup\SignupServiceProvider', to the 'providers' array in app_root/app/config/app.php</li>

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
	</li>
	
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
	or
	<pre>Route::get( '/meat', function()
	{
		if ( Auth::guest() ) return Redirect::to('/');
		return View::make('wherever')
			->nest('loginForm', 'signup::loginForm');
	});
	</pre>
	</li>

	<li>Configure SMTP Mail in app_root/config/mail.php</li>

	<li>And because we're working with passwords, you probably want ssl enabled in app_root/app/filters.php:
	<pre>
	App::before(function($request)
	{
		if( ! Request::secure())
		{
			return Redirect::secure(Request::path());
		}
	});
	</pre>
	</li>

	<li>
	Copy vendor/iateadonut/signup/src/views/layout.blade.php and home.blade.php
	 to app_root/app/views/iateadonut/signup/ .  You'll almost certainly want
	 to over-ride the default layout with this layout instead.
	</li>

	<li>Change the logo link in 
	app_root/app/views/packages/iateadonut/signup/layout.blade.php
	 to your own logo (which should probably reside in app_root/public/images/ .</li>

	<li> If you have a system that depends on the date for the user, you can
	set it (based on user's input during signup) for your application with the
	following filter in app_root/app/filters.php
	<pre>
	App::before(function($request)
	{
		if ( !Auth::guest() ) {
			$timezone = (Auth::user()->time_zone) ? 
				Auth::user()->time_zone : 
				Config::get('app.timezone');
			date_default_timezone_set($timezone);
			
			DB::statement("SET time_zone = '" . $timezone . "'");
		}
	});
	</pre>
	 
</ol>


	
@stop


