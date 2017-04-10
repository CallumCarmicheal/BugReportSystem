<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 09/04/2017
 * Time: 00:20
 */

// Load all our libs and config
require ("../../php/loader.inc.php");

// Ensure the user is Logged in
AdminHelper::EnsureAuthentication();

// Get the statistic values
$_ADMIN = [
	'Statistics' => AdminHelper::GetStatistics()
];

//
// Redirect to index.php (/)
//
redirect("/");