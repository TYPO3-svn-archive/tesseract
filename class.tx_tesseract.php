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
 * Base class for the Tesseract Project
 *
 * Contains a couple of constants and a factory class
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_tesseract
 *
 * $Id$
 */
class tx_tesseract {

		// Define class constants for structure types
	const RECORDSET_STRUCTURE_TYPE = 'recordset';
	const IDLIST_STRUCTURE_TYPE = 'idlist';

	/**
	 * Returns the right Tesseract component given the input values
	 * and performs additional, common initializations on the component
	 *
	 * @param string $type Type of component
	 * @param string $subtype Specific subtype of component
	 * @param array $componentData Data for the component
	 * @param tx_tesseract_datacontroller_output $controller Reference to the calling controller
	 * @throws tx_tesseract_exception
	 * @return tx_tesseract_component
	 */
	public static function getComponent($type, $subtype, $componentData, $controller) {
			// Get the correct service instance
			/** @var $component tx_tesseract_component */
		$component = t3lib_div::makeInstanceService($type, $subtype);
			// Check if a service was found and returned an appropriate type
		if (!($component instanceof tx_tesseract_component)) {
			throw new tx_tesseract_exception(
				'No service found for type: '. $type .', subtype: ' . $subtype,
				1341692083
			);
		} else {
				// Load the component's data
			$component->loadData($componentData);
				// Set the reference to the controller
			$component->setController($controller);
		}
		return $component;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/class.tx_tesseract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tesseract/class.tx_tesseract.php']);
}

?>