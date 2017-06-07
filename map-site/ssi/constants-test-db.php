<?php

$incoming_page = $_SERVER['REQUEST_URI'];


/* determine if we are coming from the test site? If so, use the test DB */
if (preg_match("/map-site/", $incoming_page, $matches)) {
  define("DB_NAME", "MAP2-TEST");
  define("DB_TEST", "YES");
  //echo "<h3>*** Using TEST Database *** </h3>";

} else {
	/* use production DB */
	define("DB_NAME", "MAP2");	
}

// Database Constants
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "qamap");

?>