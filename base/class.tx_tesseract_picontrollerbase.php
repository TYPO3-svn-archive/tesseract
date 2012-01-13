<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008-2010 Francois Suter (Cobweb) <typo3@cobweb.ch>
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

require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Base controller class for controllers based on pi_base
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
abstract class tx_tesseract_picontrollerbase extends tslib_pibase implements tx_tesseract_datacontroller_output {
	/**
	 * @var string Key to use for prefixing things like GP vars
	 */
	public $prefixId ;
	/**
	 * @var bool General debugging flag
	 */
	protected $debug = FALSE;
	/**
	 * @var array List of debug messages
	 */
	protected $messageQueue = array();

	/**
	 * Returns the plug-in's prefix id
	 *
	 * @return	string	The plug-in's prefix id
	 */
	public function getPrefixId() {
		return $this->prefixId;
	}

	/**
	 * Adds a debugging message to the controller's internal message queue
	 *
	 * @param string $key A key identifying the calling component (typically an extension's key)
	 * @param string $message Text of the message
	 * @param string $title An optional title for the message
	 * @param int $status A status/severity level for the message, based on the class constants from t3lib_FlashMessage
	 * @param mixed $debugData An optional variable containing additional debugging information
	 * @return void
	 */
	public function addMessage($key, $message, $title = '', $status = t3lib_FlashMessage::INFO, $debugData = NULL) {
			// Store the message only if debugging is active
		if ($this->debug) {
				// Prepend title, if any, with key
			$fullTitle = '[' . $key . ']' . ((empty($title)) ? '' : ' ' . $title);
				// The message data that corresponds to the Flash Message is stored directly as a Flash Message object,
				// as this performs input validation on the data
				/** @var $flashMessage t3lib_FlashMessage */
			$flashMessage = t3lib_div::makeInstance('t3lib_FlashMessage', $message, $fullTitle, $status);
			$this->messageQueue[] = array(
				'message' => $flashMessage,
				'data' => $debugData
			);
		}
	}

	/**
	 * Returns the complete message queue
	 *
	 * @return array The message queue
	 */
	public function getMessageQueue() {
		return $this->messageQueue;
	}

	/**
	 * Sets the debug flag
	 *
	 * @param boolean $flag TRUE to active debugging mode
	 * @return void
	 */
	public function setDebug($flag) {
		$this->debug = (boolean)$flag;
	}

	/**
	 * Returns the debug flag
	 *
	 * @return bool
	 */
	public function getDebug() {
		return $this->debug;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/base/class.tx_tesseract_datafilter.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/base/class.tx_tesseract_datafilter.php']);
}
?>