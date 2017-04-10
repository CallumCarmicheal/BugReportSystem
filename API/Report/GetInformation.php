<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 09/04/2017
 * Time: 20:49
 */

// Load all our libs and config
require ("../../php/loader.inc.php");

// Check if we have post
if (!empty($_POST)) {
	require (ROOT. "posts/api/reports/getInformation.php");
} else {
	redirect ("/");
}