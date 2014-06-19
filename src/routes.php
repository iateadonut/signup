<?php



use Illuminate\Support\Facades\Auth;


Route::group( Config::get('Signup::routing'), function()
{

	Route::get( '/', function()
	{
		return View::make('signup::home')
			->nest('loginForm', 'signup::loginForm');
	});
	

	//APPLICATION
	Route::get( '/meat', function()
	{
		if ( Auth::guest() ) return Redirect::to('/');
		return View::make('signup::meat')
			->nest('loginForm', 'signup::loginForm');
	});

	

	//LOGIN
	Route::filter('auth', function() {
		if (Auth::guest()) return Redirect::to('/');
	});
	
	Route::get( 'logout', function(){
		if ( !Auth::guest() ) Auth::logout();
		return Redirect::to('/');
	});
	
	Route::get ('login', function()
	{
		return Redirect::to('/');
	});
	
	Route::post( 'login', function()
	{
		$credentials = array(
				'email'		=> Input::get('email'),
				'password'	=> Input::get('pword'),
				'id_code'	=> '1'
		);
	
		if ( Auth::attempt($credentials, Input::get('remember')) )
		{
			return Redirect::to('/meat');
		} else {
			return View::make('signup::home')
				->nest('loginForm', 'signup::loginForm')
				->with('loginMessage', 'Invalid Login.');
		}
			
	});
	
	
	
	//SIGNUP
	Route::post( 'postpassword', array( 'uses' => 'Iateadonut\Signup\SignupController@postpassword'));
	
	Route::get( 'pwordreset/{pw_code}', array( 'uses' => 'Iateadonut\Signup\SignupController@pwordreset'));
	
	Route::post( 'newConfirmationEmail', array( 'uses' => 'Iateadonut\Signup\SignupController@newConfirmationEmail' ));
	
	Route::post( 'resetPassword', array( 'uses' => 'Iateadonut\Signup\SignupController@resetPassword' ));
	
	Route::get( 'signup', array( 'uses' => 'Iateadonut\Signup\SignupController@showSignup' ));
	
	Route::post( 'signup2', array('uses' => 'Iateadonut\Signup\SignupController@signup2'));
	
	Route::post( 'createUser', array('uses' => 'Iateadonut\Signup\SignupController@createUser'));
	
	Route::post( 'check',  array( 'uses' => 'Iateadonut\Signup\SignupController@check'));
	
	Route::get( 'confirm/{id_code}', array( 'uses' => 'Iateadonut\Signup\SignupController@confirm' ));
	
	
});

