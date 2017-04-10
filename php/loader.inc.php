<?php

/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 04/04/2017
 * Time: 23:45
 */

// Start a session
session_start();

// Folders
define ("ROOT",     __DIR__. "/");
define ("VIEWS",    __DIR__. "/views/");
define ("PAGES",    VIEWS.   "pages/");
define ("LAYOUTS",  VIEWS.   "layouts/");

//
// Load all the files in config
//
_require_all(ROOT. "config");

//
// Load all the files in libs
//
_require_all(ROOT. "libs");

//
// Load all the database incl. Models
//
_require_all(ROOT. "database");

//
// Require all function
//      Recursively require all files in a fold er
//
function _require_all($dir, $depth=0) {
	// Check if the folder depth is more than 50
	// if so then just return.
	//
	// CHANGE THIS FOR A BIGGER DEPTH
	if ($depth > 50)
		return;
	
	// require all php files
	$scan = glob("$dir/*");
	foreach ($scan as $path) {
		if (preg_match('/\.php$/', $path)) {
			//echo "Included $path <br>";
			
			require_once $path;
		} else if (is_dir($path)) {
			_require_all($path, $depth+1);
		}
	}
}