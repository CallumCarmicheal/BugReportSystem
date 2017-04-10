<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 10/04/2017
 * Time: 22:16
 */

$response = [];

// Check if the user is NOT an admin
if (!Authentication::isLoggedIn()) {
	$response = [
		'error'     => true,
		'message'   => "Please login to an admin account to update reports"
	]; goto response;
}

// Check if the id is in the post
if (!Input::contains('id', 'p')) {
	$response = [
		'error'   => true,
		'message' => "There was no id in the request"
	]; goto response;
}

// Check if the request was valid
if (!Input::contains('is_valid', 'p')) {
if  (Input::get     ('is_valid', 'p') != "VALID") {
	$response = [
		'error' => true,
		'message' => "Invalid request"
	]; goto response;
} }

// Get the report id
$id = Input::get('id', 'p');

// Check if report exists
$query = mBugReport::findByID($id);

if ($query->isEmpty()) {
	$response = [
		'error'   => true,
		'message' => "Could not find the requested report."
	]; goto response;
}

// Get the report
/** @var mBugReport $report */
$report = $query->get();

// Check for each changed data

// Check if email, brief, type or reproduce is not in the post
// these are required fields!
if (!Input::contains('email', 'p')     ||   !Input::contains('type', 'p')      ||
	!Input::contains('brief', 'p')     ||   !Input::contains('reproduce', 'p') ||
	!Input::contains('visible', 'p')   ||   !Input::contains('fixed', 'p')      ) {
	$response = [
		'error'         =>  true,
		'dont_refresh'  =>  true,
		'message'       =>  "Required information could not be found in request, ".
			                "please check over your request!"
	]; goto response;
}

// Validate email address
if (!filter_var(Input::get('email', 'p'), FILTER_VALIDATE_EMAIL)) {
	$response = [
		'error'         =>  true,
		'dont_refresh'  =>  true,
		'message'       =>  "Please enter in a valid email address!"
	]; goto response;
}

// Update the required fields
$report->setEmail(Input::get('email', 'p'));
$report->setBugType(Input::get('type', 'p'));
$report->setBrief(Input::get('brief', 'p'));
$report->setReproduce(Input::get('reproduce', 'p'));

// Check if any of the optional fields are in the request
// just: information

if (Input::contains('information', 'p'))
	$report->setInformation(Input::get('information', 'p'));

$report->setVisible (Input::get('visible', 'p') == "T" ? true : false);
$report->setFixed   (Input::get('fixed', 'p')   == "T" ? true : false);

$report->save();

$response = [
	'error'   => false,
	'message' => "Successfully updated report information."
];

response:
if (empty($response['dont_refresh']))
	$response['dont_refresh'] = false;

header('Content-Type: application/json');
die(json_encode($response));