<?php

/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 09/04/2017
 * Time: 00:58
 */
class AdminHelper {
	public static function EnsureAuthentication() {
		
		// Check if the user is not logged in
		if (!Authentication::isLoggedIn()) {
			// Redirect to index.php
			redirect("/");
			exit;
		}
	}
}