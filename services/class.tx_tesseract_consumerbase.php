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
 * Base dataconsumer service. Data Consumer services should inherit from this class, *except* FE Data Consumer services,
 * which should inherit from derived class tx_tesseract_feconsumerbase
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
abstract class tx_tesseract_consumerbase extends tx_tesseract_component implements tx_tesseract_dataconsumer {
	protected $table; // Name of the table where the details about the consumer are stored
	protected $uid; // Primary key of the record to fetch for the details
	protected $consumerData = array();
	protected $filter; // Data Filter structure
	/**
	 * Reference to the consumer's parent object, normally some kind of controller
	 *
	 * @var tx_tesseract_datacontroller_output
	 * @deprecated since tesseract 1.3.0, may be removed in the future - Use $this->controller instead
	 */
	protected $pObj;

	/**
	 * Loads the details about the Data Consumer passing it whatever data it needs
	 *
	 * This will generally be a table name and a primary key value
	 *
	 * @param array $data Data for the Data Consumer
	 * @throws Exception
	 * @return void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = intval($data['uid']);
			// Get record where the details of the data display are stored
		$whereClause = "uid = '" . $this->uid . "'";
		if (isset($GLOBALS['TSFE'])) {
			$whereClause .= $GLOBALS['TSFE']->sys_page->enableFields($this->table, $GLOBALS['TSFE']->showHiddenRecords);
		}
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->table, $whereClause);
		if (!$res || $GLOBALS['TYPO3_DB']->sql_num_rows($res) == 0) {
			throw new Exception('Could not load consumer details');
		} else {
			$this->consumerData = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		}

		$this->loadTyposcriptConfiguration($data['table']);
	}

	/**
	 * Returns the data consumer's details
	 *
	 * @return array The data consumer's details
	 */
	public function getData() {
		return $this->consumerData;
	}

	/**
	 * Sets the full data consumer's details
	 *
	 * Should be used only when needed. Normal way is to use loadData()
	 *
	 * @param array $data Complete consumer details
	 * @return void
	 */
	public function setData(array $data) {
		$this->consumerData = $data;
	}

	/**
	 * This method replaces unset data with default values defined with TypoScript
	 *
	 * @param	string	$tableName: Name of the table containing the data
	 * @return void
	 */
	protected function loadTyposcriptConfiguration($tableName) {
		if (isset($GLOBALS['TSFE'])) {
			$typoscriptConfiguration = $GLOBALS['TSFE']->config['config']['tx_tesseract.'][$tableName . '.']['default.'];
				// If there's some TypoScript configuration, use its values, but only if there's not already a value from the DB
			if (is_array($typoscriptConfiguration)) {
				foreach ($typoscriptConfiguration as $key => $value) {
					if (!isset($this->consumerData[$key]) || $this->consumerData[$key] == '') {
						$this->consumerData[$key] = $typoscriptConfiguration[$key];
					}
				}
			}
		}
	}

	/**
	 * This method is used to pass a Data Filter structure to the Data Provider
	 *
	 * @param	array		$filter: Data Filter structure
	 * @return	void
	 */
	public function setDataFilter($filter) {
		if (is_array($filter)) {
			$this->filter = $filter;
		}
	}

	/**
	 * This method is used to set a reference to the parent object, normally an instance of some controller
	 *
	 * @param object $pObj Reference to a parent object
	 * @deprecated since tesseract 1.3.0, may be removed in the future - Use setController() instead
	 */
	public function setParentReference(&$pObj) {
		t3lib_div::logDeprecatedFunction();
		if (is_object($pObj)) {
			$this->pObj = $pObj;
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_dataconsumer.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_dataconsumer.php']);
}
?>