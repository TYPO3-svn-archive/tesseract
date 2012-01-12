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
 * Interface for Data Controllers when interacting with other components
 * during output production
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
interface tx_tesseract_datacontroller_output {
	/**
	 * Returns a string that identifies the controller.
	 *
	 *  When the controller is a FE plugin - for example -
	 * it should return the prefix that can be used to name GET/POST
	 * variables in the form of "tx_mycontroller[foo]".
	 *
	 * @return	string	An ID string that identifies the controller
	 */
	public function getPrefixId();

	/**
	 * Adds a debugging message to the controller's internal message queue
	 *
	 * Implementations of this method should check whether debugging is active or not and avoid storing
	 * messages if it is not.
	 *
	 * @param string $key A key identifying a set the message belongs to (typically the calling extension's key)
	 * @param string $message Text of the message
	 * @param string $title An optional title for the message
	 * @param int $status A status/severity level for the message, based on the class constants from t3lib_FlashMessage
	 * @param mixed $debugData An optional variable containing additional debugging information
	 * @return void
	 */
	public function addMessage($key, $message, $title = '', $status = t3lib_FlashMessage::INFO, $debugData = NULL);

	/**
	 * Returns the complete message queue
	 *
	 * @return array The message queue
	 */
	public function getMessageQueue();
}
?>