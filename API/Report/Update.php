<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 10/04/2017
 * Time: 22:16
 */

// Load all our libs and config
require ("../../php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	require (ROOT. "posts/api/reports/updateInformation.php");
} else {
	redirect ("/");
}