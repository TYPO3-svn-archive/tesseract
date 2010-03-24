<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Francois Suter (Cobweb) <typo3@cobweb.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
*
* $Id$
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


/**
 * Utility methods provided by the base controller extension
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 *
 * $Id$
 */
class tx_basecontroller_utilities {

	/**
	 * This method wraps messages before display
	 *
	 * @param	string	$message: message to wrap
     * @param	string	$type: type of message (use either "error", "warning" or "success")
     *
	 * @return	string	Wrapped message
	 */
	public static function wrapMessage($message, $type = 'error') {
		switch ($type) {
			case 'success':
				$class = 'successBox';
				$style = 'background-color: #0f0; color: #000; padding:4px;';
				break;
			case 'warning':
				$class = 'warningBox';
				$style = 'background-color: #f60; color: #000; padding:4px;';
				break;
			default:
				$class = 'errorBox';
				$style = 'background-color: #f00; color: #fff; padding:4px;';
        }
		return '<div class="'.$class.'" style="'.$style.'">'.$message.'</div>';
	}

	/**
	 * This method can be used to calculate a hash based on the values of a given filter
	 *
	 * @param	array		$filter: standard filter structure
	 * @param	boolean		$useLimit: by default, the "limit" part of the filter is excluded from the hash. Use this flag to include it
	 */
	public static function calculateFilterCacheHash($filter, $useLimit = false) {
		if (is_array($filter)) {
				// If limit is not used, exclude it from the hash calculation
			if (!$useLimit) {
				unset($filter['limit']);
			}
			$string = serialize($filter);
			return md5($string);
		}
		else {
			throw new Exception('Invalid filter provided. Could not calculate hash.');
		}
	}

	/**
	 * This method reads a configuration field and returns a cleaned up set of configuration statements
	 * ignoring blank lines and comments
	 * Each line in the configuration field will correspond to an item in the returned array
	 * Comments are marked by lines starting with # or //
	 *
	 * @param	string	$text: full configuration text
	 * @return	array	List of configuration statements
	 */
	public static function parseConfigurationField($text) {
		$lines = array();
			// Explode all the lines on the return character
		$allLines = t3lib_div::trimExplode("\n", $text, 1);
		foreach ($allLines as $aLine) {
				// Take only line that don't start with # or // (comments)
			if (strpos($aLine, '#') !== 0 && strpos($aLine, '//') !== 0) {
				$lines[] = $aLine;
			}
		}
		return $lines;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/lib/class.tx_basecontroller_utilities.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/lib/class.tx_basecontroller_utilities.php']);
}

?>