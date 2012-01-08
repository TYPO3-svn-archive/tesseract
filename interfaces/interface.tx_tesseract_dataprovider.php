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
 * Interface for objects that can behave as Data Providers
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_tesseract
 *
 * $Id$
 */
interface tx_tesseract_dataprovider {

	/**
	 * This method returns the type of data structure that the Data Provider can prepare
	 *
	 * @return	string	type of the provided data structure
	 */
	public function getProvidedDataStructure();

	/**
	 * This method indicates whether the Data Provider can create the type of data structure requested or not
	 *
	 * @param	string		$type: type of data structure
	 * @return	boolean		true if it can handle the requested type, false otherwise
	 */
	public function providesDataStructure($type);

	/**
	 * This method returns the type of data structure that the Data Provider can receive as input
	 *
	 * @return	string	type of used data structures
	 */
	public function getAcceptedDataStructure();

	/**
	 * This method indicates whether the Data Provider can use as input the type of data structure requested or not
	 *
	 * @param	string		$type: type of data structure
	 * @return	boolean		true if it can use the requested type, false otherwise
	 */
	public function acceptsDataStructure($type);

	/**
	 * This method prepares an empty data structure
	 * i.e. with most properties undefined, an empty array for "records" and a "count" of 0
	 * If appropriate it should also set some flag, so that getDataStructure() knows that it must return this empty structure
	 * rather than calculate the full structure
	 *
	 * @param string $tablename Name of the table to use in the empty structure
	 * @return	void
	 */
	public function initEmptyDataStructure($tablename);

	/**
	 * This method assembles the data structure and returns it
	 *
	 * @return	array	standardised data structure
	 */
	public function getDataStructure();

	/**
	 * This method is used to pass a data structure to the Data Provider
	 *
	 * @param 	array	$structure: standardised data structure
	 * @return	void
	 */
	public function setDataStructure($structure);

	/**
	 * This method is used to pass a Data Filter structure to the Data Provider
	 *
	 * @param	array	$filter: Data Filter structure
	 * @return	void
	 */
	public function setDataFilter($filter);

	/**
     * This method returns a list of tables and fields (or equivalent) available in the data structure,
     * complete with localized labels
     *
     * @param	string	$language: 2-letter iso code for language
     * @return	array	list of tables and fields
     */
	public function getTablesAndFields($language = '');

	/**
	 * This method can be used to get the hasEmptyOutputStructure flag
	 *
	 * @return	boolean		The empty output structure flag
	 */
	public function getEmptyDataStructureFlag();

	/**
	 * This method can be used to set the hasEmptyOutputStructure flag
	 *
	 * @param	boolean		$flag: the value to set
	 * @return	void
	 */
	public function setEmptyDataStructureFlag($flag);
}
?>