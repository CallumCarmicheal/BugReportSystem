<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 10/04/2017
 * Time: 21:26
 */

// Load all our libs and config
require ("../../php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	require (ROOT. "posts/api/reports/deleteReport.php");
} else {
	redirect ("/");
}