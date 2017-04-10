<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 15:35
 */

//
// Enable or Disable recaptcha
//
define ("RECAPTCHA_ENABLED",    false);

//
// The recaptcha language
//     See: https://developers.google.com/recaptcha/docs/language
//
define ("RECAPTCHA_LANGUAGE",   "en");

//
// The keys are stored as variables because there is a
//      some error when using define :Z
//

function RECAPTCHA_getRecaptchaSite() {
	//
	// The site key
	//
	//      Site key for: localhost
	//
	return "6LeWJQ0UAAAAABXPLco2idPNfqkfyMON9G4lnXYX";
}

function RECAPTCHA_getRecaptchaSecret() {
	//
	// The secret key
	//
	//      Site secret for: localhost
	//
	return "6LeWJQ0UAAAAAJlMHXVHg9nwqewumg746vkxQG-P";
}