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

	/**
	 * Returns the whole controller data.
	 *
	 * The controller's data will depend on its context. For a FE controller, this will
	 * be the corresponding tt_content record.
	 *
	 * @return array The controller data
	 */
	public function getControllerData() {
		return $this->cObj->data;
	}

	/**
	 * Returns the value of a specific controller data.
	 *
	 * The controller's data will depend on its context. For a FE controller, this will
	 * be the corresponding tt_content record.
	 *
	 * @throws tx_tesseract_exception
	 * @param string $key Key to fetch the data with
	 * @return mixed The relevant data
	 */
	public function getControllerDataValue($key) {
		if (isset($this->cObj->data[$key])) {
			return $this->cObj->data[$key];
		} else {
			throw new tx_tesseract_exception('Value ' . $key . ' not found in controller data', 1365687949);
		}
	}

	/**
	 * Returns all the controller's arguments.
	 *
	 * The controller's arguments will depend on its context. For a FE controller, this will
	 * be the variables submitted to it (piVars in the case of a pibase controller).
	 *
	 * @return array The controller data
	 */
	public function getControllerArguments() {
		return $this->piVars;
	}

	/**
	 * Returns the value of a specific controller argument
	 *
	 * The controller's arguments will depend on its context. For a FE controller, this will
	 * be the variables submitted to it (piVars in the case of a pibase controller).
	 *
	 * @throws tx_tesseract_exception
	 * @param string $key Key to fetch the argument with
	 * @return mixed The relevant data
	 */
	public function getControllerArgumentValue($key) {
		if (isset($this->piVars[$key])) {
			return $this->piVars[$key];
		} else {
			throw new tx_tesseract_exception('Value ' . $key . ' not found in controller arguments', 1365687949);
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/base/class.tx_tesseract_datafilter.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/base/class.tx_tesseract_datafilter.php']);
}
?>