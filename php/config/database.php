<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 04/04/2017
 * Time: 23:47
 */

//
// Hostname and Port
// if unsure set port to -1 or 3306
// default port for mysql = 3306
$HOST               = "localhost";
$PORT               = 3307;

//
// Database name
$DATABASE           = "whitecircle";

//
// Username and password
$AUTH_USER          = "root";
$AUTH_PASSWORD      = "";

//
// Debug database activity
$DEBUG              = false;

//
// Now the settings are stored for access
// to the CMVC Framework (The database operations)
//

if (!empty($PORT) || $PORT == -1)   { define ("CMVC_PRJ_STORAGE_DB_HOST", 	    $HOST. ":". $PORT); }
else                                { define ("CMVC_PRJ_STORAGE_DB_HOST", 	    $HOST ); }

define ("CMVC_PRJ_STORAGE_DB_USER", 	    $AUTH_USER);
define ("CMVC_PRJ_STORAGE_DB_PASS", 	    $AUTH_PASSWORD);
define ("CMVC_PRJ_STORAGE_DB_DB",   	    $DATABASE);
define ("CMVC_PRJ_STORAGE_DB_DEBUG",        $DEBUG);

// Set the database to allow UTF8 values.
define ("CMVC_PRJ_STORAGE_DB_CHARSET", 	    "utf8");