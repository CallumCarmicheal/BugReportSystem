<?php

/**
 *  CMVC  PHP | A hackable php mvc framework written
 *  FRAMEWORK | from scratch with love
 * -------------------------------------------------------
 *   _______  ____   _______                ___  __ _____
 *  / ___/  |/  | | / / ___/               / _ \/ // / _ \
 * / /__/ /|_/ /| |/ / /__                / ___/ _  / ___/
 * \___/_/  /_/ |___/\___/               /_/  /_//_/_/
 *    _______  ___   __  ________      ______  ___  __ __
 *   / __/ _ \/ _ | /  |/  / __| | /| / / __ \/ _ \/ //_/
 *  / _// , _/ __ |/ /|_/ / _/ | |/ |/ / /_/ / , _/ ,<
 * /_/ /_/|_/_/ |_/_/  /_/___/ |__/|__/\____/_/|_/_/|_|
 *
 * -------------------------------------------------------
 * Programmed by Callum Carmicheal
 *		<https://github.com/CallumCarmicheal>
 * GitHub Repository
 *		<https://github.com/CallumCarmicheal/CommonMVC-PHP-Framework>
 *
 * Contributors:
 *
 *
 * LICENSE: MIT License
 *      <http://www.opensource.org/licenses/mit-license.html>
 *
 * You cannot remove this header from any CMVC framework files
 * which are under the following directory cmvc->framework.
 * if you are unsure what directory that is, please refer to
 * GitHub:
 * <https://github.com/CallumCarmicheal/CommonMVC-PHP-Framework/tree/master/src>
 *
 * -------------------------------------------------------
 * MIT License
 *
 * Copyright (c) 2017 Callum Carmicheal
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class Input {
	
	// Returns -1 for not found
	
	/**
	 * Get a string from the request
	 * @param $string mixed Searched input
	 * @param $type string Type to return, post|p, get|g or any.
	 * @param $default mixed Default returned value
	 * @return mixed returns $default when not found.
	 */
	public static function get($string, $type="any", $default = "") {
		//ob_clean(); echo "GET: ". $type. ", ". $string. " = ". $_GET[$string]; exit;
		
		$tl = mb_strtolower($type);
		
		if ($tl == "post" || $tl == "p") {
			if (!empty($_POST[$string])) return $_POST[$string];
			else                         return $default;
		} else if ($tl == "get" || $tl == "g") {
			if (!empty($_GET[$string]))  return $_GET[$string];
			else                         return $default;
		}
		
		// Always favor the post input
		// first, this will stop any
		// users trying to bypass post
		// through html params
		if (!empty($_POST[$string]))
			return $_POST[$string];
		
		if (!empty($_GET[$string]))
			return $_GET[$string];
		
		return $default;
	}
	
	/**
	 * Checks if the request contains a argument
	 * @param $string mixed Searched input
	 * @param $type string Type to return, post|p, get|g or any.
	 * @param $check string Type to return, isset|i, empty|e. DEFAULT = "e"
	 * @param $debug bool Stops page execution to state where the result is coming from
	 * @return bool If the request contains the argument
	 */
	public static function contains($string, $type = "any", $check = "e", $debug = false) {
		$tl     = mb_strtolower($type);
		$check  = mb_strtolower($check);
		
		if ($tl == "post" || $tl == "p") {
			if ($check == "i")           {
				if ($debug)
					die ("tp = p, check = i");
				
				return (isset($_POST[$string]));
			} else if ($check == "e")    {
				if ($debug)
					die ("tp = p, check = e");
				
				return (!empty($_POST[$string]));
			}
		}
		
		else if ($tl == "get" || $tl == "g") {
			if ($check == "i") {
				if ($debug)
					die ("tp = g, check = i");
				
				return (isset($_GET[$string]));
			} else if ($check == "e") {
				if ($debug)
					die ("tp = g, check = e");
				
				return (!empty($_GET[$string]));
			}
		}
		
		if ($check == "e") {
			if (!empty($_POST[$string])) return true;
			if (!empty($_GET[$string]))  return true;
		} else if ($check == "i") {
			if (isset($_POST[$string]))  return true;
			if (isset($_GET[$string]))   return true;
		}
		
		return false;
	}
	
	/**
	 * Escape all HTML, JavaScript, and CSS
	 *
	 * @param string $input The input string
	 * @param string $encoding Which character encoding are we using?
	 * @return string
	 */
	public static function escape($input, $encoding = 'UTF-8') {
		return htmlentities($input, ENT_QUOTES, $encoding, false);
		//return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
	}
}