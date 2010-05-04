<?php
	// Always have the base Tesseract class loaded,
	// as well as the base Tesseract exception class
require_once(t3lib_extMgm::extPath('tesseract', 'class.tx_tesseract.php'));
require_once(t3lib_extMgm::extPath('tesseract', 'lib/class.tx_tesseract_exception.php'));

	// Include the parser class from "expressions" as it is used throughout the FE processes of Tesseract
	// and also sometimes in the BE
require_once(t3lib_extMgm::extPath('expressions', 'class.tx_expressions_parser.php'));
?>
