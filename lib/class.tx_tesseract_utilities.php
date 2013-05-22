<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008-2012 Francois Suter (Cobweb) <typo3@cobweb.ch>
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
	 * This method can be used to calculate a hash based on the values of a given filter
	 *
	 * @param array $filter Standard filter structure
	 * @param boolean $useLimit By default, the "limit" part of the filter is excluded from the hash. Use this flag to include it
	 * @throws Exception
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
	 * Returns the full path to a file given either by a relative path or a FAL reference
	 *
	 * @param string $filePath A (relative) path to a file or a FAL reference (e.g. "file:123")
	 * @return string Full path to the file
	 * @throws tx_tesseract_exception
	 */
	public static function getTemplateFilePath($filePath) {
		// There could be link parameters. Explode the string to get rid of them.
		$fileParts = explode(' ', $filePath);
		// If TYPO3 version is 6 or more and string starts with "file:", try to resolve FAL reference
		// TODO: when we drop compatibility with older TYPO3 versions, remove v6 check
		if (strpos(TYPO3_version, '6') === 0 && strpos($fileParts[0], 'file:') === 0) {
			// Extract the file id
			$fileUid = intval(substr($fileParts[0], 5));
			// If valid, try to get the corresponding file object
			if ($fileUid > 0) {
				try {
					$fileObject = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->getFileObject($fileUid);
					// A valid reference was returned, get the file's relative path
					if ($fileObject instanceof \TYPO3\CMS\Core\Resource\FileInterface) {
						$relativePath = $fileObject->getPublicUrl();

					// No valid reference
					} else {
						throw new tx_tesseract_exception('No template file found for reference: ' . $filePath, 1295025186);
					}
				}
				catch (Exception $e) {
					// File reference could not be resolved
					throw new tx_tesseract_exception('No template file found for reference: ' . $filePath, 1295025186);
				}

			// Invalid file id
			} else {
				throw new tx_tesseract_exception('No template file found for reference: ' . $filePath, 1295025186);
			}

		// If not using a FAL reference syntax, assume it is already a relative path
		} else {
			$relativePath = $fileParts[0];
		}
		// Make path absolute
		$fullPath = t3lib_div::getFileAbsFileName($relativePath);
		// Verify that file really exists
		if (!is_file($fullPath)) {
			throw new tx_tesseract_exception('No template file found for reference: ' . $fullPath, 1295025186);
		}
		return $fullPath;
	}

	/**
	 * Returns a language object by trying to find an existing one or instantiating a new one properly
	 * depending on context
	 *
	 * @static
	 * @param string $language A 2-letter language code
	 * @return language The language object
	 */
	public static function getLanguageObject($language = '') {
			// Use the global language object, if it exists
		if (isset($GLOBALS['LANG'])) {
			$lang = $GLOBALS['LANG'];

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