<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Francois Suter (Cobweb) <typo3@cobweb.ch>
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
 * Base component class for all Tesseract components: Data Providers, Data Filters and Data Consumers
 * (controllers are a case apart).
 *
 * All Tesseract components are expected to be services extending
 * tx_tesseract_component or any class derived from it.
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_tesseract
 *
 * $Id$
 */
abstract class tx_tesseract_component extends t3lib_svbase {
	/**
	 * Reference to the component's parent object, normally some kind of controller
	 *
	 * @var tx_tesseract_datacontroller_output
	 */
	protected $controller;

	/**
	 * Loads the details of a component into member variables.
	 *
	 * Usually expected data will be a table name (stored in $data['table'])
	 * and a primary key value (stored in $data['uid'])
	 *
	 * @param array $data Data for the component
	 * @return void
	 */
	abstract public function loadData($data);

	/**
	 * Returns the component's details
	 *
	 * @return array The component's details
	 */
	abstract public function getData();

	/**
	 * Sets the component's details.
	 *
	 * This is normally done via loadData(). This method is used in particular
	 * during unit testing
	 *
	 * @param array $data Complete component information
	 * @return void
	 */
	abstract public function setData(array $data);

	/**
	 * Sets a reference to the parent object, normally an instance of some controller
	 *
	 * @param tx_tesseract_datacontroller_output $controller Reference to a parent object
	 * @return void
	 */
	public function setController(tx_tesseract_datacontroller_output $controller) {
		if (is_object($controller)) {
			$this->controller = $controller;
		}
	}

	/**
	 * Returns a reference to the component's controller
	 *
	 * @return tx_tesseract_datacontroller_output The controller
	 */
	public function getController() {
		return $this->controller;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_component.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_component.php']);
}
?>