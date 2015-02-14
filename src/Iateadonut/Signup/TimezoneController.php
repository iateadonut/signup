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

class TimezoneController extends \BaseController {
	

	public static function getTz_array()
	{
		
		$tz_array	= array();
		
		foreach(timezone_abbreviations_list() as $abbr=>$array)
		{
		
			foreach ( $array as $id=>$array2)
			{
		
				$offset			= $array2['offset'];
				$timezone_id	= $array2['timezone_id'];

				//$tz_byTimeZone[$timezone_id]	= format_time($offset);
				//$tz_byOffset[format_time($offset)]	= $timezone_id;
		
				$tz_array[$timezone_id]	= array(
						'timezone_id'=>$timezone_id,
						'offset'=>TimezoneController::format_time($offset),
						'int_offset'=>round($offset/60, 0)
						//WILL RETURN A VALUE = js: +/-1 new Date().getTimezoneOffset())*(-1)
				);
		
			}
			//exit;
		}
		
		usort($tz_array, function($a, $b) {
			return $a['offset'] - $b['offset'];
		});
		
		return $tz_array;
		
	}
	
	public static function format_time($t,$f=':') // t = seconds, f = separator
	{
		return str_replace('00', '0',
			str_replace(':0', ':00',
			str_replace('010:', '10:',
			str_replace('011:', '11:',
			str_replace('012:', '12:',
			str_replace('013:', '13:',
			str_replace('014:', '14:',
			sprintf("%03d%s%02d", floor($t/3600),
			$f, abs(($t/60)%60) )
			)))))));
	}
	
	public static function sortbyoffset($a, $b)
	{
		return $a['offset'] - $b['offset'];
	}
	
	
}