<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 16:20
 */

function url($url) {
	if ($url == "#")
		return $url;
	
	if ($url == "/")
		return WEB_ROOT;
	
	$url = ltrim($url, '/');
	
	return WEB_ROOT. trim($url);
}

function redirect($path) {
	$url = url($path);
	
	ob_get_clean();
	header  ("location: ".          $url);
	die     ("Redirecting to: ".    $url);
}