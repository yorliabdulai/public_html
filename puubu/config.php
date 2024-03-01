<?php

	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/');

	// Check For Incorrect Input Of Data
	function sanitize($dirty) {
		return htmlentities($dirty, ENT_QUOTES, "UTF-8");
	}
	
	define('PROOT', '/');

	define('IPINFO_PRIVATE_KEY', 'c5c08603163207');

?>
