<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 10/04/2017
 * Time: 21:26
 */

$response = [];

// Check if the user is NOT an admin
if (!Authentication::isLoggedIn()) {
	$response = [
		'error'     => true,
		'message'   => "Please login to an admin account to delete reports"
	]; goto response;
}

// Check if the data is in post
if (empty($_POST['id'])) {
	$response = [
		'error'     => true,
		'message'   => "Please enter in a id to delete"
	]; goto response;
} else if (empty($_POST['confirm'])) {
	$response = [
		'error'     => true,
		'message'   => "Please confirm the deletion!"
	]; goto response;
}

// Get the request data
$id      = $_POST['id'];
$confirm = $_POST['confirm'];

// Check if the user has not send the
// correct confirm data
if ($confirm != true) {
	$response = [
		'error'     => true,
		'message'   => "Please confirm the deletion!"
	]; goto response;
}

// Check if the report exists
$query = mBugReport::findByID($id);

if ($query->isEmpty()) {
	$response = [
		'error'     => true,
		'message'   => "Bug report was not found, maybe already deleted!"
	]; goto response;
}

// Get the bug report
/** @var mBugReport $report */
$report = $query->get();

// Delete the report
$report->delete(true);

// Set the response
$response = [
	'error'     => false,
	'message'   => "Successfully deleted report ID:". $report->getID().
					", Brief: ". Input::escape($report->getBrief())
];

response:
header('Content-Type: application/json');
die(json_encode($response));