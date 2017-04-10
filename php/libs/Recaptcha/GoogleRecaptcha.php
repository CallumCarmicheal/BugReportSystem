<?php
/**
 * Proj: Chaotic 360 - Panel
 * User: CallumCarmicheal
 * Date: 17/01/2017
 * Time: 21:29
 */

namespace Lib;

class GoogleRecaptcha {
	
	static function var_dump_pre($var, $die = false) {
		echo '<pre>'; var_dump($var); echo '</pre>';
		if($die) die("");
	}
	
	/**
	 * Create a recaptcha form
	 * @return string
	 */
	public static function Create() {
		if (!RECAPTCHA_ENABLED)
			return "";
		
		$public  = RECAPTCHA_getRecaptchaSite();
		$lang    = RECAPTCHA_LANGUAGE;
		
		$str =  '<div class="g-recaptcha" data-sitekey="' . $public . '"></div>'.
		        '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=' . $lang . '"></script>';
		return $str;
	}
	
	/**
	 * Get the value from the post
	 * @return mixed|null
	 */
	public static function getPostCaptcha() {
		return $_POST['g-recaptcha-response'];
	}
	
	/**
	 * Checks if captcha is valid
	 * IF $captcha="" then it is retrieved from the post
	 * @param string $captcha
	 * @return bool
	 */
	public static function Check($captcha = "") {
		if (!RECAPTCHA_ENABLED)
			return true;
		
		if (empty($captcha)) {
			if (!self::isInPost()) {
				return false;
			}
			
			$captcha = self::getPostCaptcha();
		}
		
		$private = RECAPTCHA_getRecaptchaSecret();
		$response   = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". $private. "&response=". $captcha. "&remoteip=". $_SERVER['REMOTE_ADDR']);
		$var        = json_decode($response);
		
		if(is_null($var)) return false;
						  return 	$var->success;
	}
	
	
	
	public static function isInPost() {
		if (!RECAPTCHA_ENABLED)
			return true;
		
		return !empty($_POST['g-recaptcha-response']);
	}
}