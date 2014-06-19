<?php namespace Iateadonut\Signup;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class SignupController extends \BaseController {

	public function showSignup()
	{
		return View::make('signup::signup');
	}

	public function set_tz_by_offset($offset) {
		$offset = $offset*60*60;
		$abbrarray = timezone_abbreviations_list();
		
		foreach ($abbrarray as $abbr) {
			foreach ($abbr as $city) {
				if ($city['offset'] == $offset) { // remember to multiply $offset by -1 if you're getting it from js
					date_default_timezone_set($city['timezone_id']);
					return true;
				}
			}
		}
		date_default_timezone_set("ust");
		return false;
	}

	public function newConfirmationEmail()
	{

		$user	= User::where('email', '=', Input::get('emailsendconfirm'))
		->first();
		
		$data = array(
				'email'		=> $user->email,
				'clickUrl'	=> URL::to('/') . '/confirm/' . $user->id_code
		);
		
		Mail::send('signup::emails.signup', $data, function($message)
		{
			$message->to( Input::get('emailsendconfirm') )->subject('Welcome!');
		});
		
		return View::make('signup::signup2')->with($data);		
		
	}

	//ACCEPTS INPUT FROM THE PASSWORD RESET FORM
	public function postpassword()
	{
		
		if ( $user	= $user	= User::where( 'pw_code', '=', Input::get('pw_code') )
			->where( 'pw_code', '!=', 0)
			->first() )
		{
		
			$user->password	= Hash::make( Input::get('pw') );
			$user->pw_code	= 0;
			$user->save();
			
			Auth::login($user);
			
			return View::make('signup::passwordupdated')
				->with( array('success'=>1) );
			
		} else {
			
			return View::make('signup::passwordupdated')
				->with( array('success'=>0) );
			
		}
		
	}
	
	//CONFIRMS THE pw_code SENT IN THE EMAIL AND DISPLAYS THE PASSWORD RESET FORM
	public function pwordreset( $pw_code )
	{
		
		if ( $user	= $user	= User::where( 'pw_code', '=', $pw_code )
				->where( 'pw_code', '!=', 0)
				->first() )
		{
			return View::make('signup::passwordreset-form')
			->with('pw_code', $pw_code)
			->with('email', $user->email);			
		} else {

			return View::make('signup::passwordreset-form');;
		
		}

	}
	
	//SENDS THE PASSWORD RESET EMAIL
	public function resetPassword()
	{
		
		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for( $code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
		
		$user	= User::where('email', '=', Input::get('resetpassword'))
			->first();
		
		if ( 0 != $user->pw_code )
		{
			$newcode = $user->pw_code;
		}
		
		$user->pw_code = $newcode;
		$user->save();
		
		$data = array(
				'clickUrl'	=> URL::to('/') . '/pwordreset/' . $newcode
		);

		Mail::send('signup::emails.pwordreset', $data, function($message)
		{
			$message->to( Input::get('resetpassword') )
			->subject('Password Reset');
		});		
		
		return View::make('signup::passwordreset-emailsent')
			->with('email', Input::get('resetpassword'));
		
	}
	
	public function signup2()
	{
		
		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for( $code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));

		$user = new User;
		$user->email		= Input::get('email');
		$user->birthday		= Input::get('bdate');
		$user->password		= Hash::make( Input::get('pw') );
		$user->id_code		= $newcode;
		$this->set_tz_by_offset( Input::get('timezone'));
		$user->time_zone	= date('P');
		$user->save();
		
		$data = array(
			'email'		=> Input::get('email'),
			'clickUrl'	=> URL::to('/') . '/confirm/' . $newcode
		);
		
		Mail::send('signup::emails.signup', $data, function($message)
		{
			$message->to( Input::get('email') )->subject('Welcome!');
		});
		
		return View::make('signup::signup2')->with($data);

	}

	
	public function confirm( $id_code )
	{
		
		if ( $user_info = User::where('id_code', '=', $id_code)->first() )
		{
		
			$uid	= $user_info->id;
			$email	= $user_info->email;
			
			$data = array(
				'id_code'	=> $id_code,
				'user_id'	=> $uid,
				'email'		=> $email
			);
			
			$user	= User::find($uid);
			$user->id_code = 1;
			$user->save();
			
			Auth::login( User::find($uid) );
			
			return View::make('signup::confirmed')->with($data);
		
		} else {

			return View::make('signup::confirmedError')->nest('loginForm', 'signup::loginForm');
		
		}
		
	}
	
	public function check()
	{

		$email = Input::get('email');
		return User::checkEmail( $email );

	}
	
	
}