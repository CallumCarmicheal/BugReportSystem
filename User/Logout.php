<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 22:54
 */

// Load all our libs and config
require ("../php/loader.inc.php");

// Logout
Authentication::Logout();

// Redirect
redirect("/");