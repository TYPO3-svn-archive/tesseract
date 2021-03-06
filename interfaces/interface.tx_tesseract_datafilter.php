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
 * Interface for objects that can behave as Data Filters
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
interface tx_tesseract_datafilter {

	/**
	 * This method processes the Data Filter's configuration and returns the filter structure
	 *
	 * @return	array	standardised filter structure
	 */
	public function getFilterStructure();

	/**
	 * This method returns true or false depending on whether the filter can be considered empty or not
	 * @abstract
	 * @return boolean
	 */
	public function isFilterEmpty();

	/**
	 * This method returns the filter information itself
	 *
	 * @return	array	Internal filter array
	 */
	public function getFilter();

	/**
	 * This method is used to pass to the DataFilter an existing filter structure, generally coming from some cache
	 *
	 * @param	array	$filter: an existing data filter structure
	 * @return	void
	 */
	public function setFilter($filter);

	/**
	 * This method is used to save the filter in session
	 * It expects the filter to have some kind of key to identify the storage in session
	 *
	 * @return	void
	 */
	public function saveFilter();
}
?>