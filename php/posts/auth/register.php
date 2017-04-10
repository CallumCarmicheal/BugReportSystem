<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 15:28
 */

// Set error messages
$error                  = "";
$errorMsg_User          = "User already exists";
$errorMsg_Recaptcha     = "Please do the recaptcha.";

// Check the recaptcha
if (!Lib\GoogleRecaptcha::Check())      { $error = $errorMsg_Recaptcha; goto Error;}

// Check if values are in post
if (!Input::contains('username', 'p'))  { $error = "Please enter in your username"; goto Error; }
if (!Input::contains('password', 'p'))  { $error = "Please enter in your password"; goto Error; }

// Get the data
$username   = Input::get('username', 'p');
$password   = Input::get('password', 'p');

// Check if the user exists
$user       = mUser::findByUsername($username);

if ($user != null) {
	// User exists
	$error = $errorMsg_User;
	goto Error;
}

// Confirm the password is more than 7 characters
if (strlen($password) < 7) {
	$error = "Password is too short, (Password has to be more than 6 characters).";
	goto Error;
}

// User does not exist
$user = new mUser();

// Set the user's data
$user->setUsername($username);
$user->setPassword($password, true);
$user->setEnabled(false);

// Save the user
$user->save();

Success:    require (PAGES. "auth/register.success.php");   return;
Error:      require (PAGES. "auth/register.php");           return;