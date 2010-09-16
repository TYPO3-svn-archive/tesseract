<?php
/* 
 * Register necessary class names with autoloader
 *
 * $Id$
 */
$extensionPath = t3lib_extMgm::extPath('tesseract');
return array(
	'tx_tesseract_dataconsumer'				=> $extensionPath . 'interfaces/interface.tx_tesseract_dataconsumer.php',
	'tx_tesseract_datacontroller'			=> $extensionPath . 'interfaces/interface.tx_tesseract_datacontroller.php',
	'tx_tesseract_datacontroller_output'	=> $extensionPath . 'interfaces/interface.tx_tesseract_datacontroller_output.php',
	'tx_tesseract_datafilter'				=> $extensionPath . 'interfaces/interface.tx_tesseract_datafilter.php',
	'tx_tesseract_dataprovider'				=> $extensionPath . 'interfaces/interface.tx_tesseract_dataprovider.php',
	'tx_tesseract_consumerbase'				=> $extensionPath . 'services/class.tx_tesseract_consumerbase.php',
	'tx_tesseract_controllerbase'			=> $extensionPath . 'services/class.tx_tesseract_controllerbase.php',
	'tx_tesseract_feconsumerbase'			=> $extensionPath . 'services/class.tx_tesseract_feconsumerbase.php',
	'tx_tesseract_filterbase'				=> $extensionPath . 'services/class.tx_tesseract_filterbase.php',
	'tx_tesseract_providerbase'				=> $extensionPath . 'services/class.tx_tesseract_providerbase.php',
	'tx_tesseract_exception'				=> $extensionPath . 'lib/class.tx_tesseract_exception.php',
	'tx_tesseract_utilities'				=> $extensionPath . 'lib/class.tx_tesseract_utilities.php',
	'tx_tesseract'							=> $extensionPath . 'class.tx_tesseract.php',
	'tx_tesseract_emconfhelper'				=> $extensionPath . 'class.tx_tesseract_emconfhelper.php',
);
?>
