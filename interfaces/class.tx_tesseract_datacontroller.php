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
interface tx_tesseract_datacontroller {

	/**
	 * This method is used to load the details about the controller
	 * This is mostly meant to match the other interfaces. In effect,
	 * it is really just about storing the controller's id
	 *
	 * @param	integer	$uid: ID of the controller
	 * @return	void
	 */
	public function loadData($uid);
	
	/**
	 * This method should return the Data Provider that the controller
	 * should pass to the Data Consumer, according to the relations defined
	 * by the controller
	 * NOTE: this is essentially meant to be used in the BE, when the
	 * Data Consumer must be "put in touch" with its Data Provider in order to
	 * know what data will be available, for mapping purposes
	 *
	 * @return	tx_tesseract_dataprovider	An oject implementing the Data Provider interface
	 */
	public function getRelatedProvider();
}
?>