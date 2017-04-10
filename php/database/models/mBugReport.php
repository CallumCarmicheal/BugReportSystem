<?php
use CommonMVC\Framework\MVCEloquentModel;

/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 00:09
 */
class mBugReport extends MVCEloquentModel {
	protected static $table     = "report";
	protected static $columns   = ['email', 'bug_type', 'reproduce', 'brief', 'information', 'visible', 'fixed'];
		
	protected static $useTimeColumns = true;
	
	/**
	 * Find by email
	 * @param $email
	 * @return bool|\CommonMVC\Framework\Eloquent\DatabaseCollection|\CommonMVC\Framework\Eloquent\DatabaseItem
	 */
	public function findByEmail($email) {
		return self::find(['email', $email]);
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
	 * @var $Email mixed
	 * @returns mixed
	 */
	public function setEmail($Email){ $this->email = $Email; }
	/**
	 * @returns mixed
	 */
	public function getEmail(){ return $this->email; }
	
	/**
	 * @var $BugType mixed
	 * @returns mixed
	 */
	public function setBugType($BugType){ $this->bug_type = $BugType; }
	/**
	 * @returns mixed
	 */
	public function getBugType(){ return $this->bug_type; }
	
	/**
	 * @var $Brief mixed
	 * @returns mixed
	 */
	public function setBrief($Brief){ $this->brief = $Brief; }
	/**
	 * @returns mixed
	 */
	public function getBrief(){ return $this->brief; }
	
	/**
	 * @var $Reproduce mixed
	 * @returns mixed
	 */
	public function setReproduce($Reproduce){ $this->reproduce = $Reproduce; }
	/**
	 * @returns mixed
	 */
	public function getReproduce(){ return $this->reproduce; }
	
	/**
	 * @var $Information mixed
	 * @returns mixed
	 */
	public function setInformation($Information){ $this->information = $Information; }
	/**
	 * @returns mixed
	 */
	public function getInformation(){ return $this->information; }
	
	/**
	 * @var $Visible mixed
	 * @returns mixed
	 */
	public function setVisible($Visible){ $this->visible = $Visible; }
	/**
	 * @returns mixed
	 */
	public function isVisible(){ return $this->visible; }
	
	/**
	 * @var $Fixed mixed
	 * @returns mixed
	 */
	public function setFixed($Fixed){ $this->fixed = $Fixed; }
	/**
	 * @returns mixed
	 */
	public function getFixed(){ return $this->fixed; }
	
	/**
	 * @var $DateCreated mixed
	 * @returns mixed
	 */
	public function setDateCreated($DateCreated){ $this->date_created = $DateCreated; }
	/**
	 * @returns mixed
	 */
	public function getDateCreated(){ return $this->date_created; }
	
	/**
	 * @var $DateLastedited mixed
	 * @returns mixed
	 */
	public function setDateLastEdited($DateLastedited){ $this->date_lastedited = $DateLastedited; }
	/**
	 * @returns mixed
	 */
	public function getDateLastEdited(){ return $this->date_lastedited; }
}