<?php

/**
 * Proj: WhiteCircle
 * User: CallumCarmicheal
 * Date: 05/04/2017
 * Time: 21:48
 */
class BugReporter {
	public static function ReportBug(&$error) {
		// Default variables
		$error = "";

		// Check the recaptcha
		if (!Lib\GoogleRecaptcha::Check())        { $error = "Please validate the reCaptcha!"; goto Error; }

		// Get the form data
		if (!Input::contains('email',       'p')) { $error = "Please enter in your email."; goto Error; }
		if (!Input::contains('select',      'p')) { $error = "Please select the bug category."; goto Error; }
		if (!Input::contains('reproduce',   'p')) { $error = "Please enter in the method to reproduce the bug"; goto Error; }
		if (!Input::contains('brief',       'p')) { $error = "Please enter in a brief description of the bug"; goto Error; }
		
		// Get data
		$dataEmail          = Input::get('email',       'p');
		$dataSelect         = Input::get('select',      'p');
		$dataBrief          = Input::get('brief',       'p');
		$dataReproduce      = Input::get('reproduce',   'p');
		$dataInformation    = Input::get('information', 'p');

		// Validate the information
		if (filter_var($dataEmail, FILTER_VALIDATE_EMAIL) === false) {
			$error = "Please enter in a valid email address!";
			goto Error;
		}
		
		if (strlen($dataEmail) > 320) {
			$error = "Email cannot be longer than 320";
			goto Error;
		}
		
		$lenBrief = strlen($dataBrief);
		if ($lenBrief > 120) {
			$error = "The brief cannot exceed more than 120 characters, LEN = ". $lenBrief;
			goto Error;
		}
		
		$lenInformation = strlen($dataInformation);
		if ($lenInformation > 3000) {
			$error = "The information cannot exceed 3000 characters, LEN = ". $lenInformation;
			goto Error;
		}
		
		$lenReproduce = strlen($dataReproduce);
		if ($lenReproduce > 3000) {
			$error = "The actions to reproduce cannot exceed 3000 characters, LEN = ". $lenReproduce;
			goto Error;
		}
		
		if ($dataSelect < 1 || $dataSelect > 3) {
			$error = "The type of report was invalid, the report action can only be 1-3, Selected: ". $lenReproduce;
			goto Error;
		}

		// Create the object
		$report = new mBugReport();
		
		$report->setEmail($dataEmail);
		$report->setBugType($dataSelect);
		$report->setBrief($dataBrief);
		$report->setReproduce($dataReproduce);
		$report->setInformation($dataInformation);
		
		$report->setFixed(false);
		$report->setVisible(false);

		// Save the object into the database
		$report->save();
		
		Success: return true;
		Error:   return false;
	}
	
	
	/**
	 * Generate Hover Title
	 * @param $mbr mBugReport
	 * @return string
	 */
	public static function GenerateHoverTitle($mbr) {
		$now            = strtotime(time());
		$id             = $mbr->getID();
		
		$date_created   = $mbr->getDateCreated();
		$days_created   = TimeHelper::GetHumanTimeSince($date_created);
		
		$date_edited    = $mbr->getDateLastEdited();
		$days_edited    = TimeHelper::GetHumanTimeSince($date_edited);
		
		$res  = "ID: $id<br>";
		$res .= "Submitted: $date_created ($days_created)<br>";
		$res .= "Edited: $date_edited ($days_edited)";
		
		return $res;
	}
	
	/**
	 * Generate html for bug list
	 * @param $array mBugReport[]
	 * @return string
	 */
	public static function GenerateHTML($array) {
		if ($array instanceof mBugReport) {
			/** @var mBugReport $mbr */
			$mbr = $array;
			$html = "";
			
			$brief_1 = Input::escape($mbr->getBrief());
			$title_1 = self::GenerateHoverTitle($mbr);
			
			$html .= '<div class="row"><div class="col-md-12 material-hover-box full-width masterTooltip" title="'.$title_1.'" >'; {
				$html .= '<a href="#" class="word-break bug-report" bug_id="'. $mbr->getID(). '">'. $brief_1. '</a>';
			} $html .= '</div></div>';
			
			return $html;
		}
		
		$amount = count($array);
		
		$html   = "";
		
		for ($x = 0; $x < $amount; $x += 3) {
			if ($x > $amount) continue;
			$html .= '<div class="row">';
			
			/** @var mBugReport $item_1 */
			/** @var mBugReport $item_2 */
			/** @var mBugReport $item_3 */
			$item_1 = $array[$x];
			$item_2 = null;
			$item_3 = null;
			if ($x+1 < $amount) $item_2 = $array[$x+1];
			if ($x+2 < $amount) $item_3 = $array[$x+2];
			
		Render:
			// Col = 12
			if ($item_2 == null) {
				$brief_1 = Input::escape($item_1->getBrief());
				$title_1 = self::GenerateHoverTitle($item_1);
				
				$html .= '<div class="col-md-12 material-hover-box full-width masterTooltip" title="'.$title_1.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_1->getID(). '">'. $brief_1. '</a>';
				} $html .= '</div>'; goto EOI;
			}
			
			// Col = 6
			else if ($item_3 == null) {
				$brief_1 = Input::escape($item_1->getBrief());
				$brief_2 = Input::escape($item_2->getBrief());
				
				$title_1 = self::GenerateHoverTitle($item_1);
				$title_2 = self::GenerateHoverTitle($item_2);
				
				$html .= '<div class="col-md-6 material-hover-box full-width masterTooltip" title="'.$title_1.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_1->getID(). '">'. $brief_1. '</a>';
				} $html .= '</div>';
				
				$html .= '<div class="col-md-6 material-hover-box full-width masterTooltip" title="'.$title_2.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_2->getID(). '">'. $brief_2. '</a>';
				} $html .= '</div>';
				
				goto EOI;
			}
			
			// Col = 4
			else {
				$brief_1 = Input::escape($item_1->getBrief());
				$brief_2 = Input::escape($item_2->getBrief());
				$brief_3 = Input::escape($item_3->getBrief());
				
				$title_1 = self::GenerateHoverTitle($item_1);
				$title_2 = self::GenerateHoverTitle($item_2);
				$title_3 = self::GenerateHoverTitle($item_3);
				
				$html .= '<div class="col-md-4 material-hover-box full-width masterTooltip" title="'.$title_1.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_1->getID(). '">'. $brief_1. '</a>';
				} $html .= '</div>';
				
				$html .= '<div class="col-md-4 material-hover-box full-width masterTooltip" title="'.$title_2.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_2->getID(). '">'. $brief_2. '</a>';
				} $html .= '</div>';
				
				$html .= '<div class="col-md-4 material-hover-box full-width masterTooltip" title="'.$title_3.'" >'; {
					$html .= '<a href="#" class="word-break bug-report" bug_id="'. $item_3->getID(). '">'. $brief_3. '</a>';
				} $html .= '</div>';
				
				goto EOI;
			}
			
			//End of Item
		EOI: $html .= '</div>';
		}
		
		return $html;
	}
}