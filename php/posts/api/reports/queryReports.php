<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 10/04/2017
 * Time: 23:23
 */

// Check if the user is NOT an admin
if (!Authentication::isLoggedIn()) {
	$response = [
		'error'     => true,
		'message'   => "Please login to an admin account to query reports"
	]; goto response;
}

// Setup some variables
$query              = [];
$index              = 0;

$res_Menu           = [];
$res_Gameplay       = [];
$res_Other          = [];

$html_Menu          = [];
$html_Gameplay      = [];
$html_Other         = [];

/*
email:          "",     // DONE
type:           0,      // DONE
brief:          "",     // DONE
reproduce:      "",     // DONE
information:    "",     // DONE
visible:        1,      // DONE
fixed:          1,      // DONE
*/

if (Input::contains('email', 'p'))
	$query[$index++] = ['email', 'LIKE', '%'. Input::get('email', 'p').         "%"];
if (Input::contains('brief', 'p'))
	$query[$index++] = ['brief', 'LIKE', '%'. Input::get('brief', 'p').         "%"];
if (Input::contains('reproduce', 'p'))
	$query[$index++] = ['reproduce', 'LIKE', '%'. Input::get('reproduce', 'p').     "%"];
if (Input::contains('information', 'p'))
	$query[$index++] = ['information', 'LIKE', '%'. Input::get('information', 'p').   "%"];

if (Input::contains('visible', 'p')) {
	$val = Input::get('visible', 'p') - 1;
	
	if ($val == 1 || $val == 2)
		$query[$index++] = ['visible', $val == 1];
}

if (Input::contains('fixed', 'p')) {
	$val = Input::get('fixed', 'p') - 1;
	
	if ($val == 1 || $val == 2)
		$query[$index++] = ['fixed', $val == 1];
}

$type = 1;

if (Input::contains('type', 'p'))
	$type = Input::get('type', 'p');

$query_Menu         = $query;
$query_Gameplay     = $query;
$query_Other        = $query;
$query_Menu[$index]     = ['bug_type', 1];
$query_Gameplay[$index] = ['bug_type', 2];
$query_Other[$index]    = ['bug_type', 3];

// Get the results
if ($type == 1 || $type == 2)
	$res_Menu       = mBugReport::find($query_Menu,     false, -1, ['id', 'DESC'])->get();
if ($type == 1 || $type == 3)
	$res_Gameplay   = mBugReport::find($query_Gameplay, false, -1, ['id', 'DESC'])->get();
if ($type == 1 || $type == 4)
	$res_Other      = mBugReport::find($query_Other,    false, -1, ['id', 'DESC'])->get();

// Compile the html
$html_Menu      = BugReporter::GenerateHTML($res_Menu);
$html_Gameplay  = BugReporter::GenerateHTML($res_Gameplay);
$html_Other     = BugReporter::GenerateHTML($res_Other);
$html_compiled  = "";

if (!empty($html_Menu)) {
	$html_compiled .= "
	<br><br> <b id=\"bugList_Menu\">Menu</b>
	<!-- Section -->
		<div id=\"bugList_Menu_Section\">$html_Menu</div>
	<!-- Section -->";
}

if (!empty($html_Gameplay)) {
	$html_compiled  .= "
	<br><br> <b id=\"bugList_Gameplay\">Gameplay</b>
	<!-- Section -->
		<div id=\"bugList_Gameplay_Section\">$html_Gameplay</div>
	<!-- Section -->";
}

if (!empty($html_Other)) {
	$html_compiled .= "
		<br><br> <b id=\"bugList_Other\">Other</b>
		<!-- Section -->
			<div id=\"bugList_Other_Section\">$html_Other</div>
		<!-- Section -->";
}

// Create the response array
$response = [
	'error'  => false,
	'HTML'   => $html_compiled
];

response:
header('Content-Type: application/json');
die(json_encode($response));

