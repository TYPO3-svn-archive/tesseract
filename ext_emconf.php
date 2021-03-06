<?php

/*********************************************************************
* Extension configuration file for ext "tesseract".
*
* Generated by ext 21-06-2013 12:49 UTC
*
* https://github.com/t3elmar/Ext
*********************************************************************/

$EM_CONF[$_EXTKEY] = array (
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
  'version' => '1.7.0',
  'constraints' => 
  array (
    'depends' => 
    array (
      'php' => '5.2.0-0.0.0',
      'typo3' => '4.5.0-6.1.99',
      'expressions' => '',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  '_md5_values_when_last_written' => 'a:27:{s:9:"ChangeLog";s:4:"19a7";s:22:"class.tx_tesseract.php";s:4:"4ba3";s:35:"class.tx_tesseract_emconfhelper.php";s:4:"1449";s:16:"ext_autoload.php";s:4:"5b7d";s:21:"ext_conf_template.txt";s:4:"464c";s:12:"ext_icon.gif";s:4:"37ae";s:17:"ext_localconf.php";s:4:"6394";s:14:"ext_tables.php";s:4:"f8c0";s:13:"locallang.xml";s:4:"554c";s:10:"README.txt";s:4:"a21e";s:44:"base/class.tx_tesseract_picontrollerbase.php";s:4:"975c";s:14:"doc/manual.pdf";s:4:"6cac";s:14:"doc/manual.sxw";s:4:"0046";s:14:"doc/manual.txt";s:4:"07a5";s:50:"interfaces/interface.tx_tesseract_dataconsumer.php";s:4:"4125";s:52:"interfaces/interface.tx_tesseract_datacontroller.php";s:4:"deea";s:59:"interfaces/interface.tx_tesseract_datacontroller_output.php";s:4:"2898";s:48:"interfaces/interface.tx_tesseract_datafilter.php";s:4:"b808";s:50:"interfaces/interface.tx_tesseract_dataprovider.php";s:4:"4ff3";s:36:"lib/class.tx_tesseract_exception.php";s:4:"5ec0";s:36:"lib/class.tx_tesseract_utilities.php";s:4:"f8e3";s:41:"services/class.tx_tesseract_component.php";s:4:"03d5";s:44:"services/class.tx_tesseract_consumerbase.php";s:4:"8cf1";s:46:"services/class.tx_tesseract_controllerbase.php";s:4:"ed24";s:46:"services/class.tx_tesseract_feconsumerbase.php";s:4:"d948";s:42:"services/class.tx_tesseract_filterbase.php";s:4:"3952";s:44:"services/class.tx_tesseract_providerbase.php";s:4:"0a52";}',
  'suggests' => 
  array (
  ),
  'comment' => 'Compatibility with TYPO3 6.0 and 6.1; improved API for getting controller properties.',
  'user' => 'francois',
);

?>