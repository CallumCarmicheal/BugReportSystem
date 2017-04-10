<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 11/04/2017
 * Time: 00:16
 */

// Load all our libs and config
require ("../php/loader.inc.php");


// Get the blog items
$_BUG_LIST = [
	'Title'     => "Bug reports",
	
	'Menu'      => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 1]], false, -1, ['id', 'DESC']),
	'Gameplay'  => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 2]], false, -1, ['id', 'DESC']),
	'Other'     => mBugReport::find([['fixed', false], ['visible', true], ['bug_type', 3]], false, -1, ['id', 'DESC']),
];

// Show the form
require (PAGES. "bugs/iframe/list.php");