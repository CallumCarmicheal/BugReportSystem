<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 00:15
 */

// Set default error
$error = "";

// Process the bug report
//                    &$error <-- function, this means pointer / ref
BugReporter::ReportBug($error);

// Form default values
$formEmail          = "";
$formSelect_1       = "";
$formSelect_2       = "";
$formSelect_3       = "";
$formBrief          = "";
$formReproduce      = "";
$formInformation    = "";

// Check if the post contains: email
if (Input::contains('email', 'p')) {
	$value = Input::escape(Input::get('email', 'p'));
	$formEmail = ' value="'. $value. '" ';
}

// Check if the post contains: select
if (Input::contains('select', 'p')) {
	$value = Input::escape(Input::get('select', 'p'));
	$sel   = ' selected="selected"';
	
	$formSelect_1 = $value == 1 ? $sel : "";
	$formSelect_2 = $value == 2 ? $sel : "";
	$formSelect_3 = $value == 3 ? $sel : "";
}

// Check if the post contains: brief
if (Input::contains('brief', 'p')) {
	$value = Input::escape(Input::get('brief', 'p'));
	$formBrief = $value;
}

// Check if the post contains: reproduce
if (Input::contains('reproduce', 'p')) {
	$value = Input::escape(Input::get('reproduce', 'p'));
	$formReproduce = $value;
}

// Check if the post contains: information
if (Input::contains('information', 'p')) {
	$value = Input::escape(Input::get('information', 'p'));
	$formInformation = $value;
}

// Escape our html for the error response
if (!empty($error)) {
	$error = Input::escape($error);
	goto Error;
}

// Display the success notification
$BUG_REPORT_STATE = "Success";

Success:    require(PAGES. "home.php"); return;
Error:      require(PAGES. "home.php"); return;