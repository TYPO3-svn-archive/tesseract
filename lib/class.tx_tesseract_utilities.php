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
***************************************************************/


/**
 * Utility methods provided by the base controller extension
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
class tx_tesseract_utilities {

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
				$style = 'background-color: #0f0; color: #000; padding:4px;';
				break;
			case 'warning':
				$style = 'background-color: #f60; color: #000; padding:4px;';
				break;
			default:
				$style = 'background-color: #f00; color: #fff; padding:4px;';
        }
		return '<div style="' . $style . '">' . $message . '</div>';
	}

	/**
	 * This method can be used to calculate a hash based on the values of a given filter
	 *
	 * @param array $filter Standard filter structure
	 * @param boolean $useLimit By default, the "limit" part of the filter is excluded from the hash. Use this flag to include it
	 * @return string The calculated hash
	 */
	public static function calculateFilterCacheHash($filter, $useLimit = FALSE) {
		if (is_array($filter)) {
				// If limit is not used, exclude it from the hash calculation
			if (!$useLimit) {
				unset($filter['limit']);
			}
			$string = serialize($filter);
		} else {
			throw new Exception('Invalid filter provided. Could not calculate hash.');
		}
		return md5($string);
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

	/**
	 * Returns a language object by trying to find an existing one or instantiating a new one properly
	 * depending on context
	 *
	 * @static
	 * @return language The language object
	 */
	public static function getLanguageObject() {
			// Use the global language object, if it exists
		if (isset($GLOBALS['lang'])) {
			$lang = $GLOBALS['lang'];

			// If no language object is available, create one
		} else {
			require_once(PATH_typo3 . 'sysext/lang/lang.php');
				/** @var $lang language */
			$lang = t3lib_div::makeInstance('language');
			$languageCode = '';
				// Find out which language to use
			if (empty($language)) {
					// If in the BE, it's taken from the user's preferences
				if (TYPO3_MODE == 'BE') {
					$languageCode = $GLOBALS['BE_USER']->uc['lang'];

					// In the FE, we use the config.language TS property
				} else {
					if (isset($GLOBALS['TSFE']->tmpl->setup['config.']['language'])) {
						$languageCode = $GLOBALS['TSFE']->tmpl->setup['config.']['language'];
					}
				}
			} else {
				$languageCode = $language;
			}
			$lang->init($languageCode);
		}
		return $lang;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/lib/class.tx_tesseract_utilities.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/lib/class.tx_tesseract_utilities.php']);
}

?>