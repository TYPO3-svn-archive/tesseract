<?php

########################################################################
# Extension Manager/Repository config file for ext "tesseract".
#
# Auto generated 22-03-2011 17:17
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Project Tesseract',
	'description' => 'This projects covers a suite of extensions designed to facilitate the extraction of data and their display, using controllers and standard data formats. More info on http://www.typo3-tesseract.com/',
	'category' => 'misc',
	'author' => 'Francois Suter (Cobweb)',
	'author_email' => 'typo3@cobweb.ch',
	'shy' => '',
	'dependencies' => 'expressions',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.0.2',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.0-0.0.0',
			'expressions' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:24:{s:9:"ChangeLog";s:4:"0845";s:10:"README.txt";s:4:"a21e";s:22:"class.tx_tesseract.php";s:4:"b3cf";s:35:"class.tx_tesseract_emconfhelper.php";s:4:"6b05";s:16:"ext_autoload.php";s:4:"253e";s:21:"ext_conf_template.txt";s:4:"464c";s:12:"ext_icon.gif";s:4:"37ae";s:17:"ext_localconf.php";s:4:"11e1";s:14:"ext_tables.php";s:4:"f8c0";s:13:"locallang.xml";s:4:"554c";s:14:"doc/manual.pdf";s:4:"d085";s:14:"doc/manual.sxw";s:4:"112c";s:50:"interfaces/interface.tx_tesseract_dataconsumer.php";s:4:"f6f8";s:52:"interfaces/interface.tx_tesseract_datacontroller.php";s:4:"deea";s:59:"interfaces/interface.tx_tesseract_datacontroller_output.php";s:4:"db52";s:48:"interfaces/interface.tx_tesseract_datafilter.php";s:4:"6dea";s:50:"interfaces/interface.tx_tesseract_dataprovider.php";s:4:"34ab";s:36:"lib/class.tx_tesseract_exception.php";s:4:"5ec0";s:36:"lib/class.tx_tesseract_utilities.php";s:4:"9693";s:44:"services/class.tx_tesseract_consumerbase.php";s:4:"06c4";s:46:"services/class.tx_tesseract_controllerbase.php";s:4:"ed24";s:46:"services/class.tx_tesseract_feconsumerbase.php";s:4:"e698";s:42:"services/class.tx_tesseract_filterbase.php";s:4:"3898";s:44:"services/class.tx_tesseract_providerbase.php";s:4:"374c";}',
	'suggests' => array(
	),
);

?>