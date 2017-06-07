
<?
	 ini_set('display_errors', 'On');
	 require_once("ssi/connection.php"); 
	 include("ssi/functions.php"); 
	 include("ssi/header.php"); 
	 
	 /*
	  * When called by all-regressions.php the regressionID is passed via id.
	  * When called by display-text.php the scriptID is passed via id.
	  */
	 $scriptID  = $_GET['id'];
	 $cmd       = $_GET['cmd'];
	 $type      = $_GET['type'];
	 $name      = $_GET['name'];
	 $debug     = $_GET['debug'];
	 
	 
	 $output  = "\n<div id=\"leftSideBar\">\n";
	 if ($cmd != '3' || ($cmd == '3' && $type == 'display' )) {
	 	
		 $output .= "<h2>Listings</h2>\n";
		 $output .= "<ul>\n";
		 $output .= "<li><a href=\"display-text-data.php?&cmd=1&id=$scriptID&type=display&name=$name\">Source Listing</a></li>\n";
		 $output .= "<li><a href=\"display-text-data.php?&cmd=2&id=$scriptID&type=display&name=$name\">Run Log</a></li>\n";
		 $output .= "<li><a href=\"display-text-data.php?&cmd=3&id=$scriptID&type=display&name=$name\">RTS</a></li>\n";
		 $output .= "</ul>\n";
		 
		 $output .= "<h2>Test Artifacts:</h2><ul>\n";
		 
		 $output .= "<li><a href=\"display-text-data.php?&cmd=4&id=$scriptID&type=display&name=$name\">Expected Files</a></li>\n";
		 $output .= "<li><a href=\"display-text-data.php?&cmd=5&id=$scriptID&type=display&name=$name\">Current Files</a></li>\n";
		 $output .= "<li><a href=\"display-text-data.php?&cmd=6&id=$scriptID\">Difference Files</a></li>\n";
		 
		 $output .= "<div class=\"clear\">&nbsp;</div>\n";
		 $output .= "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"history.go(-1);\"> </INPUT> \n";
		 $output .= "</div>\n";
	 } else {
	 	$output .= "<div class=\"clear\">&nbsp;</div>\n";
	 	$output .= "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"history.go(-1);\"> </INPUT> \n";
	 	$output .= "</div>\n";
	 }
	 /* write the navigation html */
	 $output .= "<div id=\"mainContent\">\n";
	 echo $output;
	 /* clear the buffer */
	 $output = " ";


	 /*
	  * if we were called by rts-display then
	  * get the productID so we can setup the back button to call all-regressions 
	  */
	 if ($cmd == 3 ) {

	    $regID     = getRegressionIDByScriptID($scriptID);

        echo "<div>";
        if ($type == 'display') {
        	displayTextData($regID, $cmd, $type, $name);
        } else {
        	displayTextData($scriptID, $cmd, $type, $name);
        }       
        echo "</div>";
	 } else { 
	 	displayTextData ($scriptID, $cmd, $type, $name); 
	 }  
	echo "</div>\n";  
	echo $output;		
	include("ssi/footer.php");  

