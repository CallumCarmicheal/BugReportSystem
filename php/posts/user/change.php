<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 23:00
 */

// Check if the user is logged in
if (!Authentication::isLoggedIn())
	redirect("/");

// Set default error
$error                      = "";
$error_MissingData          = "Please enter in your new password.";
$error_MissingData_C        = "Please enter in your current password.";
$error_IncorrectPassword    = "Incorrect password entered, please try again!";

// Check if the input contains the current
// password and the new password
if (!Input::contains('password',   'p')) { $error = $error_MissingData; goto Error; }
if (!Input::contains('password_C', 'p')) { $error = $error_MissingData_C; goto Error; }

// Get the data
$Password  = Input::get('password',   'p');
$cPassword = Input::get('password_C', 'p');

// Confirm the password is more than 7 characters
if (strlen($Password) < 7) {
	$error = "Password is too short, (Password has to be more than 6 characters).";
	goto Error;
}

// Get the user
$user = Authentication::getUser();

// Check if the current password is valid
if (!$user->checkPassword($cPassword)) {
	$error = $error_IncorrectPassword;
	goto Error;
}

// Set the new password
$user->setPassword($Password, true);

// Save user
$user->save();

Success:    require(PAGES. "user/password_changed.php");    return;
Error:      require(PAGES. "user/manage.php");              return;