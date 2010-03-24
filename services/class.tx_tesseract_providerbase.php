<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Francois Suter (Cobweb) <typo3@cobweb.ch>
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

require_once(PATH_t3lib.'class.t3lib_svbase.php');
require_once(t3lib_extMgm::extPath('basecontroller', 'interfaces/class.tx_basecontroller_dataprovider.php'));

/**
 * Base dataprovider service. All Data Provider services should inherit from this class
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_basecontroller
 *
 * $Id$
 */
abstract class tx_basecontroller_providerbase extends t3lib_svbase implements tx_basecontroller_dataprovider {
	public $table; // Name of the table where the details about the provider are stored
	public $uid; // Primary key of the record to fetch for the details
	public $providerData = array();
	public $filter = array(); // Data Filter structure
	public $structure = array(); // Input standardised data structure
	public $hasEmptyOutputStructure = FALSE; // Set to true if empty structure was forced (see initEmptyDataStructure())
	public $outputStructure = array(); // Output standardised data structure

// Data Provider interface methods
// (implement only methods that make sense here)

	/**
	 * This method is used to load the details about the Data Provider passing it whatever data it needs
	 * This will generally be a table name (stored in $data['tablenames']) and a primary key value (stored in $data['uid_foreign'])
	 *
	 * @param	array	$data: Data for the Data Provider
	 * @return	void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = $data['uid'];
		$tableTCA = $GLOBALS['TCA'][$this->table];
		$whereClause = "uid = '".$this->uid."'";
		if (isset($GLOBALS['TSFE'])) {
			$whereClause .= $GLOBALS['TSFE']->sys_page->enableFields($this->table, $GLOBALS['TSFE']->showHiddenRecords);
		}
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->table, $whereClause);
		if (!$res || $GLOBALS['TYPO3_DB']->sql_num_rows($res) == 0) {
			throw new Exception('Could not load provider details');
		} else {
			$this->providerData = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		}
	}

	/**
	 * This method prepares an empty data structure
	 * i.e. with most properties undefined, an empty array for "records" and a "count" of 0
	 * If appropriate it should also set some flag, so that getDataStructure() knows that it must return this empty structure
	 * rather than calculate the full structure
	 *
	 * @return	void
	 */
	public function initEmptyDataStructure($tablename) {
		$this->hasEmptyOutputStructure = TRUE;
		$this->outputStructure = array('count' => 0, 'records' => array(), 'name' => $tablename, 'uidList' => FALSE, 'header' => FALSE, 'totalCount' => 0);
	}

	/**
	 * This method is used to pass a Data Filter structure to the Data Provider
	 *
	 * @param	array		$filter: Data Filter structure
	 * @return	void
	 */
	public function setDataFilter($filter) {
		if (is_array($filter)) $this->filter = $filter;
	}

	/**
	 * This method can be used to get the hasEmptyOutputStructure flag
	 *
	 * @return	boolean		The empty output structure flag
	 */
	public function getEmptyDataStructureFlag() {
		return $this->hasEmptyOutputStructure;
	}

	/**
	 * This method can be used to set the hasEmptyOutputStructure flag
	 *
	 * @param	boolean		$flag: the value to set
	 * @return	void
	 */
	public function setEmptyDataStructureFlag($flag) {
		if ($flag) {
			$this->hasEmptyOutputStructure = TRUE;
		} else {
			$this->hasEmptyOutputStructure = FALSE;
		}
	}

// t3lib_svbase methods

	/**
	 * This method resets values for a number of properties
	 * This is necessary because services are managed as singletons
	 * 
	 * NOTE: If you make your own implementation of reset in your DataProvider class, don't forget to call parent::reset()
	 * 
	 * @return	void
	 */
	public function reset() {
		parent::reset();
		$this->table = '';
		$this->uid = '';
		$this->providerData = array();
		$this->filter = array();
		$this->structure = array();
		$this->hasEmptyOutputStructure = FALSE;
		$this->outputStructure = array();
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_dataprovider.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_dataprovider.php']);
}
?>