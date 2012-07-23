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
 * Base datafilter service. All Data Filter services should inherit from this class
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
abstract class tx_tesseract_filterbase extends tx_tesseract_component implements tx_tesseract_datafilter {
	/**
	 * Allowed values for ordering engines
	 *
	 * @var array
	 */
	protected static $allowedOrderingEngines = array('source', 'provider');

	/**
	 * Name of the table where the details about the data query are stored
	 *
	 * @var	string
	 */
	protected $table;

	/**
	 * Primary key of the record to fetch for the details
	 *
	 * @var	integer
	 */
	protected $uid;

	/**
	 * Record from the database about the Data Filter
	 *
	 * @var	array
	 */
	protected $filterData = array();

		/**
		 * Will contain the complete filter structure
		 *
		 * @var	array
		 */
	protected $filter;

// Data Filter interface methods
// (implement only methods that make sense here)

	/**
	 * Loads the details about the Data Filter passing it whatever data it needs
	 *
	 * This will generally be a table name (stored in $data['table']) and a primary key value (stored in $data['uid'])
	 *
	 * @param array $data Data for the Data Filter
	 * @throws Exception
	 * @return void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = intval($data['uid']);
		$whereClause = "uid = '" . $this->uid . "'";
		if (isset($GLOBALS['TSFE'])) {
			$whereClause .= $GLOBALS['TSFE']->sys_page->enableFields($this->table, $GLOBALS['TSFE']->showHiddenRecords);
		}
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->table, $whereClause);
		if (!$res || $GLOBALS['TYPO3_DB']->sql_num_rows($res) == 0) {
			throw new Exception('Could not load filter details');
		} else {
			$this->filterData = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		}

		$this->loadTyposcriptConfiguration($data['table']);
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
					if (!isset($this->filterData[$key]) || $this->filterData[$key] == '') {
						$this->filterData[$key] = $typoscriptConfiguration[$key];
					}
				}
			}
		}
	}

	/**
	 * This method is used to retrieve the filter's data
	 *
	 * @return	array	The filter's data, as stored in the corresponding database record
	 */
	public function getData() {
		return $this->filterData;
	}

	/**
	 * This method makes it possible to force the data of the filter
	 * Normally it should be defined via loadData()
	 *
	 * @param array $data Complete filter information
	 * @return void
	 */
	public function setData(array $data) {
		$this->filterData = $data;
	}

	/**
	 * This method returns true or false depending on whether the filter can be considered empty or not
	 *
	 * @return bool
	 */
	public function isFilterEmpty() {
			// Return true if there are no filters
		return count($this->filter['filters']) == 0;
	}

	/**
	 * This method returns the filter information itself
	 *
	 * @return	array	Internal filter array
	 */
	public function getFilter() {
		return $this->filter;
	}

	/**
	 * This method is used to pass to the DataFilter an existing filter structure, generally coming from some cache
	 *
	 * @param	array	$filter: an existing data filter structure
	 * @return	void
	 */
	public function setFilter($filter) {
		if (is_array($filter) && count($filter) > 0) {
			$this->filter = $filter;
		}
	}

	/**
	 * This method performs necessary initialisations when an instance of this service
	 * is called up several times
	 *
	 * @return	void
	 */
	public function reset() {
		$this->filter = array();
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_datafilter.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_tesseract/services/class.tx_tesseract_datafilter.php']);
}
?>