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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * This class provides a custom field for the extension configuration screen
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
class tx_tesseract_emconfhelper {
	protected static $extensionsList = array('tesseract', 'expressions', 'overlays', 'context', 'displaycontroller', 'datafilter', 'dataquery', 'templatedisplay');

	public function  __construct() {
		$GLOBALS['LANG']->includeLLFile('EXT:tesseract/locallang.xml');
	}

	/**
	 * Returns a list with the status of all "core" Tesseract extensions
	 *
	 * @param array	 $params Information about the field to be rendered
	 * @param t3lib_tsStyleConfig $pObj The calling parent object.
	 * @return string The HTML selector
	 */
	public function installationCheck(array $params, t3lib_tsStyleConfig $pObj) {
		$checkText = '<p style="margin-bottom: 10px;"><strong>' . $GLOBALS['LANG']->getLL('installationCheck.warning') . '</strong></p>';
		foreach (self::$extensionsList as $anExtension) {
			$checkText .= $this->wrapMessage($anExtension, t3lib_extMgm::isLoaded($anExtension));
		}
		return $checkText;
	}

	/**
	 * Prepares an installation status message for a given extension
	 *
	 * @param string $extension The extension key
	 * @param boolean $status True if extension is installed, false otherwise
	 * @return string HTML for the message
	 */
	protected function wrapMessage($extension, $status) {
			// Assemble flash messages and render it
		$severity = t3lib_FlashMessage::OK;
		$messageText = $GLOBALS['LANG']->getLL('installationCheck.extensionInstalled');
		$title = $GLOBALS['LANG']->getLL('installationCheck.extension') . ': ' . $extension;
		if (!$status) {
			$severity = t3lib_FlashMessage::WARNING;
			$messageText = $GLOBALS['LANG']->getLL('installationCheck.extensionNotInstalled');
		}

			/** @var $flashMessage t3lib_FlashMessage */
		$flashMessage = t3lib_div::makeInstance(
			't3lib_FlashMessage',
			$messageText,
			$title,
			$severity
		);
		return $flashMessage->render();
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/class.tx_tesseract_emconfhelper.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/class.tx_tesseract_emconfhelper.php']);
}
?>