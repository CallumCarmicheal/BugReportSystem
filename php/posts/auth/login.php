<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 15:28
 */

// Set error messages
$error                  = "";
$errorMsg_UserPassword  = "The username or password entered is invalid.";
$errorMsg_Recaptcha     = "Please do the recaptcha.";
$errorMsg_UserDisabled  = "The user is not enabled.";

// Check the recaptcha
if (!Lib\GoogleRecaptcha::Check())      { $error = $errorMsg_Recaptcha; goto Error;}

// Check if values are in post
if (!Input::contains('username', 'p'))  { $error = "Please enter in your username"; goto Error; }
if (!Input::contains('password', 'p'))  { $error = "Please enter in your password"; goto Error; }

// Get the data
$username = Input::get('username', 'p');
$password = Input::get('password', 'p');

// Find a user by username
$user = mUser::findByUsername($username);

// Check if the user is null
if ($user == null) {
	// User does not exist
	$error = $errorMsg_UserPassword;
	goto Error;
}

// Check if the password is invalid
if (!$user->checkPassword($password)) {
	$error = $errorMsg_UserPassword;
	goto Error;
}

// Check if the user is enabled
if (!$user->isEnabled()) {
	$error = $errorMsg_UserDisabled;
	goto Error;
}

// Set the user id in the session
// (User has correctly logged in)
Authentication::setID($user->getID());

Success:    redirect("/");                          return;
Error:      require (PAGES. "auth/login.php");      return;