<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 09/04/2017
 * Time: 00:39
 */

// Load all our libs and config
require ("php/loader.inc.php");

// Get the blog items
$_BUG_LIST = [
	'Menu'      => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 1]], false, -1, ['id', 'DESC']),
	'Gameplay'  => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 2]], false, -1, ['id', 'DESC']),
	'Other'     => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 3]], false, -1, ['id', 'DESC']),
];

// Show the view
require (VIEWS. "pages/bug_list.php");