<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 16:23
 */

// Load all our libs and config
require ("php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	// Execute our post request
	require (ROOT. "posts/bugReport/home.php");
	
	// Stop the current file from
	//   executing.
	return;
}

// Set some form default values
$formEmail          = "";
$formSelect_1       = "";
$formSelect_2       = "";
$formSelect_3       = "";
$formBrief          = "";
$formReproduce      = "";
$formInformation    = "";

// Show the view
require (VIEWS. "pages/Home.php");