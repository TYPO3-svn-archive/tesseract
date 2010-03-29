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

require_once(PATH_t3lib . 'class.t3lib_svbase.php');
require_once(t3lib_extMgm::extPath('tesseract', 'interfaces/class.tx_tesseract_datafilter.php'));

/**
 * Base datafilter service. All Data Filter services should inherit from this class
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
abstract class tx_tesseract_filterbase extends t3lib_svbase implements tx_tesseract_datafilter {
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
	 * This method is used to load the details about the Data Filter passing it whatever data it needs
	 * This will generally be a table name (stored in $data['table']) and a primary key value (stored in $data['uid'])
	 *
	 * @param	array	$data: Data for the Data Filter
	 * @return	void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = $data['uid'];
		$whereClause = "uid = '".$this->uid."'";
		if (isset($GLOBALS['TSFE'])) {
			$whereClause .= $GLOBALS['TSFE']->sys_page->enableFields($this->table, $GLOBALS['TSFE']->showHiddenRecords);
		}
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->table, $whereClause);
		if (!$res || $GLOBALS['TYPO3_DB']->sql_num_rows($res) == 0) {
			throw new Exception('Could not load filter details');
		}
		else {
			$this->filterData = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
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