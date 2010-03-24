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
require_once(t3lib_extMgm::extPath('basecontroller', 'interfaces/class.tx_basecontroller_dataconsumer.php'));

/**
 * Base dataconsumer service. Data Consumer services should inherit from this class, *except* FE Data Consumer services,
 * which should inherit from derived class tx_basecontroller_feconsumerbase
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 *
 * $Id$
 */
abstract class tx_basecontroller_consumerbase extends t3lib_svbase implements tx_basecontroller_dataconsumer {
	protected $table; // Name of the table where the details about the consumer are stored
	protected $uid; // Primary key of the record to fetch for the details
	protected $consumerData = array();
	protected $filter; // Data Filter structure
	protected $pObj; // Reference to the consumer's parent object, normally some kind of controller

	/**
	 * This method is used to load the details about the Data Consumer passing it whatever data it needs
	 * This will generally be a table name and a primary key value
	 *
	 * @param	array	$data: Data for the Data Consumer
	 * @return	void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = $data['uid'];
			// Get record where the details of the data display are stored
		$tableTCA = $GLOBALS['TCA'][$this->table];
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
	 * @param	object	$pObj: reference to a parent object
	 */
	public function setParentReference(&$pObj) {
		if (is_object($pObj)) {
			$this->pObj = $pObj;
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_dataconsumer.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_dataconsumer.php']);
}
?>