<?php
/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 16:30
 */


class Authentication {
	/**
	 * Session variable
	 * @var string
	 */
	private static $_VAR = "_AUTH_";
	
	/**
	 * Cached User
	 * @var null|mUser
	 */
	private static $CachedUser = null;
	
	/**
	 * Get ID from session
	 * @return int
	 */
	public static function getID() {
		if (!self::hasID())
			return -1;
		
		return $_SESSION[self::$_VAR]['USER_ID'];
	}
	
	/**
	 * Check if the session has an ID
	 * @return bool
	 */
	public static function hasID() {
		if (empty($_SESSION[self::$_VAR]))
			return false;
		
		if (!isset($_SESSION[self::$_VAR]['USER_ID']))
			return false;
		
		return true;
	}
	
	/**
	 * Set the session ID
	 * @param $id
	 */
	public static function setID($id) {
		if (empty($_SESSION[self::$_VAR])) {
			$_SESSION[self::$_VAR] = [];
		}
		
		$_SESSION[self::$_VAR]['USER_ID'] = $id;
	}
	
	/**
	 * Check if the user is logged in
	 * @return bool
	 */
	public static function isLoggedIn() {
		if (!self::hasID())
			return false;
		
		$user = self::getUser();
		
		if (!$user)
			return false;
		
		return true;
	}
	
	/**
	 * Get the current logged in user
	 * @return bool|mUser|null
	 */
	public static function getUser() {
		if (self::$CachedUser != null)
			return self::$CachedUser;
		
		$id     = self::getID();
		
		/** @var bool|mUser $user */
		$user   = mUser::findByID($id)->get();
		
		if (!$user)
			 return null;
		else return $user;
	}
	
	/**
	 * Logout
	 */
	public static function Logout() {
		if (self::isLoggedIn())
			unset($_SESSION[self::$_VAR]['USER_ID']);
	}
}
