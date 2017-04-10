<?php
use CommonMVC\Framework\MVCEloquentModel;

/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 02:13
 */
class mUser extends MVCEloquentModel {
	protected static $table = "users";
	protected static $useTimeColumns = true;
	
	protected static $columns = ['username', 'password', 'is_enabled'];
	
	
	/**
	 * Get a user by username
	 * @param string $username
	 * @return mUser|Null
	 */
	public static function findByUsername($username = "") {
		/** @var mUser|null $res */
		$res = self::find(['username', $username])->get();
		return $res;
	}
	
	/**
	 * Set the password and encrypt if needed
	 * @var $Password mixed
	 * @var $Encrypt mixed
	 * @returns mixed
	 */
	public function setPassword($Password, $Encrypt=false){
		// Encrypt the password
		if ($Encrypt)
			$Password = password_hash($Password, \PASSWORD_BCRYPT);
		
		// Set the password
		$this->password = $Password;
	}
	
	/**
	 * Check if the password is correct
	 * @param $password
	 * @return bool
	 */
	public function checkPassword($password) {
		$hash = $this->getPassword();
		return password_verify($password, $hash);
	}
	
	
	// =============================================
	//                Database Model
	//              Getters and Setters
	//
	//   You usually do not need to go beyond this
	//      area unless you need to modify the
	//              getters and setters.
	// =============================================
	
	/**
	 * @var $Username mixed
	 * @returns mixed
	 */
	public function setUsername($Username){ $this->username = $Username; }
	/**
	 * @returns mixed
	 */
	public function getUsername(){ return $this->username; }
	
	/**
	 * @returns mixed
	 */
	public function getPassword(){ return $this->password; }
	
	/**
	 * @var $IsEnabled mixed
	 * @returns mixed
	 */
	public function setEnabled($IsEnabled){ $this->is_enabled = $IsEnabled; }
	/**
	 * @returns mixed
	 */
	public function isEnabled(){ return $this->is_enabled; }
	
	/**
	 * @returns mixed
	 */
	public function getDateCreated(){ return $this->date_created; }
	/**
	 * @returns mixed
	 */
	public function getDateLastedited(){ return $this->date_lastedited; }
}