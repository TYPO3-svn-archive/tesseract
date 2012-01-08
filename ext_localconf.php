<?php
	// Load various base Tesseract classes
require_once(t3lib_extMgm::extPath('tesseract', 'class.tx_tesseract.php'));
require_once(t3lib_extMgm::extPath('tesseract', 'lib/class.tx_tesseract_exception.php'));
require_once(t3lib_extMgm::extPath('tesseract', 'services/class.tx_tesseract_component.php'));

	// Include the parser class from "expressions" as it is used throughout the FE processes of Tesseract
	// and also sometimes in the BE
require_once(t3lib_extMgm::extPath('expressions', 'class.tx_expressions_parser.php'));
?>
