<?php

$incoming_page = $_SERVER['REQUEST_URI'];


/* determine if we are coming from the test site? If so, use the test DB */
if (preg_match("/map-site/", $incoming_page, $matches)) {
  define("DB_NAME", "MAP2-TEST");
  //echo "*** Using TEST Database *** <br />";

} else {
	/* use production DB */
	define("DB_NAME", "MAP2");	
}

// Database Constants
define("DB_SERVER", "usmghcentos65.asg.com");
define("DB_USER", "scottba");
define("DB_PASS", "qamap");

?>