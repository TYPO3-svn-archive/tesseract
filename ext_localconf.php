<?php
	// Always have the base tesseract class loaded
require_once(t3lib_extMgm::extPath('tesseract', 'class.tx_tesseract.php'));

	// Include the parser class from "expressions" as it is used throughout the FE processes of Tesseract
	// and also sometimes in the BE
require_once(t3lib_extMgm::extPath('expressions', 'class.tx_expressions_parser.php'));
?>
