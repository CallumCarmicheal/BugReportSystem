<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 09/04/2017
 * Time: 21:05
 */

// Response
$response = ['error' => false];

// Check if we have a id
if (empty($_POST['id'])) {
	$response['error'] = true;
	$response['message'] = "Could not find id in request.";
	goto Result;
}

// Get the id
$id = $_POST['id'];

// Check if the bug report exists with that id
$query = mBugReport::findByID($id);

if ($query->isEmpty()) {
	$response['error'] = true;
	$response['message'] = "Could not find requested bug report.";
	goto Result;
}

// Get the report
/** @var mBugReport $report */
$report = $query->get();

// Check if the report is not visible
// and the user is not logged in
$nLoggedIn = !Authentication::isLoggedIn();

if (!$report->isVisible() && $nLoggedIn) {
	// Cannot show this report to the user
	$response['error'] = true;
	$response['message'] = "Could not find requested bug report.";
	goto Result;
}

// Sanitise Data
if (!empty($report->getBrief()))
	$report->setBrief(Input::escape($report->getBrief()));
if (!empty($report->getInformation()))
	$report->setInformation(Input::escape($report->getInformation()));
if (!empty($report->getReproduce()))
	$report->setReproduce(Input::escape($report->getReproduce()));

// Store the bug report's value
$response = $report->toDbArray();
$response ['admin'] = !$nLoggedIn;
$response ['error'] = false;

// Hide admin only values
if ($nLoggedIn) {
	unset ($response ['visible']);
	unset ($response ['email']);
}


Result:
header('Content-Type: application/json');
die(json_encode($response));