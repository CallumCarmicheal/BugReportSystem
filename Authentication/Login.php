<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 15:28
 */

// Load all our libs and config
require ("../php/loader.inc.php");

// Check if we are logged in
if (Authentication::isLoggedIn())
	redirect ("/");

// Check if we have post
if (!empty($_POST)) {
	// Execute our post request
	require(ROOT . "posts/auth/login.php");
	
	// Stop the current file from
	//   executing.
	return;
}

// Show the form
require (PAGES. "auth/login.php");