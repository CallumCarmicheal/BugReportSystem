<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 22:59
 */

// Load all our libs and config
require ("../php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	// Execute our post request
	require (ROOT. "posts/user/change.php");
	
	// Stop the current file from
	//   executing.
	return;
}

// Show the view
require (VIEWS. "pages/user/manage.php");