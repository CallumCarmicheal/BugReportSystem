<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 04/04/2017
 * Time: 23:40
 */

// Load all our libs and config
require ("../php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	// Execute our post request
	require (ROOT. "posts/bugReport/iframe.php");
	
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

// Show the form
require (PAGES. "report_bug/iframe/form.php");